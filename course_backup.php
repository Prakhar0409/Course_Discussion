<?php

 
	include 'credentials.php';

	session_start();
	if($_SESSION['user']){
		$user=$_SESSION['user'];
	}else{
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Course Details Page</title>
</head>
<body>
		<?php
			if($_SERVER['REQUEST_METHOD']=='GET' && $_GET['coursename']){
				$coursename=mysql_real_escape_string($_GET['coursename']);

				mysql_connect($DB_HOST,$DB_USER,$DB_PASS);
				mysql_select_db($DB);
				$query=mysql_query("Select * from courses where coursename='$coursename'");



				while($row=mysql_fetch_array($query)){
					print "Course Name: " .$row['coursename']. "<br/>";
					print "Course Details: ". $row['details']. "<br/>";
					print "Course Overlaps: ". $row['overlaps']. "<br/>";
					print "Pre requisites: ". $row['prereq']. "<br/>";
				}


				// Ratings retrival
				$query=mysql_query("Select * from ratings where coursename='$coursename'");

				$rat=0; $num=0;
				while($row=mysql_fetch_array($query)){
					$rat=$rat+$row['rating'];
					$num=$num+1;
				}
				if($num==0){
					print "Course Ratings: 0 <br/>";
				}else{
					print "Course Ratings: ". $rat/$num. "<br/>";
				}

				echo "<br/><br/><br/>";
				$query=mysql_query("Select * from comments where coursename='$coursename'");

				while($row=mysql_fetch_array($query)){
					print "Username: " .$row['username']. "<br/>";
					print "Comment: ". $row['comment']. "<br/>";
					//print "Course Overlaps: ". $row['overlaps']. "<br/>";
					//print "Pre requisites: ". $row['prereq']. "<br/>";
					//print "Course Ratings: ". $row['rating']. "<br/>";
				}


			}else{
				echo "Go back and select a course name or number";
			}

		?>

		<p>Comment:</p>
		<form method='POST' action='post_comment.php'>
			<input	type="text" name="comment" placeholder="enter your comment">
			<input	type="text" name="coursename" hidden="hidden" value=<?php echo $coursename ?>>
			<input	type="text" name="username" hidden="hidden" value=<?php echo $user ?>>
			<input	type="Submit" name="submit" value='Submit Comment'>
		</form>
<br/>
<br/>
		<p>Rate:</p>
		<form method='POST' action='post_ratings.php'>
			<input	type="number" name="rating" placeholder="enter your rating">
			<input	type="text" name="coursename" hidden="hidden" value=<?php echo $coursename ?>>
			<input	type="text" name="username" hidden="hidden" value=<?php echo $user ?>>
			<input	type="Submit" name="submit" value='Submit Comment'>
		</form>	

</body>
</html>