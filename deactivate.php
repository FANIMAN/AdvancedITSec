<?php

	// Connect to database
    require('config.php');

	// Check if id is set or not, if true,
	// toggle else simply go back to the page
	if (isset($_GET['id']) && !empty($_GET['id'])){

		// Store the value from get to
		// a local variable "account_id"
		$account_id=$_GET['id'];

        // print_r($account_id); 

		// SQL query that sets the status to
		// 0 to indicate deactivation.
		$sql="UPDATE `users` SET `status`= 0 WHERE id='$account_id'";
        // $updres = mysqli_query($conn, $selsql);
    	// $selr = mysqli_fetch_assoc($updres);

		// Execute the query
		mysqli_query($conn,$sql);
	}

	// Go back to course-page.php
	header('location: viewaccounts.php');
?>
