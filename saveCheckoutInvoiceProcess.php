<?php
session_start();
include "connection.php";

if (!isset($_SESSION["u"])) {
    echo "unauthorized";
    exit();
}

if (empty($_POST["o"]) || empty($_POST["m"]) || empty($_POST["a"]) || empty($_POST["q"])) {
    echo "missing_fields";
    exit();
}

$order_id = $_POST["o"];
$mail = $_POST["m"];
$amount = (float)$_POST["a"];
$qty = (int)$_POST["q"];

Database::setUpConnection();
$conn = Database::$connection;

if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    echo "invalid_email";
    exit();
}

if ($qty <= 0 || $amount <= 0) {
    echo "invalid_amount_or_qty";
    exit();
}

$order_id_escaped = $conn->real_escape_string($order_id);
$mail_escaped = $conn->real_escape_string($mail);

$d = new DateTime("now", new DateTimeZone("Asia/Colombo"));
$date = $conn->real_escape_string($d->format("Y-m-d H:i:s"));

$cart_rs = Database::search("SELECT * FROM cart WHERE users_email = '$mail_escaped'");
if ($cart_rs->num_rows === 0) {
    echo "empty_cart";
    exit();
}

while ($cart_data = $cart_rs->fetch_assoc()) {
    $pid = (int)$cart_data["Product_id"];
    $item_qty = (int)$cart_data["qty"];

    $product_rs = Database::search("SELECT qty FROM product WHERE id = '$pid'");
    if ($product_rs->num_rows !== 1) {
        echo "invalid_product_$pid";
        exit();
    }

    $product_data = $product_rs->fetch_assoc();
    $current_qty = (int)$product_data["qty"];

    if ($item_qty > $current_qty) {
        echo "not_enough_stock_for_product_$pid";
        exit();
    }

    $new_qty = $current_qty - $item_qty;
    $new_qty_escaped = $conn->real_escape_string($new_qty);
    Database::iud("UPDATE product SET qty = '$new_qty_escaped' WHERE id = '$pid'");

    $item_qty_escaped = $conn->real_escape_string($item_qty);
    $amount_escaped = $conn->real_escape_string($amount); 
    Database::iud("INSERT INTO invoice (order_id, date, total, qty, status, Product_id, users_email) 
        VALUES ('$order_id_escaped', '$date', '$amount_escaped', '$item_qty_escaped', '0', '$pid', '$mail_escaped')");
}

Database::iud("DELETE FROM cart WHERE users_email = '$mail_escaped'");

echo "success";
exit();
