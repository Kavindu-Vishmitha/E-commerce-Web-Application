<?php

session_start();
include "connection.php";

$email = $_SESSION["a"]["email"];


$user_rs = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");


if ($user_rs->num_rows == 1) {




    if (sizeof($_FILES) == 1) {

        $image = $_FILES["img"];
        $image_extension = $image["type"];

        $allowed_image_extensions = array("image/jpeg", "image/png", "imge/svg+xml");

        if (in_array($image_extension, $allowed_image_extensions)) {
            $new_img_extension;

            if ($image_extension == "image/jpeg") {
                $new_img_extension = ".jpeg";
            } else if ($image_extension == "image/png") {
                $new_img_extension = ".png";
            }
            if ($image_extension == "image/svg+xml") {
                $new_img_extension = ".svg";
            }



            $file_name = "resources//profile_images//" . $email . "_" . uniqid() . $new_img_extension;
            move_uploaded_file($image["tmp_name"], $file_name);

            $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $email . "'");

            if ($profile_img_rs->num_rows == 1) {

                Database::iud("UPDATE `profile_img` SET `path`='" . $file_name . "' WHERE `users_email` = '" . $email . "'");
            } else {

                Database::iud("INSERT INTO `profile_img`(`path`,`users_email`) VALUES ('" . $file_name . "','" . $email . "')");
            }

            echo ("success");
        }else{
            echo("Invalid Image type");
        }
    } else if (sizeof($_FILES) == 0) {

        echo ("Please choose your Profile Image");
    }
} else {
    echo ("Invalid user");
}
