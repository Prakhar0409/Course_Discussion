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
		$comment=mysql_real_escape_string($_POST['comment']);

		mysql_query("Insert into comments (comment,coursename,username) values ('$comment','$coursename','$username')");
		header("location:course.php?coursename=$coursename");
	}else{
		header("location:index.php");
	}
?>