<?php
    session_start();
    include '../../DBConnect.php';

    if(isset($_POST['cancel']))
    {
        $cancel_id =  $_POST['cancel_id'];
        $qr = "DELETE FROM appointment WHERE ID = '" . $cancel_id. "'";
        $res = mysqli_query($conn,$qr);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cancel Appointment </title>
        
        <style>
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

        <link rel="stylesheet" href="../../styles/User.css">
        <link rel="stylesheet" href="../../styles/NavBar.css">
        
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
                    <li><a href="../DashBoard.php">Home</a></li>
                    <li><a href="../Booking/Book.php">Book an Appointment</a></li>
                    <li><a href="../Edit/Edit.php">Edit Appointment</a></li>
                    <li><a href="Cancel.php">Cancel Appointment</a></li>
                    <li><a href="../Logout.php">Logout</a></li>
                </ul>
                <h5 class="logo" style="font-size: 1.3rem;">Welcome 
                <?php if($_SESSION["patname"]) { echo $_SESSION["patname"]; }?> </h5>
            </div>
        </nav>
        <br><br><br><br><br>

        <table id="patient">
            <thead>
                <tr>
                <th scope="col">S.NO.</th>
                <th scope="col">Name</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Doctor Name</th>
                <th scope="col">Cancel appointment</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = "SELECT * FROM appointment WHERE Pat_ID = '" . $_SESSION["patid"]. "'";
                    $result = mysqli_query($conn,$query);
                    if (mysqli_num_rows($result) > 0) 
                        {
                            $i = 0;
                            while($row = mysqli_fetch_assoc($result)) 
                            {
                ?>
            
                        <tr>
                        <th scope="row"><?php echo ++$i; ?></th>
                        <td><i> <?php echo $row['Name']; ?></i></td>
                        <td><i> <?php echo $row['Phone']; ?></i></td>
                        <td><i> <?php echo $row['App_Date']; ?></i></td>
                        <td><i> <?php echo $row['App_Time']; ?> </i></td>
                        <td><i> 
                            <?php 
                                $qr = "SELECT * FROM doctor WHERE ID = '" . $row["Doc_ID"]. "'";
                                $res = mysqli_query($conn,$qr);
                                $r = mysqli_fetch_assoc($res);
                                echo $r['Name'];
                            ?> 
                        </i></td>
                        <td>
                            <form method="post">
                                <input type="hidden" value= <?php echo $row["ID"]?> name="cancel_id">
                                <input type="submit" style="background-color: aquamarine; color: black; padding: 14px 20px; margin: 8px 0; border: none; cursor: pointer;" name="cancel" value="Cancel">
                            </form>
                        </td>
                        </tr>
                <?php
                            }
                        }
                ?>   
            </tbody>
        </table>
        
        </div>
    </body>
</html>