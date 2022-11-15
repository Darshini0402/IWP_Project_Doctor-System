<?php
include '../../DBConnect.php';
session_start();
$loggeduserid = $_SESSION['id'];
$card=$_REQUEST['cardname'];
$no=$_REQUEST['cardno'];
$exp=$_REQUEST['exp'];
$cvv=$_REQUEST['cvv'];
$type=$_REQUEST['card'];
$query = "SELECT Fee FROM doctor where ID = (SELECT Doc_ID FROM appointment WHERE Pat_ID = '" .$loggeduserid. "')";
$inqu="INSERT into billing values('$loggeduserid','$card','$no','$exp','$cvv','$type')";
$result = mysqli_query($conn,$query);
$res= mysqli_query($conn,$inqu);
if($res)
    header('Location: /Doctor-System/Patient/Feedback/FeedBack.php');
?>


