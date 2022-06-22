<?php
require('config.php');

session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
    header("Location: index.php");
}
 

// define variables and set to empty values
$nameErr = $emailErr = $subjectErr = $fileErr = "";
$name = $email = $subject = $filename = $fromuser = "";

// if(isset($_POST) & !empty($_POST)){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

  
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
      } else {
        $nam = test_input($_POST["name"]);
        $name = mysqli_real_escape_string($conn, $nam);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
          $nameErr = "Only letters and white space allowed";
        }
      }

      if (empty($_POST["email"])) {
        $emailErr = "Email is required";
      } else {
        $emai = test_input($_POST["email"]);
        $email = mysqli_real_escape_string($conn, $emai);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }
      }

      if (empty($_POST["subject"])) {
        $subjectErr = "Subject is required";
      } else {
        $subjec = test_input($_POST["subject"]);
        $subject = mysqli_real_escape_string($conn, $subjec);
      }


      // $filename = mysqli_real_escape_string($conn, $filename);
    


      if (empty($_FILES['filename']['name'])) {
        $fileErr = "File is required";
      } else {
        // $filenam = test_input($_POST["filename"]);
        $filename = mysqli_real_escape_string($conn, $filename);
      }





    //       if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
    //     echo "You file extension must be .zip, .pdf or .docx";
    // } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
    //     echo "File too large!";
    // } else {
    //     // move the uploaded (temporary) file to the specified destination
    //     if (move_uploaded_file($file, $destination)) {
    //         $sql = "INSERT INTO files (name, size, downloads) VALUES ('$filename', $size, 0)";
    //         if (mysqli_query($conn, $sql)) {
    //             echo "File uploaded successfully";
    //         }
    //     } else {
    //         echo "Failed to upload file.";
    //     }
    // }


          // // name of the uploaded file
          // $filenamee = $_FILES['filename']['name'];

          // // destination of the file on the server
          // $destination = 'uploads/' . $filenamee;
      
          // // get the file extension
          // $extension = pathinfo($filenamee, PATHINFO_EXTENSION);
      
          // // the physical file on a temporary uploads directory on the server
          // $file = $_FILES['filename']['tmp_name'];



    $fromuser = $_SESSION['username'];

    if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["subject"]) && empty($nameErr) && empty($emailErr) && empty($subjectErr) && empty($fileErr)){
      $name = $_POST['name'];
      if (isset($_FILES['filename']['name']))
      {
        $file_name = $_FILES['filename']['name'];
        $file_tmp = $_FILES['filename']['tmp_name'];

        move_uploaded_file($file_tmp,"./pdf/".$file_name);

        $isql = "INSERT INTO comments (name, email, subject, filename, fromuser) VALUES ('$name', '$email', '$subject', '$file_name', '$fromuser')";
        $ires = mysqli_query($conn, $isql) or die(mysqli_error($conn));
        if($ires){
            $smsg = "Your Comment Submitted Successfully";
        }else{
            $fmsg = "Failed to Submit Your Comment";
        }

      }
      else
      {
         ?>
          <div class=
          "alert alert-danger alert-dismissible
          fade show text-center">
            <a class="close" data-dismiss="alert"
               aria-label="close">×</a>
            <strong>Failed!</strong>
                File must be uploaded in PDF format!
          </div>
        <?php
      }




        // $isql = "INSERT INTO comments (name, email, subject, filename, fromuser) VALUES ('$name', '$email', '$subject', '$filename', '$fromuser')";
        // $ires = mysqli_query($conn, $isql) or die(mysqli_error($conn));
        // if($ires){
        //     $smsg = "Your Comment Submitted Successfully";
        // }else{
        //     $fmsg = "Failed to Submit Your Comment";
        // }
       
    }else{
        $fmsg = "Please fill all the questions correctly";
  

    }


    
    
	// $name = mysqli_real_escape_string($conn, $_POST['name']);
	// $email = mysqli_real_escape_string($conn, $_POST['email']);
	// $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    // $filename = mysqli_real_escape_string($conn, $_POST['filename']);



    // echo $isql = "INSERT INTO comments (name, email, subject, filename) VALUES ('$name', '$email', '$subject', '$filename')";
	// $isql = "INSERT INTO comments (name, email, subject, filename) VALUES ('$name', '$email', '$subject', '$filename')";
	// $ires = mysqli_query($conn, $isql) or die(mysqli_error($conn));
	// if($ires){
	// 	$smsg = "Your Comment Submitted Successfully";
	// }else{
	// 	$fmsg = "Failed to Submit Your Comment";
	// }
 }

 function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  
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
    <div class="row homepage">   
        <div class="col-sm-2">
            <a href="welcome.php">Homepage</a>
        </div>

        <div class="col-sm-8 commentform">
    
            <div class="panel panel-default">
            <!-- <div class="panel-heading">Submit Your Comments</div> -->
            <div class="panel-body">
                <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
                <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputName1" placeholder="Name">
                    <span class="error">* <?php echo $nameErr;?></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    <span class="error">* <?php echo $emailErr;?></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Subject</label>
                    <textarea name="subject" class="form-control" rows="3" placeholder="Comment"></textarea>
                    <span class="error">* <?php echo $subjectErr;?></span>
                </div>
                <div class="form-group">
                    <label>Upload File</label>
                    <input type="file" name="filename" class="form-control" accept=".pdf" title="Upload PDF"/>
                    <span class="error">* <?php echo $fileErr;?></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            </div>
    
        </div>
	
	</div>
</div>
</body>
</html>