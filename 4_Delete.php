<?php
require_once './connection.php';

if (isset($_GET["ID"])){

    $ID = $_GET["ID"];

    $sql = "DELETE FROM mycompany_receive WHERE ID=$ID";
    mysqli_query($link, $sql);
}

header("location: ./ComWeb4.php");
exit;
?>