<?php
	session_start();
	if($_SESSION['user']){
		$username=$_SESSION['user'];
		if($_GET['user2']){
			$found=false;
			mysql_connect("127.0.0.1","root","") or die(mysql_error());
			mysql_select_db("chat_db") or die("Unable to connect to the database");
			$query=mysql_query("select * from users where username!='$username'");
			while($row=mysql_fetch_array($query)){
				$user2=$row['username'];
				if($user2==$_GET['user2']){
					$found=true;
				}
			}
			if($found==false){
				print "<script>alert('No such user exists! Stop playing with teh URL -_-');</script>";
				print "<script>window.location.assign('home.php');</script>";
			}
		}	
	}else{
		header("location:index.php");
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Chat field</title>
</head>
<body>
<h2>Chat with <?php echo $_GET['user2']?> </h2>
</body>
</html>