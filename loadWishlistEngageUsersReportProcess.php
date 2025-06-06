<?php

include "connection.php";

$rs = Database::search("SELECT
    w.w_id AS watchlist_id,
    p.id AS product_id,
    p.title AS product_title,
    c.cat_name AS category_name,
    b.brand_name AS brand_name,
    m.model_name AS model_name,
    p.qty AS product_quantity,
    p.price AS product_price,
    p.datetime_added AS product_added_date
FROM
    watchlist w
    JOIN product p ON w.Product_id = p.id
    JOIN category c ON p.category_id = c.cat_id
    JOIN model_has_brand mhb ON p.model_has_brand_id = mhb.id
    JOIN brand b ON mhb.brand_brand_id = b.brand_id
    JOIN model m ON mhb.model_model_id = m.model_id;");

$num = $rs->num_rows;

while ($d = $rs->fetch_assoc()) {
?>

<tr>
    <td><?php echo $d["watchlist_id"] ?></td>
    <td><?php echo $d["product_id"] ?></td>
    <td><?php echo $d["product_title"] ?></td>
    <td><?php echo $d["category_name"] ?></td>
    <td><?php echo $d["brand_name"] ?></td>
    <td><?php echo $d["model_name"] ?></td>
    <td><?php echo $d["product_quantity"] ?></td>
    <td>Rs. <?php echo $d["product_price"] ?>.00</td>
    <td><?php echo $d["product_added_date"] ?></td>
</tr>

<?php
}
?>
