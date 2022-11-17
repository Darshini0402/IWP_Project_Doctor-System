<?php
session_start();
include '../../DBConnect.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <link rel="stylesheet" href="../../styles/User.css">
        <link rel="stylesheet" href="../../styles/NavBar.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
    $(document).ready(function(){
    $('#edit').click(function(){
        alert("Enter the new date");
    });
});
</script>
        <title>Edit Appointment</title>
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
                    <li><a href="Edit.php">Edit Appointment</a></li>
                    <li><a href="../Cancel/Cancel.php">Cancel Appointment</a></li>
                    <li><a href="../Logout.php">Logout</a></li>
                </ul>
                <h5 class="logo" style="font-size: 1.3rem;">Welcome 
                <?php if($_SESSION["patname"]) { echo $_SESSION["patname"]; }?> </h5>
            </div>
        </nav>
        <br><br><br><br><br>

        <div>
            <!-- <ul>
                <li class="active"><a data-toggle="tab" href="#menu1">Appointments</a></li>
            </ul> -->
            <?php
             $patid = $_SESSION["patid"];
            $sql1="SELECT ID,Name,Phone,App_Date,App_Time,Doc_ID from appointment WHERE Pat_ID = '$patid' ";
            $res1=mysqli_query($conn,$sql1);
            // while ($row=mysqli_fetch_array($res1))
            // {
            //     echo $row['Name'];
            //     echo $row['Phone'];
            // }
            ?>
            <div>
              <div>
                <?php
                    echo "
                      <table id='patient'>
                        <thead>
                          <tr>
                            <th scope='col'>S.NO.</th>
                            <th scope='col'>Name</th>
                            <th scope='col'>Phone number</th>
                            <th scope='col'>Date</th>
                            <th scope='col'>Time</th>
                            <th scope='col'>Doctor Name</th>
                            <th scope='col'>Edit appointment</th>
                          </tr>
                        </thead>
                      <tbody>";

                    if (mysqli_num_rows( $res1 )==0 )
                    {
                        echo '<tr><td colspan="4">No Rows Returned</td></tr>';
                    }
                    else
                    {
                        $i = 0;
                        while( $row = mysqli_fetch_array( $res1 ) )
                        {
                          $id_doc=$row['Doc_ID'];
                          $sql2="SELECT Name from doctor where ID='$id_doc'";
                          $res2=mysqli_query($conn,$sql2);
                        
                            echo "
                              <tr>
                                <th scope='row'>" . (++$i) . "</th>
                                <td><i>" .$row['Name']. "</i></td>
                                <td><i>". $row['Phone'] . "</i></td>
                                <td><i>". $row['App_Date']." </i></td>
                                <td><i>". $row['App_Time']."</i></td>";

                                while($r=mysqli_fetch_array($res2))
                                {
                                  echo "<td><i>". $r['Name']."</i></td>";
                                } 
                                $output = '<td><a href="EditAppointment.php?id=' . $row['ID'] .' ">Edit</a> </td> 
                              </tr>'; 
                              echo $output;
                        }
                    }
                ?>      
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </body>
</html>