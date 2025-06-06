<?php
include "connection.php";
session_start();



if (isset($_GET["id"])) {

    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,
    product.category_id,product.model_has_brand_id,product.condition_condition_id,
    product.status_status_id,product.users_email,model.model_name AS mname,brand.brand_name AS bname FROM 
    `product` INNER JOIN `model_has_brand` ON model_has_brand.id=product.model_has_brand_id INNER JOIN 
    `brand` ON brand.brand_id=model_has_brand.brand_brand_id INNER JOIN `model` ON 
    model.model_id = model_has_brand.model_model_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {

        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $product_data["title"] ?> | X-flax </title>
            <link rel="stylesheet" href="css/style.css" />
            <link rel="icon" href="resources/logo.svg" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        </head>

        <body>

            <?php require "header.php"; ?>

            <div class="container-fluid">
                <div class="row">
                    <div class="offset-lg-0 col-10 offset-1 col-lg-6 bg-body rounded mb-3 border border-primary mt-4 ms-lg-4 ">
                        <div class="row mt-5 mb-5 justify-content-center">

                            <?php
                            $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");

                            if ($image_rs->num_rows > 0) {

                                $first_image = $image_rs->fetch_assoc();
                                $first_image_url = $first_image['img_path'];

                            ?>

                                <div class="col-12 col-md-8 col-lg-6 mt-2">
                                    <div class="rounded mt-lg-4 mb-1" style="width: 100%;">
                                        <img src="<?php echo $first_image_url; ?>" class="card-img-top img-thumbnail zoom2" id="mainImg" style="width: 100%; height: auto;">
                                    </div>
                                </div>
                            <?php
                            }        ?>

                        </div>

                    </div>
                    <div class="offset-lg-1 col-10 offset-1 col-lg-4 bg-body rounded mb-3 border border-primary mt-4  ">
                        <div class="row mt-2 mb-3 justify-content-center">
                            <div class="text-start mb-2">
                                <a href="index.php">
                                    <span class="badge rounded-pill text-bg-success " style="width:60px;">Home</span></a>
                                <span class="text-dark" style="font-weight: bold;">/ Single Product View</span>
                            </div>
                            <hr class="border border-1 border-primary">

                            <div class="text-center">
                                <p style="font-size:28px;font-weight:bold" class="text-dark"><?php echo $product_data["title"]; ?></p>
                            </div>
                            <div class="text-center">
                                <span class="fa fa-star checked" style="margin-right: 10px; font-size:19px"></span>
                                <span class="fa fa-star checked" style="margin-right: 10px; font-size:19px"></span>
                                <span class="fa fa-star checked" style="margin-right: 10px; font-size:19px"></span>
                                <span class="fa fa-star" style="margin-right: 10px;font-size:19px"></span>
                                <span class="fa fa-star" style="margin-right: 10px; font-size:19px"></span>
                            </div>
                        </div>

                        <?php

                        $price = $product_data["price"];
                        $adding_price = ($price / 100) * 10;
                        $new_price = $price + $adding_price;
                        $difference = $new_price - $price;


                        if ($product_data["qty"] <= 0) {
                        ?>
                            <div class="text-center">
                                <p style="font-size:20px; font-weight:bold;" class="text-danger">Out of Stock</p>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="text-center">
                            <p class="text-success fw-bold" style="font-size:30px;">Rs. <?php echo $price; ?> .00</p>
                        </div>
                        <div class="row">
                            <div class="text-center col-4 offset-lg-1 text-decoration-line-through text-decoration-danger">
                                <p class="text-danger fw-bold" style="font-size:20px;">Rs. <?php echo $new_price; ?> .00</p>
                            </div>
                            <div class="text-center col-8  col-lg-6">
                                <p class="text-secondary fw-bold" style="font-size:20px;">Save Rs. <?php echo $difference; ?> .00 (10%)</p>
                            </div>
                        </div>


                        <hr class="border border-1 border-primary row">

                        <div class="row mb-4 p-3 ">

                            <div class="col-lg-1 col-1 offset-lg-1 offset-1">
                                <label class="form-label fw-bold" style="font-size: 18px;">Quantity:</label>
                            </div>
                            <div class="col-lg-3 col-3 offset-lg-2 offset-2">
                                <input type="number" class="form-control border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="qty_input" value="1" oninput='checkValue( this, 1, <?php echo $product_data["qty"]; ?>);' min="1" />
                            </div>
                            <div class="col-lg-4 ms-lg-4 col-5 ">
                                <p class="text-success fw-bold"><?php echo $product_data["qty"]; ?> Items Available</p>
                            </div>
                            <div class="mt-5">
                                <div class="col-12 d-grid mb-2">
                                    <button class="btn btn-success" style="border-radius: 20px;" type="submit" id="payhere-payment" onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                                </div>
                                <?php if ($product_data["qty"] > 0) { ?>
                                    <div class="col-12 d-grid mb-2">
                                        <button class="btn btn-warning fw-bold" style="border-radius: 20px;" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add to Cart</button>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-12 d-grid mb-2">
                                        <button class="btn btn-warning fw-bold" style="border-radius: 20px;">Add to Cart</button>
                                    </div>
                                <?php } ?>
                                <div class="col-12 d-grid">
                                    <button class="btn btn-dark " style="border-radius: 20px;" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">Add to Watchlist</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-10 offset-1 offset-lg-0 col-lg-6 bg-body-light rounded border border-1 border-primary ms-lg-4  p-1">

                        <div class="row justify-content-center mt-2 mb-2">


                            <?php
                            $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                            $image_num = $image_rs->num_rows;
                            $img = array();

                            if ($image_num != 0) {
                                for ($x = 0; $x < $image_num; $x++) {
                                    $image_data = $image_rs->fetch_assoc();
                                    $img[$x] = $image_data["img_path"];

                            ?>
                                    <div class="col-lg-1" style="width:18rem;">
                                        <img src="<?php echo $img[$x]; ?>" class="img-thumbnail" id="productImg<?php echo $x; ?>" onclick="loadMainImg(<?php echo $x; ?>);">
                                    </div>

                            <?php

                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="col-10 offset-1 offset-lg-1 col-lg-4 bg-body-light rounded border border-1 border-primary  p-1 mt-3 mt-lg-0">

                        <div class="row justify-content-center mt-2 mb-2">

                            <div class="row">
                                <div class="mb-3 fw-bold text-dark col-lg-2 col-3 fs-5">
                                    <label for="" style="font-size: 20px;"><u>Delivery</u> </label>
                                </div>

                            </div>
                            <div class="row">

                                <div class="mb-3 col-6 text-dark col-lg-5 col-3 fs-5 offset-lg-1 offset-1">
                                    <label for="" style="font-size: 15px;">Delivery fee Colombo :</label>
                                </div>
                                <div class="col-lg-3 col-3 offset-lg-0 ">
                                    <p class="text-success fw-bold">Rs. <?php echo $product_data["delivery_fee_colombo"]; ?> .00</p>
                                </div>

                            </div>
                            <div class="row">

                                <div class="mb-2 col-6  text-dark col-lg-4 col-3 fs-5 offset-lg-1 offset-1">
                                    <label for="" style="font-size: 15px;">Delivery fee Other :</label>
                                </div>
                                <div class="col-lg-3 col-3 offset-lg-1">
                                    <p class="text-success fw-bold">Rs. <?php echo $product_data["delivery_fee_other"]; ?> .00</p>
                                </div>

                            </div>
                            <div class="row">
                                <div class="mb-3 fw-bold text-dark col-lg-2 col-3 fs-5">
                                    <label for="" style="font-size: 20px;"><u>Payment</u> </label>
                                </div>
                            </div>
                            <div class="row">

                                <div class="offset-2 offset-lg-2 col-2 pm pm1"></div>
                                <div class="col-2 pm pm2"></div>
                                <div class="col-2 pm pm3"></div>
                                <div class="col-2 pm pm4"></div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-10 offset-1 col-lg-6 bg-body rounded mb-3 border border-primary mt-3 ms-lg-4">
                        <div class="row mt-2 mb-3 justify-content-center">

                            <div class="text-start mb-2">
                                <span class="text-dark" style="font-weight: bold;font-size: 18px;">Product Details</span>
                            </div>
                            <hr class="border border-1 border-primary">
                            <div class="row">
                                <div class="mb-3 fw-bold text-dark col-lg-2 col-3">
                                    <label for="">Brand :</label>
                                </div>
                                <div class="col-lg-6 col-6 offset-1 offset-lg-0">
                                    <p class="text-success fw-bold"><?php echo $product_data["bname"]; ?></p>
                                </div>

                            </div>

                            <hr class="border border-1 border-primary">
                            <div class="row">
                                <div class="mb-3 fw-bold text-dark col-lg-2 col-3">
                                    <label for="">Model :</label>
                                </div>
                                <div class="col-lg-6 col-6 offset-lg-0 offset-1">
                                    <p class="text-success fw-bold"><?php echo $product_data["mname"]; ?></p>
                                </div>

                            </div>

                            <?php

                            $product_rs =  Database::search("SELECT `condition`.`condition_name`
                          FROM `product`
                          INNER JOIN `condition` ON `product`.`condition_condition_id` = `condition`.`condition_id`
                          ");
                            $product_num = $product_rs->num_rows;

                            $product_data = $product_rs->fetch_assoc();

                            ?>

                            <hr class="border border-1 border-primary">
                            <div class="row">
                                <div class="mb-3 fw-bold text-dark col-lg-2 col-3">
                                    <label for="">Condition :</label>
                                </div>
                                <div class="col-lg-6 offset-lg-0 col-6 offset-1">
                                    <p class="text-success fw-bold"><?php echo $product_data["condition_name"] ?></p>
                                </div>
                            </div>

                            <hr class="border border-1 border-primary">
                            <div class="row">
                                <div class="mb-3 fw-bold text-dark col-lg-2 col-3">
                                    <label for="">Warrenty :</label>
                                </div>
                                <div class="col-lg-6 offset-lg-0 col-6 offset-1">
                                    <p class="text-success fw-bold">6 Months Warrenty</p>
                                </div>
                            </div>
                            <hr class="border border-1 border-primary">
                            <div class="row">
                                <div class="mb-3 fw-bold text-dark col-lg-2 col-4">
                                    <label for="">Return Policy :</label>
                                </div>
                                <div class="col-lg-10 col-6 ">
                                    <p class="text-success fw-bold">1 Months Return Policy</p>
                                </div>
                            </div>
                            <hr class="border border-1 border-primary">
                            <div class="row">
                                <div class="mb-3 mt-2 fw-bold text-dark col-lg-2 col-4">
                                    <label for="">Description :</label>
                                </div>
                                <div class="col-lg-10 col-8 mt-2">

                                    <?php

                                    $rs = Database::search("SELECT `description` FROM `product` WHERE `id`='$pid'");
                                    $product_num = $rs->num_rows;

                                    $product_data = $rs->fetch_assoc();

                                    ?>
                                    <p class="text-success fw-bold"> <?php echo $product_data["description"]; ?></p>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-12 col-lg-10 bg-body rounded mb-3 border border-primary mb-4 offset-lg-1">
                    <div class="text-center mt-4 mb-4">
                        <div class="row gap-5 justify-content-center">
                            <?php
                            include_once("connection.php");

                            if (isset($_GET["id"])) {
                                $pid = $_GET["id"];

                                $product_rs = Database::search("SELECT * FROM product WHERE id='" . $pid . "'");
                                $product_data = $product_rs->fetch_assoc();

                                if ($product_data) {
                                    $related_rs = Database::search("SELECT * FROM product WHERE category_id='" . $product_data["category_id"] . "' LIMIT 4");

                                    while ($related_data = $related_rs->fetch_assoc()) {
                                        $related_img_rs = Database::search("SELECT * FROM product_img WHERE product_id='" . $related_data["id"] . "'");
                                        $related_img_data = $related_img_rs->fetch_assoc();
                            ?>
                                        <div class="card col-12 col-md-5 col-lg-2 mt-2 mb-2" style="width: 18rem;">
                                            <span class="badge rounded-pill text-bg-warning align-self-end" style="width:40px">New</span>
                                            <img src="<?php echo $related_img_data["img_path"]; ?>" class="card-img-top img-thumbnail mt-4 zoom" style="height: 180px" onclick="sendsingelProductid(<?php echo $related_data['id']; ?>);" />
                                            <div class="card-body ms-0 m-0 text-center">
                                                <h5 class="card-title fw-bold fs-6"><?php echo $related_data["title"]; ?></h5>
                                                <span class="card-text text-primary">Rs. <?php echo $related_data["price"]; ?>.00</span><br />
                                                <?php
                                                if ($related_data["qty"] > 0) {
                                                ?>
                                                    <span class="card-text text-warning fw-bold">In Stock</span><br />
                                                    <span class="card-text text-success fw-bold"><?php echo $related_data["qty"]; ?> Items Available</span><br />
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                    <div class="row">
                                                        <a href="<?php echo "singleProductView.php?id=" . $related_data["id"]; ?>" class="col-4 btn btn-outline-warning mt-2 border border-dark"><i class="bi bi-bag-fill text-dark fs-5"></i></a>
                                                        <button class="col-4 btn btn-outline-warning mt-2 border border-dark" onclick="addToCart(<?php echo $related_data['id']; ?>);">
                                                            <i class="bi bi-cart-fill text-dark fs-5"></i>
                                                        </button>
                                                    <?php


                                                } else {
                                                    ?>
                                                        <span class="card-text text-danger fw-bold">Out of Stock</span><br />
                                                        <span class="card-text text-success fw-bold"><?php echo $related_data["qty"]; ?> Items Available</span><br />
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star checked"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <div class="row">
                                                            <a href="<?php echo "singleProductView.php?id=" . $related_data["id"]; ?>" class="col-4 btn btn-outline-warning mt-2 border border-dark"><i class="bi bi-bag-fill text-dark fs-5"></i></a>
                                                            <button class="col-4 btn btn-outline-warning mt-2 border border-dark">
                                                                <i class="bi bi-cart-fill text-dark fs-5"></i>
                                                            </button>

                                                        <?php
                                                    }
                                                        ?>
                                                        <button class="col-4 btn btn-outline-warning mt-2 border border-dark" onclick="addToWatchlist(<?php echo $related_data['id']; ?>);">
                                                            <i class="bi bi-heart-fill text-dark fs-5" id="heart<?php echo $related_data["id"]; ?>"></i>
                                                        </button>
                                                        </div>
                                                    </div>
                                            </div>
                                <?php
                                    }
                                } else {
                                    echo "No product found.";
                                }
                            } else {
                                echo "Product ID not set.";
                            }
                                ?>
                                        </div>
                        </div>
                    </div>

                </div>

                <?php include "footer.php"   ?>
                <script src="js/script.js "></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>

<?php

    } else {
        echo ("Sorry for the inconvenience.Please try again later.");
    }
} else {
    echo ("Something Went Wrong.");
}

?>