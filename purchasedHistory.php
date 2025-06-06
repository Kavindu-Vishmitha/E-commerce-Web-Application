<?php
session_start();
include "connection.php";

if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Purchased History | X-flax</title>
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>
    <?php include "header.php"; ?>

    <body onload="loadInvoice();" class="d-flex flex-column min-vh-100">

        <div class="container-fluid flex-grow-1">
            <div class="row">
                <div class="col-12 col-lg-12 mb-1 mt-3 bg-body">
                    <div class="row">
                        <div class="offset-lg-3 col-12 col-lg-6 mb-4 mt-1">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <p class="fs-1 mt-3 pt-2 fw-bold h1" style="font-family: 'Times New Roman';">Purchased History</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `users_email`='" . $user['email'] . "'");
            $invoice_num = $invoice_rs->num_rows;

            if ($invoice_num == 0) {
            ?>

                <div class="offset-lg-1 col-12 col-lg-10 bg-body rounded mb-3 mb-lg-5 border border-secondary">
                    <div class="row">
                        <div class="offset-lg-1 col-12 col-lg-10 text-center mt-4">
                            <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                <div class="mt-lg-5 mb-lg-5 mt-4 mb-4">
                                    <img src="resources/add cart.png" style="width:150px;">
                                </div>
                                <div class="col-10 offset-1 col-lg-12 offset-lg-0 mt-3 mb-5">
                                    <span class="h1 text-black-50 fw-bold">No Purchased...</span>
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
                <div class="col-xl-10 col-12 mt-4 offset-lg-1">
                    <div class="card mb-3">
                        <div class="card-header fw-bold text-center text-primary" style="font-size:25px;">Invoice Details</div>
                        <div class="card-body">
                            <div class="mt-3">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Product Title</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Total</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody id="tb">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div></br></br>
            <?php
            }
            ?>

        </div>

        <?php include "footer.php"; ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>

    </html>
<?php
} else {
?>
    <script>
        window.location = "signIn.php";
    </script>
<?php
}
?>