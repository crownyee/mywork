<?php
$servername = "localhost";
$username = "chuchu";
$password = "0927";
$dbName = "mywork";
$link = new mysqli($servername, $username, $password, $dbName);

if($link->connect_error){
  die("Connection failed".$link->connect_error);
}

?>

