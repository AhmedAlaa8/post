<?php


$conn = mysqli_connect("localhost", "root", "", "post&com");



$DL = "DELETE FROM posts WHERE  `posts`.`id` = 5";

mysqli_query($conn, $DL);

$x = $_POST['dm'];

echo $_POST['id'];


var_dump($_POST);

// unlink("./image/$x");
