<?php

	// Connect to database
    require('config.php');

	// Check if id is set or not if true toggle,
	// else simply go back to the page
	if (isset($_GET['id']) & !empty($_GET['id'])){

		// Store the value from get to a
		// local variable "course_id"
		$account_id=$_GET['id'];

		// SQL query that sets the status
		// to 1 to indicate activation.
		$sql="UPDATE `users` SET `status`=1 WHERE id='$account_id'";
        // $updres = mysqli_query($conn, $selsql);
    	// $selr = mysqli_fetch_assoc($updres);

		// Execute the query
		mysqli_query($conn,$sql);
	}

	// Go back to course-page.php
	header('location: viewaccounts.php');
?>
