<?php

    $servername = "localhost"; 
    $username = "root"; 
    $usrpassword = "";
   
    $database = "IWP";
   
    $conn = mysqli_connect($servername, $username, $usrpassword, $database);
   
    if($conn) {
        // echo "success"; 
    } 
    else {
        die("Error". mysqli_connect_error()); 
    } 
?>