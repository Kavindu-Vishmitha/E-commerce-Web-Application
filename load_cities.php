<?php
require "connection.php";

if (isset($_GET["did"])) {
    $did = $_GET["did"];
    $city_rs = Database::search("SELECT * FROM `city` WHERE `district_district_id` = '" . $did . "'");
    echo '<option value="0">Select City</option>';
    while ($city = $city_rs->fetch_assoc()) {
        echo '<option value="' . $city["city_id"] . '">' . $city["city_name"] . '</option>';
    }
}
?>
