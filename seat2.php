<?php
		session_start();
		$seats=$_SESSION['seats'];
		if(isset($seats)){
		echo '<script>var numberseats = "' . $seats . '";</script>';
		}
		else{
		echo '<script>var numberseats = "";</script>';
		}

		if(isset($_SESSION['seats'])){
			$seats=$_SESSION['seats'];
		}
		else{
			echo "select your seats first";
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Seat Selection</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
	<center><h2>Please Select Your <?php echo $seats;?> Seats Now</h2></center>
	<form action="book1.php" method="post">
	<fieldset>
	<div class="seat-map">
		<div class="seat-row">
			<div class="seat" id="1A">1A</div>
			<div class="seat" id="1B">1B</div>
			<div class="seat" id="1C">1C</div>
			<div class="seat" id="1D">1D</div>
			<div class="seat" id="1E">1E</div>
		</div>
		<div class="seat-row">
			<div class="seat" id="2A">2A</div>
			<div class="seat" id="2B">2B</div>
			<div class="seat" id="2C">2C</div>
			<div class="seat" id="2D">2D</div>
			<div class="seat" id="2E">2E</div>
		</div>
		<div class="seat-row">
			<div class="seat" id="3A">3A</div>
			<div class="seat" id="3B">3B</div>
			<div class="seat" id="3C">3C</div>
			<div class="seat" id="3D">3D</div>
			<div class="seat" id="3E">3E</div>
		</div>
        <div class="seat-row">
			<div class="seat" id="4A">4A</div>
			<div class="seat" id="4B">4B</div>
			<div class="seat" id="4C">4C</div>
			<div class="seat" id="4D">4D</div>
			<div class="seat" id="4E">4E</div>
		</div>
        <div class="seat-row">
			<div class="seat" id="5A">5A</div>
			<div class="seat" id="5B">5B</div>
			<div class="seat" id="5C">5C</div>
			<div class="seat" id="5D">5D</div>
			<div class="seat" id="5E">5E</div>
		</div>
        <div class="seat-row">
			<div class="seat" id="6A">6A</div>
			<div class="seat" id="6B">6B</div>
			<div class="seat" id="6C">6C</div>
			<div class="seat" id="6D">6D</div>
			<div class="seat" id="6E">6E</div>
		</div>
        <div class="seat-row">
			<div class="seat" id="7A">7A</div>
			<div class="seat" id="7B">7B</div>
			<div class="seat" id="7C">7C</div>
			<div class="seat" id="7D">7D</div>
			<div class="seat" id="7E">7E</div>
		</div>
        <div class="seat-row">
			<div class="seat" id="8A">8A</div>
			<div class="seat" id="8B">8B</div>
			<div class="seat" id="8C">8C</div>
			<div class="seat" id="8D">8D</div>
			<div class="seat" id="8E">8E</div>
		</div>
        <div class="seat-row">
			<div class="seat" id="9A">9A</div>
			<div class="seat" id="9B">9B</div>
			<div class="seat" id="9C">9C</div>
			<div class="seat" id="9D">9D</div>
			<div class="seat" id="9E">9E</div>
		</div>
        <div class="seat-row">
			<div class="seat" id="10A">10A</div>
			<div class="seat" id="10B">10B</div>
			<div class="seat" id="10C">10C</div>
			<div class="seat" id="10D">10D</div>
			<div class="seat" id="10E">10E</div>
		</div>
	</div>
	<br>
	<center><button class='submit' id="submit-btn">Submit</button></center>
	</fieldset>
	<div id="selected-seats"></div>
</form>
	<script>
		$(document).ready(function() {
			$(".seat").click(function() {
				$(this).toggleClass("selected");
			});

			$("#submit-btn").click(function(event) {
				event.preventDefault();
				var selectedSeats = $(".selected").map(function() {
					return this.id;
				}).get();

				var url = "http://localhost/project/seat.php?seats=" + selectedSeats.join(",");
				console.log(url);
                	// Check if more than 4 seats are selected
			if (selectedSeats.length > numberseats) {
				alert("You can only select a maximum of "+numberseats+" seats.");
				// Uncheck the extra seats
				for (let i = numberseats; i < selectedSeats.length; i++) {
					selectedSeats[i].checked = false;
				}
				return;
			}
			if (selectedSeats.length <=0) {
				alert("Please Select Your At Least your  "+numberseats+" seats.");
				// Uncheck the extra seats
				for (let i = numberseats; i < selectedSeats.length; i++) {
					selectedSeats[i].checked = false;
				}
				return;
			}
			if (selectedSeats.length <numberseats) {
				alert("Please Select Your At Least your  "+numberseats+" seats.");
				// Uncheck the extra seats
				for (let i = numberseats; i < selectedSeats.length; i++) {
					selectedSeats[i].checked = false;
				}
				return;
			}
				$("#selected-seats").text("Selected seats: " + selectedSeats.join(", "));
                    // Construct the URL with the selected seats as a query parameter
                    var url = "http://localhost/project/book1.php?seats=" + selectedSeats.join(",");

                    // Redirect to the new URL
                    window.location.href = url;

			});
		});
	</script>
	<style type="text/css">
		.seat-map {
				display: flex;
				flex-direction: column;
				align-items: center;
				margin: 20px;
				}

				.seat-row {
				display: flex;
				justify-content: center;
				}

				.seat {
				width: 30px;
				height: 30px;
				border-radius: 50%;
				background-color: #ccc;
				margin: 5px;
				display: flex;
				justify-content: center;
				align-items: center;
				font-weight: bold;
				font-size: px;
				cursor: pointer;
				user-select: none;
				}

				.seat.selected {
				background-color: #27ae60;
				color: #fff;
				}
				fieldset {
			border: 2px solid orange;
			border-radius: 0px;
			padding: 20px;
			position: relative;
			width:100px;
			margin: 50px auto;
			
			}

			fieldset:before {
			content: '';
			position: absolute;
			top: -px;
			left: 50%;
			transform: translateX(-50%);
			border-top: px solid transparent;
			border-bottom: px solid #ccc;
			border-left: px solid transparent;
			border-right: px solid transparent;
			}

			fieldset:after {
			content: '';
			position: absolute;
			bottom: -px;
			left: 50%;
			transform: translateX(-50%);
			border-top: px solid #ccc;
			border-bottom: px solid transparent;
			border-left: px solid transparent;
			border-right: px solid transparent;
			}
			.submit{
				background-color:orange;
				width:70px;
				cursor: pointer;
				height:40px;
				color:white;
			}
	</style>
</body>
</html>
