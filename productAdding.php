<?php

session_start();

if (isset($_SESSION["a"])) {

    include "connection.php"

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Adding | X-flax</title>
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>
    <?php include "adminHeader.php" ?>

    <body>

        <div class="container-fluid">

            <div class="row">

                <div class="col-12 col-lg-12 mb-3 mt-4 bg-body ">
                    <div class="row">
                        <div class="offset-lg-3 col-12 col-lg-6 mb-4 mt-1">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <P class="fs-1 mt-3 pt-2 fw-bold h1" style="font-family: 'Times New Roman';">Add New Product</P>
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

                                <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="category">
                                    <option value="0">Select Category</option>
                                    <?php
                                    $category_rs = Database::search("SELECT * FROM `category`");
                                    $category_num = $category_rs->num_rows;

                                    for ($x = 0; $x < $category_num; $x++) {
                                        $category_data = $category_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $category_data["cat_id"]; ?>">
                                            <?php echo $category_data["cat_name"]; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-4 mb-4 p-3 border-end border-primary ">
                                <div class="col-12 text-start">
                                    <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Select Product Brand</label>
                                </div>
                                <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="brand">
                                    <option value="0">Select Brand</option>
                                    <?php
                                    $brand_rs = Database::search("SELECT * FROM `brand`");
                                    $brand_num = $brand_rs->num_rows;

                                    for ($x = 0; $x < $brand_num; $x++) {
                                        $brand_data = $brand_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $brand_data["brand_id"]; ?>">
                                            <?php echo $brand_data["brand_name"]; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-12 col-lg-4 mb-4 p-3 ">
                                <div class="col-12 text-start">
                                    <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Select Product Model</label>
                                </div>
                                <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="model">
                                    <option value="0">Select Model</option>
                                    <?php
                                    $model_rs = Database::search("SELECT * FROM `model`");
                                    $model_num = $model_rs->num_rows;

                                    for ($x = 0; $x < $model_num; $x++) {
                                        $model_data = $model_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $model_data["model_id"]; ?>">
                                            <?php echo $model_data["model_name"]; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
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
                                <input type="text" class="form-control mb-3 border border-top-0 border-start-0 border-end-0 border-2 border-warning" placeholder="" id="title" />
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
                                        <div class="col-12">

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="c" id="b" value="option1">
                                                <label class="form-check-label" for="b" style="font-size: 15px;">Brand new</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="c" id="u" value="option2">
                                                <label class="form-check-label" for="u" style="font-size: 15px;">Used</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-4 mb-4 p-3 border-end border-primary ">
                                <div class="col-12 text-start">
                                    <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Select Product Color</label>
                                </div>
                                <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="clr">
                                    <option value="0">Select Color</option>
                                    <?php
                                    $clr_rs = Database::search("SELECT * FROM `color`");
                                    $clr_num = $clr_rs->num_rows;

                                    for ($x = 0; $x < $clr_num; $x++) {
                                        $clr_data = $clr_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo $clr_data["clr_id"]; ?>">
                                            <?php echo $clr_data["clr_name"]; ?>
                                        </option>
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
                                    <input type="number" class="form-control border border-top-0 border-start-0 border-end-0 border-2 border-warning" value="0" min="0" id="qty" />
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
                                    <input type="text" class="form-control" id="cost" />
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>

                            <div class="col-11 col-lg-4 mb-4 p-3 ">
                                <div class="col-12 text-start">
                                    <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Delivery Cost within Colombo</label>
                                </div>
                                <div class="input-group mb-2 mt-2">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" id="dwc" />
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>

                            <div class="col-11 col-lg-4 mb-4 p-3 ">
                                <div class="col-12 text-start">
                                    <label class="form-label" for="form-label" style="font-weight:bold; font-size:18px">Delivery Cost out of Colombo</label>
                                </div>
                                <div class="input-group mb-2 mt-2">
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" id="doc" />
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 bg-body-light rounded mb-3 border border-1 border-primary mt-2 mb-3">
                <div class="row mb-4">
                    <div class="offset-lg-1 col-10 offset-1 col-lg-10 text-center mt-4 ">
                        <div class="row d-flex justify-content-center">
                            <div class="col-12 text-start">
                                <label class="form-label fw-bold" style="font-size: 18px;">Product Description</label>
                            </div>
                            <div class="col-12">
                                <textarea cols="30" rows="5" class="form-control border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="desc" style="resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 bg-body-light rounded mb-3 border border-1 border-primary">
                <div class="row mb-4 ">
                    <div class="offset-lg-1 col-10 offset-1 col-lg-10 mt-4 text-center">
                        <div class="col-12 text-start">
                            <label class="form-label fw-bold" style="font-size: 18px;">Add Product Image</label>
                        </div>
                    </div>

                    <div class="row justify-content-center">

                        <div class="col-lg-2 col-6 mb-2 gap-2 d-flex p-4 me-3 ms-5">
                            <div class="card p-2" style="width: 18rem;">
                                <div class="rounded mb-3 border border-3 border-light">
                                    <img src="resources/image add.svg" class="card-img-top img-thumbnail zoom" id="i0">
                                </div>
                                <div class="card-body text-center mb-1">
                                    <p class="card-text" style="font-size:18px;font-weight:bold">Add Photo</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 mb-2 gap-2 d-flex p-4 me-3 ms-5">
                            <div class="card p-2" style="width: 18rem;">
                                <div class="rounded mb-3 border border-3 border-light">
                                    <img src="resources/image add.svg" class="card-img-top img-thumbnail zoom" id="i1">
                                </div>
                                <div class="card-body text-center mb-1">
                                    <p class="card-text" style="font-size:18px;font-weight:bold">Add Photo</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-6 mb-2 gap-2 d-flex p-4 me-3 ms-5">
                            <div class="card p-2" style="width: 18rem;">
                                <div class="rounded mb-3 border border-3 border-light">
                                    <img src="resources/image add.svg" class="card-img-top img-thumbnail zoom" id="i2">
                                </div>
                                <div class="card-body text-center mb-1">
                                    <p class="card-text" style="font-size:18px;font-weight:bold">Add Photo</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-2 d-grid offset-lg-5 col-6 offset-3 ">
                        <input type="file" class="d-none" multiple id="imageuploader" />
                        <label for="imageuploader" class="btn btn-primary" onclick="addProductImage();">Upload Images</label>
                    </div>

                </div>
            </div>

            <div class="row mb-5 mt-1">
                <div class="col-lg-2 d-grid offset-lg-4 col-5 offset-1 ">
                    <button class="btn btn-success" onclick="addProduct();">Save Product</button>
                </div>
                <div class="col-lg-2 d-grid col-5">
                    <button class="btn btn-danger" onclick="clearA()">Clear</button>
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
     <script> window.location.href = "adminSignIn.php";</script>
     <?php
}

?>