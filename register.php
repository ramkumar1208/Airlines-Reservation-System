<?php
include 'db.php';
if(isset($_POST['regsub'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $username = $_POST['reg_username'];
        $password = $_POST['reg_pass'];
        $email = $_POST['mail_id'];
        
    //$con=mysqli_connect("localhost","root","","airlines");

    if($con->connect_error){
		die('connection Failed :'.$con->connect_error);
	}
    
        $select="SELECT * FROM users WHERE username='$username'";
     
        $result = mysqli_query($con, $select);
        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                echo "Username already exists.";

            } else {
                $sql = "INSERT INTO users(firstname, lastname, gender, dob, username, `password`, email)
                 VALUES ('$firstname', '$lastname', '$gender', '$dob', '$username', '$password', '$email')";
                $insert=mysqli_query($con,$sql);
                
            }
        }
        else {
            // Print an error message if the query execution failed
            echo "Error executing query: " . mysqli_error($con);
        }
        
 
    $con->close();
}
?>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>
<script type="text/javascript">
     function checkPassword() {
        let password1 = document.getElementById("cpass").value;
        let password2 = document.getElementById("crepass").value;

        if (password1 === password2) {
          
        } else {
          alert("Passwords  not Same");
        }
      }

</script>
<body>

    <h1 style="
    background-color: azure;
    position: relative;
    text-align: center;
    top: 50px;
    ">Airlines Reservation</h1>
    <div class="register">
        <form action="register.php" method="post">
            <h2>Register here!</h2>
            <label for="name">First Name </label><br>
            <input type="text" name="firstname" id="firstname" placeholder="abc" required><br>
            <label for="name">last Name</label><br>
            <input type="text" name="lastname" id="lastname" placeholder="xyz" required><br>
            <label for="">gender</label><br>
            <label for="gender">
            <input type="radio" name="gender" id="gender" value="male">male</label>
            <label for="gender">
            <input type="radio" name="gender" id="gender" value="female">female</label><br>
           
            <label for="dob">Date-Of-Birth</label><br>
            <input type="date" name="dob" id="dob"><br>
             <label for="">Create User name</label><br>
            <input type="text" name="reg_username" id="reg_username" placeholder="abc123" required><br>
            <label for="cpass">Create Password</label><br>
            <input type="text" name="reg_pass" id="cpass" placeholder="****************" required><br>
            <label for="crepass">Re-Enter Password</label><br>
            <input type="text" name="reg_repass" id="crepass" placeholder="****************" required><br>
            <label for="mno">Mail Id</label><br>
            <input type="email" name="mail_id" id="mail_id" placeholder="abc@gmail.com" max="30" required><br>
            <input type="submit" name="regsub" id="regsub"  onclick="checkPassword()">

        </form>
    </div>
</body>

</html>

