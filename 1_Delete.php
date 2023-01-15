<?php
require_once './connection.php';


if (isset($_GET["Id_card_number"])){


    $Id_card_number = $_GET["Id_card_number"];
    $sql= "SELECT * FROM `myclient` WHERE Id_card_number='$Id_card_number';";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);


    if($row['Consumption_status'] == '正常'){
        $sql =  "UPDATE myclient SET Consumption_status='停用' WHERE Id_card_number='$Id_card_number';"; 
    }else{
        $sql =  "UPDATE myclient SET Consumption_status='正常' WHERE Id_card_number='$Id_card_number';";
    }
    
    mysqli_query($link, $sql);
}
    header("location: ./ComWeb1.php");
    exit;
?>