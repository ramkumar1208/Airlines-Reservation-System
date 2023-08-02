<?php
include 'db.php';
    session_start();
    if ( isset($_GET['ticket_id']) && isset($_GET['flight'])) {
        $_SESSION['ticket_id']=$_GET['ticket_id'];
        $_SESSION['flight']=$_GET['flight'];
    } 
    else {
        echo "please select product";
    }
    $flight=$_SESSION['flight'];
    //$conn = new mysqli('localhost', 'root','', 'airlines');
$ticket_id=$_SESSION['ticket_id'];
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    $query = "DELETE FROM `passenger` WHERE `ticket_id` = '$ticket_id'";
    $query_works=mysqli_query($conn,$query);        
    if($query_works){                    
                      $find_seat="SELECT `seat` FROM `find` WHERE `f_id`='$flight'";
                      $seat_query=mysqli_query($conn,$find_seat);
                      $old_seat=mysqli_fetch_array($seat_query)['seat'];
                      $new_seat=$old_seat+1;
                    $update_seats="UPDATE `find` SET `seat`='$new_seat' WHERE `f_id`='$flight'";
                    $update_seat_query=mysqli_query($conn,$update_seats);
                    if($update_seat_query){
                        echo "
                        <script>
                        alert('Your Ticket is DeleTed sucessfully');
                        window.location.href='history.php';        
                      </script>";
                    }
                    else{
                        echo "Error:" . mysqli_error($conn);
                    }
                    }
                    else{
                        echo "Error:" . mysqli_error($conn);
                    }
/*                    
window.location.href='history.php';   */
?>
