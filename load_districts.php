<?php
require "connection.php";

if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];
    $district_rs = Database::search("SELECT * FROM `district` WHERE `province_province_id` = '" . $pid . "'");
    echo '<option value="0">Select District</option>';
    while ($district = $district_rs->fetch_assoc()) {
        echo '<option value="' . $district["district_id"] . '">' . $district["district_name"] . '</option>';
    }
}
?>
