<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);
	// echo "<script>alert('$result')</script>";
	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		$_SESSION['role'] = $row['role'];
		$_SESSION['password'] = $row['password'];
		$_SESSION['status'] = $row['status'];

		if($_SESSION['role'] == 'member' && $_SESSION['status'] == 1){
			header("Location: welcome.php");
		}elseif($_SESSION['role'] == 'member' && $_SESSION['status'] == 0){
		//   echo "<script>alert('You Can not login your account is Deactivated')</script>";
			$fmsg = "You Cant Login. Your Account Is Deactivated";
			header("Location: index.php");
		}
		elseif($_SESSION['role'] == 'admin'){
			header("Location: adminwelcome.php");
		}else{
			$fmsg = "Email or Password is Wrong";
			// header("Location: index.php");
		}
		
	} else {
		$fmsg = "Invalid Credential";
		// header("Location: index.php");
		// echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Advanced IT SEC</title>
</head>
<body>
	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
            <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
	</div>
</body>
</html>