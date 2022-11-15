<?php
    $message="";
    
    if(count($_POST)>0) {
        include '../../DBConnect.php';
        $uname = $_POST["username"];
        $passw = $_POST["password"];
        
        $query = "SELECT * FROM patient WHERE Username = '" . $uname. "'";
        
        $result = mysqli_query($conn,$query);
        
        $row = mysqli_fetch_assoc($result);
        
        if(is_array($row)) 
        {
            if(password_verify($passw, $row['Password']))
            {
                session_start();
                $_SESSION["patid"] = $row['ID'];
                $_SESSION["patname"] = $row['Username'];
            }
            else
            {
                $message = "Invalid Password! Try again...";
            }
        } 
        else 
        {
            $message = "Invalid Username!";
        }
    }
    if(isset($_SESSION["patid"])) 
    {
        echo "<script>top.window.location = '/Doctor-System/Patient/DashBoard.php'</script>";
        // header('Window-target: _top');
        // header("Location: /Doctor-System/Patient/DashBoard.php");
    }
    // mysqli_close($conn);
?>
<!DOCTYPE html>
<!--Darshini.R 20BCE1054 3.8.2022-->
    <head>
        <title>Patient Sign In</title>
        <link rel="stylesheet" href="../../styles/User.css">
        <style>
            h3{
                color: antiquewhite;
                text-align: center;
                font-weight: bold;
            }
            td{
            color: azure;
            font-weight: bold;
            font-size: large;
            }
        </style>
    </head>
    <body>
        <h3>Patient Login</h3>
        <div class="message">
            <?php 
                if($message!="") 
                    echo $message; 
            ?>
        </div>
        <br>
        <div align="center">
            <img src="https://www.clipartmax.com/png/middle/271-2719453_korea-circle-person-icon-png.png" alt="Doctor" class="avatar">
        </div>
        <br><br>
        <form name="patient_login" method="post" action="">
            <table align="center" class="tb">
                <tr>
                    <td style="color: whitesmoke;">
                        Username
                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </td>
                </tr>

                <tr>
                    <td style="color: whitesmoke;">
                        Password
                    </td>
                    <td>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </td>
                </tr>
                
                <tr>
                    <td align="center">
                        <p>
                            <button type="submit" style="color: black;">Submit</button>               
                        </p>                
                    </td>
                </tr>

                <tr>
                    <td>
                        <p style="color: white;">Don't have an account? <a href="../SignUp/PatientSignUp.html" style="color: white;" target="_blank">Sign Up</a>
                        </p>   
                    </td>
                </tr>
            </table> 
        </form>
    </body>
</html>