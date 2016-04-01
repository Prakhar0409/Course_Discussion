<?php

 
	include 'credentials.php';

	session_start();
	if($_SESSION['user'] && $_SERVER['REQUEST_METHOD']=='POST'){
		mysql_connect($DB_HOST,$DB_USER,$DB_PASS);
		mysql_select_db($DB);

		$user=$_SESSION['user'];
		echo 'hey';
		$coursename=mysql_real_escape_string($_POST['coursename']);
		$username=$user;
		$rating=mysql_real_escape_string($_POST['rating']);
		$courseUser=$coursename+$username;
		echo "$coursename+$username";

		// INSERT INTO table (id, name, age) VALUES (1, 'A', 19) ON DUPLICATE KEY UPDATE id = id + 1;


		mysql_query("Insert into course_ratings (rating,courseName,courseUser) values ('$rating','$coursename','$coursename+$username') ON DUPLICATE KEY UPDATE rating='$rating'");
		header("location:course.php?coursename=$coursename");
	}else{
		header("location:index.php");
	}
?>