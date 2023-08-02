<?php
$server="";
$username="if0_34736433";
$pass="FN3w46QBdUB";
$db="if0_34736433_airlines";
$con=mysqli_connect($server,$username,$pass,$db);
if(!$con){
    die("connection failed".mysqli_error_connect());
}
?>