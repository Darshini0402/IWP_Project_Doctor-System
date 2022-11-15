<?php
    // if(!$_SESSION["id"])
    //     header('Location: /Doctor-System/Index.html');
    session_start();

    $_SESSION["docid"] = $_COOKIE["docid"];

    include '../../DBConnect.php';

    $query = "SELECT * FROM doctor WHERE ID = '" . $_SESSION["docid"]. "'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);

    $_SESSION["docname"] = $row['Name'];

    if(isset($_POST['datesubmit'])) {

        $ippatname = $_REQUEST["inputname"];
        $age = $_REQUEST["inputage"];
        $aadhar = $_REQUEST["inputaadhar"];
        $phone = $_REQUEST["inputphone"];
        // $date = $_REQUEST["inputDate"];
        // $time = $_REQUEST["inputTime"];
        $symp = $_REQUEST["inputSymptoms"];
        $doc_id = $_SESSION["docid"];
        $pat_id = $_SESSION["patid"];

        $date = $_REQUEST["inputDate"];

        $_SESSION['doctorid'] = $doc_id;
        $_SESSION['patientid'] = $pat_id;
        $_SESSION['ippatname'] = $ippatname;
        $_SESSION['age'] = $age;
        $_SESSION['aadhar'] = $aadhar;
        $_SESSION['phone'] = $phone;
        $_SESSION['symp'] = $symp;
        $_SESSION['date'] = $date;

        $query = "SELECT * from appointment WHERE App_Date = '$date' AND Doc_ID = '$doc_id'";
        $result = mysqli_query($conn, $query);
        
        $time_arr = array();
        
        while($rows = mysqli_fetch_assoc($result)){
            array_push($time_arr,$rows['App_Time']);
        }
            
    }

    if(isset($_POST['formsubmit']))
    { 
        $time = $_REQUEST['inputTime'];

        $doc_id = $_SESSION['doctorid'];
        $pat_id = $_SESSION['patientid'];
        $ippatname = $_SESSION['ippatname'];
        $age = $_SESSION['age'];
        $aadhar = $_SESSION['aadhar'];
        $phone = $_SESSION['phone'];
        $symp = $_SESSION['symp'];
        $date = $_SESSION['date'];

        $sql="INSERT INTO appointment (Doc_ID, Pat_ID, Name, Age, Aadhar, Phone, App_Date, App_Time, Symptoms) VALUES ('$doc_id','$pat_id','$ippatname', '$age','$aadhar','$phone','$date', '$time', '$symp')";
        
        $res = mysqli_query($conn, $sql);
        if($res)
            header('Location: /Doctor-System/Patient/Billing/Billing.html');
        else
            echo "fail";
    }

    // mysqli_close($conn);


    // if ($status==1)
    // {
    //     header('Location: /Doctor-System/Patient/SignUp/PatientSignUp.html');
    // }
    // else
    // {
    // }
?>

