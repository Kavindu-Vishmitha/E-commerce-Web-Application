<?php

session_start();
require "connection.php";

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advanced Search | X-flax</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css" />

    <link rel="icon" href="resources/logo.svg" />


</head>

<?php include "header.php" ?>

<body style="background-color: #eee;">

    <div class="container-fluid">
        <div class="row">

            <div class="col-12 col-lg-12 mb-3 mt-3 bg-body ">
                <div class="row">
                    <div class="offset-lg-3 col-12 col-lg-6 mb-4 mt-1">
                        <div class="row">
                            <div class="col-12 text-center">
                                <P class="fs-1 mt-3 pt-2 fw-bold h1" style="font-family: 'Times New Roman';">Advanced Search</P>
                            </div>
                            <div class="col-12 col-lg-10 mt-4 mb-1 input-group" style="justify-content: center;">
                                <input type="text" class="form-control border border-secondary" placeholder="Type keyword to search..." id="t" />
                                <span class="btn btn-primary" onclick="advancedSearch(0);"><i class="bi bi-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 offset-lg-5 d-grid mb-4">
                        <button class="btn btn-danger" onclick="clearA();">Clear</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="offset-lg-1 col-12 col-lg-10 bg-body rounded mb-3 border border-secondary">
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


        <div class="offset-lg-1 col-12 col-lg-10 mt-3 mb-3 ">
            <div class="row">

                <div class="col-12 border border-secondary rounded">
                    <div class="row mt-3">

                        <div class="col-12 col-lg-4 mb-3">
                            <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="c1">
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

                        <div class="col-12 col-lg-4 mb-3">
                            <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="b1">
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

                        <div class="col-12 col-lg-4 mb-3">
                            <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="m">
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

                        <div class="col-12 col-lg-6 mb-3">
                            <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="c2">
                                <option value="0">Select Condition</option>
                                <?php
                                $condition_rs = Database::search("SELECT * FROM `condition`");
                                $condition_num = $condition_rs->num_rows;

                                for ($x = 0; $x < $condition_num; $x++) {
                                    $condition_data = $condition_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $condition_data["condition_id"] ?>"><?php echo $condition_data["condition_name"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="c3">
                                <option value="0">Select Colour</option>
                                <?php
                                $color_rs = Database::search("SELECT * FROM `color`");
                                $color_num = $color_rs->num_rows;

                                for ($x = 0; $x < $color_num; $x++) {
                                    $color_data = $color_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $color_data["clr_id"] ?>"><?php echo $color_data["clr_name"] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <input type="text" class="form-control border border-top-0 border-start-0 border-end-0 border-2 border-warning" placeholder="Price From..." id="pf" />
                        </div>

                        <div class="col-12 col-lg-6 mb-2">
                            <input type="text" class="form-control border border-top-0 border-start-0 border-end-0 border-2 border-warning" placeholder="Price To..." id="pt" />
                        </div>

                        <div class="offset-lg-2 col-12 col-lg-8 rounded mb-3">
                            <div class="row">
                                <div class="offset-lg-3 col-lg-6 col-12 mt-2 mb-2">
                                    <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-warning" id="sor">
                                        <option value="0">SORT BY</option>
                                        <option value="1">Price Low to High</option>
                                        <option value="2">Price High to Low</option>
                                        <option value="3">Quantity Low to High</option>
                                        <option value="4">Quantity High to Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3 mt-5">
                        <div class="col-lg-3 d-grid offset-lg-3 mb-2">
                            <button class="btn btn-success" onclick="goBack()">Back to Page</button>
                        </div>
                        <div class="col-lg-3 d-grid mb-2">
                            <button class="btn btn-primary" onclick="advancedSearch(0);">Search</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>




    </div>

    <?php include "footer.php" ?>
    <script src="js/script.js"></script>

</body>

</html>