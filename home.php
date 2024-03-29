 <?php
    # Access session.
    session_start() ;
    # Redirect if not logged in.
    if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

    echo "<p>Welcome to MK Time Brand, {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
    $page_title = 'home' ;

    # Open database connection.
    require ( 'connect_db.php' ) ;
    include ('header.php')
    ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="style/style.css">-->
    <style>
        /* You can also add custom styles here if needed */
        body {
            background-color: #ee8309; /* Set the desired background color */
            color: #000000; /* Set the text color */
        }

    </style>

    <title>Home</title>
</head>

<body>

<h1 class="text-center">Joy of watching the time</h1>

<!-- Subtitle -->
<div class="col-lg-6 mx-auto text-center"><p class="lead mb-4">Nature theme Swiss unisex watches made from ethically sourced recyclable materials</p></div>

<!-- Main block for the features and Cards-->
<div class="overflow-hidden" style="max-height: 30vh;">
    <div class="container px-5">

        <!-- Main picture -->
        <div class="text-center"><img src="img/naturewatch.webp" class="img-fluid border rounded-3 shadow-lg mb-4 mx-auto" alt="Example image" width="600" height="500" loading="lazy"></div>
        <!-- WHY US? -->
        <h2 class="pb-2 border-bottom text-center">Why would you spend time with us?</h2>

        <!-- Row for the features -->
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">

            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#collection"></use></svg>
                </div>
                <h3 class="fs-2 text-body-emphasis"><img src="img/handshake1.jpg" width="225" alt="Professional Photo" class="img-fluid"> Professional</h3>
                <p>We guarantee quick and efficient service whether you buy a watch for yourself or a loved one. We understand that watches are not just a piece of jewellery but potential lifelong companions therefore, we strive to offer you a pleasant experience starting from selecting your watch to your doorstep delivery.</p>
            </div>

            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"></use></svg>
                </div>
                <h3 class="fs-2 text-body-emphasis"><img src="img/tree1.jpg" width="225" alt="Eco Friendly Photo" class="img-fluid"> Eco Friendly
                </h3>
                <p>All our products are made from ethically sourced recycled materials from Swiss farmers, we believe that sustainability creates true beauty!</p>
            </div>

            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"></use></svg>
                </div>
                <h3 class="fs-2 text-body-emphasis"><img src="img/heart2.jpg" width="225" alt="Personal Touch Photo" class="img-fluid"> Personal Touch</h3>

                <p>We are a family business, and creating watches is our passion, all our products are inspired by our daily encounters with the nature which we love.</p>
            </div>
        </div>
    </div>


        <!-- Main Container for the cards -->
    <div class="container">

        <div class="text-center pb-2 border-bottom"><h1> Watches: </h1></div><br>

            <!-- Cards -->

            <?php

            echo '<div class="row mb-5">';

            # Retrieve movies from 'movie' database table.
            $q = "SELECT * FROM products" ;
            $r = mysqli_query( $link, $q ) ;
            if ( mysqli_num_rows( $r ) > 0 )
            {
                while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
# Display card section.
                    echo '
      <div class="col-md-4">
        <div class="card">
          <img src=' . $row['item_img'] . ' width="100" height="100" class="card-img-top" alt="..." width="200" height="100">
          <div class="card-body bg-success"><h5 class="card-title"><strong>' . $row['item_name'] . '</strong></h5>
            <p class="card-text">' . $row['item_desc'] . '</p>
            <p class="card-text">Price: <strong>' . $row['item_price'] . '</strong></p>
            <a href="added.php?id='.$row['item_id'].'" class="btn btn-sm btn-primary">Add to Cart</a>
          </div>
        </div><br>
      </div>
      ';
                }
                # Close database connection.
                mysqli_close( $link) ;
            }
            # Or display message.
            else { echo '<p>There are currently no items in the table to display.</p>
	'; }
            echo '</div>';
            include ('footer.html')
            ?>
        </div>

</body>
</html>

	
	