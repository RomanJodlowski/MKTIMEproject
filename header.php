<?php

echo '

<!-- Navbar -->
<nav class="navbar navbar-expand-lg" navbar style="background-color: #25a75f;">
    <a class="navbar-brand text-dark" href="home.php">
        <img src="img/naturewatch.webp" width="50" alt="MK Watches Logo" class="img-fluid">
    </a> MK watches

    <!-- Responsive menu button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars" style="font-size:24px"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
                <a class="nav-link text-dark" href="home.php">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
                 <a class="nav-link text-dark" href="cart.php">Cart <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link text-dark" href="logout.php">Logout <span class="sr-only">(current)</span></a>
            </li>

        </ul>
    </div>
</nav>';
?>