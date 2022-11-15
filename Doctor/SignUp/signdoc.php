<?php

include '../../DBConnect.php';

$username=$_REQUEST['uname'];
$name = $_REQUEST['name'];
$m=$_REQUEST['mail'];
$ph=$_REQUEST['number'];
$password=$_REQUEST['passw'];
$selected=$_REQUEST['spl'];
$exp=$_REQUEST['exp'];
$fee=$_REQUEST['fee'];
$city=$_REQUEST['city'];
$lang=$_REQUEST['lang'];
$degree=$_REQUEST['deg'];
$password = password_hash($password, PASSWORD_DEFAULT);
$status=0;
if (($username=="") || ($username==NULL) || ($name=="") || ($name==NULL) || ($m=="") || ($m==NULL) || ($degree==NULL) || ($degree=="")|| ($ph=="") || ($ph==NULL) ||($password==NULL) || ($password==""))
    $status=1;
else
    $status=0;

$sql="INSERT INTO doctor (Username, Name, Email, ContactNo, Password, Degree, Speciality, Experience, Language, Fee, City) VALUES ('$username', '$name', '$m','$ph','$password','$degree','$selected','$exp','$lang','$fee','$city')";

if ($status==1)
{
    header('Location: /Doctor-System/Doctor/SignUp/DoctorSignup.html');
}
else
{
   $res = mysqli_query($conn, $sql);
//    echo $res;
    if($res)
      header('Location: /Doctor-System/UserLogin.php');
    else
        echo "fail";
}
mysqli_close($conn);
?>