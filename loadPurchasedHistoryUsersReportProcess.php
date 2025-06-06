<?php

include "connection.php";

$rs = Database::search("SELECT invoice.invoice_id,
invoice.qty,
invoice.total,
invoice.date,
users.fname,
users.lname,
users.email,
product.title,
users_has_address.line1,
users_has_address.line2,
users_has_address.postal_code
FROM 
invoice
JOIN 
users ON invoice.users_email = users.email
JOIN 
product ON invoice.Product_id = product.id
JOIN 
users_has_address ON users.email = users_has_address.users_email;
");

$num = $rs->num_rows;

for ($i = 0; $i < $num; $i++) {
    $d = $rs->fetch_assoc();
?>

    <tr>

        <td><?php echo $d["invoice_id"] ?></td>
        <td><?php echo $d["fname"] ?></td>
        <td><?php echo $d["lname"] ?></td>
        <td><?php echo $d["title"] ?></td>
        <td><?php echo $d["qty"] ?></td>
        <td>Rs. <?php echo $d["total"] ?> .00</td>
        <td><?php echo $d["date"] ?></td>
        <td><?php echo $d["line1"] ?></td>
        <td><?php echo $d["line2"] ?></td>
        <td><?php echo $d["postal_code"] ?></td>
        <td><?php echo $d["email"] ?></td>

    </tr>

<?php
}
?>