<?php # DISPLAY SHOPPING CART PAGE.
session_start();
# Redirect if not logged in.


if (!isset($_SESSION['user_id'])) {
    require('login_tools.php');
    load();
}

# Set page title and display header section.
//include ('');

# Check if form has been submitted for update.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    # Update changed quantity field values.
    foreach ($_POST['qty'] as $item_id => $item_qty) {
        # Ensure values are integers.
        $id = (int) $item_id;
        $qty = (int) $item_qty;

        # Change quantity or delete if zero.
        if ($qty == 0) {
            unset($_SESSION['cart'][$id]);
        } elseif ($qty > 0) {
            $_SESSION['cart'][$id]['quantity'] = $qty;
        }
    }
}

# Initialize grand total variable.
$total = 0;

# Display the cart if not empty.
if (!empty($_SESSION['cart'])) {
    # Connect to the database.
    require('connect_db.php');

    # Retrieve all items in the cart from the 'products' database table.
    $q = "SELECT * FROM products WHERE item_id IN (";
    foreach ($_SESSION['cart'] as $id => $value) {
        $q .= $id . ',';
    }
    $q = substr($q, 0, -1) . ') ORDER BY item_id ASC';
    $r = mysqli_query($link, $q);

    # Display body section with a form and a table.
    echo '
  <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <style>
  body {
    background-color: #ee8309;
    color: #000000;
  }
  </style>
  </head>
  <body>
  <form action="cart.php" method="post">
			<table class="table">
				<thead>
				<tr><th>Items in your cart</th></tr>
				</thead>
				<tbody>
				<tr>';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        # Calculate sub-totals and grand total.
        $subtotal = $_SESSION['cart'][$row['item_id']]['quantity'] * $_SESSION['cart'][$row['item_id']]['price'];
        $total += $subtotal;

        # Display the row/s:
        echo "<tr>
            <td>{$row['item_name']}</td>
            <td><img src='{$row['item_img']}' width=\"100\" height=\"50\"></td>
            <td><input type=\"text\" size=\"3\" name=\"qty[{$row['item_id']}]\" value=\"{$_SESSION['cart'][$row['item_id']]['quantity']}\"></td>
            <td>@ {$row['item_price']} = </td>
            <td> &pound " . number_format($subtotal, 2) . "</td>
          </tr>";
    }

    # Close the database connection.
    mysqli_close($link);

    # Display the total.
    echo '<tr>
          <td></td>
          <td></td>
          <td></td>
          <td>Total = &pound ' . number_format($total, 2) . '</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td><input type="submit" name="submit" class="btn btn-info btn-block" value="Update My Cart"></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td><a href="checkout.php?total=' . $total . '" class="btn btn-light btn-block">Checkout Now</a></td>
  </table>
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
  <p class="col-md-4 mb-0 text-body-secondary">© 2024 MK Watches</p>
  <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
  <svg class="bi me-2" width="40" height="32">
    <use xlink:href="#bootstrap"></use>
  </svg>
  </a>
    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="home.php" class="nav-link px-2 text-dark">Home</a></li>
      <li class="nav-item"><a href="logout.php" class="nav-link px-2 text-dark">Logout</a></li>
    </ul>
  </footer>
  </form>';
} else
# Or display a message.
{ echo '
    <head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <style>
body {
    background-color: #ee8309;
    color: #000000;
  }
  </style>
  </head>
  <body>';
    include ('header.php');

    echo '<div class="alert alert-secondary" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<p>Your cart is currently empty.</p>
				</div>
		</div>';
		include ( 'footer.html' );
    echo '</body>';
}


# Display footer section.





