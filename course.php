<?php
	session_start();
	if($_SESSION['user']){
		$user=$_SESSION['user'];
	}else{
		header("location:index.php");
	}
?>

<?php
			if($_SERVER['REQUEST_METHOD']=='GET' && $_GET['coursename']){
				$coursename=mysql_real_escape_string($_GET['coursename']);
			}else{
				echo "Go back and select a calid course name or number";
			}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Course Details - Courserator</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	
 <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">BSP Course Discussion</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="./index.php">Home</a></li>
            
            <li><a href="./register.php">Signup</a></li>
            	
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>





	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.php">Home</a></li>
			<li class="active">CoursePage</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-sm-8 maincontent">
				<header class="page-header">
					<h1 class="page-title">Courserator - Course Details</h1>
				</header>
				<h3><span class="label label-primary"><?php echo $coursename ?></span></h3>
				<br/>
<?php
	

				mysql_connect("127.0.0.1","root","");
				mysql_select_db("bsp_db");
				$query=mysql_query("Select * from courses where coursename='$coursename'");


				//echo "<span class=''>"
				while($row=mysql_fetch_array($query)){
				//	print "Course Name: " .$row['coursename']. "<br/>";
					print "Details : ". $row['details']. "<br/>";
					print "Overlaps with : ". $row['overlaps']. "<br/>";
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
					$netRate=0;
					print "Course Ratings: 0 <br/>";
				}else{
					$netRate=$rat/$num;
					print "Course Ratings: ". number_format((float)$netRate, 2, '.', ''). "<br/>";
				}
				mysql_query("Update courses SET rating=$netRate where coursename='$coursename'");

				echo "<br/><br/><br/>";
				$query=mysql_query("Select * from comments where coursename='$coursename'");

				while($row=mysql_fetch_array($query)){
					print "<span class='text-danger'>".$row['username']. " says</span> :: ";
					print  "<span class='text-primary'>".$row['comment']. "</span><br/>";
					//print "Course Overlaps: ". $row['overlaps']. "<br/>";
					//print "Pre requisites: ". $row['prereq']. "<br/>";
					//print "Course Ratings: ". $row['rating']. "<br/>";
				}


			

		?>

			<br/>

		<!-- <h4><span class="label label-primary">Comment:</span></h4> -->
		<form method='POST' action='post_comment.php'>
			<input	type="text" name="comment" placeholder="Comment">
			<input	type="text" name="coursename" hidden="hidden" value=<?php echo $coursename ?>>
			<!-- <input	type="text" name="username" hidden="hidden" value=<?php echo $user ?>> -->
			<button	type="Submit" class="btn btn-primary" name="submit" value='Comment'>Comment</button>
		</form>
	<br/>
	<br/>
		<!-- <p>Rate:</p> -->
		<form method='POST' action='post_ratings.php'>
			<input	type="number" name="rating" placeholder="Rating">
			<input	type="text" name="coursename" hidden="hidden" value=<?php echo $coursename ?>>
			<!-- <input	type="text" name="username" hidden="hidden" value=<?php echo $user ?>> -->
			
			<button	type="Submit" class="btn btn-primary" name="submit" value='Rate'>Rate</button>
		</form>	



				
			</article>
			<!-- /Article -->
			
			<!-- Sidebar -->
			<aside class="col-sm-4 sidebar sidebar-right">

				<div class="widget">
					<h4>Top Rated Courses</h4>
					<ul class="list-unstyled list-spaces">
					<?php
					
						$query=mysql_query("Select * from courses order by rating ASC LIMIT 5");
						if($query){
							
							while($row=mysql_fetch_array($query)){
								print "<li><a href=''>" .$row['coursename']. "</a></li>";
								//print "Course Details: ". $row['details']. "<br/>";
								//print "Course Overlaps: ". $row['overlaps']. "<br/>";
								//print "Pre requisites: ". $row['prereq']. "<br/>";
							}
						}else{
							echo "Nothing to display. Please come back tommorrow!<br>";
						}
						//echo "hi toppers!";


					?>

					
					
					</ul>
				</div>

			</aside>
			<!-- /Sidebar -->

		</div>
	</div>	<!-- /container -->
	









<div id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">
					
					<div class="col-md-3 widget">
						<h3 class="widget-title">Contact</h3>
						<div class="widget-body">
							<p>+918588815188<br>
								<a href="mailto:#">BSP@somewhere.com</a><br>
								<br>
								BSP Office, IIT Delhi.
							</p>	
						</div>
					</div>

					<div class="col-md-3 widget">
						<h3 class="widget-title">Follow us</h3>
						<div class="widget-body">
							<p class="follow-me-icons">
								<a href=""><i class="fa fa-twitter fa-2"></i></a>
								<a href=""><i class="fa fa-dribbble fa-2"></i></a>
								<a href=""><i class="fa fa-github fa-2"></i></a>
								<a href=""><i class="fa fa-facebook fa-2"></i></a>
							</p>	
						</div>
					</div>

					<div class="col-md-6 widget">
						<h3 class="widget-title">About us</h3>
						<div class="widget-body">
							<p>BSP Lorem Ipsum text :p</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">
					
					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="#">Home</a> | 
								
								<b><a href="register.php">Sign up</a></b>
							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
								Copyright &copy; 2016, BSP. Designed by <a href="http://www.cse.iitd.ac.in/~cs1140207/" rel="designer">Prakhar</a> 
							</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

	</div>	
	
	



	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
</body>
</html>




<!DOCTYPE html>
<html>
<head>
	<title>Course Details Page</title>
</head>
<body>
		