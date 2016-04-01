<?php 
	include 'credentials.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Course entry</title>
</head>
<body>
	<form action='' method='POST'>
		<input	type="text" name="coursecode" placeholder="coursecode">
		<input	type="text" name="coursename" placeholder="coursename">
		<input	type="text" name="details" placeholder="Details">
		<input	type="number" name="rating" placeholder="rating">
		<input	type="text" name="overlaps" placeholder="overlaps">
		<input	type="text" name="prereq" placeholder="prereq">
		<!--<input	type="text" name="coursename" placeholder="coursename">-->
		<input	type="submit" name="submit" value="Submit Course!">
	</form>

</body>
</html>

<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		mysql_connect($DB_HOST,$DB_USER,$DB_PASS);
		mysql_select_db($DB) or die("failed to connect to the database");
		$coursecode=mysql_real_escape_string($_POST['coursecode']);
		$coursename=mysql_real_escape_string($_POST['coursename']);
		$details=mysql_real_escape_string($_POST['details']);
		$rating=mysql_real_escape_string($_POST['rating']);
		$overlaps=mysql_real_escape_string($_POST['overlaps']);
		$prereq=mysql_real_escape_string($_POST['prereq']);
		
		$courseExists=false;
		$query=mysql_query("Select * from courses");


		while($row=mysql_fetch_array($query)){
			if($coursename==$row['coursename']){
				$courseExists=true;
				print "<script>alert('Course already added!');</script>>";
				print "<script>window.location.assign('courseentry.php');</script>";
			}
		}
		if($courseExists==false){
			mysql_query("Insert into courses (coursecode, coursename,details,rating,overlaps,prereq) Values ('$coursecode',$coursename','$details','$rating','$overlaps','$prereq')");
			print "<script>alert('Course Successfully added');</script>";
			print "<script>window.location.assign('courseentry.php');</script>";
			//print "<script>window.location.assign('register.php');</script>";
		}
	}
?>