<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">-->
    <!--      <link rel="stylesheet" href="style/style.css">-->
    <style>
        /* You can also add custom styles here if needed */
        body {
            background-color: #ee8309; /* Set the desired background color */
            color: #000000; /* Set the text color */
        }
    </style>

    <title>Index</title>
</head>

<body class="text-center">
<div class="container">

<?php # DISPLAY SHOPPING CART PAGE.

session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

//include ('');

# Check for passed total and cart.
if ( isset( $_GET['total'] ) && ( $_GET['total'] > 0 ) && (!empty($_SESSION['cart']) ) ) {

# Open database connection.
    require('connect_db.php');

# Store buyer and order total in 'orders' database table.
    $q = "INSERT INTO orders ( user_id, total, order_date ) VALUES (" . $_SESSION['user_id'] . "," . $_GET['total'] . ", NOW() ) ";
    $r = mysqli_query($link, $q);

# Retrieve current order number.
    $order_id = mysqli_insert_id($link);

# Retrieve cart items from 'products' database table.
    $q = "SELECT * FROM products WHERE item_id IN (";
    foreach ($_SESSION['cart'] as $id => $value) {
        $q .= $id . ',';
    }
    $q = substr($q, 0, -1) . ') ORDER BY item_id ASC';
    $r = mysqli_query($link, $q);

# Store order contents in 'order_contents' database table.
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        $query = "INSERT INTO order_content ( order_id, item_id, quantity, price )
    VALUES ( $order_id, " . $row['item_id'] . "," . $_SESSION['cart'][$row['item_id']]['quantity'] . "," . $_SESSION['cart'][$row['item_id']]['price'] . ")";
        $result = mysqli_query($link, $query);
    }
}


# Retrieve order from 'order_contents' database table.
    $q = "SELECT * FROM orders ORDER BY order_id DESC LIMIT 1";
    $r = mysqli_query($link, $q);
    if (mysqli_num_rows($r) > 0) {
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
            echo '
<h1 class="display-4 text-muted">Proceed Order</h1>
				<hr class="bg-info">
			</div><span style="color:white">
			<div class="table-responsive">
				<table class="table">
				<thead class="thead-dark">
				<tr>
				<th scope="col"> Order ID</th>
				<th scope="col"> Price</th>
				<th scope="col"> Date of Purchase</th>
				</tr>
				</thead>
				</span>
				<tbody>
			<tr>
			<td>' . $order_id . '</td>
			<td>' . $row['total'] . '</td>
			<td>' . date("Y.m.d") . '</td>
';
# Close database connection.
            mysqli_close($link);

            echo '
<div id="paypal-button-container"></div>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    // Render the PayPal button
    paypal.Button.render({
// Set your environment
        env: \'sandbox\', // sandbox | production

// Specify the style of the button
        style: {
            layout: \'vertical\',  // horizontal | vertical
            size:   \'medium\',    // medium | large | responsive
            shape:  \'rect\',      // pill | rect
            color:  \'gold\'       // gold | blue | silver | white | black
        },

        funding: {
            allowed: [
                paypal.FUNDING.CARD,
                paypal.FUNDING.CREDIT
            ],
            disallowed: []
        },

// Enable Pay Now checkout flow (optional)
        commit: true,

// PayPal Client IDs - replace with your own

        client: {
            sandbox: \'AeClmmvlaMBi5VLuTM5qkVY6C9s8fUf5lK_Py4Pa4kfaD9SL4blXrKgBPlSsqa5nKtIRoVh3CyZt8CeX\',
            production: \'<insert production client id>\'
        },

        payment: function (data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: {
                                total: ' . $row['total'] . ',
                                currency: \'GBP\'
                            }
                        }
                    ]
                }
            });
        },

        onAuthorize: function (data, actions) {
            return actions.payment.execute()
                .then(function () {
                    window.alert(\'Payment Complete!\');window.location.href = "home.php";
                });
        }
    }, \'#paypal-button-container\');
</script>
';
        }
        # Remove cart items.
        $_SESSION['cart'] = NULL ;
    }
    # Or display a message.
    else { echo '<p>There are no items in your cart.</p> ' ; include ('footer.html');}
?>
</div>
<!--John-->
<!--First name:-->
<!--Doe-->
<!--Last name:-->
<!--sb-7rd1c25073343@personal.example.com-->
<!--Email ID:-->
<!--Qb[L0V$p-->
<!--password-->

<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>