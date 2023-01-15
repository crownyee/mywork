<?php
require_once './connection.php';

if (isset($_GET["ID"])){

    $ID = $_GET["ID"];

    $sql = "SELECT * FROM myorder_history WHERE ID=$ID";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    $Order_price = $row["Order_price"];

    $sql2 =  "UPDATE myorder_history SET Order_name='退費', consume='-$Order_price' WHERE ID=$ID;";
    mysqli_query($link, $sql2);
}
    header("location: ./ComWeb2.php");
    exit;
?>