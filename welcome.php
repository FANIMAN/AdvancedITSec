<?php 



session_start();

// if (!isset($_SESSION['username'])) {
//     header("Location: index.php");
// }

if (!isset($_SESSION['username']) || !isset($_SESSION['password']) || $_SESSION['role'] != 'member') {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link  href="welcome.css" rel="stylesheet" type="text/css">
    <title>Welcome</title>
</head>
<body>
    <div class="row headerr">
        <div class="welcomename col-sm-8 ">
        <?php echo "<h1>Welcome " . $_SESSION['username'] . "</h1>"; ?>
        </div>
        <div>
       
        <a class="linklogout col-sm-2" href="logout.php">Logout</a>
        </div>
    </div>
  
    
    <?php print_r($_SESSION); ?>
    <div class="container-fluid">
    <div class="row welcome">
        <!-- <button class="btn btn-primary">Click me</button> -->
        <div>
        <a class="linksubmit" href="commentform.php">Submit Feedback</a>
        </div>

        <div>
        <a class="linkreview" href="viewcomments.php">Review Feedback</a>
        </div>
        

    </div>
    </div>
   
    
</body>
</html>