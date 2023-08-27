<?php
session_start();
include 'db.php';
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- UIkit JS -->
<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  </head>

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
    h1 {
      text-align: center;
      color: white;
      padding-top: 12px;
    }

    header span.icon {
      padding-right: 30px;
    }
  </style>
  <body>
    <script>
  const mobileInput = document.getElementById('mobile');
  const mobileError = document.getElementById('mobile-error');

  function validateMobile() {
    const mobileRegex = /^[6-9]\d{9}$/;
    if (!mobileRegex.test(mobileInput.value)) {
      mobileError.textContent = 'Please enter a valid mobile number.';
      mobileError.style.color = 'red';
      return false;
    } else {
      mobileError.textContent = '';
      return true;
    }
  }

  mobileInput.addEventListener('blur', validateMobile);

  document.querySelector('form').addEventListener('submit', function(event) {
    if (!validateMobile()) {
      event.preventDefault();
    }
  });
</script>

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
            </nav><br>

 </header>
   <center>
    <h1 style="
  font-size: 36px;
  font-weight: bold;
  color: #333;
  text-align: center;
  margin-top: 50px;"
>You're almost here</h1>
    </center>
  </body>
</html>

<?php 
ob_start();
header("Content-Type: text/html");
$seats=$_SESSION['seats'];
if(empty($seats)){
  echo "please select how many seats";
}

//$con = mysqli_connect("localhost", "root", "", "airlines");
if(isset($_SESSION['fid'])){
  $r=$_SESSION['fid'];

  for ($i=0; $i <=$seats; $i++) {
      if(isset($_POST['book'])){
              if($i==$_POST['book']){
                          $fid=$r[$i];
                          $_SESSION['book_fid']=$fid;
                          break; 
              }    
                    }
                  }

}
else{
  echo "fid is not available";
}
$fid=$_SESSION['book_fid'];
  echo "Your Flight id is ".$fid."<br><br>";
  if($_SESSION['type']==="one-way"){
     $sql = "SELECT * FROM find WHERE f_id='$fid'";
    $enter = mysqli_query($con, $sql);
    if (mysqli_num_rows($enter) == 1) {
        echo '<html>
        <body>
        <style>
            table {
              border-collapse: collapse;
              width: 100%;
              text-align: center;
            }
            td {
              padding: 10px;
            }
          </style>
          ';

        echo '<table>';
        while ($row = mysqli_fetch_array($enter)) {
            echo '
            <tr>
                <th>From : ' . $row['from_place'] . '</th>
                <th>Travel Time : </th>
                <th>To : ' . $row['to_place'] . '</th>
                <th>Departure Date</th>
                <th>Amount : </th>
                
            </tr>        
            <tr>
                <td>' . $row['departure'] . '</td>
                <td>' . $row['time'] . '  Hours </td>
                <td>' . $row['arrival'] . '</td>
                <td>'.$row['date'].'</td>
                <td>' . $row['amount'] . '  Rs</td>
                
            </tr>
            ';

            $_SESSION['amount']=$row['amount'];
          $date=$row['date'];
          if(isset($_SESSION['type'])){
        if($_SESSION['type']==="two-way"){ 
          
  // Assign the value of the 'ret-date' column to the session variable
  $_SESSION['ret-date'] = $row['ret_date'];
  print_r($_SESSION['ret-date']);
        }
        if($_SESSION['type']==="one-way"){
          $_SESSION['ret-date']=[];
        }
      }else{
        echo "not setted return date";
      }
          }
        echo '</table>
            
          </body>
        </html>';
          $_SESSION['date']=$date;
      
        }
   
  }
  elseif($_SESSION['type']==="two-way"){
     $sql = "SELECT * FROM find WHERE f_id='$fid'";
    $enter = mysqli_query($con, $sql);
    if (mysqli_num_rows($enter) == 1) {
        echo '<html>
        <body>
        <style>
              table {
              width: 100%;
              text-align: center;
              border-collapse: collapse;
              margin: 10px 0;
            }
            th, td {
              padding: 10px;
              text-align: center;
            }

            th {
              background-color: #f2f2f2;
              font-weight: bold;
            }

            td {
              border: 1px solid #ddd;
            }

          </style>
          ';

        echo '<table>';
        while ($row = mysqli_fetch_array($enter)) {
            echo '
            <tr>
                <th>From : ' . $row['from_place'] . '</th>
                <th>Travel Time : </th>
                <th>To : ' . $row['to_place'] . '</th>
                <th>Departure Date</th>
                <th>Return Flight Date</th>
                <th>Amount : </th>
                
            </tr>        
            <tr>
                <td>' . $row['departure'] . '</td>
                <td>' . $row['time'] . '  Hours </td>
                <td>' . $row['arrival'] . '</td>
                <td>'.$row['date'].'</td>
                <td>'.$row['ret_date'].'</td>
                <td>' . $row['amount'] . '  Rs</td>
                
            </tr>
            ';

            $_SESSION['amount']=$row['amount'];
          $date=$row['date'];
          if(isset($_SESSION['type'])){
        if($_SESSION['type']==="two-way"){ 
          
  // Assign the value of the 'ret-date' column to the session variable
  $_SESSION['ret-date'] = $row['ret_date'];
  
        }
        if($_SESSION['type']==="one-way"){
          $_SESSION['ret-date']=[];
        }
      }else{
        echo "not setted return date";
      }
          }
        echo '</table>
            
          </body>
        </html>';
          $_SESSION['date']=$date;
      
        } 
  }
    else{
      echo "flight not found";
    }

