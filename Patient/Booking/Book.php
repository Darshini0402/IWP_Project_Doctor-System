<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Patient Portal</title>
        <link rel="stylesheet" href="../../styles/User.css">
        <link rel="stylesheet" href="../../styles/NavBar.css">
        <!-- <link rel="stylesheet" href="../../styles/Contact.css"> -->
        <script>
            function changeVal()
            {
                // var f = document.getElementById("spl");
                // var chosenSpl = f.options[f.selectedIndex].value;
                // document.getElementById("showSplList").innerHTML += '<p>' + chosenSpl + '</p>';
                // document.getElementById("chosenSpl").className="show"; 
            }

        </script>

        <!-- <script language="JavaScript" type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
        <script language="JavaScript" type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
        <script language="JavaScript" type="text/javascript" src="/js/sprinkle.js"></script> -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <style>
            #table-container {
            border-radius: 15px;
            border: 10px solid rgba(255, 255, 255, 0.03);
            max-width: 555px;
            overflow: hidden;
            }
            #table-container table {
            border-collapse: collapse;
            height: auto;
            color: rgba(255, 255, 255, 0.3);
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, rgba(245, 255, 246, 0.1) 100%);
            }
            #table-container table tbody {
            height: 100%;
            width: 100%;
            }
            #table-container table tr td, #table-container table tr th {
            padding: 20px;
            text-align: left;
            }
            #table-container table tr th {
            color: rgba(255, 255, 255, 0.7);
            }
            #table-container table tr td {
            color: rgba(255, 255, 255, 0.5);
            font-weight: lighter;
            }
            #table-container table tr td:hover {
            background-color: rgba(255, 255, 255, 0.01);
            }
            #table-container table tr:first-child {
            /*background: linear-gradient(
                -45deg,
                rgba(127, 255, 127, 0.5) 0%,
                rgba(127, 0, 255, 0.5) 100%
                );*/
            background: linear-gradient(45deg, #d000c9 0%, #cc9924 100%);
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
                    <li><a href="../DashBoard.php">Home</a></li>
                    <li><a href="Booking/Book.php">Book an Appointment</a></li>
                    <li><a href="../Edit/Edit.php">Edit Appointment</a></li>
                    <li><a href="../Cancel/Cancel.php">Cancel Appointment</a></li>
                    <li><a href="../Logout.php">Logout</a></li>
                </ul>
                <h5 class="logo" style="font-size: 1.3rem;">Welcome 
                <?php if($_SESSION["patname"]) { echo $_SESSION["patname"]; }?> </h5>
            </div>
        </nav>
        <br><br><br><br><br>
        
        <form action="" method="post" name="speciality">
            <h4 style="display: inline-block; vertical-align: middle; margin: 10px 0;"> Please choose your preferred speciality :</h4>
            <div style="display: inline-block; vertical-align: middle; margin: 10px 0;">
                <select name="spl" required>
                    <option value="" selected>Select speciality</option>
                    <option value="General Physician">General Physician</option>
                    <option value="Gynaecologist">Gynaecologist</option>
                    <option value="Orthopedic">Orthopedic</option>
                    <option value="Dermatologist">Dermatologist</option>
                    <option value="ENT">ENT</option>
                    <option value="Ophthalmologist">Ophthalmologist</option>
                    <option value="Pediatrician">Pediatrician</option>
                    <option value="Urologist">Urologist</option>
                    <option value="Psychiatrist">Psychiatrist</option>
                    <option value="Dentist">Dentist</option>
                    <option value="Physiotherapist">Physiotherapist</option>
                </select>
            </div>
            <input style="background-color: aquamarine; color: black; padding: 14px 20px; margin: 8px 0; border: none; cursor: pointer;" type="submit" placeholder="Login" class="btn" name="submit">
        </form>
        <?php
            include '../../DBConnect.php';

                if(isset($_POST['submit']))
                {
                    $spl = $_REQUEST['spl'];
                    
                    $query = "SELECT * FROM doctor WHERE Speciality = '" . $spl. "'";
                    $result = mysqli_query($conn,$query);

                    if (mysqli_num_rows($result) > 0) 
                            {
        ?>
                    <!-- <form method="get" action="../Appointment/Appointment.php"> -->
                        <div id="table-container">
                            <?php
                            
                                while($row = mysqli_fetch_assoc($result)) 
                                {
                                    ?>
                                <table>
                                    <tbody>
                       
                                        <tr>
                                            <th>Name: <?php echo $row["Name"] ?> <?php echo $row["Degree"] ?> </th>
                                        </tr>
                                        <tr>
                                            <td>Email: <?php echo $row["Email"] ?> </td>
                                            <td>Phone No: <?php echo $row["ContactNo"] ?> </td>
                                        </tr>
                                        <tr>
                                            <td>Experience: <?php echo $row["Experience"] ?> years</td>
                                            <td>Fee: Rs. <?php echo $row["Fee"] ?> </td>
                                        </tr>
                                        <tr>
                                            <td>City: <?php echo $row["City"] ?> </td>
                                            <td>Languages: <?php echo $row["Language"] ?> </td>
                                        </tr>
                                        <tr>
                                            <td> <button type="reset" onclick="chat('<?php echo $row['ID'];?>')" name="instantchat"> Instant Appoinment </td>
                                            <script>
                                                function chat(docid){
                                                    var doc_id = docid;
                                                    <?php
                
                                                        $idquery = "SELECT * FROM instantappointments ORDER BY ID DESC LIMIT 1";
                                                        $idresult = mysqli_query($conn,$idquery);
                                                        $idrow = mysqli_fetch_assoc($idresult);

                                                        $msgid = $idrow['MessageID'];
                                                        $msgid = substr($msgid,3);

                                                        $msgid = (int)$msgid;
                                                        $msgid += 1;
                                                        
                                                        $msgid = strval($msgid);
                                                        $msgid = "MSG" . $msgid;

                                                        $pid = $_SESSION['patid'];
                                                        $did = $row['ID'];
                                                        
                                                        $_SESSION["msgid"] = $msgid;
                                                        
                                                        // $doc_func_id = "document.writeln(doc_id);";     
                                                                                                                
                                                        // if($did == (int) $doc_func_id)
                                                        // {
                                                        //     echo "hey";
                                                        //     $q = "INSERT INTO instantappointments (Pat_ID,Doc_ID,MessageID) VALUES ('$pid','$did','$msgid')";
                                                        //     $r = mysqli_query($conn,$q);
                                                        // }
                                                        
                                                        // $idquery = "SELECT * FROM instantappointments ORDER BY ID DESC LIMIT 1";
                                                        // $idresult = mysqli_query($conn,$idquery);
                                                        // $idrow = mysqli_fetch_assoc($idresult);
                                                        // $msgid = $idrow['ID'];
                                                    ?>

                                                    var msg_id = "<?php echo $msgid?>";

                                                    //Creating a cookie after the document is ready
                                                    $(document).ready(function () {
                                                        createCookie("docchooseid", doc_id);
                                                    });
                                                    
                                                    location.href = "http://localhost/Doctor-System/Chat/patindex.php";
                                                    // Function to create the cookie
                                                    function createCookie(name, value, days) {
                                                        var expires;
                                                        
                                                        if (days) {
                                                            var date = new Date();
                                                            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                                                            expires = "; expires=" + date.toGMTString();
                                                        }
                                                        else {
                                                            expires = "";
                                                        }
                                                        
                                                        document.cookie = escape(name) + "=" + 
                                                            escape(value) + expires + "; path=/";
                                                    }
                                                }
                                            </script>
                                            
                                            <td> <button onclick="appointment('<?php echo $row['ID'];?>')" type="reset" name="laterappointment">Later Appointment</button> </td>
                                            <script>
                                                function appointment(docid){
                                                    var doc_id = docid;
                                                    console.log(doc_id);
                                                    //Creating a cookie after the document is ready
                                                    $(document).ready(function () {
                                                        createCookie("doc_later_id", doc_id);
                                                    });
                                                    
                                                    location.href = "http://localhost/Doctor-System/Patient/Appointment/Appointment.php";
                                                    // Function to create the cookie
                                                    function createCookie(name, value, days) {
                                                        var expires;
                                                        
                                                        if (days) {
                                                            var date = new Date();
                                                            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                                                            expires = "; expires=" + date.toGMTString();
                                                        }
                                                        else {
                                                            expires = "";
                                                        }
                                                        
                                                        document.cookie = escape(name) + "=" + 
                                                            escape(value) + expires + "; path=/";
                                                    }
                                                }
                                            </script>
                                        </tr>
                                    </tbody>
                                </table>
                                <br><br>
                                <?php 
                                }
                                ?>
                            </div>
                        <!-- </form> -->
                    <?php    
                    } 
                }
            mysqli_close($conn);
        ?>
        
        <!-- <div id="chosenSpl" class="hide">
            <div id="showSplList"></div>
        </div>
        <br>
        <form action="Appointment.html" method="POST" >
            <div id='doc' class='bg-text' style="position: relative; top: 70px;">
                <b>Name :</b> <i> fname lname </i><br><br>
                <b>Experience :</b> <i> in years </i><br><br>
                <b>Languages :</b> <i> languages known  </i> <br><br>
                <b>Fee :</b> <i> Rs. fee</i><br><br>
                <b>City :</b> <i> city </i><br><br>
                <span><button name="instant" value="" style="left:30px; font-size:12px; color: black;" class="btn" type="submit">Instant Appointment</button></span>
                <span><button onclick="Appointment.html" name="later" value="" style="left:30px; font-size:12px; color: black;" class="btn" type="submit">Later Appointment</button></span><br>
            </div>
            <br>
        </form> -->
    </body>
</html>