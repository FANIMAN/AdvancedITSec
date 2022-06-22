<?php
require('config.php');
 
if(isset($_GET['id']) & !empty($_GET['id'])){
	$id = $_GET['id'];
 
	$delsql="DELETE FROM `comments` WHERE id=$id";
	if(mysqli_query($conn, $delsql)){
		header("Location: viewcomments.php");
	}
}else{
	header('location: viewcomments.php');
}
 
?>