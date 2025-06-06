<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <div class="container-fluid" style="background-color: rgba(231, 181, 70, 1);">
        <div class="row ">
            <div class="col-12 text-center ">
                <div class="row mb-3 mt-3 ">
                    <div class="offset-4 offset-lg-1 col-4 col-lg-1 logo2" style="height: 80px; margin-top: -5px; cursor:pointer;" onclick="home();"></div>
                    <div class="col-12 col-lg-6">
                        <div class="input-group mb-4 mt-4">
                            <span id="kw" class="form-control" type="text" placeholder="Search Products..." aria-label="Text input with dropdown button"></span>
                            <span class="form-select" style="max-width: 250px;" id="c">
                                <option value="">All Categories</option>
                            </span>
                            <span class="btn" style="background-color: #f26522;"><i class="bi bi-search"></i></span>
                        </div>
                    </div>
                    <div class="col-12 col-lg-2 mt-1 mt-lg-4 text-center text-lg-start">
                        <div class="d-flex align-items-center">
                            <a href="advancedSearch.php" class="text-decoration-none link-secondary fw-bold me-2">
                                <button class="btn btn-warning">Advance</button>
                            </a>
                            <ul class="list-unstyled d-flex m-0">
                                <li class="me-2">

                                    <?php

                                    if (isset($_SESSION["u"])) {
                                        $session_data = $_SESSION["u"];

                                        if (isset($_SESSION["u"])) {
                                            $umail = $_SESSION["u"]["email"];

                                            $rs = Database::search("SELECT SUM(`qty`) as total_qty FROM `cart` WHERE `users_email`='" . $umail . "'");

                                            if ($rs->num_rows > 0) {
                                                $cart_data = $rs->fetch_assoc();
                                                $total_qty = $cart_data['total_qty'] ? $cart_data['total_qty'] : 0;
                                            } else {
                                                $total_qty = 0;
                                            }
                                        }
                                    ?>
                                        <a href="cart.php" class="text-decoration-none link-secondary fw-bold notification">
                                            <button class="btn" style="display: flex; align-items: center;">
                                                <i class="bi bi-cart-fill" style="color: #f26522;"></i>&emsp;
                                                <span class="padding_10" style="color: white;">CART</span>
                                                <span id="cart-badge" style="position: absolute; top: -10px; right: 48px; padding: 0.5px 5px ; border-radius: 50%;background: red; color: white;"><?php echo $total_qty; ?></span>
                                            </button>
                                        </a>
                                    <?php

                                    } else {
                                    ?>
                                        <a href="signIn.php" class="text-decoration-none link-secondary fw-bold notification">
                                            <button class="btn" style="display: flex; align-items: center;">
                                                <i class="bi bi-cart-fill" style="color: #f26522;"></i>&emsp;
                                                <span class="padding_10" style="color: white;">CART</span>
                                            </button>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </li>
                                <?php

                                if (isset($_SESSION["u"])) {
                                    $session_data = $_SESSION["u"];
                                ?>
                                    <li class="me-2">
                                        <a href="myAccount.php" class="text-decoration-none link-secondary fw-bold">
                                            <button class="btn" style="display: flex; align-items: center;">
                                                <i class="bi bi-person-fill" style="color: #f26522;"></i>&emsp;
                                                <span class="padding_10" style="color: black; font-weight: bold; text-transform: uppercase;"><?php echo $session_data["fname"]; ?></span>
                                            </button>
                                        </a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="me-2">
                                        <a href="signIn.php" class="text-decoration-none link-secondary fw-bold">
                                            <button class="btn" style="display: flex; align-items: center;">
                                                <i class="bi bi-person-fill" style="color: #f26522;"></i>&emsp;
                                                <span class="padding_10" style="color: white;">ACCOUNT</span>
                                            </button>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                                <div>
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="resources/toggle-icon.png" style="height: 20px; margin-top: -4px;"></button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="index.php"> <i class="bi bi-house-door-fill"></i>
                                                &emsp;Home</a></li>
                                        <li><a class="dropdown-item" href="whishlist.php"><i class="bi bi-chat-heart-fill"></i>
                                                &emsp;Watchlist</a></li>
                                        <li><a class="dropdown-item" href="purchasedHistory.php"><i class="bi bi-bag-heart-fill"></i>
                                                &emsp;Purchased History</a></li>
                                        <li><a class="dropdown-item" href="Contact.php"><i class="bi bi-person-lines-fill"></i>
                                                &emsp;Contact</a></li>
                                        <?php

                                        if (isset($_SESSION["u"])) {
                                            $session_data = $_SESSION["u"];
                                        ?>
                                            <li><a class="dropdown-item" href="#" onclick="signoutH();"><i class="bi bi-door-open-fill"></i></i>&emsp;Log out</a></li>
                                        <?php
                                        } else {
                                        ?>
                                            <li><a class="dropdown-item" href="signIn.php"><i class="bi bi-door-open-fill"></i>&emsp;Login</a></li>
                                            <li><a class="dropdown-item" href="signUp.php"><i class="bi bi-r-circle-fill"></i>
                                                    &emsp;Register</a></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>