<?php
    if(!isset($_SESSION["patid"]) || !isset($_SESSION["docid"])){
        ?>
            <!DOCTYPE html>
                <head>
                    <title>Sign In</title>
                    <style>
                        h1{
                            color: antiquewhite;
                            text-align: center;
                        }
                    </style>
                    <link rel="stylesheet" href="styles/User.css">
                </head>
                <body>
                    <h1>Doctor Appointment System</h1>
                    <br><br><br>

                    <iframe src="Doctor/Login/Doctor_Form.php" frameborder="0" scrolling="no"                           
                        style="height: 450px; width: 49%; float: left; border: solid 2px cyan;" height="100%" width="49%" align="left">
                    </iframe>  


                    <iframe src="Patient/Login/Patient_Form.php" frameborder="0" scrolling="no"  
                        style="height: 450px; width: 49%; float: right; border: solid 2px cyan;"  width="49%"  height="100%" align="right">
                    </iframe>
                    
                </body>
            </html>
        <?php
    }
?>
