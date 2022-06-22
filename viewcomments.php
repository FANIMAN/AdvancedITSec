<?php
require('config.php');

	session_start();

	// if (!isset($_SESSION['username'])) {
	// 	header("Location: index.php");
	// }

	if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
		header("Location: index.php");
	}

	$fromuser = $_SESSION['username'];
	$role = $_SESSION['role'];
	if($role == 'member'){
		$sql = "SELECT * FROM comments WHERE fromuser='$fromuser'";
	}else{
		$sql = "SELECT * FROM comments";
	}
	$res = mysqli_query($conn, $sql);
 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
 
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" href="styles.css" >
 
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>
 
 
<div class="container">
<div class="row commentpage">   
        <div class="col-sm-2">
			<!-- <?php
               $role = $_SESSION['role'];
			   $result = $role == 'member' ? 'welcome.php' : 'adminwelcome.php';
			?> -->
			 <a href="welcome.php">Back</a>
          
            
        </div>
	<div class="col-sm-10 comments">
		<div class="panel panel-default">
			<div class="panel-heading">Comments</div>
			<table class="table table-striped"> 
				<thead> 
					<tr> 
						<th>#</th> 
						<!-- <th>Content Title</th>  -->
						<th>Name</th> 
						<th>Email</th> 
						<th>Comment</th> 
						<th>Filename</th> 
						<!-- <th>Feedback From</th>  -->
						<th>Operations</th> 
					</tr> 
				</thead> 
				<tbody> 
				<?php
					while ( $r = mysqli_fetch_assoc($res)) {
				?>
					<tr> 
						<th scope="row"><?php echo $r['id']; ?></th> 
						<!-- <td><?php echo $r['id']; ?></td>  -->
						<td><?php echo $r['name'] ?></td> 
						<td><?php echo $r['email'] ?></td> 
						<td><?php echo $r['subject']; ?></td> 
						<td><?php echo $r['filename']; ?></td> 
						<!-- <td><?php echo $r['fromuser']; ?></td>  -->
						<td><a href="editcomment.php?id=<?php echo $r['id']; ?>">Edit</a> --- <a href="delcomment.php?id=<?php echo $r['id']; ?>">Del</a></td> 
					</tr> 
				<?php } ?>
				</tbody> 
			</table>
		</div>
 
	</div>
</div>
</div>
</body>
</html>