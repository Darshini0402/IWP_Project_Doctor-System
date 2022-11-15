<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
 
        <title>Chat Application</title>
        <meta name="description" content="Tuts+ Chat Application" />
        <link rel="stylesheet" href="../styles/style.css" />
    </head>
    <?php
 
        session_start();

        include '../DBConnect.php';

        $msgchatid = $_SESSION["msgid"];

        $did = $_COOKIE["docchooseid"];
        $pid = $_SESSION["patid"];

        $q = "INSERT INTO instantappointments (Pat_ID,Doc_ID,MessageID) VALUES ('$pid','$did','$msgchatid')";
        $r = mysqli_query($conn,$q);

        $_SESSION["msgchatid"] = $msgchatid;

        $query = "SELECT * FROM instantappointments WHERE MessageID = '$msgchatid' ";
        $result = mysqli_query($conn,$query);

        $row = mysqli_fetch_assoc($result);
        $msg_id = $row['MessageID'];
        
        if(isset($_GET['logout'])){    
            
            //Simple exit message
            $logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['patchatname'] ."</b> has left the chat session.</span><br></div>";
            file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
            
            file_put_contents("log.html", "");

            unset($_SESSION["patchatname"]);

            header("Location: http://localhost/Doctor-System/Patient/DashBoard.php"); //Redirect the user
        }
        
        if(isset($_POST['enter'])){
            if($_POST['name'] != "" || $_POST['pmid'] != ""){
                $_SESSION['patchatname'] = stripslashes(htmlspecialchars($_POST['name']));
                $_SESSION['patmid'] = $_POST['pmid'];
            }
            else{
                echo '<span class="error">Please type in a name</span>';
            }
        }
        
        function loginForm(){
            echo
            '<div id="loginform">
            <p>Please enter your name to continue!</p>
            <form action="patindex.php" method="post">
            <label for="name">Name &mdash;</label>
            <input type="text" name="name" id="name" />
            <br><br>
            <label for="pmid">ID &mdash;</label>
            <input type="text" name="pmid" id="pmid" />
            <input type="submit" name="enter" id="enter" value="Enter" />
            </form>
        </div>';
        }
    
    ?>
    <body>
        
        <script>
            alert("Your ID to proceed with chat: <?php echo $msg_id?>")
        </script>
        <?php
        if(!isset($_SESSION['patchatname'])){
            loginForm();
        }
        else 
        {
            if(isset($_SESSION['docid']))
            {
                $msgchatid =  $_SESSION["msgchatid"];
                $q = "SELECT * FROM instantappointments WHERE MessageID = '$msgchatid' ";
                $r = mysqli_query($conn,$q);
                $row = mysqli_fetch_assoc($r);
                
                if($_SESSION['docid'] == $row['Doc_ID'] && $_SESSION['patid'] == $row['Pat_ID'] && $_SESSION['patmid'] == $row['MessageID'])
                {
                    ?>
                        <div id="wrapper">
                            <div id="menu">
                                <p class="welcome">Welcome, <b><?php echo $_SESSION['patchatname']; ?></b></p>
                                <p class="logout"><a id="exit" href="#">Exit Chat</a></p>
                            </div>
                
                            <div id="chatbox">
                                <?php
                                if(file_exists("log.html") && filesize("log.html") > 0){
                                    $contents = file_get_contents("log.html");          
                                    echo $contents;
                                }
                                ?>
                            </div>
                
                            <form name="message" action="">
                                <input name="usermsg" type="text" id="usermsg" />
                                <input name="submitmsg" type="submit" id="submitmsg" value="Send" />
                            </form>
                        </div>  

                        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script type="text/javascript">

                            // jQuery Document
                            $(document).ready(function () {
                                $("#submitmsg").click(function () {
                                    var clientmsg = $("#usermsg").val();
                                    $.post("post.php", { text: clientmsg, user:"pat" });
                                    $("#usermsg").val("");
                                    return false;
                                });
    
                                function loadLog() {
                                    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
    
                                    $.ajax({
                                        url: "log.html",
                                        cache: false,
                                        success: function (html) {
                                            $("#chatbox").html(html); //Insert chat log into the #chatbox div
                
                                            //Auto-scroll           
                                            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                                            if(newscrollHeight > oldscrollHeight){
                                                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                                            }   
                                        }
                                    });
                                }
    
                                setInterval (loadLog, 2500);
                
                                $("#exit").click(function () {
                                    var exit = confirm("Are you sure you want to end the session?");
                                    if (exit == true) {
                                    window.location = "patindex.php?logout=true";
                                    }
                                });
                            });
                        </script>
    </body>
</html>
                    <?php
                }
                else{
                    ?>
                    <script>
                        alert("Incorrect credentials... please check again.");
                    </script>
                    <?php
                        loginForm();
                }
            }
            else{
                ?>
                <script>
                    alert("Doctor has not logged in yet... please wait.");
                </script>
                <?php
                    loginForm();
            }
        }
?>