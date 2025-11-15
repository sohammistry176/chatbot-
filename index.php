<?php
	session_start();
	
?>
<!DOCTYPE html>
<html>
<head>


<title>Login Page</title>
<link rel="stylesheet" href="css/stylex.css">
-->
<style>
body 
{
  background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20190223/ourmid/pngtree-smart-robot-arm-advertising-background-backgroundrobotblue-backgrounddark-backgroundlightlight-image_68405.jpg' );
   background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: 100% 100%;
}



</style>



</head>

<br>
<br>
<br>
<br>
<br>
<br>

<br>
<br>
	

<!-- <body style="background-color:#bdc3c7"> -->
	
	<div id="main-wrapper">
		<center>
			<h2><strong id="log">Login</strong></h2>
			<div class="imgcontainer">
			<img src="image/bot_avatar.png" class="avatar"/>
		</center>
	
		<form class="myform" action="index.php" method="post">

			<div class="inner_container">

			<label><b id="un">Username:</b></label><br>
			<input name="username" id="us" type="text" class="inputvalues" placeholder="Enter Username here..." required/><br>
			<label><b id="pas">Password:</b></label><br>
			<input name="password" id="pass" type="password" class="inputvalues" placeholder="Your Password..." required/><br>
			
			<input name="login" type="submit" id="login_btn" value="Login"/><br>
			

			<a href="register.php"><input type="button" id="register_btn" value="Register"/></a> <br>
		
		</div>

		</form>
		<?php
		// 1. Database Connection attempt (It's better to connect once before the check)
		$conn=mysqli_connect("localhost","root","","soham");

		if(isset($_POST['login']))
		{
			// The connection is repeated here, which is redundant but works
			$conn=mysqli_connect("localhost","root","","soham");
			
			$username=$_POST['username'];
			$password=$_POST['password'];

			// 2. SQL Query to select a user with the provided username AND password
			$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			
			// 3. Execute the Query
			$stmt = mysqli_query($conn,$sql);

			// 4. Check for success/failure
			if( !$stmt) // This check is for query execution failure, not for finding a user
			{
				echo '<script type="text/javascript"> alert("Invalid credentials") </script>';
			}
			else
			{
				// If query executed, check if any rows were returned (i.e., user found)
				if(mysqli_num_rows($stmt) > 0) {
					$_SESSION['username']= $username;
					header('location:homepage.php');
					exit(); // Good practice to include exit() after header
				} else {
					// User not found in the database
					echo '<script type="text/javascript"> alert("Invalid credentials") </script>';
				}
			}
			
		}
		
		
		?>
		
	</div>
</body>
</html>