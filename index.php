<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>

	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<h3>Grading System</h3>
		<form method="POST" action="index.php">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="username" name="username">
				<label class="mdl-textfield__label" for="username">Name</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="password" id="password" name="password">
				<label class="mdl-textfield__label" for="password">Password</label>
			</div>
			<br>
			<br>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="submit" name="submit" id="submit" value="Submit">
				Login
			</button>
			<button class="mdl-button mdl-js-button mdl-button--primary" type="reset" value="Clear">
				Clear
			</button>
		</form>
		<br>
		<a href="register.php">Not yet registered? Click here!</a>
	</div>

	<!-- javascript -->
	<script src="js/material.min.js"></script>


	<!-- php -->
	<?php
	$hostname = 'localhost';
    $dbname   = 'webexam'; 
    $username = 'root';
    $password = '';
	$conn = mysqli_connect($hostname,$username,$password,$dbname);
    
	if(isset($_POST['submit']))
	{
		$user=$_POST['username'];
		$pass=$_POST['password'];

		$searchrecord = "select * from accounts";
		
		$result=mysqli_query($conn,$searchrecord);
		$rows=mysqli_num_rows($result);
		if($rows==0)
			echo "<script type='text/javascript'>alert('No record found')</script>";
		else
		{
			while($rec=mysqli_fetch_array($result))
			{
				$userrec=$rec['Username'];
				$passrec=$rec['Password'];
	            $name=$rec['Name'];
				if(($userrec==$user) && ($passrec==$pass))
				{
					setcookie("pangalan",$name,time() + (86400) * 30, "/");
					header("Location: usermodule.php");
		            exit();
				}
			}
		}
	}
   
	?>
</body>
</html>