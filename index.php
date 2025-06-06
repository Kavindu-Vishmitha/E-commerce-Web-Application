<?php

session_start();

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>

    <title> Home | X-flax</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="banner_bg_main">
                <div class="col-12">
                    <div class="header_section_top fixed-top ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="custom_menu">
                                    <ul>
                                        <li><a href="index.php">Home</a>&emsp;|</li>

                                        <li><a href="whishlist.php">Watchlist</a>&emsp;|</li>
                                        <li><a href="purchasedHistory.php">Purchased History</a>&emsp;|</li>
                                        <li><a href="Contact.php">Contact</a></li>

                                        <?php

                                        if (isset($_SESSION["u"])) {
                                            $session_data = $_SESSION["u"];

                                        ?>

                                        <?php

                                        } else {
                                        ?>

                                            <li>|<a href="signIn.php">&emsp;Login</a> &emsp;or</li>
                                            <li><a href="signUp.php">Register</a></li>

                                        <?php

                                        }

                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="logo_section  mt-5 mb-3 ">
                    <div class="col-12 ">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="logo"><span><img src="resources/logo.svg" style="height:125px;" /></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header_section">
                    <div class="col-12">
                        <div class="containt_main">

                            <div id="mySidenav" class="sidenav fixed-top">
                                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                                <a href="index.php">Home</a>
                                <a href="whishlist.php">Watchlist</a>
                                <a href="purchasedHistory.php">Purchased History</a>
                                <a href="Contact.php">Contact</a>

                                <?php

                                if (isset($_SESSION["u"])) {
                                    $session_data = $_SESSION["u"];

                                ?>
                                <?php

                                } else {
                                ?>
                                    <a href="signUp.php"> Register </a>
                                    <a href="signIn.php">Login</a>
                                <?php
                                }


                                ?>

                            </div>
                            <span class="toggle_icon" onclick="openNav()"><img src="resources/toggle-icon.png"></span>
                            <div class="dropdown">
                                <a href="#" class="dropdown-item"></a>

                            </div>
                            <div class="main">

                                <div class="input-group">

                                    <input type="text" class="form-control" placeholder="Search Products...." id="kw">
                                    
                                    <div class="input-group-append">

                                        <select class="form-select" style="max-width: 250px;" id="c">
                                            <option value="0">All Categories</option>

                                            <?php

                                            $category_rs = Database::search("SELECT * FROM `category`");
                                            $category_num = $category_rs->num_rows;

                                            for ($x = 0; $x < $category_num; $x++) {

                                                $category_data = $category_rs->fetch_assoc();

                                            ?>

                                                <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>

                                            <?php

                                            }

                                            ?>

                                        </select>

                                        <button class="btn btn-secondary" type="button" onclick="basicSearch(0);" style="background-color: #f26522; border-color:#f26522">

                                            <i class="fa fa-search"></i>

                                        </button>
                                    </div>
                                </div>

                            </div>
                            <div class="header_box">
                                <div class="land_box  mt-0 mt-lg-0 text-center">
                                    <a href="advancedSearch.php" class="text-decoration-none link-secondary fw-bold"><button class="btn btn-warning">Advance</button></a>
                                </div>&emsp;
                                <div class="login_menu">
                                    <ul>

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

                                            <li><a href="cart.php" class="notification">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                    <span class="padding_10 " style="color:white;">Cart</span>
                                                    <span id="cart-badge" class="badge"><?php echo $total_qty; ?></span>
                                                </a>
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li><a href="signIn.php" class="notification">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                    <span class="padding_10 " style="color:white;">Cart</span>

                                                </a>
                                            </li>

                                        <?php
                                        }


                                        if (isset($_SESSION["u"])) {
                                            $session_data = $_SESSION["u"];

                                        ?>
                                            <li>|&nbsp;&nbsp;<a href="myAccount.php">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <span class="padding_10" style="color:black; font-weight: bold;">HI ! <?php echo $session_data["fname"] . " " . $session_data["lname"]; ?></span></a>&emsp;&emsp;&emsp;
                                            </li>

                                        <?php
                                        } else {
                                        ?>

                                            <li>|&nbsp;&nbsp;<a href="signIn.php">
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <span class="padding_10 " style="color:white;">My Account</span></a>&emsp;&emsp;&emsp;
                                            </li>
                                        <?php
                                        }
                                        ?>
                                        <?php

                                        if (isset($_SESSION["u"])) {
                                            $session_data = $_SESSION["u"];

                                        ?>
                                            <li><a href="signIn.php">
                                                    <i class="bi bi-box-arrow-right"></i>
                                                    <span class="padding_10" onclick="signout();" style="color:white;">Log Out</span></a>

                                            </li>
                                        <?php
                                        }
                                        ?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="banner_section layout_padding">
                    <div class="col-12">
                        <div id="my_slider" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h1 class="banner_taital">Wellcome to X-flax</h1><br>

                                            <div class="spinner-grow text-dark" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-dark" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-dark" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-dark" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h1 class="banner_taital">Shop Open 24 Hrs</h1><br>
                                            <div class="spinner-grow text-dark" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-dark" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-dark" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-dark" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <h1 class="banner_taital">Get start shopping</h1><br>
                                            <div class="spinner-grow text-dark" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-dark" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-dark" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-dark" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <div class="spinner-grow text-warning" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php

            $c_rs = Database::search("SELECT * FROM `category`");
            $c_num = $c_rs->num_rows;

            for ($y = 0; $y < $c_num; $y++) {

                $c_data = $c_rs->fetch_assoc();
            ?>
                <div><br />

                    <div id="basicSearchResult" class="row border border-warning">

                    </div>
                </div>
                <div class="col-12 mt-3" style="text-align-last: center;">
                    <span class="text-decoration-none text-dark fs-1 fw-bold"><?php echo $c_data["cat_name"]; ?></span>
                </div>
                <a href="#" class="text-decoration-none text-dark fs-6 fw-bold">Sell All &nbsp;&rarr;</a>

                <div class="col-12 mb-3">
                    <div class="row border border-warning">
                        <div class="col-12">
                            <div class="row justify-content-center gap-5">


                                <?php

                                $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                    `category_id`='" . $c_data['cat_id'] . "' AND `status_status_id`='1' ORDER BY 
                                    `datetime_added` DESC LIMIT 5 OFFSET 0");

                                $product_num = $product_rs->num_rows;

                                for ($x = 0; $x < $product_num; $x++) {
                                    $product_data = $product_rs->fetch_assoc();

                                ?>

                                    <div class="card col-12 col-lg-2 mt-2 mb-2" style="width: 18rem;">

                                        <?php

                                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                            `product_id`='" . $product_data['id'] . "'");

                                        $img_data = $img_rs->fetch_assoc();


                                        ?>
                                        <span class="badge rounded-pill text-bg-warning align-self-end" style="width:40px;">New</span>

                                        <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-4 zoom" style="height: 180px " onclick="sendsingelProductid(<?php echo $product_data['id']; ?>);" />

                                        <div class="card-body ms-0 m-0 text-center">
                                            <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>
                                            <span class="card-text text-primary">Rs. <?php echo $product_data["price"]; ?> .00</span><br />

                                            <?php
                                            if ($product_data["qty"] > 0){
                                            ?>
                                                <span class="card-text text-warning fw-bold">In Stock</span></br>
                                                <span class="caed-text text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span></br>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <div class="row ">

                                                    <a href="<?php echo "singleProductView.php?id=" . ($product_data["id"]);  ?>" class=" col-4 btn btn-outline-warning mt-2 border border-dark"> <i class="bi bi-bag-fill text-dark fs-5"></i></a>


                                                    <button class="col-4 btn btn-outline-warning mt-2 border border-dark" onclick="addToCart(<?php echo $product_data['id']; ?>);">
                                                        <i class="bi bi-cart-fill text-dark fs-5"></i>
                                                    </button>
                                                <?php
                                            } else {
                                                ?>
                                                    <span class="card-text text-danger fw-bold">Out of Stock</span></br>
                                                    <span class="caed-text text-success fw-bold">0 Items Available</span></br>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <div class="row ">

                                                        <a href="<?php echo "singleProductView.php?id=" . ($product_data["id"]);  ?>" class=" col-4 btn btn-outline-warning mt-2 border border-dark"> <i class="bi bi-bag-fill text-dark fs-5"></i></a>


                                                        <button class="col-4 btn btn-outline-warning mt-2 border border-dark">
                                                            <i class="bi bi-cart-fill text-dark fs-5"></i>
                                                        </button>
                                                    <?php
                                                }
                                                    ?>

                                                    <button class="col-4 btn btn-outline-warning mt-2 border border-dark" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">
                                                        <i class="bi bi-heart-fill text-dark fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                    </button>

                                                    </div>
                                                </div>
                                        </div>

                                    <?php

                                }
                                    ?>

                                    </div>
                            </div>
                        </div>
                    </div>

                <?php

            }

                ?>

                </div>

        </div>

        <?php
        require "footer.php";
        ?>
    </div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>