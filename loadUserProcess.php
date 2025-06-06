<?php

include "connection.php";

$rs = Database::search("SELECT * FROM `users` WHERE `user_type_id` = '2'");

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
        <td><?php echo $d["fname"] ?></td>
        <td><?php echo $d["lname"] ?></td>
        <td><?php echo $d["email"] ?></td>
        <td><?php echo $d["mobile"] ?></td>
        <td>
            <?php
            if ($d["status_status_id"] == 1) {
            ?>
                <div class="col-1">
                    <button class="btn btn-success" id="ac" onclick="userStatus('<?php echo $d['email']; ?>');">Active</button>
                </div>
            <?php
            } else {
                ?>
                <div class="col-1">
                    <button class="btn btn-danger" id="de" onclick="userStatus('<?php echo $d['email']; ?>');">Deactive</button>
                </div>
            <?php
            }
            ?>
        </td>
    </tr>

<?php
}
?>
