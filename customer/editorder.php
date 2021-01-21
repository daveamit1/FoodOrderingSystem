<?php
    session_start();
    require_once('../includes/DbConnection.php');
    if(isset($_SESSION['type'])&&$_SESSION['type']===2){
    }else{
        header("Location:../index.php");
        die();
    }
    $msg="";
    if(isset($_GET)&& !empty($_GET)){
        if(isset($_GET['delete'])){
            $sql="DELETE FROM `orders` WHERE id={$_GET['orderid']}";
            if(mysqli_query($connection,$sql)){
                header("Location: index.php");
            }else{
                echo mysqli_error($connection);
            }
            die();
        }
        if(isset($_GET['update'])){
            $msg="alert('Place order for items here. To change the quantity or remove an item, go to review order page');";
        }
    }
    $sql="select * from categories";
    $result=mysqli_query($connection,$sql);
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
    <title>Edit order</title>
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
        <?php
            if($result)
            while($category=mysqli_fetch_assoc($result)){
        ?>
		<div class="row">
            <h4><?=$category['categ'] ?></h4>
			<table class="table table-striped">
				<thead>
				<tr>
					<th>Name</th>
                    <th>Price</th>
					<th>Quantity</th>
                    <th>Remarks</th>
					<th>#</th>
				</tr>
				</thead>
				<tbody>
                    <?php
                        $query="SELECT * from fooditems where category_id = {$category['id']} and id not in (SELECT `fooditems_id` FROM `order_fooditems` WHERE order_id = {$_GET['orderid']} )";
                        $res=mysqli_query($connection,$query);
                        if($res)
                        while($item=mysqli_fetch_assoc($res)){
                    ?>
					<tr>
                        <form action="waiter.php" method="post">
                        <input name="itemid" type="number" value="<?= $item['id'] ?>" readonly required style="visibility:hidden;">
                        <input name="orderid" type="number" value="<?= $_GET['orderid'] ?>" readonly required style="visibility:hidden;">
						<td> <?= $item['itemname'] ?> </td>
						<td> <?= $item['price'] ?> </td>
						<td> <input type=number min=1 name=qty  required> </td>
						<td> <input type=text name=remarks > </td>
						<td><button type="submit" class="btn btn-warning " name="add">Add item </button></td>
                        </form>
					</tr>
                    <?php } ?>
				</tbody>
			</table>
		</div>
        <?php 
            }
        ?>
		<div class=row>
			<center>
				<form action="revieworder.php" method="get">
					<input name=orderid value=<?= $_GET['orderid'] ?> style="visibility:hidden" readonly>
					<button type="submit" class="btn btn-lg btn-block btn-success">Place Order</button>
				</form>
			</center>
		</div>
    </div>

    
    <script src="../assets/js/jquery-1.9.0.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/holder.min.js"></script>

</body></html>