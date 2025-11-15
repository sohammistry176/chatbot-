
<!DOCTYPE html>
<html>
<head>


<style>
body 
{
  background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20190223/ourmid/pngtree-smart-robot-arm-advertising-background-backgroundrobotblue-backgrounddark-backgroundlightlight-image_68405.jpg' );
   background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}
</style>


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>	
<title>Registration Page</title>
<link rel="stylesheet" href="css/stylex.css">
</head>
<!--<body style="background-color:#bdc3c7"> -->
	
	<div id="main-wrapper">
		<center>
			<h2><strong id="regis">Sign Up</strong></h2>
			<img src="image/user_avatar.png" class="avatar"/>
		</center>
	
		<form class="myform" action="register.php" method="POST">


			<div class="inner_container">


 			<label><b id="run">Username:</b></label><br>
			<input name="username" type="text" id="ruser" class="inputvalues" placeholder="Username" required/><br>
			<label><b id="pass">Password:</b></label><br>
			<input name="password" type="password" id="password" class="inputvalues" placeholder="Password" required/><br>
				<label><b id="pass2">Confirm Password:</b></label><br>
			<input name="password2" type="password" id="password2" class="inputvalues" placeholder="Confirm password" required/><br>
			<label><b id="mail">Email:</b></label><br>
			<input name="email" type="email" id="email" class="inputvalues" placeholder="Email" required/><br>
			<input name="submit_btn" type="submit" id="signup_btn" value="Sign Up"/><br>
			<a href="index.php"><input type="button" id="back_btn" value="Back"/></a>
		
		</div>

		</form>
		
<?php
    if(isset($_POST['submit_btn']))
    {
        // Get form data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $email = $_POST['email'];

        // Check if passwords match
        if($password == $password2)
        {
            // Database connection parameters
            $db_host = "localhost";
            $db_user = "root"; // Update if your XAMPP user is different
            $db_pass = "";     // Update with your actual password if root has one
            $db_name = "soham";

            // Establish connection
            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

            // Check connection
            if (!$conn) {
                die('<script type="text/javascript"> alert("Database connection failed: ' . mysqli_connect_error() . '") </script>');
            }

            // 1. Check if username already exists
            $sql_check = "SELECT * FROM users WHERE username='$username'";
            $result_check = mysqli_query($conn, $sql_check);

            // Check if any row was returned (meaning user exists)
            if (mysqli_num_rows($result_check) > 0) {
                echo '<script type="text/javascript"> alert("User already exists.. try another username") </script>';
            } else {
                // 2. If user doesn't exist, proceed with registration
                
                // IMPORTANT: In a real application, you should hash the password!
                // For demonstration, we'll use the plain password as in your original script.
                // $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
                
                $sql_insert = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
                
                if (mysqli_query($conn, $sql_insert)) {
                    echo '<script type="text/javascript"> alert("User Registered successfully! Go to login page to login") </script>';
                } else {
                    echo '<script type="text/javascript"> alert("Registration failed: ' . mysqli_error($conn) . '") </script>';
                }
            }
            
            // Close the database connection
            mysqli_close($conn);

        } else {
            // Passwords do not match
            echo '<script type="text/javascript"> alert("Passwords does not match!") </script>';
        }
    }  
?>
	</div>
</body>
</html>