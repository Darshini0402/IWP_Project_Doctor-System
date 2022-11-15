<?php

include '../../DBConnect.php';

$username=$_REQUEST['uname'];
$m=$_REQUEST['mail'];
$a=$_REQUEST['age'];
$ph=$_REQUEST['phno'];
$password=$_REQUEST['passw'];
$password = password_hash($password, PASSWORD_DEFAULT);
$status=0;

if (($username=="") || ($username==NULL) || ($m=="") || ($m==NULL) || ($a==NULL) || ($a=="")|| ($ph=="") || ($ph==NULL) ||($password==NULL) || ($password==""))
    $status=1;
else
    $status=0;

$sql="INSERT INTO patient (Username, Email, Age, Contact_No, Password) VALUES ('$username', '$m','$a','$ph','$password')";

if ($status==1)
{
    header('Location: /Doctor-System/Patient/SignUp/PatientSignUp.html');
}
else
{
    $res = mysqli_query($conn, $sql);
    if($res)
        header('Location: /Doctor-System/UserLogin.html');
}
mysqli_close($conn);
?>