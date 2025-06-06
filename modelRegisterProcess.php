<?php

include "connection.php";

$model = $_POST["m"];

if(empty($model)) {
    echo("Please Enter Your Model Name");
} else if(strlen($model) > 20) {
    echo("Your Model Name should be less than 20 Characters");
    
}else if (!preg_match('/[a-zA-Z]/',$model)){

    echo ("Invalid Model Name");
}
else{
    
    $rs = Database::search("SELECT * FROM `model` WHERE `model_name`='".$model."'");
    $num = $rs->num_rows;
    
    if ($num > 0) {
        echo("Your Model Name is Already Exists");
    } else {
        
        Database::iud("INSERT INTO `model`(`model_name`) VALUE('".$model."')");
        echo("Success");
    }
    
}
?>