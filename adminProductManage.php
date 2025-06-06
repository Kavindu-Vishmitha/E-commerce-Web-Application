<?php

session_start();

if (isset($_SESSION["a"])) {

    include "connection.php";

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Product Manage | X-flax</title>
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    </head>

    <body>
        <?php include "adminHeader.php" ?>
        <div class="container-fluid">
            <div class="row">

                <div class="col-12 col-lg-12 mb-3 mt-3 bg-body ">
                    <div class="row">
                        <div class="offset-lg-3 col-12 col-lg-6 mb-4 mt-1">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <P class="fs-1 mt-3 pt-2 fw-bold h1" style="font-family: 'Times New Roman';">Manage Product</P>
                                </div>
                                <div class="col-12 col-lg-10 mt-4 mb-1 input-group" style="justify-content: center;">
                                    <input type="text" class="form-control border border-secondary" placeholder="Type keyword to search..." id="ms" />
                                    <span class="btn btn-primary" onclick="manageSearch(0);"><i class="bi bi-search"></i></span>
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

                <div class="offset-lg-1 col-12 col-lg-10 bg-body rounded mb-3 border border-1 border-warning mt-4">
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

                <div class="col-xl-10 mt-4 offset-lg-1 ">

                    <div class="card mb-5">
                        <div class="card-header fw-bold text-center" style="font-size:20px;">Product Register</div>
                        <div class="card-body">

                            <div class="row ">

                                <div class="col-lg-4 col-5 offset-lg-1 me-lg-2 offset-1 mt-5 ">
                                    <label class="form-label" for="form-label" style="font-weight: bold;">Category :</label>
                                    <input type="text" class="form-control mb-3" placeholder="Ex: Phone" id="cat" />
                                    <div class="text-center">
                                        <div class="d-none" id="msgD3">
                                            <div class="alert alert-danger text-center" id="msgB3" onclick="closeAlert7()"></div>
                                        </div>
                                    </div>
                                    <div class="col-l2 d-grid">
                                        <button class="btn btn-success" onclick="category();">Category Register</button>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-5 offset-lg-2 mt-5 ">
                                    <label class="form-label" for="form-label" style="font-weight: bold;">Brand :</label>
                                    <input type="text" class="form-control mb-3" placeholder="Ex: Samsung" id="b" />
                                    <div class="text-center">
                                        <div class="d-none" id="msgD4">
                                            <div class="alert alert-danger text-center" id="msgB4" onclick="closeAlert8()"></div>
                                        </div>
                                    </div>

                                    <div class="col-l2 d-grid">
                                        <button class="btn btn-success " onclick="brand();">Brand Register</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">

                                <div class="col-lg-4 col-5 offset-lg-1 me-lg-2 offset-1 ">
                                    <label class="form-label" for="form-label" style="font-weight: bold;">Model :</label>
                                    <input type="text" class="form-control mb-3" placeholder="Ex: Galaxy A11" id="m" />
                                    <div class="text-center">
                                        <div class="d-none" id="msgD5">
                                            <div class="alert alert-danger text-center" id="msgB5" onclick="closeAlert9()"></div>
                                        </div>
                                    </div>

                                    <div class="col-l2 d-grid">
                                        <button class="btn btn-success " onclick="model();">Model Register</button>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-5 offset-lg-2 mb-5 ">
                                    <label class="form-label" for="form-label" style="font-weight: bold;">Color :</label>
                                    <input type="text" class="form-control mb-3" placeholder="Ex: Black" id="c" />
                                    <div class="text-center">
                                        <div class="d-none" id="msgD6">
                                            <div class="alert alert-danger text-center" id="msgB6" onclick="closeAlert10()"></div>
                                        </div>
                                    </div>
                                    <div class="col-l2 d-grid">
                                        <button class="btn btn-success " onclick="color();">Color Register</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 d-grid offset-lg-5 col-4 offset-4 mb-3">
                                <button class="btn btn-danger" onclick="reload();"> Clear</button>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </div>


        <?php
        include "adminFooter.php";
        ?>


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