<?php
include "db.php" ;
if(isset($_POST['logsub'])){

session_start();
                $log_username=$_POST['log_username'];
                $log_pass=$_POST['log_pass'];
                    //$con=mysqli_connect("localhost","root","","airlines");
                    if($con->connect_error){
                        die("Login error ".connect_error);
                    }
                    else{
                        $sql_id="SELECT * FROM users WHERE username='$log_username'";
                        $enter_name=mysqli_query($con,$sql_id);
                        if(mysqli_num_rows($enter_name)==1){
                            $sql_pass="SELECT * FROM users WHERE `password`='$log_pass'";
                            $enter_pass=mysqli_query($con,$sql_pass);
                                if(mysqli_num_rows($enter_pass)==1){
                                    $_SESSION['username']=$log_username;
                                    header("location:index.php");
                                    exit();
                                    }
                                    else{
                                     ?>
                                     <script type="text/javascript">
        function fun() {
            const log_username = document.getElementById('log_username').value;
            const log_pass = document.getElementById('log_pass').value;
                var pass_check='';
                                     pass_check= pass_check + 'Pass incorrect<br>';
                                         document.getElementById('pass').innerHTML = pass_check;
                }
                fun();
        
                        </script>
                                    <?php
                                     }
                        }
                        else if(mysqli_num_rows($enter_name)==0){
                            ?>
                            <script type="text/javascript">
        function fun() {
            const log_username = document.getElementById('log_username').value;
            const log_pass = document.getElementById('log_pass').value;
             
            var log_check='';
                            log_check= log_check + 'you dont have an account pls sign-up <br>';
                                document.getElementById('log_name').innerHTML = log_check;   
                }
                fun();
                 
    </script>
                        <?php
                            }
                    }         
                }
?>
       
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1 name="hone" style="
    background-color: azure;
    position: relative;
    text-align: center;
    top: 50px;
    ">Airlines Reservation</h1>
    <div class="login">
        <form action="login.php" method="post">
            <h2>Login here!</h2>
            <label for="logname">User Name</label><br><br><br>
            <input type="text" name="log_username" id="log_username" placeholder="abc123" required><br><br>
            <small id="log_name"></small>
            <label for="logpass">Password</label><br><br><br>
            <input type="text" name="log_pass" id="log_pass" placeholder="****************" required><br><br>
            <small id="pass"></small>
            <input type="submit" name="logsub" id="logsub" onclick="fun()"><br><br><br>
            <a href="register.php">I Don't Have An Account</a>
        </form>
    </div>
   
</body>
</html>