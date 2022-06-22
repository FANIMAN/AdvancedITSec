<?php 

$server = "localhost";
$user = "root";
$pass = "Faniman@1999";
$database = "mydatabase";

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

?>