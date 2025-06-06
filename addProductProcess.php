<?php

session_start();
include "connection.php";

$email = $_SESSION["a"]["email"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["con"];
$clr = $_POST["col"];
$qty = $_POST["q"];
$cost = $_POST["co"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["de"];

if (empty($category)) {
    echo "Please select the category";
} elseif (empty($brand)) {
    echo "Please select the brand";
} elseif (empty($model)) {
    echo "Please select the model";
} elseif (empty($title)) {
    echo "Please enter the title";
} elseif (strlen($title) > 100) {
    echo "Your title should be less than 100 characters";
} elseif (empty($condition)) {
    echo "Please select the product condition";
} elseif (empty($clr)) {
    echo "Please select the color";
} elseif (empty($qty)) {
    echo "Please enter the product quantity";
} elseif (!preg_match('/^\d+(\.\d{1,2})?$/', $cost)) {
    echo "Please enter a valid price";
} elseif (!preg_match('/^\d+(\.\d{1,2})?$/', $dwc)) {
    echo "Please enter the delivery fee for Colombo";
} elseif (!preg_match('/^\d+(\.\d{1,2})?$/', $doc)) {
    echo "Please enter the delivery fee for out of Colombo";
} elseif (empty($desc)) {
    echo "Please enter the product description";
} elseif (empty($_FILES) || !isset($_FILES["image0"])) {
    echo "Images not uploaded";
} else {

    $allowed_types = ["image/jpg", "image/jpeg", "image/png", "image/svg+xml"];
    $image_count = count($_FILES);
    $valid_images = [];

    if ($image_count > 3) {
        echo "Only 3 images allowed";
        exit;
    }

    foreach ($_FILES as $img) {
        if ($img["error"] === 0 && !empty($img["name"])) {
            $type = $img["type"];

            if (!in_array($type, $allowed_types)) {
                echo "Invalid image type";
                exit;
            }

            $valid_images[] = $img;
        }
    }

    if (count($valid_images) === 0) {
        echo "Images not uploaded";
        exit;
    }

    $mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='$model' AND `brand_brand_id`='$brand'");
    if ($mhb_rs->num_rows > 0) {
        $mhb_data = $mhb_rs->fetch_assoc();
        $model_has_brand_id = $mhb_data["id"];
    } else {
        Database::iud("INSERT INTO `model_has_brand`(`model_model_id`,`brand_brand_id`) VALUES ('$model','$brand')");
        $model_has_brand_id = Database::$connection->insert_id;
    }

    $d = new DateTime("now", new DateTimeZone("Asia/Colombo"));
    $date = $d->format("Y-m-d H:i:s");
    $status = 1;

    Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,
        `delivery_fee_other`,`category_id`,`model_has_brand_id`,`color_clr_id`,`condition_condition_id`,`status_status_id`,
        `users_email`) VALUES ('$cost','$qty','$desc','$title','$date','$dwc','$doc','$category','$model_has_brand_id',
        '$clr','$condition','$status','$email')");

    $product_id = Database::$connection->insert_id;

    $img_index = 0;
    foreach ($valid_images as $img) {
        $ext = pathinfo($img["name"], PATHINFO_EXTENSION);
        $filename = "resources/Product_Images/" . $title . "_" . $img_index . "_" . uniqid() . "." . $ext;

        if (move_uploaded_file($img["tmp_name"], $filename)) {
            Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) VALUES ('$filename','$product_id')");
            $img_index++;
        }
    }

    echo "Product added successfully!";
}
