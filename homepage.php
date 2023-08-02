<?php
    session_start();

    echo $_SESSION['username'];
?>
<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="hompage.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- UIkit JS -->
<meta name='viewport' content='width=device-width, initial-scale=1'>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<style>
    label {
			display: block;
			margin-bottom: 10px;
		}
		input[type="date"] {
			padding: 5px;
			border: 1px solid #ccc;
			border-radius: 4px;
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
                
            </ul>
            </nav><br>
            
            <button class="login"><i class='far fa-address-book'></i>&nbsp;&nbsp;&nbsp;<a href="login.php">LOGIN/SIGNUP</a></button>
    </header>
    
<div class="bg">

<h1>Book Your Tickets Now </h1>
<div class="home">

    <form action="find.php" method="post">
        <ul class="return-type">
            <div class="radio">

            <li>
           <label for="oneway">
    <input type="radio" name="one" value="oneway" id="oneway" onclick="disableInputs()" class="one-way"/> One-Way
            </label>
           </li>
            <li >
            <label for="return"> 
    <input type="radio" name="one" value="return" id="return" onclick="enableInputs()"/> Return
            </label>
            
        </li>
    </div>
               
    </ul>
        <br><br>


    <div class="input-space">
        
        <label>FROM</label><br><input list="from" name="from_place" id="from_place" require>
<datalist id ="from">
        <option value="DEL">Delhi</option>
        <option value="CHE">Chennai</option>
        <option value="MUM">Mumbai</option>
        <option value="BAN">Bangalore</option>
</datalist >
        <label>TO</label><br><input list="to" name="to_place" id="to_place" require>
<datalist id ="to">
        <option value="DEL">Delhi</option>
        <option value="CHE">Chennai</option>
        <option value="MUM">Mumbai</option>
        <option value="BAN">Bangalore</option>
</datalist >
        <label>DEPARTURE<br><input type="date" name="departure" id="departure" required></label>
        <label>RETURN<br><input type="date" name="ret" id="ret" required></label>
        <label>SEATS</label><br><input type="number" name="seat" id="seat" min="1" max="30" required><br><br>
    </div>
    <button class="but" name="search" id="search">SEARCH FLIGHTS</button>
</form>
</div>
</div>

<script type="text/javascript">
		function disableInputs() {
			document.getElementById("ret").disabled = true;
		}
		function enableInputs() {
			document.getElementById("ret").disabled = false;
		}

</script>
</body>
</html>