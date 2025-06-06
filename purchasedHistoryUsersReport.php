<?php

session_start();

if (isset($_SESSION["a"])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Purchased | Users Report | X-flax</title>
        <link rel="icon" href="resources/logo.svg" />
        <link rel="stylesheet" href="css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    </head>
    <?php include "adminHeader.php" ?>

    <body onload="loadPurchasedHistoryUserReport();">

        <div class="container-fluid mb-lg-0" id="printA">
            <div class="row">

                <div class="col-12 col-lg-12 mb-1 mt-3 bg-body ">
                    <div class="row">
                        <div class="offset-lg-3 col-12 col-lg-6 mb-4 mt-1">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <P class="fs-1 mt-3 pt-2 fw-bold h1" style="font-family: 'Times New Roman';">Purchased History</P>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-12 mt-4  ">

                <div class="card mb-5">
                    <div class="card-header fw-bold text-center text-primary" style="font-size:25px;">Users Report</div>
                    <div class="card-body">

                        <div class="mt-3">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Invoice Id</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Address Line 1</th>
                                        <th scope="col">Address Line 2</th>
                                        <th scope="col">Postal Code</th>
                                        <th scope="col">Email</th>

                                    </tr>
                                </thead>
                                <tbody id="tb">
                                    <tr>

                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 offset-lg-5 d-grid mb-lg-5 col-4 offset-4 mb-5">
            <button class="btn btn-primary" onclick="printPro1Rep();">Download</button>
        </div>

        <?php include "adminFooter.php"  ?>
        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>

    </html>
<?php
} else {

    echo ("Your are not a Valid Admin");
}

?>