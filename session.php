<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit();
}
$connection = mysqli_connect("localhost", "root", "", "admission");

?>