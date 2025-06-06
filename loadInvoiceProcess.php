<?php
session_start();
include "connection.php";

if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"]["email"];

    $rs = Database::search("SELECT  product.title, invoice.date, invoice.qty, invoice.total, invoice.invoice_id 
                            FROM `product` 
                            INNER JOIN `invoice` ON product.id = invoice.Product_id 
                            INNER JOIN `users` ON users.email = invoice.users_email  
                            WHERE users.email = '" . $user . "'");

    $num = $rs->num_rows;

    for ($i = 0; $i < $num; $i++) {
        $d = $rs->fetch_assoc();
?>

        <tr>
            <th scope="row">
                <?php
                echo $i + 1;
                ?>
            </th>
            <td><?php echo $d["title"]; ?></td>
            <td><?php echo $d["date"]; ?></td>
            <td><?php echo $d["qty"]; ?></td>
            <td>Rs. <?php echo $d["total"]; ?> .00</td>
        </tr>

<?php
    }
} else {
    echo "User not authenticated";
}
?>
