<?php
session_start();
include '../../DBConnect.php';
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>DashBoard</title>

        <link rel="stylesheet" href="../../styles/NavBar.css">
        <link rel="stylesheet" href="../../styles/User.css">
        
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

            #patient {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #patient td, #patient th {
                border: 1px solid #2C3845;
                padding: 8px;
            }

            /* #patient tr:nth-child(even){background-color: #2C3845;} */

            #patient tr:hover {background-color: #2C3845;}

            #patient th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #2C3845;
                color: white;
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
                    <li><a href="DashBoard.php">Home</a></li>
                    <li><a href="../Chat/docindex.php">Instant Appoinment</a></li>
                    <li><a href="Cancel/Cancel.php">Cancel Appointment</a></li>
                    <li><a href="../Logout.php">Logout</a></li>
                </ul>
                <h5 class="logo" style="font-size: 1.3rem;">Welcome 
                <?php if($_SESSION["docname"]) { echo $_SESSION["docname"]; }?> </h5>
            </div>
        </nav>
        <br><br><br><br><br>
        <table id="patient">
            <thead>
                <tr>
                <th scope="col">S.NO.</th>
                <th scope="col">Patient Name</th>
                <th scope="col">Message ID</th>
                <th scope="col">Start Chatting</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $did = $_SESSION["docid"];
                    $query = "SELECT * FROM instantappointments WHERE Doc_ID = '$did'";
                    $result = mysqli_query($conn,$query);
                    if (mysqli_num_rows($result) > 0) 
                        {  
                            $i = 0;                  
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                            ?>
                            <tr>
                                <th scope="row"><?php echo ++$i; ?></th>
                                <td><i> 
                                    <?php 
                                        $pid = $row['Pat_ID'];
                                        $q = "SELECT * FROM patient WHERE ID = '$pid'";
                                        $r = mysqli_query($conn,$q);
                                        $v = mysqli_fetch_assoc($r);
                                        echo $v['Username']; 
                                    ?>
                                </i></td>
                                <td><i> 
                                    <?php 
                                        echo $row['MessageID']; 
                                    ?>
                                </i></td>
                                <td><i> <button type="reset" onclick="instantchat()">Chat Now</button></i></td>
                                <script>
                                    function instantchat(){            
                                        location.href = "http://localhost/Doctor-System/Chat/docindex.php";
                                    }
                                </script>
                            </tr>
                            <?php
                            }
                        }
                ?>
    </body>
</html>