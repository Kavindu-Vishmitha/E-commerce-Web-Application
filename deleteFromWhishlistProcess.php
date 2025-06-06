<?php

include "connection.php";

if(isset($_GET["id"])){

    $wid = $_GET["id"];

    Database::iud("DELETE FROM `watchlist` WHERE `w_id`='".$wid."'");
    echo("Removed");
}else{

echo("Something Went Wrong");

}



?>