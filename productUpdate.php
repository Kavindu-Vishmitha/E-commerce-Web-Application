<?php

session_start();


if (isset($_SESSION["a"])) {
    include "connection.php";
    $email = $_SESSION["a"];

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Updating | X-flax</title>
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>
    <?php include "adminHeader.php" ?>

    <body>

        <div class="container-fluid">

            <div class="row">


                <div class="col-12 col-lg-12 mb-3 mt-3 bg-body ">
                    <div class="row">
                        <div class="offset-lg-3 col-12 col-lg-6 mb-4 mt-1 ">
                            <div class="row">

                                <div class="col-12 text-center">
                                    <P class="fs-1 mt-3 pt-2 fw-bold h1" style="font-family: 'Times New Roman';">Product Update</P>
                                </div>
                                <div class="col-12 col-lg-10 mt-4 mb-1 input-group" style="justify-content: center;">
                                    <input type="text" class="form-control border border-secondary" placeholder="Type keyword to search..." id="us" />
                                    <span class="btn btn-primary" onclick="updateSearch(0);"><i class="bi bi-search"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="d-grid col-lg-2 col-4 offset-4 offset-lg-5 mb-3">
                            <button class="btn btn-danger" onclick="clearA();">Clear</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-12 col-lg-3 mb-3 offset-lg-1 me-lg-5">
                    <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="category">
                        <option value="0">Select Category</option>
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
                </div>
                <div class="col-12 col-lg-3 mb-3 me-lg-5">
                    <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="brand">
                        <option value="0">Select Brand</option>
                        <?php
                        $brand_rs = Database::search("SELECT * FROM `brand`");
                        $brand_num = $brand_rs->num_rows;

                        for ($x = 0; $x < $brand_num; $x++) {
                            $brand_data = $brand_rs->fetch_assoc();
                        ?>
                            <option value="<?php echo $brand_data["brand_id"] ?>"><?php echo $brand_data["brand_name"] ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <div class="col-12 col-lg-3 mb-3">
                    <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="model">
                        <option value="0">Select Model</option>
                        <?php
                        $model_rs = Database::search("SELECT * FROM `model`");
                        $model_num = $model_rs->num_rows;

                        for ($x = 0; $x < $model_num; $x++) {
                            $model_data = $model_rs->fetch_assoc();
                        ?>
                            <option value="<?php echo $model_data["model_id"] ?>"><?php echo $model_data["model_name"] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="offset-lg-1 col-12 col-lg-10 bg-body rounded mb-3 border border-1 border-warning mt-5">
                    <div class="row ">
                        <div class="offset-lg-1 col-12 col-lg-10 text-center mt-4">
                            <div class="row" id="view_area">
                                <div class="offset-5 col-2 mt-5">
                                    <span class="fw-bold text-black-50"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                                </div>
                                <div class="offset-3 col-6 mt-3 mb-5">
                                    <span class="h1 text-black-50 fw-bold">No Items Searched Yet...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 bg-body-light rounded mb-3 border border-1 border-primary mt-2">
                <div class="row  ">
                    <div class="offset-lg-1 col-lg-10 text-center mt-4 ">
                        <div class="row d-flex justify-content-center">

                            <div class="col-12 col-lg-4 mb-4 p-3 border-end border-primary   ">
                                <div class="col-12 text-start">
                                    <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Select Product Category</label>
                                </div>
                                <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" disabled>
                                    <?php

                                    if (isset($_SESSION["p"])) {

                                        $product = $_SESSION["p"];

                                        $category_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='" . $product["category_id"] . "'");
                                        $category_data = $category_rs->fetch_assoc();
                                    ?>
                                        <option><?php echo $category_data["cat_name"]; ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-4 mb-4 p-3 border-end border-primary ">
                                <div class="col-12 text-start">
                                    <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Select Product Brand</label>
                                </div>
                                <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" disabled>
                                    <?php

                                    if (isset($_SESSION["p"])) {

                                        $product = $_SESSION["p"];


                                        $brand_rs = Database::search("SELECT * FROM `brand` WHERE `brand_id` IN 
                                                    (SELECT `brand_brand_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");
                                        $brand_data = $brand_rs->fetch_assoc();
                                    ?>
                                        <option><?php echo $brand_data["brand_name"]; ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-4 mb-4 p-3 ">
                                <div class="col-12 text-start">
                                    <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Select Product Model</label>
                                </div>
                                <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" disabled>
                                    <?php

                                    if (isset($_SESSION["p"])) {

                                        $product = $_SESSION["p"];


                                        $model_rs = Database::search("SELECT * FROM `model` WHERE `model_id` IN 
                                                    (SELECT `model_model_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");
                                        $model_data = $model_rs->fetch_assoc();
                                    ?>
                                        <option><?php echo $model_data["model_name"]; ?></option>
                                    <?php
                                    }                              ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 bg-body-light rounded mb-3 border border-1 border-primary mt-2">
                <div class="row ">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center mt-4 p-4">
                        <div class="row">
                            <div class="col-lg-12 col-12 mb-5 text-start ">
                                <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Add Title to Your Product</label>
                                <input type="text" class="form-control mb-3 border border-top-0 border-start-0 border-end-0 border-2 border-warning" value="<?php if (isset($_SESSION["p"])) {
                                                                                                                                                                $product = $_SESSION["p"]; ?><?php echo $product["title"]; ?><?php } ?>" id="t" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 bg-body-light rounded mb-3 border border-1 border-primary mt-2">
                <div class="row ">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center mt-4 p-4">

                        <div class="row">

                            <div class="col-12 col-lg-4 p-3 mt-1">
                                <div class="row">

                                    <div class="col-lg-12 col-12 text-start mb-2 ">
                                        <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Select Product Condition</label>
                                        <?php

                                        if (isset($_SESSION["p"])) {

                                            $product = $_SESSION["p"];

                                            if ($product["condition_condition_id"] == 1) {


                                        ?>
                                            <?php

                                            }
                                            ?>
                                            <div class="col-12">

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="c" id="b" value="option1" checked disabled>
                                                    <label class="form-check-label" for="c" style="font-size: 15px;">Brand new</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="c" id="u" value="option2" disabled>
                                                    <label class="form-check-label" for="u" style="font-size: 15px;">Used</label>
                                                </div>
                                            </div>
                                        <?php

                                        } else {
                                        ?>
                                            <div class="col-12">

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="c" id="b" value="option1" disabled>
                                                    <label class="form-check-label" for="c" style="font-size: 15px;">Brand new</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="c" id="u" value="option2" checked disabled>
                                                    <label class="form-check-label" for="u" style="font-size: 15px;">Used</label>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 mb-4 p-3 border-end border-primary ">
                                <div class="col-12 text-start">
                                    <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Select Product Color</label>
                                </div>
                                <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" disabled>
                                    <?php

                                    if (isset($_SESSION["p"])) {

                                        $product = $_SESSION["p"];


                                        $color_rs = Database::search("SELECT * FROM `color` WHERE `clr_id`='" . $product["color_clr_id"] . "'");
                                        $color_data = $color_rs->fetch_assoc();
                                    ?>
                                        <option><?php echo $color_data["clr_name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-4 mb-4 p-3">
                                <div class="col-12 text-start">
                                    <label class="form-label fw-bold" style="font-size: 18px;">Add Product Quantity</label>
                                </div>
                                <div class="col-12">
                                    <input type="number" class="form-control border border-top-0 border-start-0 border-end-0 border-2 border-warning" min="0" value="<?php echo $product["qty"]; ?>" id="q" />

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 bg-body-light rounded mb-3 border border-1 border-primary mt-2">
                <div class="row ">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center mt-4 ">
                        <div class="row d-flex justify-content-center">

                            <div class="col-11 col-lg-4 mb-4 p-3 ">
                                <div class="col-12 text-start">
                                    <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Cost Per Item</label>
                                </div>
                                <div class="input-group mb-2 mt-2">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" disabled value="<?php if (isset($_SESSION["p"])) {
                                                                                                $product = $_SESSION["p"]; ?><?php echo $product["price"]; ?><?php } ?>" />
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>

                            <div class="col-11 col-lg-4 mb-4 p-3 ">
                                <div class="col-12 text-start">
                                    <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Delivery Cost within Colombo</label>
                                </div>
                                <div class="input-group mb-2 mt-2">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" value="<?php if (isset($_SESSION["p"])) {
                                                                                        $product = $_SESSION["p"]; ?><?php echo $product["delivery_fee_colombo"]; ?><?php } ?>" id="dwc" />
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>

                            <div class="col-11 col-lg-4 mb-4 p-3 ">
                                <div class="col-12 text-start">
                                    <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Delivery Cost out of Colombo</label>
                                </div>
                                <div class="input-group mb-2 mt-2">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" value="<?php if (isset($_SESSION["p"])) {
                                                                                        $product = $_SESSION["p"]; ?><?php echo $product["delivery_fee_other"]; ?><?php } ?>" id="doc" />
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 bg-body-light rounded mb-3 border border-1 border-primary mt-2 b-3">
                <div class="row mb-4">
                    <div class="offset-lg-1 col-10 offset-1 col-lg-10 text-center mt-4 ">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 text-start">
                                <label class="form-label fw-bold" style="font-size: 18px;">Product Description</label>
                            </div>
                            <div class="col-12">
                                <textarea cols="30" rows="5" class="form-control border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="d" style="resize: none"><?php if (isset($_SESSION["p"])) {
                                                                                                                                                                                            $product = $_SESSION["p"]; ?><?php echo $product["description"]; ?><?php } ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 bg-body-light rounded mb-3 border border-1 border-primary mt-2">
                <div class="row mb-4 ">
                    <div class="offset-lg-1 col-10 offset-1 col-lg-10 text-center mt-4  ">
                        <div class="col-12 text-start">
                            <label class="form-label fw-bold" style="font-size: 18px;">Add Product Image</label>
                        </div>
                    </div>

                    <?php

                    if (isset($_SESSION["p"])) {
                        $product = $_SESSION["p"]; ?><?php


                                                        $img = array();

                                                        $img[0] = "resources/image add.svg";
                                                        $img[1] = "resources/image add.svg";
                                                        $img[2] = "resources/image add.svg";

                                                        $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product["id"] . "'");
                                                        $product_img_num = $product_img_rs->num_rows;

                                                        for ($x = 0; $x < $product_img_num; $x++) {
                                                            if ($x < 3) {
                                                                $product_img_data = $product_img_rs->fetch_assoc();
                                                                $img[$x] = $product_img_data["img_path"];
                                                            }
                                                        }
                                                        ?>
                <?php
                    } ?>
                <?php
                $img = array();

                $img[0] = "resources/image add.svg";
                $img[1] = "resources/image add.svg";
                $img[2] = "resources/image add.svg";

                if (isset($_SESSION["p"])) {
                    $product = $_SESSION["p"]; ?><?php

                                                    $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product["id"] . "'");
                                                    $product_img_num = $product_img_rs->num_rows;

                                                    for ($x = 0; $x < $product_img_num; $x++) {
                                                        if ($x < 3) {
                                                            $product_img_data = $product_img_rs->fetch_assoc();
                                                            $img[$x] = $product_img_data["img_path"];
                                                        }
                                                    }
                                                    ?>
            <?php
                }

            ?>

            <div class="row justify-content-center">
                <?php for ($i = 0; $i < 3; $i++) : ?>
                    <div class="col-lg-2 col-6 mb-2 gap-2 d-flex p-4 me-3 ms-5">
                        <div class="card p-2" style="width: 18rem;">
                            <div class="rounded mb-3 border border-3 border-light">
                                <img src="<?php echo $img[$i]; ?>" class="card-img-top img-thumbnail zoom" id="i<?php echo $i; ?>">
                            </div>
                            <div class="card-body text-center mb-1">
                                <p class="card-text" style="font-size:18px;font-weight:bold">Add Photo</p>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="col-lg-2 d-grid offset-lg-5 col-6 offset-3 ">
                <input type="file" class="d-none" multiple id="imageuploader" />
                <label for="imageuploader" class="btn btn-primary" onclick="changeProductImage();">Upload Images</label>
            </div>

                </div>
            </div>

            <div class="row mb-5 mt-1">
                <div class="col-lg-2 d-grid offset-lg-4 col-5 offset-1 ">
                    <button class="btn btn-success" onclick="updateProduct();">Update Product</button>
                </div>
                <div class="col-lg-2 d-grid col-5">
                    <button class="btn btn-danger" onclick="clearA();">Clear</button>
                </div>
            </div>

        </div>


        <?php include "adminFooter.php";  ?>

        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>
<?php

} else {

?>
    <script>
        window.location.href = "adminSignIn.php";
    </script>
<?php
}
?>