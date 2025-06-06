<?php
session_start();
include "connection.php";

if(isset($_SESSION["u"])) {
    $umail = $_SESSION["u"]["email"];
    $cart_rs = Database::search("SELECT SUM(`qty`) AS cart_count FROM `cart` WHERE `users_email`='".$umail."'");
    $cart_data = $cart_rs->fetch_assoc();
    echo $cart_data['cart_count'];
} else {
    echo 0;
}
?>
