<?php
session_start();
require "connection.php";

header('Content-Type: application/json'); 

if (!isset($_SESSION["u"])) {
    echo json_encode(["status" => 1, "message" => "User not logged in"]);
    exit;
}

$umail = $_SESSION["u"]["email"];
$array = [];

$order_id = uniqid();

$address_rs = Database::search("SELECT * FROM `users_has_address` WHERE `users_email`='" . $umail . "'");
if ($address_rs->num_rows != 1) {
    echo json_encode(["status" => 2, "message" => "Address not found"]);
    exit;
}

$address_data = $address_rs->fetch_assoc();
$city_id = $address_data["city_city_id"];
$address = $address_data["line1"] . ", " . $address_data["line2"];

$city_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='" . $city_id . "'");
$city_data = $city_rs->fetch_assoc();
$district_id = $city_data["district_district_id"];
$city_name = $city_data["city_name"];

$cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $umail . "'");
if ($cart_rs->num_rows == 0) {
    echo json_encode(["status" => 3, "message" => "Cart is empty"]);
    exit;
}

$total = 0;
$item_names = [];
$qty_total = 0;

while ($cart_data = $cart_rs->fetch_assoc()) {
    $pid = $cart_data["Product_id"];
    $qty = $cart_data["qty"];
    $qty_total += $qty;

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    if ($product_rs->num_rows == 1) {
        $product_data = $product_rs->fetch_assoc();
        $price = (int)$product_data["price"];
        $item_names[] = $product_data["title"];

        $delivery_fee = $district_id == "2" ? $product_data["delivery_fee_colombo"] : $product_data["delivery_fee_other"];
        $total += ($price * $qty) + (int)$delivery_fee;
    }
}

$item = implode(", ", $item_names);
$amount = $total;
$currency = "LKR";

$fname = $_SESSION["u"]["fname"];
$lname = $_SESSION["u"]["lname"];
$mobile = $_SESSION["u"]["mobile"];

$merchant_id = "***********";
$merchant_secret = "*****************************";

$hash = strtoupper(
    md5(
        $merchant_id .
            $order_id .
            number_format($amount, 2, '.', '') .
            $currency .
            strtoupper(md5($merchant_secret))
    )
);

$array = [
    "status" => 0,
    "id" => $order_id,
    "item" => $item,
    "amount" => $amount,
    "fname" => $fname,
    "lname" => $lname,
    "mobile" => $mobile,
    "address" => $address,
    "city" => $city_name,
    "umail" => $umail,
    "mid" => $merchant_id,
    "currency" => $currency,
    "hash" => $hash,
    "qty" => $qty_total
];

echo json_encode($array);
