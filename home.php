<?php 
include 'credentials.php';
 ?>

<?php
  session_start();
  $user="";
  if($_SESSION['user']){
    //check if user is already logged in

    $user=$_SESSION['user'];
    
  }else{
    echo "WTF! go Back";
    header('Location: ./login.php');

  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Course discussion</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">

    <link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">

  <!-- Custom styles for our template -->
  <link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
  <link rel="stylesheet" href="assets/css/main.css">




    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body role="document">

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
            <li class="active"><a href="#">Home</a></li>
            
            <li><a href="#about">About</a></li>
            <li><a href="logout.php">Logout</a></li>
            
            <!-- <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li> -->
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" style="padding-top:10%;" role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>Courserator</h1>
        <p>This is a course discussion platform brought to you by <em>BSP</em>. You may use this platform to make positive/negative comments about courses at IIT Delhi. People looking for courses can find the constructive discussion under the course.</p>
      </div>


<?php

    
		mysql_connect($DB_HOST,$DB_USER,$DB_PASS);
		mysql_select_db($DB);
		$query=mysql_query("select * from courses");
		print "<table>";
		while($row=mysql_fetch_array($query)){
			$course=$row['coursename'];
			print "<a href='./course.php?coursename=".$course."'><tr>".$course."</tr></a><br/>";
		}
		print "</table>";
	// }else{
	// 	header("location:index.php");
	// }
?>


      
<!--Search Bar-->

 <div class="container">
  <div class="row">
    <h2>Search a Course</h2>
      <form method="post">
           <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" class="  search-query form-control" name="search" placeholder="Search" />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="button">
                                        <span class=" glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
      </form>
  </div>
</div>
 <!-- <button type="button" class="btn btn-lg btn-primary">Search</button> -->

    </div> <!-- /container -->


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



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.min.js"></script>
    
    <script src="dist/js/bootstrap.min.js"></script>
    
  </body>
</html>


<?php

  if($_SERVER["REQUEST_METHOD"]=="POST"){
    //check if user is already logged in  
    $search=mysql_real_escape_string($_POST["search"]);
  echo "<script type='text/javascript'>window.location='./course.php?coursename=$search'</script>";
   } 
?>





