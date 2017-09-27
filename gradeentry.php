<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Enter Grade</title>

	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<form method="POST" action="gradeentry.php">
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="name" name="name">
				<label class="mdl-textfield__label" for="name">Name</label>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="sn" name="sn">
				<label class="mdl-textfield__label" for="sn">Student Number</label>
				<span class="mdl-textfield__error">Input is not a number!</span>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="q1" name="q1">
				<label class="mdl-textfield__label" for="q1">Quiz 1</label>
				<span class="mdl-textfield__error">Input is not a number!</span>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="q2" name="q2">
				<label class="mdl-textfield__label" for="q2">Quiz 2</label>
				<span class="mdl-textfield__error">Input is not a number!</span>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="mpave" name="mpave">
				<label class="mdl-textfield__label" for="mpave">MP Average</label>
				<span class="mdl-textfield__error">Input is not a number!</span>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="cs" name="cs">
				<label class="mdl-textfield__label" for="cs">Class Standing</label>
				<span class="mdl-textfield__error">Input is not a number!</span>
			</div>
			<br>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="exam" name="exam">
				<label class="mdl-textfield__label" for="exam">Exam</label>
				<span class="mdl-textfield__error">Input is not a number!</span>
			</div>
			<br>
			<br>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="submit" name="submit" id="submit" value="Submit">
				Submit
			</button>
			<button class="mdl-button mdl-js-button mdl-button--primary" type="reset" value="Clear">
				Clear
			</button>
		</form>
		<br>
		<a href="usermodule.php">Go back</a>
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
			$name = $_POST['name'];
			$studNo = $_POST['sn'];
			$q1 = $_POST['q1'];
			$q2 = $_POST['q2'];
			$mpa = $_POST['mpave'];
			$cs = $_POST['cs'];
			$exam = $_POST['exam'];
			
			if ($name == "" || $studNo == "" || $q1 == "" || $q2 == "" || $mpa == "" || $cs == "" || $exam == ""){
				echo "<script type='text/javascript'>alert('Please fill out information')</script>";
			}
			else {
				$qave = ($q1 + $q2) / 2;
				$cg = (($qave + $mpa)/2) * .40 + ($cs * .10) + ($exam * .50);
				$equivalent = 0;
				if($cg <= 50){
					$equivalent = 0;
				}elseif ($cg < 75) {
					$equivalent = 5;
				}elseif ($cg < 77) {
					$equivalent = 3;
				}elseif ($cg < 80) {
					$equivalent = 2.75;
				}elseif ($cg < 83) {
					$equivalent = 2.50;
				}elseif ($cg < 86) {
					$equivalent = 2.25;
				}elseif ($cg < 89) {
					$equivalent = 2.00;
				}elseif ($cg < 92) {
					$equivalent = 1.75;
				}elseif ($cg < 95) {
					$equivalent = 1.50;
				}elseif ($cg < 98) {
					$equivalent = 1.25;
				}elseif ($cg <= 100) {
					$equivalent = 1.00;
				}else{
					$equivalent = 0;
				}

				if($equivalent == 0){
					echo "<script type='text/javascript'>alert('Error: The equivalent is greater than 1 or extremely low. Please check inputs')</script>";
				}
				else{
					$insert = "INSERT INTO grading (Name, StudNum, Q1, Q2, MPAve, CS, Exam, ComputedGrade, Equivalent) VALUES ('$name','$studNo','$q1','$q2','$mpa','$cs','$exam','$cg','$equivalent')"; 

					if($conn->query($insert) === TRUE)
					{
						echo "<script type='text/javascript'>alert('Successfully Inserted')</script>";
					}
					else
					{
						echo "<script type='text/javascript'>alert('Error: " . $insert . "<br>" . $conn->error . "'</script>";
					}
				}

   				
			}
		}
?>
</body>
</html>