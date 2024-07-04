<?php
$connection = mysqli_connect("localhost", "root", "", "admission");
$db = mysqli_select_db($connection, "admission");

$delete = $_GET['del'];

$sql = "delete from stud where sno ='$delete'";

if (mysqli_query($connection, $sql)) {
    echo '<script> location.replace("insert.php")</script>';
} else {
    echo "Something went wrong: " . $connection->error;
}

?>