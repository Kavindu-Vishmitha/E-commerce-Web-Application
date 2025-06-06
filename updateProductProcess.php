<?php
session_start();
require "connection.php";

if (isset($_SESSION["p"])) {

    $pid = $_SESSION["p"]["id"];

    $title = $_POST["t"];
    $qty = $_POST["q"];
    $dwc = $_POST["dwc"];
    $doc = $_POST["doc"];
    $desc = $_POST["d"];

    if (empty($title)) {
        echo "Please Enter the Title";
    } else if (strlen($title) > 100) {
        echo "Your Title Should be less than 100 Characters";
    } else if (empty($qty)) {
        echo "Please Enter the Product Quantity Count";
    } else if (!preg_match('/^\d+$/', $qty)) {
        echo "Please enter a valid quantity";
    } else if (empty($dwc)) {
        echo "Please Enter the Product Delivery Cost within Colombo";
    } else if (!preg_match('/^\d+(\.\d{1,2})?$/', $dwc)) {
        echo "Please Enter a valid delivery fee for Colombo";
    } else if (empty($doc)) {
        echo "Please Enter the Product Delivery Cost out of Colombo";
    } else if (!preg_match('/^\d+(\.\d{1,2})?$/', $doc)) {
        echo "Please Enter a valid delivery fee for out of Colombo";
    } else if (empty($desc)) {
        echo "Please Enter the Product Description";
    } else {

        $allowed_types = ["image/jpg", "image/jpeg", "image/png", "image/svg+xml"];
        $valid_images = [];
        $image_count = 0;

        foreach ($_FILES as $img) {
            if ($img["error"] === 0 && !empty($img["name"])) {
                $image_count++;

                if (!in_array($img["type"], $allowed_types)) {
                    echo "Invalid image type: " . $img["type"];
                    exit;
                }

                $valid_images[] = $img;
            }
        }

        if ($image_count > 3) {
            echo "Only 3 images allowed";
            exit;
        }

        Database::iud("UPDATE `product` SET 
            `title`='" . $title . "', 
            `qty`='" . $qty . "', 
            `delivery_fee_colombo`='" . $dwc . "',
            `delivery_fee_other`='" . $doc . "', 
            `description`='" . $desc . "' 
            WHERE `id`='" . $pid . "'");

        if ($image_count > 0) {
            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
            while ($img_data = $img_rs->fetch_assoc()) {
                if (file_exists($img_data["img_path"])) {
                    unlink($img_data["img_path"]);
                }
            }
            Database::iud("DELETE FROM `product_img` WHERE `product_id`='" . $pid . "'");

            $img_index = 0;
            foreach ($valid_images as $img) {
                $ext = pathinfo($img["name"], PATHINFO_EXTENSION);
                $file_path = "resources/Product_Images/" . $title . "_" . $img_index . "_" . uniqid() . "." . $ext;

                if (move_uploaded_file($img["tmp_name"], $file_path)) {
                    Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) 
                        VALUES ('" . $file_path . "','" . $pid . "')");
                    $img_index++;
                }
            }
        }

        unset($_SESSION["p"]);

        echo "Product has been Updated";
    }
} else {
    echo "No product selected to update.";
}
?>
