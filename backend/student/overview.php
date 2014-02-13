<?php 

	require("../config.php");
    
    // At the top of the page we check to see whether the user 
    if(empty($_SESSION['usuario'])){ //is logged in or not 
        // If they are not, we redirect them to the login page. 
        header("Location: /fluent/formlogin.html");          
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to /fluent/formlogin.html"); 
    }     
    // Everything below this point in the file is secured by the login system

	//recupero variables

	//creo variables
 		$actual_month = $_SESSION['mes'];
		$actual_year = $_SESSION['ano'];

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>FluentSpeaking - StudentPortal</title>

	<link rel="stylesheet" type="text/css" href="/fluent/backend/admin/css/normalize.css"/>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
	<link rel="stylesheet" type="text/css" href="/fluent/backend/student/css/estilo_std.css"/>
	<link rel="shortcut icon" href="/fluent/frontend/img/favicon.ico">


	<script src="/fluent/backend/student/js/prefixfree.min.js"></script>
	<script src="/fluent/backend/student/js/jquery.js"></script>
	<script src="/fluent/backend/student/js/fluent.js"></script>
	<script src="/fluent/backend/student/js/script.js"></script> 
</head>

<body>
	<header>
		<div id="logo"><!--<logo>-->
			<a style="text-decoration: none; margin-left: 12px;" href="http://www.fluentspeaking.com" title="FluentSpeaking">
			    <img style="margin-top: 2px;" height="49" src="/fluent/backend/student/img/logo_last.png" alt="Fluent Speaking" />
			</a>
		</div >
		<div id="picture"><!--<picture>-->
			<a href="#"><img src="img/mark.jpg" width="96" height="96"></a>
		</div>	
		<div id="description"><!--<description>-->
			<tr><td><h10><?=$_SESSION['snombre']?></h10></td><td> </td><td><h10><?=$_SESSION['sapellido']?></h10></td></tr><br />
			<tr><td><h9><?=$_SESSION['scity']?></h9></td><td> / </td><td><h9><?=$_SESSION['scountry']?></h9></td></tr><br />
			<tr><td><a style="text-decoration: none;" href="profile.php">Profile</a> | <a style="text-decoration: none;" href="/fluent/backend/logout.php">Logout</a></td></tr><br />
		</div>			
	</header>
	<br />
	<br />
	<br />
	<ul class="tabrow"><!--- Tabs Main Menu -->
		<li><a href="/fluent/backend/student/home.php">HOME</a></li>
		<li class="selected"><a href="/fluent/backend/student/overview.php">LIVE LESSONS</a></li>
		<li><a href="/fluent/backend/student/profile.php">MY ACCOUNT</a></li>
		<li><a href="/fluent/backend/student/etest.php">EVALUATION TEST</a></li>
	</ul>
	<ul class="tabrow">	<!-- Tabs Sub Menu -->
		<li class="selected"><a href="#">Overview</a></li>
		<li><a href="#">Lessons List</a></li>
		<li><a href="#">Lessons Resources</a></li>
	</ul>	
	
<!-- MAIN CONTENT -->

	<section id="izq">
		<article id="live_uno">
			<div class="titul">	
				<tr><td><h3>Schedule Lessons</h3></td>	
					<td>
					</td>
				</tr>	
			</div>
			<div class="subtitul">			
			</div>
		</article>
		<article id="live_dos">
			<div>	
				<tr><td><h3>This Month Lessons</h3></td>	
					<td>
					</td>
				</tr>	
			</div>
			<div>			
			</div>
		</article>
		<article id="live_tres">
			<div>	
				<tr><td><h3>Archived Lessons</h3></td>	
					<td>
					</td>
				</tr>	
			</div>
			<div>			
			</div>
		</article>
	</section>
	<section id="der">	
		<article id="schedule1">
			<div class="titul">	
				<tr align=center><td><u>Profile Picture</u></td>	
					<td>
					</td>
				</tr>	
			</div>
			<div class="subtitul">			
			</div>
		</article>						
	</section>	
	
<!-- FOOTER -->
	<div id="footer">
		<p>Copyright 2012 &copy;<a href="http://www.fluentspeaking.de">FLUENTSPEAKING</a>. All rights reserved.</p>
		<!--<p><strong>AdminPortal </strong> by &copy;<a href="http://www.fluentspeaking.com"> QUANTICA SOFT, LLC</a></p>-->
	</div> 
<!-- end footer -->

</body>
</html>

<!-- end webPage -->