/*else{
    echo     '<html>
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
            alert("FID not available");
        </script>   
        </body>
        </html>'; 
}
*/

ob_end_flush();
?>
<html>
  <style>
    /* Center the content of the page */
body {
  
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f5f5f5;
}

/* Style the fieldset */
fieldset {
  width: 500px;
  padding: 32px;
  border: none;
  border-radius: 4px;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
  background-color: #fff;
}

/* Style the heading */
h4 {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 16px;
}

/* Style the paragraphs */
p {
 color:white;
 background-color:red; 
}

/* Style the input fields */
input {
  margin-bottom: 16px;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

/* Style the button */
button {
  margin-top: 16px;
  padding: 8px 16px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 16px;
  cursor: pointer;
}

/* Style the link inside the button */
button a {
  color: #fff;
  text-decoration: none;
}

/* Style the select field */
select {
  margin-right: 8px;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="8" height="4"><path d="M0 0h8L4 4z" fill="%23666666"/></svg>');
  background-repeat: no-repeat;
  background-position: right 8px center;
}

  </style>
  <body>
    <fieldset>
      <legend>TRAVELLER DETAILS</legend>
      <p>Note</p>
      <p>Please make sure you enter the Name as per your govt. photo ID</p>
    <h4>TRAVELLER DETAILS  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="seat2.php"><button name="seats" id="seats">Select Your Seats</button></a></h4><br>
    <form action="passenger.php" method="post">
    <?php
    for($i=1;$i<=$seats;$i++){
    echo  "name <input type=text placeholder='first & middle name' name='fname$i' id=fname required>
    <input type=text name='lname$i' id=lname placeholder='last name' required><br>";
    }
    ?>
      email address <input type="email" name="email" id="email">your tickets will be sent to this email<br>

  <label for="std">Mobile number:</label>
  <select name="std" id="std">
    <option value="india">+91</option>
  </select>
  <input type="text" name="mobile" id="mobile">
  <span id="mobile-error"></span>
  <br>
<button name="proceed" id="proceed" onclick="validateMobile()">Proceed</button>
    </form>  
    </fieldset>
  </body>
</html>
<?php
if (isset($_GET['seats'])) {
  $seats = $_GET['seats'];
  $seats_array = explode(',', $seats); // convert the comma-separated list of seats to an array
  $_SESSION['seat_nos'] = $seats_array;
  if(empty($_SESSION['seat_nos'])){
         echo     '<html>    
        <body>
        <script type=text/javascript>
            alert("PLease Select Your Seats First");
        </script>   
        </body>
        </html>'; 
  }
}
?>