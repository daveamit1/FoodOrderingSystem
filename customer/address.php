<?php
    session_start();
    require_once('../includes/DbConnection.php');
    if(isset($_SESSION['type'])&&$_SESSION['type']===2){
    }else{
        header("Location:../index.php");
        die();
    }
    $msg="";
    if(isset($_POST)&& !empty($_POST)){
        $name=stripslashes(mysqli_real_escape_string($connection,$_POST['name']));
        $line1=stripslashes(mysqli_real_escape_string($connection,$_POST['line1']));
        $line2=stripslashes(mysqli_real_escape_string($connection,$_POST['line2']));
        $city=stripslashes(mysqli_real_escape_string($connection,$_POST['city']));
        $phone=stripslashes(mysqli_real_escape_string($connection,$_POST['phone']));
        $sql="INSERT INTO `address`(`user_id`, `name`, `line1`, `line2`, `city`, `phone`) VALUES ({$_SESSION['userid']},\"{$name}\",\"{$line1}\",\"{$line2}\",\"{$city}\",\"{$phone}\")";
        if(mysqli_query($connection,$sql)){
            $msg="alert('address added successfully');window.opener.location.reload(true); window.close();";
            
        }else{
            $msg="alert('address FAILED. Please try again')";
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Add New Address</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <style>
        #newitem{
            padding-right:10%;
            padding-left:10%;
        }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Foody.com</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"></a></li>
            <li><a href="../logout.php">Logout</a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
          </ul>
          
        </div>
      </div>
    </nav>
	<script>
        <?= $msg ?>
	</script>
    <div class="container">
		<h1><center>Welcome to Foody.com</center></h1>
		<h3><center>Pamper yourself with the most delicious food items</center></h3>
        
        <div class="row" >
            <h4>Add New Address</h4>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="form-group">
                    <label for="name">Enter Name:</label>
                    <input class="form-control" name="name" placeholder="Khushi" required>
                </div>
                <div class="form-group">
                    <label for="line1">Enter Address Line 1:</label>
                    <input class="form-control" name="line1" placeholder="Address Line 1" required>
                </div>
                <div class="form-group">
                    <label for="line2">Enter Address Line 2:</label>
                    <input class="form-control" name="line2" placeholder="Address Line 2">
                </div>
                <div class="form-group">
                    <label for="city">Enter City:</label>
                    <input class="form-control" name="city" placeholder="Panjim" required>;
                </div>
                <div class="form-group">
                    <label for="phone">Enter Phone:</label>
                    <input class="form-control" name="phone" placeholder="10 digit mobile number" required>;
                </div>
                <div class="form-submit">
                    <button type="submit" class="btn btn-large btn-block btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>

   
    <script src="../assets/js/jquery-1.9.0.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="../assets/js/holder.min.js"></script>

</body></html> 