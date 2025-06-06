<?php

include "connection.php";

$color = $_POST["c"];

if (empty($color)) {

    echo("Please Enter Your Color Name");
} else if (strlen($color) > 20 ){
    
    echo("Your Color Should be less than 20 Characters");
}else if (!preg_match('/[a-zA-Z]/',$color)){

    echo ("Invalid Color Name");
}
else{
    
    $rs = Database::search("SELECT * FROM `color` WHERE `clr_name` = '".$color."'");
    $num = $rs->num_rows;

    if($num > 0){

        echo("Your Color is Already Exists");

    }else{

        Database::iud("INSERT INTO `color`(`clr_name`) VALUE('".$color."')");
        echo("Success");
    }
}


?>