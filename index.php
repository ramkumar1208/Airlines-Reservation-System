<?php
    session_start();
    include 'db.php';
    
    ?>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="find.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- UIkit JS -->
<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script type="text/javascript">
		function disableInputs() {
			document.getElementById("ret").disabled = true;
		}
		function enableInputs() {
			document.getElementById("ret").disabled = false;
		}
</script>
</head>
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
              <li><?php

            if(isset($_SESSION['username'])){
                ?>
                <a href="logout.php">Log-out</a>
                <?php
            }
            else{
   echo "<script>
        alert('Please Login');
      </script>
            <a href='login.php'>Login</a>";

}
      ?></li>
 
            </ul>
            </nav>
            
                </header>
    <div class="bg">
<div class="home">
    <form action="index.php" method="post">
        <ul class="return-type">
            <div class="radio">

            <li>
           <label for="oneway">
    <input type="radio" name="one-way" value="oneway" id="oneway" onclick="disableInputs()"/> One-Way
            </label>
           </li>
            <li >
            <label for="two-way"> 
    <input type="radio" name="two-way" value="return" id="return" onclick="enableInputs()" /> Return
            </label>
        </li>
    </div>
               
    </ul>
        <br><br>
    <div class="input-space">
        <label>FROM</label><br><input list="from" name="from_place" id="from_place" value="CHE" require>
<datalist id ="from">
        <option value="DEL">Delhi</option>
        <option value="CHE">Chennai</option>
        <option value="MUM">Mumbai</option>
        <option value="BAN">Bangalore</option>
        <option value="KOL">Kolkatta</option>
</datalist >
        <label>TO</label><br><input list="to" name="to_place" id="to_place" value="DEL" require>
<datalist id ="to">
        <option value="DEL">Delhi</option>
        <option value="CHE">Chennai</option>
        <option value="MUM">Mumbai</option>
        <option value="BAN">Bangalore</option>
        <option value="KOL">Kolkatta</option>
</datalist >
        <label>DEPARTURE DATE</label><br><input type="date" name="departure" id="departure">
        <label>RETURN DATE</label><br><input type="date" name="ret" id="ret">
        <label>SEATS</label><br><input type="number" name="seat" id="seat" min="1" max="30" required>

    </div>
        <center>
    <button class="but" name="search" id="search">FIND FLIGHTS</button><br>
    </center>        
    </form>
    </div>
    </div>
</body>
</html>
<?php

$f_id=array();
//$con=mysqli_connect("localhost","root","","airlines");
if($con->connect_error){
		die('connection Failed :'.$con->connect_error);
}
if(isset($_POST['seat'])){
    $_SESSION['seats']=$_POST['seat'];
}
if(isset($_POST['ret'])){
    $arrival=$_POST['ret'];
}

if(isset($_POST['search'])){
    
 if(isset($_POST['two-way'])){
    $_SESSION['type']="two-way";
    
 }elseif(isset($_POST['one-way'])){
    $_SESSION['type']="one-way";
 }
    $from=$_POST['from_place'];
    $to=$_POST['to_place'];
    $departure=$_POST['departure'];
    $seat=$_POST['seat'];
    if(isset($_POST['two-way'])){
        $ret=$_POST['ret'];
    }
    if(isset($_POST['two-way'])){
         $sql="SELECT  * FROM  `find` WHERE `from_place`='$from' and `to_place`='$to' and `seat`>='$seat' and `date`='$departure' and `ret_date`='$arrival'";
    $enter=mysqli_query($con,$sql);
    if(mysqli_num_rows($enter) > 0) {
        echo '<html>
        <body>
        <style>
           table {
              width: 100%;
              text-align: center;
  border-collapse: collapse;
  margin: 10px 0;
}

caption {
  font-size: 24px;
  font-weight: bold;
  padding-bottom: 10px;
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

.book_now {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

          </style>
          
          <form action=book1.php method=post>
          ';

        $i=0;
        while ($row = mysqli_fetch_array($enter)) {
            echo '<table>';
            echo '
            <caption>' . $row['f_id'] . '</caption>
            <tr>
                <th>From : ' . $row['from_place'] . '</th>
                <th>Travel Time : </th>
                <th>To : ' . $row['to_place'] . '</th>
                <th>Amount : </th>
                <th>Departure Date</th>
                <th>ReTurn Flight Date</th>
                <th>Book Now</th>
            </tr>        
            <tr>
                <td>' . $row['departure'] . '</td>
                <td>' . $row['time'] . '</td>
                <td>' . $row['arrival'] . '</td>
                <td>' . $row['amount'] . ' </td>
                <td>'.$row['date'].'</td>
                <td>'.$row['ret_date'].'</td>
                <td>
                <button class="book_now" name="book" value='.$i.' id='.$i.'>Book</button>
                </td> 
            </tr>
            ';
            array_push($f_id, $row['f_id']);           
            $i++;
            echo '</table>';
        }
        
        echo '</form>
        </body>
        </html>'; 
        }         
    }
    elseif(isset($_POST['one-way'])){
         $sql="SELECT  * FROM  `find` WHERE `from_place`='$from' and `to_place`='$to' and `seat`>='$seat' and `date`='$departure'";
    $enter=mysqli_query($con,$sql);
    if(mysqli_num_rows($enter) > 0) {
        echo '<html>
        <body>
        <style>
           table {
              width: 100%;
              text-align: center;
  border-collapse: collapse;
  margin: 10px 0;
}

caption {
  font-size: 24px;
  font-weight: bold;
  padding-bottom: 10px;
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

.book_now {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

          </style>
          
          <form action=book1.php method=post>
          ';

        $i=0;
        while ($row = mysqli_fetch_array($enter)) {
            echo '<table>';
            echo '
            <caption>' . $row['f_id'] . '</caption>
            <tr>
                <th>From : ' . $row['from_place'] . '</th>
                <th>Travel Time : </th>
                <th>To : ' . $row['to_place'] . '</th>
                <th>Amount : </th>
                <th>Departure Date</th>
                <th>Book NOw</th>
            </tr>        
            <tr>
                <td>' . $row['departure'] . '</td>
                <td>' . $row['time'] . '</td>
                <td>' . $row['arrival'] . '</td>
                <td>' . $row['amount'] . ' </td>
                <td>'.$row['date'].'</td>
                <td>
                <button class="book_now" name="book" value='.$i.' id='.$i.'>Book</button>
                </td> 
            </tr>
            ';
            array_push($f_id, $row['f_id']);           
            $i++;
            echo '</table>';
        }
        
        echo '</form>
        </body>
        </html>'; 
        }         
    
    }
        
    }
    $con->close();
    ?>
    <?php
        $flight_id=$f_id;
        
        $_SESSION['fid'] =$flight_id;
?>
