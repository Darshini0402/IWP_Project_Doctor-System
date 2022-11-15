<?php
session_start();
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>DashBoard</title>

        <link rel="stylesheet" href="../styles/NavBar.css">
        
        <style>
            html{
                background-color: black;
                color: antiquewhite;
            }
            h1{
                color: antiquewhite;
                text-align: center;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <nav class="navbar">
            <div class="navbar-container container">
                <input type="checkbox" name="" id="">
                <div class="hamburger-lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </div>
                <ul class="menu-items">
                    <li><a href="#">Home</a></li>
                    <li><a href="Booking/Book.php">Book an Appointment</a></li>
                    <li><a href="Edit/Edit.php">Edit Appointment</a></li>
                    <li><a href="Cancel/Cancel.php">Cancel Appointment</a></li>
                    <li><a href="Logout.php">Logout</a></li>
                </ul>
                <h5 class="logo" style="font-size: 1.3rem;">Welcome 
                <?php if($_SESSION["patname"]) { echo $_SESSION["patname"]; }?> </h5>
            </div>
        </nav>
        <br><br><br><br><br>
    </body>
</html>