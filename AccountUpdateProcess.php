<?php

session_start();
include "connection.php";

if (
    !isset($_SESSION["u"]["email"]) ||
    !isset($_POST["fn"], $_POST["ln"], $_POST["mn"], $_POST["al1"], $_POST["al2"], $_POST["p"], $_POST["d"], $_POST["c"], $_POST["pc"])
) {
    echo "invalid data";
    exit();
}

$email = $_SESSION["u"]["email"];

$fname = $_POST["fn"];
$lname = $_POST["ln"];
$mobile = $_POST["mn"];
$line1 = $_POST["al1"];
$line2 = $_POST["al2"];
$province = $_POST["p"];
$district = $_POST["d"];
$city = $_POST["c"];
$pcode = $_POST["pc"];

if (empty($fname)) {
    echo "Please enter your First Name";
    exit();
} else if (strlen($fname) > 45) {
    echo "First Name must have less than 45 characters";
    exit();
} else if (empty($lname)) {
    echo "Please enter your Last Name";
    exit();
} else if (strlen($lname) > 45) {
    echo "Last Name must have less than 45 characters";
    exit();
} else if (empty($mobile)) {
    echo "Please enter your Mobile Number";
    exit();
} else if (strlen($mobile) != 10) {
    echo "Mobile Number must contain exactly 10 digits";
    exit();
} else if (!preg_match("/^07[0-9]{8}$/", $mobile)) {
    echo "Invalid Mobile Number";
    exit();
} else if (empty($line1)) {
    echo "Please enter your Address Line 1";
    exit();
} else if (empty($line2)) {
    echo "Please enter your Address Line 2";
    exit();
} else if (empty($province)) {
    echo "Please select your Province";
    exit();
} else if (empty($district)) {
    echo "Please select your District";
    exit();
} else if (empty($city)) {
    echo "Please select your City";
    exit();
} else if (empty($pcode)) {
    echo "Please enter your Postal Code";
    exit();
} else if (!preg_match("/^[0-9]{5}$/", $pcode)) {
    echo "Postal Code must be exactly 5 digits";
    exit();
}

$user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");

if ($user_rs->num_rows != 1) {
    echo "Invalid user";
    exit();
}

Database::iud("UPDATE `users` SET `fname` = '$fname', `lname` = '$lname', `mobile` = '$mobile' WHERE `email` = '$email'");

$address_rs = Database::search("SELECT * FROM `users_has_address` WHERE `users_email` = '$email'");
if ($address_rs->num_rows == 1) {
    Database::iud("UPDATE `users_has_address` SET `line1` = '$line1', `line2` = '$line2', `postal_code` = '$pcode' WHERE `users_email` = '$email'");
} else {
    Database::iud("INSERT INTO `users_has_address` (`users_email`, `city_city_id`, `line1`, `line2`, `postal_code`) VALUES ('$email', '$city', '$line1', '$line2', '$pcode')");
}

if (!empty($_FILES["img"])) {
    $image = $_FILES["img"];
    $image_extension = $image["type"];
    $allowed = ["image/jpeg", "image/png", "image/svg+xml"];

    if (!in_array($image_extension, $allowed)) {
        echo "Invalid image format";
        exit();
    }

    $new_ext = match ($image_extension) {
        "image/jpeg" => ".jpeg",
        "image/png" => ".png",
        "image/svg+xml" => ".svg",
        default => ""
    };

    $file_name = "resources/profile_images/" . $fname . "_" . uniqid() . $new_ext;
    move_uploaded_file($image["tmp_name"], $file_name);

    $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email` = '$email'");
    if ($profile_img_rs->num_rows == 1) {
        Database::iud("UPDATE `profile_img` SET `path` = '$file_name' WHERE `users_email` = '$email'");
    } else {
        Database::iud("INSERT INTO `profile_img` (`path`, `users_email`) VALUES ('$file_name', '$email')");
    }
} else {
    $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email` = '$email'");
    if ($profile_img_rs->num_rows == 0) {
        echo "A profile image has not been selected yet. Please add a profile image";
        exit();
    }
}

echo "Success";
