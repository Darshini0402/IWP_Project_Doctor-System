<?php
    session_start();
    $message="";

    if(count($_POST)>0) {
        include '../../DBConnect.php';
        $uname = $_POST["username"];
        $passw = $_POST["password"];

        $query = "SELECT * FROM doctor WHERE Username = '" . $uname. "'";

        $result = mysqli_query($conn,$query);
        
        $row = mysqli_fetch_assoc($result);

        if(is_array($row)) 
        {
            if(password_verify($passw, $row['Password']))
            {
                $_SESSION["docid"] = $row['ID'];
                $_SESSION["docname"] = $row['Name'];
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
    if(isset($_SESSION["docid"])) 
    {
        echo "success";
        echo "<script>top.window.location = '/Doctor-System/Doctor/DashBoard.php'</script>";
        // header('Window-target: _top');
        // header("Location: /Doctor-System/Patient/DashBoard.php");
    }
?>
<!DOCTYPE html>
<!--Darshini.R - 20BCE1054 3.8.2022-->
    <head>
        <title>Doctor Sign In</title>
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
        <link rel="stylesheet" href="../../styles/User.css">
    </head>
    <body>
        <h3>Doctor Login</h3>
        <div class="message">
            <?php 
                if($message!="") 
                    echo $message; 
            ?>
        </div>
        <br>
        <div align="center">
            <img src="https://icon-library.com/images/doctor-icon-black-and-white/doctor-icon-black-and-white-3.jpg" alt="Doctor" class="avatar">
        </div>
        <br><br>
        <form name="doctor_login" method="post" action="">
            <table align="center" class="tb">
                <tr>
                    <td>
                        Username
                    </td>
                    <td>
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </td>
                </tr>
                <tr>
                    <td>
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
                        <p style="color: white;">Don't have an account? <a href="../SignUp/DoctorSignup.html" style="color: white;" target="_blank">Sign Up</a>
                        </p>   
                    </td>
                </tr>
            </table>  
        </form>
    </body>
</html>