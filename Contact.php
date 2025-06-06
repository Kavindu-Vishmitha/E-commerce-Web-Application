<?php

session_start();
require "connection.php";

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contact Details | X-flax</title>
        <link rel="icon" href="resources/logo.svg" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="css/style.css" />

    </head>

    <body class="main-body">
        <?php include "header.php"  ?>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="col-md-8">
                    <div class="card card-re">
                        <div class="card-body p-md-5">
                            <div class="text-center">
                                <img src="resources/logo.svg" alt="X-flax Logo" style="width: 150px;" class="img-fluid mb-3">
                                <h1 class="display-4" style="font-family: 'Times New Roman';">X-flax</h1>
                                <p class="lead">X-flax.lk™ Welcome to our shop. If you come to our shop, you can buy all the electronic products you need here and you can buy those products at a very profitable and convenient price. Come now. Also, if you want to know anything about a product you have bought or are going to buy here, contact us through the links below.</p>
                            </div>

                            <ul class="list-unstyled list-inline text-center mt-5">
                                <li class="list-inline-item mx-3">
                                    <a href="#" class="text-white">
                                        <i class="bi bi-envelope-at-fill" style="font-size: 20px;"></i>
                                        xflax@gmail.com</a>
                                </li>
                                <li class="list-inline-item mx-3">
                                    <a href="#" class="text-white">
                                        <i class="bi bi-telephone-fill" style="font-size: 20px;"></i>
                                        +94751 420 808</a>
                                </li>
                                <li class="list-inline-item mx-3">
                                    <a href="#" class="text-white">
                                        <i class="bi bi-whatsapp" style="font-size: 20px;"></i>
                                        +94751 420 808</a>
                                </li>
                                <li class="list-inline-item mx-3">
                                    <a href="#" class="text-white">
                                        <i class="bi bi-facebook" style="font-size: 20px;"></i>
                                        FaceBook</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php" ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>