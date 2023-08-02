<?php
session_start();
$_SESSION['ram']="hello world";
echo $_SESSION['ram'];
        if (isset($_POST['book'])) {
        for ($i=0; $i <= mysqli_num_rows($enter); $i++) {
            if ($i == $_POST['book']) {
                $_SESSION["fid"] = "$f_id[$i]";
                $_SESSION["ram"]="ramkumar";
                $_SESSION['num']="9";
                setcookie("ram", filter_var($f_id[$i], FILTER_SANITIZE_STRING));
              
                break;
            }
            elseif($i!=$_POST['book']){
                            echo     "<html>
                    <head> </head>
                    <style>
                    p{
                    position: relative;
                    top:450px;
                    left:400px;
                    }
                    </style>
                    <body>
                    <script type=text/javascript>
                        alert('fid doesn't have any value ');
                </script>
                    
                    </body>
                    </html>"; 
                }    
            }
            }
?>