<?php
    session_start();
    require_once('../includes/DbConnection.php');
    if(isset($_SESSION['type'])&&$_SESSION['type']===0){
    }else{
        header("Location:../index.php");
        die();
    }
    $msg="";
    if(isset($_GET)&& !empty($_GET)){
        if(isset($_GET['update'])){
            $sql="SELECT fooditems.id as id, category_id, itemname, price, categ FROM `fooditems` join categories on `category_id`=categories.id WHERE fooditems.id ={$_GET['itemid']}";
            $result=mysqli_query($connection,$sql);
            if($result)
            if($item=mysqli_fetch_assoc($result)){
            
            }else{
                die(mysqli_error($connection));
            }
            
        }
        if(isset($_GET['delete'])){
            $sql="DELETE FROM `fooditems` WHERE id ={$_GET['itemid']}";
            if(mysqli_query($connection,$sql)){
                header("Location: manageitems.php");
            }else{
                die(mysqli_error($connection));
            }
            die();
        }
    }
    if(isset($_POST)&& !empty($_POST)){
        $itemname=stripslashes(mysqli_real_escape_string($connection,$_POST['itemname']));
        $category=stripslashes(mysqli_real_escape_string($connection,$_POST['category']));
        $price=stripslashes(mysqli_real_escape_string($connection,$_POST['price']));
        $itemid=stripslashes(mysqli_real_escape_string($connection,$_POST['item_id']));
        $sql="UPDATE fooditems set `itemname`='{$itemname}',`category_id`={$category},`price`={$price} WHERE id={$itemid}";
        if(mysqli_query($connection,$sql)){
            $msg="alert('{$itemname} Updated successfully')";
            header("Location:manageitems.php");
        }else{
            $msg="alert('{$itemname} Update failed')";
        }
    }
    $sql="SELECT * FROM `categories` WHERE 1";
    $categories=mysqli_query($connection,$sql);
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
    <title>New Discount Code</title>
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <style>
        #newitem{
            padding-right:10%;
            padding-left:10%;
        }
    </style>
    <script>
        <?= $msg ?>
    </script>
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
          <a class="navbar-brand" href="#">Foody.com</a>
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

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <h3>Select Category</h3>
          <ul class="nav nav-sidebar">
            <li ><a href="index.php">New Food Item</a></li>
            <li ><a href="discount.php">New Discount Coupon</a></li>
			<li class="active"><a href="manageitems.php">Manage Food Items<span class="sr-only">(current)</span></a></li>
			<li ><a href="managediscount.php">Manage Discount Coupons</a></li>
          </ul>
          
        </div>
         
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <div class="row" >
                <h4>Add New Food-Item</h4>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <input name=item_id style="visibility:hidden" value="<?= $item['id'] ?>" required readonly >
                    <div class="form-group">
                        <label for="itemname">Enter Food-Item Name:</label>
                        <input class="form-control" name="itemname" placeholder="Butter Chicken" value="<?= $item['itemname'] ?>" required>
                    </div>
					<div class="form-group">
                        <label for="category">Enter Food-Item Catagory:</label>
                        <select class="form-control" name="category"  required>
							<option value=""> Select </option>
							<?php
                                if($categories)
                                while($cat=mysqli_fetch_assoc($categories)){
                            ?>
                            <option value="<?=$cat['id'] ?>" <?php if($cat['id']==$item['category_id']) echo "selected=\"selected\"" ?> > <?=$cat['categ'] ?> </option>
                            <?php
                                }
                            ?>
						</select>
                    </div>
					<div class="form-group">
                        <label for="price">Enter Food-Item Price:</label>
                        <input class="form-control" name="price" placeholder="Enter price" type="number" value="<?= $item['price'] ?>" required>
                    </div>
					<div class="form-submit">
						<button type="submit" class="btn btn-large btn-block btn-success">Submit</button>
					</div>
                </form>
            </div>
        </div>
      </div>
    </div>

    
    <script src="../assets/js/jquery-1.9.0.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/holder.min.js"></script>

</body></html>