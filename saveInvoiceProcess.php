<?php
session_start();
include "connection.php";

if (!isset($_SESSION["u"])) {
    echo "unauthorized";
    exit();
}

if (
    empty($_POST["o"]) || empty($_POST["i"]) || empty($_POST["m"]) ||
    empty($_POST["a"]) || empty($_POST["q"])
) {
    echo "missing_fields";
    exit();
}

$order_id = $_POST["o"];
$pid = (int)$_POST["i"];
$mail = $_POST["m"];
$amount = (float)$_POST["a"];
$qty = (int)$_POST["q"];

// Product validation
$product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
if ($product_rs->num_rows == 0) {
    echo "invalid_product";
    exit();
}
$product_data = $product_rs->fetch_assoc();

$current_qty = (int)$product_data["qty"];
if ($qty > $current_qty) {
    echo "not_enough_stock";
    exit();
}

$new_qty = $current_qty - $qty;
Database::iud("UPDATE `product` SET `qty` = '" . $new_qty . "' WHERE `id` = '" . $pid . "'");

// Current date & time
$d = new DateTime("now", new DateTimeZone("Asia/Colombo"));
$date = $d->format("Y-m-d H:i:s");

// Insert to invoice
Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`status`,`Product_id`,`users_email`) 
VALUES ('" . $order_id . "', '" . $date . "', '" . $amount . "', '" . $qty . "', '0', '" . $pid . "', '" . $mail . "')");

// Optionally: If this product exists in cart, remove it (Buy Now is separate anyway)
Database::iud("DELETE FROM `cart` WHERE `Product_id` = '" . $pid . "' AND `users_email` = '" . $mail . "'");

echo "success";