<!DOCTYPE html>
    <head>
        <title>Appointment Booking</title>
        <style>
            h1{
                color: antiquewhite;
                text-align: center;
            }
            #ani{
                font-size: large;
                font-weight: bolder;
            }
            #doc-name::selection{
                color: black;
                background-color: white;
            }
            input:focus{
                background-color: bisque;
            }
        </style>
        <link rel="stylesheet" href="../../styles/User.css">
        <link rel="stylesheet" href="../../styles/NavBar.css">
        <script>
            function validate(){
                var name = document.forms["patient_form"]["inputname"].value;
                var age = document.forms["patient_form"]["inputage"].value;
                var aadhar = document.forms["patient_form"]["inputaadhar"].value;
                var phone = document.forms["patient_form"]["inputphone"].value;
                var date = document.forms["patient_form"]["inputDate"].value;
                var time = document.forms["patient_form"]["inputTime"].value;
                var symptoms = document.forms["patient_form"]["inputSymptoms"].value;
                // document.write(name)
                if(name=="" || age==null || aadhar==null || phone==null || date==null || time==null || symptoms==null)
                {
                    alert("Please fill all your details!!!");
                    // document.write("ifblock");
                }
                else
                {
                    // document.write("\nName: "+name+"\nAge: "+age+"\nAadhar: "+aadhar+"\nPhone: "+phone+"\nDate: "+date+"\nTime: "+time+"\nSymptoms: "+symptoms);
                    // document.getElementById("output").innerHTML="heyyy";
                    document.getElementById("output").innerHTML = "\nName: "+name+"\nAge: "+age+"\nAadhar: "+aadhar+"\nPhone: "+phone+"\nDate: "+date+"\nTime: "+time+"\nSymptoms: "+symptoms;
                }
            }
        </script>
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
                    <li><a href="../Booking/Book.php">Book an Appointment</a></li>
                    <li><a href="../Edit/Edit.php">Edit Appointment</a></li>
                    <li><a href="../Cancel/Cancel.php">Cancel Appointment</a></li>
                    <li><a href="../Logout.php">Logout</a></li>
                </ul>
                <h5 class="logo" style="font-size: 1.3rem;">Welcome 
                <?php if($_SESSION["patname"]) { echo $_SESSION["patname"]; }?> </h5>
            </div>
        </nav>
        <br><br><br><br><br>

        <h3 id="doc-name">Doctor Name: Dr. <?php echo $_SESSION["docname"]; ?></h3>
        <br><br>
        <div style="width: 100%; height: 100%;">
            <form name="patient_form" action="" method="post">
                <table>
                    <tr>
                        <td>
                            <label name="inputname">Patient Name</label>
                        </td>
                        <td>
                            <input type="text" name="inputname" placeholder="Name" style="width: 450px;">
                        </td>
                        <td>
                            <label name="inputage">Patient Age</label>
                        </td>
                        <td>
                            <input type="number" name="inputage" placeholder="Age" min=1 max=150 style="width: 450px;">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label name="inputaadhar">Patient Aadhar Number</label>
                        </td>
                        <td>
                            <input type="tel" pattern="[0-9]{4} [0-9]{4} [0-9]{4}" name="inputaadhar" placeholder="xxxx xxxx xxxx" style="width: 450px;">
                        </td>
                        <td>
                            <label name="inputphone">Phone Number</label>
                        </td>
                        <td>
                            <input type="tel" pattern="[0-9]{10}" name="inputphone" placeholder="Phone Number" style="width: 450px;">
                        </td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td>
                            <label name="inputSymptoms">Symptoms &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </td>
                        <td>
                            <input type="text" name="inputSymptoms" placeholder="Symptoms" style="width: 1005px;">
                        </td>
                    </tr>
                </table>
                <br><br>                
                <table>
                    <tr>
                        <td>
                            <label name="inputDate">Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        </td>
                        <td>
                            <input id='inputDate' type="date" name="inputDate" placeholder="Date" style="width: 450px;" min="<?php echo date("Y-m-d");?>">
                        </td>
                        <td>
                            <input type="submit" name="datesubmit" id="datesubmit" value="Check Availability">
                        </td>
                    </tr>
                </table>
            </form>

            <form method="post" action="">

            <table>
                <tr>
                    <td>
                        <label name="inputTime">Time</label>
                    </td>
                    <td>
                        <select name="inputTime" required style="width: 450px;">
                            <option value="" selected>Select Appointment time</option>
                            <?php if(in_array("10:00 AM",$time_arr)): ?>
                                <option value="10:00 AM" disabled>10:00 AM</option>
                            <?php else: ?>
                                <option value="10:00 AM" >10:00 AM</option>
                            <?php endif; ?>

                            <?php if(in_array("10:30 AM",$time_arr)): ?>
                                <option value="10:30 AM" disabled>10:30 AM</option>
                            <?php else: ?>
                                <option value="10:30 AM" >10:30 AM</option>
                            <?php endif; ?>

                            <?php if(in_array("11:00 AM",$time_arr)): ?>
                                <option value="11:00 AM" disabled>11:00 AM</option>
                            <?php else: ?>
                                <option value="11:00 AM" >11:00 AM</option>
                            <?php endif; ?>

                            <?php if(in_array("11:30 AM",$time_arr)): ?>
                                <option value="11:30 AM" disabled>11:30 AM</option>
                            <?php else: ?>
                                <option value="11:30 AM" >11:30 AM</option>
                            <?php endif; ?>

                            <?php if(in_array("12:00 PM",$time_arr)): ?>
                                <option value="12:00 PM" disabled>12:00 PM</option>
                            <?php else: ?>
                                <option value="12:00 PM" >12:00 PM</option>
                            <?php endif; ?>

                            <?php if(in_array("12:30 PM",$time_arr)): ?>
                                <option value="12:30 PM" disabled>12:30 PM</option>
                            <?php else: ?>
                                <option value="12:30 PM" >12:30 PM</option>
                            <?php endif; ?>

                            <?php if(in_array("01:00 PM",$time_arr)): ?>
                                <option value="01:00 PM" disabled>01:00 PM</option>
                            <?php else: ?>
                                <option value="01:00 PM" >01:00 PM</option>
                            <?php endif; ?>

                            <?php if(in_array("01:30 PM",$time_arr)): ?>
                                <option value="01:30 PM" disabled>01:30 PM</option>
                            <?php else: ?>
                                <option value="01:30 PM" >01:30 PM</option>
                            <?php endif; ?>

                            <?php if(in_array("05:00 PM",$time_arr)): ?>
                                <option value="05:00 PM" disabled>05:00 PM</option>
                            <?php else: ?>
                                <option value="05:00 PM" >05:00 PM</option>
                            <?php endif; ?>

                            <?php if(in_array("05:30 PM",$time_arr)): ?>
                                <option value="05:30 PM" disabled>05:30 PM</option>
                            <?php else: ?>
                                <option value="05:30 PM" >05:30 PM</option>
                            <?php endif; ?>

                            <?php if(in_array("06:00 PM",$time_arr)): ?>
                                <option value="06:00 PM" disabled>06:00 PM</option>
                            <?php else: ?>
                                <option value="06:00 PM" >06:00 PM</option>
                            <?php endif; ?>

                            <?php if(in_array("06:30 PM",$time_arr)): ?>
                                <option value="06:30 PM" disabled>06:30 PM</option>
                            <?php else: ?>
                                <option value="06:30 PM" >06:30 PM</option>
                            <?php endif; ?>

                            <?php if(in_array("07:00 PM",$time_arr)): ?>
                                <option value="07:00 PM" disabled>07:00 PM</option>
                            <?php else: ?>
                                <option value="07:00 PM" >07:00 PM</option>
                            <?php endif; ?>

                            <?php if(in_array("07:30 PM",$time_arr)): ?>
                                <option value="07:30 PM" disabled>07:30 PM</option>
                            <?php else: ?>
                                <option value="07:30 PM" >07:30 PM</option>
                            <?php endif; ?>

                            <?php if(in_array("08:00 PM",$time_arr)): ?>
                                <option value="08:00 PM" disabled>08:00 PM</option>
                            <?php else: ?>
                                <option value="08:00 PM" >08:00 PM</option>
                            <?php endif; ?>

                            <?php if(in_array("08:30 PM",$time_arr)): ?>
                                <option value="08:30 PM" disabled>08:30 PM</option>
                            <?php else: ?>
                                <option value="08:30 PM" >08:30 PM</option>
                            <?php endif; ?>

                        </select>
                    </td>
                </tr>
            </table>
            <button type="submit" style="color: black;" name="formsubmit">Proceed with Billing</button>
        </form>
    </body>
</html>