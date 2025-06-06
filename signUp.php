<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sign Up | X-flax</title>
    <link rel="icon" href="resources/logo.svg" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css" />

</head>

<body class="main-body">


    <div class="container vh-100">

        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card card-re" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <p class="text-center h1 fw-bold mb-2 mx-1 mx-md-4 mt-1" style="font-family: 'Times New Roman';">Register</p>
                                <br />
                                <div class="text-center ">
                                    <div class="col-12 d-none" id="msgdiv" style="margin-left:13px;">
                                        <div class="alert alert-danger text-center" role="alert" id="msg" onclick="closeAlert3();"></div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label ">First Name</label>
                                        <input type="text" placeholder="ex: Sahan" id="fname" class="form-control" />

                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" placeholder="ex: Madushan" id="lname" class="form-control" />
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label ">Email</label>
                                        <input type="email" placeholder="ex: sahan@gmail.com" id="email" class="form-control" />

                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label ">Password</label>
                                        <div class="input-group">
                                            <input type="password" placeholder="ex: ********" id="signUpp" class="form-control" />
                                            <buton class="btn btn-outline-secondary" type="button" id="signUpp2" onclick="showPassword4();">
                                                <i class="bi bi-eye-fill"></i>
                                            </buton>
                                        </div>
                                    </div>

                                </div>

                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label ">Mobile</label>
                                        <input type="text" placeholder="ex: 076 142 0801" id="mobile" class="form-control" />
                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label ">Gender</label>
                                        <select class="form-control" id="gender">
                                            <option value="0">Select your Gender</option>
                                            <?php
                                            require "connection.php";

                                            $rs = Database::search("SELECT * FROM `gender`");
                                            $n = $rs->num_rows;

                                            for ($x = 0; $x < $n; $x++) {
                                                $d = $rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?></option>

                                            <?php

                                            }

                                            ?>
                                        </select>


                                    </div>
                                </div>


                                <div class="col-12 d-grid mt-4" style="margin-left:7px;">
                                    <button class="btn btn-primary" onclick="signUp();">Sign Up</button>
                                </div>

                                <div class="col-12 d-grid mt-3" style="margin-left:7px;">
                                    <a href="signIn.php" class="btn btn-dark">Already have an Account? Sign In</a>
                                </div>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                <img src="resources/e_commerce.png" class="img-fluid" alt="Sample image">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    </div>

    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>