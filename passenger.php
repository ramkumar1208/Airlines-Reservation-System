<?php
    include 'db.php';
    session_start();
    if(empty($_SESSION['seat_nos'])){
         echo     '<html>    
        <body>
        <script type=text/javascript>
            alert("PLease Select Your Seats First");
            window.href.location="book1.php";
        </script>   
        </body>
        </html>'; 
  }
  else{
         //$con=mysqli_connect("localhost","root","","airlines");
            if($con->connect_error){
		        die('connection Failed :'.$con->connect_error);
            }
        
        if(isset($_SESSION['seat_nos'])){
                if(isset($_POST['proceed'])){
            if(isset($_SESSION['username'])){
           echo "HEllo ".$_SESSION['username'];
           $uname=$_SESSION['username'];
        }
        else{
            echo "login_firts";
        }
        $f_id=$_SESSION['book_fid'];
        
        $f_string=(string)$f_id;

        $q="SELECT user_id FROM `users` WHERE username ='$uname'";
        $result=mysqli_query($con,$q);
        if(!$result){
            echo "failes".mysqli_error($con);
        }
        else{
          while($row=mysqli_fetch_array($result)){
             $u_id=$row['user_id'];
          }
        }
        $seats=$_SESSION['seats'];
        $first_name=array();
        $last_name=array();

        for($i=1;$i<=$seats;$i++){
            array_push($first_name,$_POST['fname'.$i]);
            array_push($last_name,$_POST['lname'.$i]);
        }
        if(empty($_SESSION['seat_nos'])){
         echo     '<html>    
        <body>
        <script type=text/javascript>
            alert("PLease Select Your Seats First");
            window.href.location="book1.php";
        </script>   
        </body>
        </html>'; 
        }
        $seat_no=$_SESSION['seat_nos'];
        
        $date=$_SESSION['date'];
        $f_id=$_SESSION['fid'];
        $email=$_POST['email'];
        $mobile_no=$_POST['mobile'];
        $amount=$_SESSION['amount'];
    
            if(empty($_SESSION['ret-date'])){
                        for($i=1;$i<=$seats;$i++){
            $sql="INSERT INTO `passenger`(`first_name`,`last_name`,`email`,`mobile_no`,`user_name`,`f_id`,`dateof`,`seat_no`,`amount`) 
            VALUES('".$first_name[$i-1]."','".$last_name[$i-1]."','".$email."','".$mobile_no."','".$uname."','".$f_string."','".$date."','".$seat_no[$i-1]."','".$amount."')";
            $insert_id=mysqli_query($con,$sql);
            }
            if(!$insert_id){
                                        echo "error".$insert_id."<br>".mysqli_error($con);
                                }
            }
            else{
                $ret_date=$_SESSION['ret-date'];
                       for($i=1;$i<=$seats;$i++){
                        $sql="INSERT INTO  `passenger`(`first_name`,`last_name`,`email`,`mobile_no`,`user_name`,`f_id`,`dateof`,`seat_no`,`amount`) 
            VALUES('".$first_name[$i-1]."','".$last_name[$i-1]."','".$email."','".$mobile_no."','".$uname."','".$f_string."','".$date."','".$seat_no[$i-1]."','".$amount."')";
            $ret_=mysqli_query($con,$sql);
            $sql="INSERT INTO  `passenger`(`first_name`,`last_name`,`email`,`mobile_no`,`user_name`,`f_id`,`dateof`,`seat_no`,`amount`) 
            VALUES('".$first_name[$i-1]."','".$last_name[$i-1]."','".$email."','".$mobile_no."','".$uname."','".$f_string."','".$ret_date."','".$seat_no[$i-1]."','".$amount."')";
            $ret_insert=mysqli_query($con,$sql);
                                   
 
                        
                        
        }
                if(!$ret_insert && !$ret_){
                                        echo "error".$ret_insert."<br>".mysqli_error($con);
                                }
            
            }
        if($insert_id || $ret_insert || $ret_){
            $find_seats="SELECT * FROM `find`  where f_id='$f_string'";
            $find_seats_query=mysqli_query($con,$find_seats);
            if(mysqli_num_rows($find_seats_query)>0){
                while($row=mysqli_fetch_array($find_seats_query)){
                    $seats_already_in_flights=$row['seat'];
                }
                $new_edited_seats=$seats_already_in_flights-$seats;
                $edit_seats="UPDATE `find` SET `seat`='$new_edited_seats' where `f_id`='$f_string'";
                if(mysqli_query($con,$edit_seats)){
                      echo     '<html>
                                <body>
                                <script type=text/javascript>
                                    alert("Tickets BOoked ");
                                    window.location.href="history.php"; 
                                </script>   
                                </body>
                                </html>'; 
                }
                else{
                    echo "error".$edit_seats."<br>".mysqli_error($con);    
                }
            }
                                    /* */ 
                          
                }
            if(!$result){
                echo "error".$sql."<br>".mysqli_error($con);
            }
        
        }
        }
        else{
              echo     '<html>    
        <body>
        <script type=text/javascript>
            alert("PLease Select Your Seats First");
            window.href.location="book1.php";
        </script>   
        </body>
        </html>'; 
        }
        
  }
   
$con->close();
?>