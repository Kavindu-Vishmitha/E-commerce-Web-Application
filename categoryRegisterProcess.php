<?php
include "connection.php";

$cat = $_POST["c"];

if (empty($cat)) {

    echo("Please Enter Your Category Name");
} else if (strlen($cat) > 20 ){
    
    echo("Your Category Should be less than 20 Characters");

} else if (!preg_match('/[a-zA-Z]/',$cat))  {

    echo ("Invalid Category Name");
}
else{
    
    $rs = Database::search("SELECT * FROM `category` WHERE `cat_name` = '".$cat."'");
    $num = $rs->num_rows;

    if($num > 0){

        echo("Your Category is Already Exists");

    }else{

        Database::iud("INSERT INTO `category`(`cat_name`) VALUE('".$cat."')");
        echo("Success");
    }
}


?>