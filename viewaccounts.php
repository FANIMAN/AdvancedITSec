<?php
require('config.php');

	session_start();

	// if (!isset($_SESSION['username'])) {
	// 	header("Location: index.php");
	// }

	// if (!isset($_SESSION['username']) || !isset($_SESSION['password'])) {
	// 	header("Location: index.php");
	// }

	
if (!isset($_SESSION['username']) || !isset($_SESSION['password']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
}


	$fromuser = $_SESSION['username'];
	$role = $_SESSION['role'];
	if($role == 'admin'){
		$sql = "SELECT * FROM users WHERE role='member'";
	}else{
		// $sql = "SELECT * FROM comments WHERE fromuser='$fromuser'";
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
	<link rel="stylesheet" href="viewaccount.css" >
 
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>
 
 
<div class="container">
<div class="row commentpage">   
        <div class="col-sm-2">
			<?php
               $role = $_SESSION['role'];
			   $result = $role == 'member' ? 'welcome.php' : 'adminwelcome.php';
			//    echo "$result"
			  

			?>
			 <a href="adminwelcome.php">Back</a>
          
            
        </div>
	<div class="col-sm-10 comments">
		<div class="panel panel-default">
			<div class="panel-heading">User Accounts</div>
			<table class="table table-striped"> 
				<thead> 
					<tr> 
						<th>#</th> 
						<!-- <th>Content Title</th>  -->
						<th>Name</th> 
						<th>Email</th> 
						<th>Role</th> 
						<th>Account Status</th> 
						<th>Change Status</th> 
						<!-- <th>Status</th>  -->
					</tr> 
				</thead> 
				<tbody> 
				<?php
					while ( $r = mysqli_fetch_assoc($res)) {
				?>
					<tr> 
						<th scope="row"><?php echo $r['id']; ?></th> 
						<!-- <td><?php echo $r['id']; ?></td>  -->
						<td><?php echo $r['username'] ?></td> 
						<td><?php echo $r['email'] ?></td> 
						<td><?php echo $r['role']; ?></td> 
						<td><?php 
                        // Usage of if-else statement to translate the 
                        // tinyint status value into some common terms
                        // 0-Inactive
						// 1-Active
						if($r['status']=="1") 
							echo "Active";
						else 
							echo "Inactive";
							?>                          
              		  </td>

						<td>
                    <?php 
                    if($r['status']=="1") 
  
                        // if a course is active i.e. status is 1 
                        // the toggle button must be able to deactivate 
                        // we echo the hyperlink to the page "deactivate.php"
                        // in order to make it look like a button
                        // we use the appropriate css
                        // red-deactivate
                        // green- activate
                        echo 
"<a href=deactivate.php?id=".$r['id']." class='btn red'>Deactivate</a>";
                    else 
                        echo 
"<a href=activate.php?id=".$r['id']." class='btn green'>Activate</a>";
                    ?>

						</td>


						<!-- <td><?php echo $r['filename']; ?></td> 
						<td><?php echo $r['fromuser']; ?></td>  -->
						<!-- <td><a href="editcomment.php?id=<?php echo $r['id']; ?>">Deactivate</a> --- <a href="delcomment.php?id=<?php echo $r['id']; ?>">Activate</a></td>  -->
						<!-- <td><button href="editcomment.php?id=<?php echo $r['id']; ?>">Deactivate</button> --- <button href="delcomment.php?id=<?php echo $r['id']; ?>">Activate</button></td>  -->
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