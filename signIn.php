<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sign In | X-flax</title>
    <link rel="icon" href="resources/logo.svg" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css" />

</head>

<body class="main-body">


    <div class="container vh-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card card-re " style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 mt-4">

                                <p class="text-center h1 fw-bold mb-2 mx-1 mx-md-4 mt-4" style="font-family: 'Times New Roman';">Sign In</p>
                                <br />
                                <div class="text-center ">
                                    <div class="col-12 d-none" id="msgdiv" style="margin-left:13px;">
                                        <div class="alert alert-danger" role="alert" id="msg" onclick="closeAlert2();"></div>
                                    </div>
                                </div>

                                <?php

                                $email = "";
                                $password = "";

                                if (isset($_COOKIE["email"])) {
                                    $email = $_COOKIE["email"];
                                }

                                if (isset($_COOKIE["password"])) {
                                    $password = $_COOKIE["password"];
                                }

                                ?>


                                <div class="d-flex flex-row align-items-center mb-2">
                                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label ">Email</label>
                                        <input type="text" id="email2" placeholder="ex: sahan@gmail.com" class="form-control" value="<?php echo $email ?>" />

                                    </div>
                                </div>

                                <div class="d-flex flex-row align-items-center mb-2 ">
                                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                    <div class="form-outline flex-fill mb-0">
                                        <label class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" id="signp" placeholder="ex: *******" class="form-control" value="<?php echo $password ?>" />
                                            <buton class="btn btn-outline-secondary" type="button" id="signp2" onclick="showPassword3();">
                                                <i class="bi bi-eye-fill"></i>
                                            </buton>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" style="margin-left: -6px;" value="" id="rememberme">
                                        <label class="form-check-label" style="margin-left: 10px;" for="rememberme">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 text-end" style="margin-top:-26px;">
                                    <a href="#" class="link-primary" onclick="forgotPassword();"><b>Forgotten Password?</b></a>
                                </div>

                                <div class="col-12 d-grid mt-4" style="margin-left:7px;">
                                    <button class="btn btn-primary" onclick="signin();">Sign In</button>
                                </div>

                                <div class="col-12 d-grid mt-3" style="margin-left:7px;">
                                    <a href="signUp.php" class="btn btn-danger">New to X-flax ? Join Now</a>
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
    <div class="modal" tabindex="-1" id="forgotPasswordModel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModal();"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-6">
                            <lable class="form-lable">New Password</lable>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="np" />
                                <buton class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword1();">
                                    <i class="bi bi-eye-fill"></i>
                                </buton>
                            </div>
                        </div>

                        <div class="col-6">
                            <lable class="form-lable">Retype New Password</lable>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="rnp" />
                                <buton class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();">
                                    <i class="bi bi-eye-fill"></i>
                                </buton>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-lable">Verification Code</label>
                            <input type="text" class="form-control" id="vc" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal();" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset Password</button>
                </div>
            </div>

        </div>
    </div>


    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>