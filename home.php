<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/style.css">
    <style>
        /* You can also add custom styles here if needed */
        body {
            background-color: #ee8309; /* Set the desired background color */
            color: #000000; /* Set the text color */
        }
    </style>

    <title>Hello, world!</title>
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg" navbar style="background-color: #25a75f;">
    <a class="navbar-brand text-dark" href="home.php">
        <img src="img/icon.jpg" width="50" alt="MK Watches Logo" class="img-fluid">
    </a> MK watches

    <!-- Responsive menu button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
                <a class="nav-link text-dark" href="home.php">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link text-dark" href="#">Our products <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link text-dark" href="logout.php">Logout <span class="sr-only">(current)</span></a>
            </li>

        </ul>
    </div>
</nav>

<h1 class="text-center">Joy of watching the time</h1>

<!-- Subtitle -->
<div class="col-lg-6 mx-auto"><p class="lead mb-4">Nature theme Swiss unisex watches made from ethically sourced recyclable materials</p></div>

<!-- Main block for the features and Cards-->
<div class="overflow-hidden" style="max-height: 30vh;">
    <div class="container px-5">

        <!-- Main picture -->
        <div class="text-center"><img src="img/imgBrand.jpg" class="img-fluid border rounded-3 shadow-lg mb-4 mx-auto" alt="Example image" width="600" height="500" loading="lazy"></div>
        <!-- WHY US? -->
        <h2 class="pb-2 border-bottom">Why would you spend time with us?</h2>

        <!-- Row for the features -->
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">

            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#collection"></use></svg>
                </div>
                <h3 class="fs-2 text-body-emphasis"><img src="img/m2.jpg" width="100" alt="Professional Photo" class="img-fluid"> Professional</h3>
                <p>We guarantee quick and efficient service whether you buy a watch for yourself or a loved one. We understand that watches are not just a piece of jewellery but potential lifelong companions therefore, we strive to offer you a pleasant experience starting from selecting your watch to your doorstep delivery.</p>
            </div>

            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"></use></svg>
                </div>
                <h3 class="fs-2 text-body-emphasis"><img src="img/w1.jpg" width="160" alt="Eco Friendly Photo" class="img-fluid"> Eco Friendly
                </h3>
                <p>All our products are made from ethically sourced recycled materials from Swiss farmers, we believe that sustainability creates true beauty!</p>
            </div>

            <div class="feature col">
                <div class="feature-icon d-inline-flex align-items-center justify-content-center text-bg-primary bg-gradient fs-2 mb-3">
                    <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"></use></svg>
                </div>
                <h3 class="fs-2 text-body-emphasis"><img src="img/w3.jpg" width="160" alt="Personal Touch Photo" class="img-fluid"> Personal Touch
                </h3>
                <p>We are a family business, and creating watches is our passion, all our products are inspired by our daily encounters with the nature which we love.</p>
            </div>

        </div>
    </div>


    <!-- Main Container for the cards -->

    <div class="text-center pb-2 border-bottom"><h1> Watches: </h1></div><br>

    <div class="container">
        <!-- Cards -->
        <div class="row mb-5">

            <?php
            # Redirect if not logged in.
            if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

            # Access session.
            session_start() ;

            # Open database connection.
            require ( 'connect_db.php' ) ;

            # Retrieve movies from 'movie' database table.
            $q = "SELECT * FROM view_items" ;
            $r = mysqli_query( $link, $q ) ;
            if ( mysqli_num_rows( $r ) > 0 )
            {
                while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
# Display card section.
                    echo '
      <div class="col-md-4">
        <div class="card">
          <img src=' . $row['item_img'] . ' width="100" height="200" class="card-img-top" alt="..." width="200" height="200">
          <div class="card-body bg-success"><h5 class="card-title"><strong>' . $row['item_name'] . '</strong></h5>
            <p class="card-text">' . $row['item_desc'] . '</p>
            <p class="card-text">Price: <strong>' . $row['item_price'] . '</strong></p>
            <a href="checkout.php" class="btn btn-sm btn-primary">Add to cart</a>
          </div>
        </div><br><br>
      </div>
      ';
                }
            }
            ?>
        </div>
    </div>

    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">© 2024 MK Watches</p>
        <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        </a>
        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="home.php" class="nav-link px-2 text-dark">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-dark">Our products</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link px-2 text-dark">Logout</a></li>
        </ul>
    </footer>
</body>
</html>
