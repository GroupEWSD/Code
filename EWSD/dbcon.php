<?php
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DATABASE", "ha07");

//establish database connection
$conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
} else {
    // echo " Connect Successfully";
}?>

<html>
    <head>
    <link rel="stylesheet" type="text/css" href="box.css">
    <link rel="stylesheet" type="text/css" href="logandsign.css">
</head>
</html>
