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
        if(isset($_POST['add'])){
            $itemid=stripslashes(mysqli_real_escape_string($connection,$_POST['itemid']));
            $orderid=stripslashes(mysqli_real_escape_string($connection,$_POST['orderid']));
            $qty=stripslashes(mysqli_real_escape_string($connection,$_POST['qty']));
            $remarks=stripslashes(mysqli_real_escape_string($connection,$_POST['remarks']));
            $sql="INSERT INTO `order_fooditems`(`order_id`, `fooditems_id`, `quantity`, `remarks`) VALUES ({$orderid},{$itemid},{$qty},'{$remarks}')";
            if(mysqli_query($connection,$sql)){
                header("Location: editorder.php?orderid={$orderid}");
            }
            die(mysqli_error($connection));
        }
        if(isset($_POST['update'])){
            $itemid=stripslashes(mysqli_real_escape_string($connection,$_POST['itemid']));
            $orderid=stripslashes(mysqli_real_escape_string($connection,$_POST['orderid']));
            $qty=stripslashes(mysqli_real_escape_string($connection,$_POST['qty']));
            $remarks=stripslashes(mysqli_real_escape_string($connection,$_POST['remarks']));
            $sql="UPDATE `order_fooditems` set `quantity`={$qty}, `remarks`= '{$remarks}' where `order_id`={$orderid} and `fooditems_id`={$itemid}";
            if(mysqli_query($connection,$sql)){
                header("Location: revieworder.php?orderid={$orderid}");
            }
            die(mysqli_error($connection));
        }
    }
?>