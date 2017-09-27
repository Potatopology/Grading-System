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
		<h3>Welcome <?php echo "" . $_COOKIE['pangalan']; ?></h3>
		<form method="POST" action="usermodule.php">
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="button" onclick="location.href='gradeentry.php';" value="Submit">
				Add Entry
			</button>
			<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" type="submit" name="submit" id="submit" value="Submit">
				View Records
			</button>
		</form>
		<br>
		<a href="index.php">Logout</a>
		<br>
	

	<!-- javascript -->
	<script src="js/material.min.js"></script>

	<!-- php -->
	

<?php 
if(isset($_POST['submit']))
{
mysql_connect("localhost", "root","") or die("No Connection");
mysql_select_db("webexam") or die("No Database");

$sql="select * from grading";
$result=mysql_query($sql);
$cnt=mysql_num_rows($result);
if($cnt==0)
print"No records found";
else{
echo "<br><center><table class=\"mdl-data-table mdl-js-data-table\">";

		echo "<thead>
        <tr>
          <th>Name</th>
          <th>Student Number</th>
          <th>Quiz 1</th>
          <th>Quiz 2</th>
          <th>MP Average</th>
          <th>Class Standing</th>
          <th>Exam</th>
          <th>Computed Grade</th>
          <th>Equivalent</th>
        </tr>
      </thead>";
	while($row=mysql_fetch_array($result))
	{
		echo "<tr> <td>" . $row['Name'] . "</td> <td>" . $row['StudNum'] . "</td>  <td>" . $row['Q1'] . "</td> <td>" . $row['Q2'] . "</td> <td>" . $row['MPAve'] . "</td> <td>" . $row['CS'] . "</td> <td>" . $row['Exam'] . "</td> <td>" . $row['ComputedGrade'] . "</td> <td>" . $row['Equivalent'] . "</td></tr>";
	}
		echo "</table>";
		
	}
print"</table></center>";
}
echo "</div>";
?>
</body>
</html>