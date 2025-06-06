<?php

include "connection.php";

$brand = $_POST["b"];

if(empty($brand)) {
    echo("Please Enter Your Brand Name");
} else if(strlen($brand) > 20) {
    echo("Your Brand Name should be less than 20 Characters");
    
}else if (!preg_match('/[a-zA-Z]/',$brand)){

    echo ("Invalid Brand Name");
}
else{
    
    $rs = Database::search("SELECT * FROM `brand` WHERE `brand_name`='".$brand."'");
    $num = $rs->num_rows;
    
    if ($num > 0) {
        echo("Your Brand Name is Already Exists");
    } else {
        
        Database::iud("INSERT INTO `brand`(`brand_name`) VALUE('".$brand."')");
        echo("Success");
    }
    
}
?>