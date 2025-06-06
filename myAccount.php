<?php
session_start();
require "connection.php";

?>
<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Account | X-flax </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="resources/logo.svg" />

</head>


<body>
    <?php require "header.php"; ?>

    <div class="container-fluid ">

        <div class="row">

            <div class="container-xl px-4 mt-4">

                <div class="row">
                    <?php



                    if (isset($_SESSION["u"])) {

                        $email = $_SESSION["u"]["email"];

                        $details_rs = Database::search("SELECT * FROM `users` INNER JOIN `gender`
    ON users.`gender_id` = gender.`id` WHERE `email` = '" . $email . "'");

                        $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email` = '" . $email . "'");

                        $address_rs = Database::search("SELECT * FROM `users_has_address` INNER JOIN `city` ON
    users_has_address.city_city_id = city.city_id INNER JOIN `district` ON
    city.district_district_id = district.district_id INNER JOIN `province` ON
    district.province_province_id = province.province_id WHERE `users_email` = '" . $email . "'");

                        $user_details = $details_rs->fetch_assoc();
                        $image_details = $image_rs->fetch_assoc();
                        $address_details = $address_rs->fetch_assoc();

                    ?>
                        <div class="col-lg-4 col-8 offset-2 offset-lg-6 text-center mb-1">
                            <div class="d-none" id="msgDiv2" style="margin-left:13px;">
                                <div class="alert alert-danger" role="alert" id="msg2" onclick="closeAlert1();"></div>
                            </div>
                        </div>


                        <div class="col-xl-4">

                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header fw-bold" style="font-size:15px;">Profile Picture</div>
                                <div class="card-body text-center">

                                    <?php

                                    if (empty($image_details["path"])) {
                                    ?>
                                        <img class="img-account-profile rounded-circle mb-4" style="width:150px; height:150px;" src="resources/profile.svg" id="img">

                                    <?php
                                    } else {
                                    ?>
                                        <img class="img-account-profile rounded-circle mb-4" style="width:150px; height:150px;" src="<?php echo $image_details["path"] ?>" id="img">
                                    <?php

                                    }
                                    ?>

                                    <div class="  text mb-2 fw-bold" style="font-size:16px;"><?php echo $user_details["fname"] . " " . $user_details["lname"] ?></div>

                                    <div class="  text-muted mb-4 "><?php echo $email; ?></div>
                                    <input type="file" class="d-none" id="profileimage" />
                                    <label for="profileimage" class="btn btn-success" type="button" onclick="changeProfileImg();">Upload Profile image</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">

                            <div class="card mb-4">
                                <div class="card-header fw-bold" style="font-size:15px;">Account Details</div>
                                <div class="card-body">
                                    <form>

                                        <div class="row gx-3 mb-3">

                                            <div class="col-md-6">
                                                <label class=" mb-1">First Name</label>
                                                <input class="form-control" id="fname" type="text" placeholder="" value="<?php echo $user_details["fname"] ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label class=" mb-1">Last Name</label>
                                                <input class="form-control" id="lname" type="text" placeholder="" value="<?php echo $user_details["lname"] ?>">
                                            </div>
                                        </div>

                                        <div class="row gx-3 mb-3">

                                            <div class="col-md-6">
                                                <label class=" mb-1">Mobile Number</label>
                                                <input class="form-control" id="mobile" type="text" placeholder="" value="<?php echo $user_details["mobile"] ?>">
                                            </div>

                                            <div class="col-md-6">
                                                <label class=" mb-1">Registered Date</label>
                                                <input class="form-control" type="text" placeholder="" value="<?php echo $user_details["joined_date"] ?>" readonly>
                                            </div>


                                        </div>

                                        <div class="row gx-3 mb-3">

                                            <div class="col-md-6">
                                                <label class="mb-1">Email</label>
                                                <input class="form-control" type="text" placeholder="" value="<?php echo $user_details["email"] ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="mb-1">Gender</label>
                                                <input class="form-control" type="text" placeholder="" value="<?php echo $user_details["gender_name"] ?>" readonly>
                                            </div>

                                        </div>
                                        <div class="row gx-3 mb-3 ">
                                            <div class="col-md-6">
                                                <label class="mb-1">Password</label>
                                                <div class="input-group">
                                                    <input class="form-control" type="password" id="ac1" placeholder="" value="<?php echo $user_details["password"] ?>" readonly>
                                                    <buton class="btn btn-outline-secondary" type="button" id="ac2" onclick="showPassword6();">
                                                        <i class="bi bi-eye-fill"></i>
                                                    </buton>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="mb-1">Address Line 01</label>
                                            <?php
                                            if (empty($address_details["line1"])) {
                                            ?>
                                                <input class="form-control" id="line1" type="text" placeholder="" value="">
                                            <?php
                                            } else {
                                            ?>
                                                <input class="form-control" id="line1" type="text" placeholder="" value="<?php echo $address_details["line1"]; ?>">
                                            <?php
                                            }

                                            ?>
                                        </div>

                                        <div class="mb-3">
                                            <label class="mb-1">Address Line 02</label>

                                            <?php
                                            if (empty($address_details["line2"])) {
                                            ?>
                                                <input class="form-control" id="line2" type="text" placeholder="" value="">
                                            <?php
                                            } else {
                                            ?>
                                                <input class="form-control" id="line2" type="text" placeholder="" value="<?php echo $address_details["line2"]; ?>">
                                            <?php

                                            }
                                            ?>
                                        </div>

                                        <?php

                                        $province_rs = Database::search("SELECT * FROM `province`");
                                        $district_rs = Database::search("SELECT * FROM `district`");
                                        $city_rs = Database::search("SELECT * FROM `city`");

                                        ?>

                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="mb-1">Province</label>
                                                <select class="form-select" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php
                                                    $province_rs = Database::search("SELECT * FROM `province`");
                                                    while ($province_data = $province_rs->fetch_assoc()) {
                                                    ?>
                                                        <option value="<?php echo $province_data["province_id"]; ?>" <?php if (!empty($address_details["province_id"]) && $province_data["province_id"] == $address_details["province_id"]) {
                                                                                                                            echo "selected";
                                                                                                                        } ?>>
                                                            <?php echo $province_data["province_name"]; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="mb-1">District</label>
                                                <select class="form-select" id="district">
                                                    <option value="0">Select District</option>
                                                    <?php
                                                    if (!empty($address_details["province_id"])) {
                                                        $district_rs = Database::search("SELECT * FROM `district` WHERE `province_province_id` = '" . $address_details["province_id"] . "'");
                                                        while ($district_data = $district_rs->fetch_assoc()) {
                                                    ?>
                                                            <option value="<?php echo $district_data["district_id"]; ?>" <?php if ($district_data["district_id"] == $address_details["district_id"]) {
                                                                                                                                echo "selected";
                                                                                                                            } ?>>
                                                                <?php echo $district_data["district_name"]; ?>
                                                            </option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="mb-1">City</label>
                                                <select class="form-select" id="city">
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    if (!empty($address_details["district_id"])) {
                                                        $city_rs = Database::search("SELECT * FROM `city` WHERE `district_district_id` = '" . $address_details["district_id"] . "'");
                                                        while ($city_data = $city_rs->fetch_assoc()) {
                                                    ?>
                                                            <option value="<?php echo $city_data["city_id"]; ?>" <?php if ($city_data["city_id"] == $address_details["city_id"]) {
                                                                                                                        echo "selected";
                                                                                                                    } ?>>
                                                                <?php echo $city_data["city_name"]; ?>
                                                            </option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>


                                            <div class="col-md-6">
                                                <label class="mb-1">Postal Code</label>
                                                <?php
                                                if (empty($address_details["postal_code"])) {
                                                ?>
                                                    <input class="form-control" id="pcode" type="text" placeholder="" value="">
                                                <?php
                                                } else {
                                                ?>
                                                    <input class="form-control" id="pcode" type="text" placeholder="" value="<?php echo $address_details["postal_code"]; ?>">
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-lg-2 d-grid col-12 ">
                                                <button class="btn btn-success mt-2 mb-2 " type="button" onclick="goBack()">Back to Page</button>
                                            </div>
                                            <div class="col-lg-2 d-grid col-6 offset-lg-6 ">
                                                <button class="btn btn-danger mt-2 mb-2" type="button" onclick="clearA();">Clear</button>
                                            </div>
                                            <div class="col-lg-2 d-grid col-6">
                                                <button class="btn btn-success mt-2 mb-2" type="button" onclick="updateProfile();">Save Changes</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        <?php
                    }
        ?>


        </div>
    </div>
    <?php require "footer.php"; ?>

    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>


</html>