<?php
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    echo "success";
} else {
    echo "Product ID not provided";
}

?>
