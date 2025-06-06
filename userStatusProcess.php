<?php
include "connection.php";

$user_email = $_GET["email"];

$user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $user_email . "'");
$user_num = $user_rs->num_rows;

if ($user_num == 1) {
    $user_data = $user_rs->fetch_assoc();
    $status = $user_data["status_status_id"];

    if ($status == 1) {
        Database::iud("UPDATE `users` SET `status_status_id`='2' WHERE `email`='" . $user_email . "'");
        echo ("User Successfully Deactivated");
    
    } else if ($status == 2) {
        Database::iud("UPDATE `users` SET `status_status_id`='1' WHERE `email`='" . $user_email . "'");
        echo ("User Successfully Activated");
    }
} else {
    echo ("Cannot find the user. Please try again later");
}
?>

