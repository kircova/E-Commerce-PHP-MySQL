<!-- Nav Bar Start -->
<div class="nav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="product-list.php" class="nav-item nav-link">Products</a>
                    <a href="cart.php" class="nav-item nav-link">Cart</a>
                    <a href="checkout.php" class="nav-item nav-link">Checkout</a>
                    <a href="my-account.php" class="nav-item nav-link">My Account</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">More Pages</a>
                        <div class="dropdown-menu">
                            <a href="wishlist.php" class="dropdown-item active">Wishlist</a>
                            <a href="login.php" class="dropdown-item">Login & Register</a>
                            <a href="contact.php" class="dropdown-item">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="navbar-nav ml-auto">
                    <div class="nav-item dropdown">
                        <?php
                            // Check if the user is logged in, if not then redirect him to login page
                              if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
                              {
                                ?>
                                <a href="login.php" class="nav-item nav-link"> Welcome back, <?php echo $_SESSION["name"]?>!</a>
                                <?php
                              }
                              else
                              {
                                ?>
                                <a href="login.php" class="nav-item nav-link">Login & Register</a>
                                <?php
                              }
                            ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->
