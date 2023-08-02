<?php
include 'db.php';
session_start();
$_SESSION['seat_nos']=[];
?>
<html>
  

<style>
    * {
  margin: 0px;
  padding: 0px;
}

header img {
  display: block;
  height: 80px;
  cursor: pointer;
  margin-right: auto;
  border-radius: 30px;
  border-image: round;
}

li,
a,
button {
  font-family: "Times New Roman", Times, serif;
  font-weight: 800;
  font-size: 16px;
  color: black;
  text-decoration: none;
}

header {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  padding: 3px 10%;
  border-radius: 25px;
  background-color: white;
}

.navigation {
  list-style: none;
  position: relative;
  left: -420px;
}

.navigation li {
  display: inline-block;
  padding: 10px 20px;
  border: #c3c3e4;
  border-width: 2px;
  border-style: solid;
  border-radius: 15px;
}

.navigation a {
  position: relative;
  left: -20px;
}

.login {
  margin-left: 70px;
  padding: 9px 12px;
  border-radius: 15px;

  border: rgb(26, 26, 197);

  border-width: 2px;
  border-style: solid;
  border-radius: 15px;
  cursor: pointer;
  width: 190px;
  transition: all 0.3s ease-in-out 0s;
}

.login:hover {
  color: black;
}
.logout:hover {
  color: black;
}
h1 {
  text-align: center;
  color: white;
  padding-top: 12px;
}
.logout{
  color:white;
  width:110px;
  height:40px;
  border-radius:15px;
  border-color:blue 1px solid;
  background-color:white;
}
.login{
  color:white;
  background-color:white;
}
header span.icon {
  padding-right: 30px;
}
  </style>
  <body>
     <header>    
        <img src="rk.jpg" alt="logo" class="logo">
        
            <nav>
            <ul class="navigation">
                <li>
                    <span class="icon">&#9992</span><a href="index.php">Flights</a>
                </li>
                <li>
                    <i class="fa fa-history" style="font-size:18px"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="history.php">History</a>
                </li>
                                          <?php
            if(isset($_SESSION['username'])){
              echo "Welcome    ".$_SESSION['username'];
            }
              ?> 
              <?php

            if(isset($_SESSION['username'])){
                ?>
                <li>
                <a href="logout.php">Log-out</a>
                </li>
                <?php
                }
                else{
      echo "<script>
            alert('Please Login');
          </script>";
    }
          ?>
 
            </ul>
            </nav>
    </header>
</body>
    </html>
<?php

$u_id=$_SESSION['username'];
    //$con=mysqli_connect("localhost","root","","airlines");
            if($con->connect_error){
		        die('connection Failed :'.$con->connect_error);
            }

$ret_pass="SELECT `f_id` as count,COUNT(`f_id`) as count_flight FROM passenger WHERE user_name = '$u_id' GROUP BY `f_id`";

        $ret_query=mysqli_query($con,$ret_pass);
        if (mysqli_num_rows($ret_query) >0) {
          $i=0;
          
          while($row=mysqli_fetch_array($ret_query)){
              $flight_id=$row['count'];
              $count="SELECT * FROM `passenger` WHERE  user_name = '$u_id' AND `f_id`='$flight_id'";
              $count_query=mysqli_query($con,$count);
              if($count_query){
                echo '<html>
        <body>
        <style>
           body {
              font-family: Arial, sans-serif;
              font-size: 16px;
              line-height: 1.5;
            }

            h1 {
              font-size: 24px;
              font-weight: bold;
              margin-bottom: 20px;
            }

            p {
              margin-bottom: 10px;
            }

            a {
              color: blue;
              text-decoration: none;
            }

            a:hover {
              text-decoration: underline;
            }

            .delete_button{
              background-color: #4CAF50;
              border: none;
              color: white;
              padding: 10px 20px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
              margin-top: 10px;
              cursor: pointer;
              border-radius: 5px;
            }

            .delete_button:hover {
              background-color: #3e8e41;
            }
                table {
                        border-collapse: collapse;
                        width: 100%;
                        text-align: center;
                        background-color: #f2f2f2;
                    }
                    th, td {
                        padding: 8px;
                        width: 200px;
                        border: 1px solid #ddd;
                    }
                    th {
                        background-color: #4CAF50;
                        color: white;
                    }
                
          </style>
          ';

            echo'<br><br><br><table>';
        while ($row = mysqli_fetch_array($count_query)) {
            echo <<<EOT
            <caption>
            <tr>
                <th>Nmae: </th>
                <th>Flight : </th>
                <th>Amount :</th>
                <th>Date Of Journey</th>
                <th>Seat No</th>
                <th></th>
            </tr>        
            <tr>
                <td>{$row['first_name']} {$row['last_name']}</td>
                <td>{$row['f_id']}</td>
                <td>{$row['amount']}</td>
                <td>{$row['dateof']}</td>
                <td>{$row['seat_no']}</td>
            <td><a href="ticket_delete.php?ticket_id={$row['ticket_id']}&flight={$row['f_id']}"><button class='delete_button'>Delete Ticket</button></a></td>
</tr>
EOT;

        }
        echo '</table>
          </body>
        </html>';
  
              }
          }
              
            
          

          }
  
?>