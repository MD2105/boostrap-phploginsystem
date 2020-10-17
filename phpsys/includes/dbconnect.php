<?php

$servername = "localhost";
$dbUsername = "root";
$dbpassword = "";
$dbName = "userdetail";

$conn = mysqli_connect($servername,$dbUsername,$dbpassword,$dbName);
if (!$conn){
    die("Connection Failed: ".mysqli_connect_error());
}
