<?php
session_start();

include "connection.php";

if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"]["email"];



    $total = 0;
    $subtotal = 0;
    $shipping = 0;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart | X-flax</title>
        <link rel="icon" href="resources/logo.svg" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css" />

    </head>

    <?php
    include "header.php";
    ?>

    <body>

        <div class="container-fluid">

            <div class="row mt-4">

                <div class="col-lg-6 text-lg-end mt-lg-2 mt-2 col-6 text-end">
                    <span style="font-family:'Times New Roman';font-size:60px">Cart</span>
                </div>
                <div class="col-lg-6 col-6 mt-lg-4 mt-4  text-start">
                    <img src="resources/Acart.svg" style="width:65px;">
                </div>
            </div>

            <div class="col-12 col-lg-12 mb-3  bg-body ">
                <div class="row">
                    <div class="offset-lg-3 col-12 col-lg-6 mb-4 ">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-4 mb-1 input-group" style="justify-content: center;">
                                <input type="text" class="form-control border border-secondary" placeholder="Type keyword to search..." id="cs" />


                                <select class="form-select border border-secondary" style="max-width: 250px;" id="category">
                                    <option value="0">All Categories</option>
                                    <?php
                                    $category_rs = Database::search("SELECT * FROM `category`");
                                    $category_num = $category_rs->num_rows;

                                    for ($x = 0; $x < $category_num; $x++) {
                                        $category_data = $category_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $category_data["cat_id"] ?>"><?php echo $category_data["cat_name"] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <span class="btn btn-primary" onclick="cartSearch(0);"><i class="bi bi-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6 offset-3 offset-lg-5 d-grid mb-2">
                        <button class="btn btn-danger" onclick="clearA();">Clear</button>
                    </div>
                </div>
            </div>

            <div class="offset-lg-1 mb-2">
                <a href="index.php">
                    <span class="badge rounded-pill text-bg-success " style="width:60px;">Home</span></a>
                <span class="text-dark" style="font-weight: bold;">/ Cart</span>
            </div>


            <div class="offset-lg-1 col-12 col-lg-10 bg-body rounded mb-3  border border-secondary">
                <div class="row ">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center mt-4">
                        <div class="row" id="view_area">
                            <div class="offset-5 col-2 mt-5">
                                <span class="fw-bold text-black-50"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                            </div>
                            <div class="offset-lg-3 col-10 offset-1 col-lg-6 mt-3 mb-5">
                                <span class="h1 text-black-50 fw-bold">No Items Searched Yet...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row col-lg-4 offset-lg-4 col-8 offset-2 text-center mt-2">
                <div class=" d-none" id="msgD2">
                    <div class="alert alert-danger" role="alert" id="msgB2" onclick="reload();">
                    </div>
                </div>
            </div>

            <?php

            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user . "'");
            $cart_num = $cart_rs->num_rows;

            if ($cart_num == 0) {

            ?>

                <div class="offset-lg-1 col-12 col-lg-10 bg-body rounded mb-3 border border-secondary">
                    <div class="row ">
                        <div class="offset-lg-1 col-12 col-lg-10 text-center mt-4">
                            <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">

                                <div class="mt-lg-5 mb-lg-5 mt-4 mb-4">
                                    <img src="resources/add cart.png" style="width:150px;">
                                </div>
                                <div class="col-10 offset-1 col-lg-12 offset-lg-0 mt-3 mb-5">
                                    <span class="h1 text-black-50 fw-bold">No items added...</span>
                                </div>
                                <a href="index.php" class="btn btn-success fs-3 fw-bold mb-lg-5 col-6 offset-3 offset-lg-2 mb-4 col-lg-8">
                                    Start Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


            <?php



            } else {

            ?>


                <div class="row">


                    <?php

                    for ($x = 0; $x < $cart_num; $x++) {

                        $cart_data = $cart_rs->fetch_assoc();

                        $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
    product.id=product_img.product_id WHERE `id`='" . $cart_data["Product_id"] . "'");
                        $product_data = $product_rs->fetch_assoc();

                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                        $address_rs = Database::search("SELECT `district_id` AS did FROM `users_has_address` 
    INNER JOIN `city` ON users_has_address.city_city_id = city.city_id 
    INNER JOIN `district` ON city.district_district_id = district.district_id 
    WHERE `users_email`='" . $user . "'");

                        if ($address_rs->num_rows > 0) {
                            $address_data = $address_rs->fetch_assoc();
                            $ship = 0;

                            if ($address_data["did"] == 2) {
                                $ship = $product_data["delivery_fee_colombo"];
                            } else {
                                $ship = $product_data["delivery_fee_other"];
                            }

                            $shipping = $shipping + $ship;
                        } else {
                            $ship = $product_data["delivery_fee_other"];
                            $shipping = $shipping + $ship;
                        }


                        $p_rs = Database::search("SELECT color.clr_name AS color_name, `condition`.condition_name, product.title,product.price, product.description, product_img.img_path 
    FROM product 
    INNER JOIN `condition` ON `condition`.`condition_id` = product.`condition_condition_id` 
    INNER JOIN color ON product.`color_clr_id` = color.`clr_id` 
    INNER JOIN product_img ON product.id = product_img.product_id 
    WHERE product.id = '" . $cart_data["Product_id"] . "'");
                        $product_num = $p_rs->num_rows;
                        $product_data = $p_rs->fetch_assoc();
                    ?>

                        <div class="col-12 col-lg-7 bg-body-light rounded border border-1 border-primary p-4 mb-3 offset-lg-1">
                            <div class="row mb-4">
                                <span class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0 text-center d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Description ">
                                    <img src="<?php echo $product_data["img_path"]; ?>" class="img-thumbnail zoom" id="productImg"  style="max-width: 100%" />
                                </span>
                                <div class="col-12 col-md-8 col-lg-9">
                                    <h5 class="fw-bold"><?php echo $product_data["title"] ?></h5>
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-3 col-lg-2">
                                            <span>Color: <?php echo $product_data["color_name"] ?></span>
                                        </div>|
                                        <div class="col-5 col-lg-4">
                                            <span>Condition: <?php echo $product_data["condition_name"] ?></span>
                                        </div>
                                    </div>
                                    <p class="mt-2">Price: <b>Rs. <?php echo $product_data["price"] ?> .00</b></p>
                                    <div class="row align-items-center mt-2">
                                        <div class="col-4 col-md-3">
                                            <label class="form-label fw-bold">Quantity:</label>
                                        </div>
                                        <div class="col-8 col-md-5">
                                            <input type="number" class="form-control border-0 border-bottom border-2 border-warning" value="<?php echo $cart_data["qty"]; ?>" onchange="changeQTY(<?php echo $cart_data['cart_id']; ?>);" id="qty_num" value="1" min="1" />
                                        </div>
                                    </div>


                                    <p class="mt-2">Delivery fee: <b>Rs. <?php echo $ship   ?> .00</b></p>
                                </div>
                            </div>

                            <div class="row justify-content-center mb-3">
                                <div class="col-6 col-md-4 mb-2 mb-md-0">
                                    <a href="<?php echo 'singleProductView.php?id=' . $cart_data['Product_id']; ?>" class="btn btn-success w-100">Buy Now</a>
                                </div>

                                <div class="col-6 col-md-4">
                                    <button class="btn btn-danger w-100" onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);">Remove</button>
                                </div>
                            </div>

                            <hr class="border border-1 border-primary">

                            <div class="row justify-content-end">
                                <div class="col-lg-2 col-4">
                                    <p>Requested Total</p>
                                </div>=
                                <div class="col-lg-2 col-4">
                                    <p class="fw-bold">Rs. <?php echo ($product_data["price"] * $cart_data["qty"]) + $ship    ?> .00</p>
                                </div>
                            </div>
                        </div>

                    <?php
                    }

                    ?>

                    <div class="col-12 col-lg-3 ms-lg-3">
                        <div class="row">

                            <div class="col-12">
                                <label class="form-label fs-3 fw-bold">Summary</label>
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-6 mb-3">
                                <span class="fs-6 fw-bold">Items (<?php echo $cart_num; ?>)</span>
                            </div>

                            <div class="col-6 text-end mb-3">
                                <span class="fs-6 fw-bold">Rs. <?php echo $total;    ?> .00</span>
                            </div>

                            <div class="col-6">
                                <span class="fs-6 fw-bold">Shipping</span>
                            </div>

                            <div class="col-6 text-end">
                                <span class="fs-6 fw-bold">Rs. <?php echo $shipping;    ?> .00</span>
                            </div>

                            <div class="col-12 mt-3">
                                <hr />
                            </div>

                            <div class="col-6 mt-2">
                                <span class="fs-4 fw-bold">Total</span>
                            </div>

                            <div class="col-6 mt-2 text-end">
                                <span class="fs-4 fw-bold">Rs. <?php echo $total + $shipping;  ?> .00</span>
                            </div>

                            <?php

                            if (isset($_SESSION["u"])) {
                                $email = $_SESSION["u"]["email"];

                                $cart_rs = Database::search("
        SELECT 
            cart.cart_id,
            cart.qty AS cart_qty,
            cart.users_email,
            product.id AS product_id,
            product.title,
            product.price,
            product.qty AS product_qty,
            product.description,
            product.datetime_added,
            product.delivery_fee_colombo,
            product.delivery_fee_other,
            product.category_id,
            product.model_has_brand_id,
            product.condition_condition_id,
            product.status_status_id,
            product.users_email,
            model.model_name AS mname,
            brand.brand_name AS bname
        FROM cart
        INNER JOIN product ON cart.product_id = product.id
        INNER JOIN model_has_brand ON product.model_has_brand_id = model_has_brand.id
        INNER JOIN brand ON brand.brand_id = model_has_brand.brand_brand_id
        INNER JOIN model ON model.model_id = model_has_brand.model_model_id
        WHERE cart.users_email = '" . $email . "'
    ");

                                $cart_products = array();

                                if ($cart_rs->num_rows > 0) {
                                    while ($row = $cart_rs->fetch_assoc()) {
                                        $cart_products[] = $row;
                                    }
                                }
                            }
                            ?>
                            <div class="col-12 mt-3 mb-3 d-grid">
                                <button class="btn btn-primary fs-5 fw-bold" type="submit"
                                    onclick="checkOut('<?php echo $user; ?>', cartProductIds);">CHECKOUT</button>
                            </div>

                        </div>

                    </div>
                </div>
            <?php

            }

            ?>

        </div>

        <?php include "footer.php"    ?>
        <script src="js/script.js"></script>
        <script>
            const cartProductIds = <?php
                                    $ids = [];
                                    $cart_rs = Database::search("SELECT Product_id FROM cart WHERE users_email='" . $user . "'");
                                    while ($row = $cart_rs->fetch_assoc()) {
                                        $ids[] = $row["Product_id"];
                                    }
                                    echo json_encode($ids);
                                    ?>;
        </script>

        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>

    </html>

<?php
} else {
?>
    <?php
    echo ("Please Sign In to Your Account or Create a new Account");
    ?>
<?php
}

?>