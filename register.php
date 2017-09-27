<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>

	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<h3>Create an account</h3>
		<form method="POST" action="register.php">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="name" name="name">
				<label class="mdl-textfield__label" for="name">Name</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="email" name="email">
				<label class="mdl-textfield__label" for="email">Email</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="user" name="user">
				<label class="mdl-textfield__label" for="user">Username</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="password" id="pass" name="pass">
				<label class="mdl-textfield__label" for="pass">Password</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="password" id="confirm" name="confirm">
				<label class="mdl-textfield__label" for="confirm">Confirm Password</label>
			</div>
			<br>
			<br>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="submit" name="submit" id="submit" value="Submit">
				Register
			</button>
			<button class="mdl-button mdl-js-button mdl-button--primary" type="reset" value="Clear">
				Clear
			</button>
		</form>
		<br>
		<a href="index.php">Go back</a>
	</div>

	<!-- javascript -->
	<script src="js/material.min.js"></script>


	<!--php-->
	<?php
	$hostname = 'localhost';
    $dbname   = 'webexam'; 
    $username = 'root';
    $password = '';
	$conn = mysqli_connect($hostname,$username,$password,$dbname);
    
	if(isset($_POST['submit']))
		{
			$regName = $_POST['name'];
			$email = $_POST['email'];
			$user = $_POST['user'];
			$pass = $_POST['pass'];
			$confirm = $_POST['confirm'];
			
			if ($regName == "" || $email == "" || $user == "" || $pass == ""){
				echo "<script type='text/javascript'>alert('Please fill out information')</script>";
			}
			else if ($pass != $confirm) {
				echo "<script type='text/javascript'>alert('Confirm password incorrect')</script>";
			}
			else {
   				$insert = "INSERT INTO accounts (Name, Email, Username, Password) VALUES ('$regName','$email','$user','$pass')"; 

				if($conn->query($insert) === TRUE)
				{
					header("Location: index.php");
					echo "<script type='text/javascript'>alert('Sign-up successful')</script>";
				}
				else
				{
					echo "<script type='text/javascript'>alert('Error: " . $insert . "<br>" . $conn->error . "'</script>";
				}
			}

		}
?>


</body>
</html>