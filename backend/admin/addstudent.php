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
		$filter_student = $_SESSION['FilterStudent'];
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>FluentSpeaking - AdminPortal</title>

	<link rel="stylesheet" type="text/css" href="/fluent/backend/admin/css/normalize.css"/>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
	<link rel="stylesheet" type="text/css" href="/fluent/backend/admin/css/estilos_adm.css"/>
	<link rel="shortcut icon" href="/fluent/frontend/img/favicon.ico">


	<script src="/fluent/backend/admin/js/prefixfree.min.js"></script>
	<script src="/fluent/backend/admin/js/jquery.js"></script>
	<script src="/fluent/backend/admin/js/fluent.js"></script>
	<script src="/fluent/backend/admin/js/script.js"></script> 
</head>

<body>
	<div id="top_menu"><!--<menu superior>-->
		<div id="menu">
			<a href="/fluent/backend/logout.php" title="Salir!">Logout</a>
		</div>        
	</div>
	<div id="logo"><!--<logo>-->
		<a style="text-decoration: none; margin-left: 12px;" href="http://www.fluentspeaking.com" title="FluentSpeaking">
		    <img style="margin-top: 2px;" height="39" src="/fluent/frontend/img/logo_last.png" alt="Fluent Speaking" />
		</a>
	</div>
	<br />
	<ul class="tabrow"><!--- Tabs Menu -->
		<li><a href="/fluent/backend/admin/admin.php">WEBPAGE</a></li>
		<li><a href="/fluent/backend/admin/account.php">ACCOUNTING</a></li>
		<li><a href="/fluent/backend/admin/admins.php">ADMINs</a></li>
		<li><a href="/fluent/backend/admin/trainer.php">TRAINERs</a></li>
		<li class="selected"><a href="/fluent/backend/admin/student.php">STUDENTs</a></li>
		<li><a href="#">UNITs</a></li>
	</ul>
	<br />
	
<!-- MAIN CONTENT -->

<!-- linea de control -->
<center>
	<table>			
	<td><h10>ADD a NEW student Profile</h10>
	|<button type="submit" form="form7" value="Submit">Submit</button>
	|<button type="reset" form="form7" value="Submit">Reset</button>	
	|<a href="student.php"><img src="img/backward.png" width="14" height="14"/></a>|

	</td>
	</table>
</center>
<!-- end linea de control -->
<!-- Tabs Menu -->
	<ul class="tabrow">
		<li class="selected"><a href="#">General Information</a></li>
		<li><a href="#">Booking Information</a></li>
		<li><a href="#">Credit Summary</a></li>
		<li><a href="#">Units</a></li>
		<li><a href="#">Training Agenda/Report</a></li>
	</ul>
<!-- end Tabs Menu -->

<!-- info basica -->
<form action="newstudent.php" method="POST" id="form7">

	<section>

		<article id="columna_izq">
			<div class="titul">	
				<tr><td><u>BASIC INFORMATION </u></td>	
				</tr>	
			</div>
			<div class="subtitul">			
				<tr><td><h10>First Name :  <input type='text' name="nsnombre" value='' size=40 autofocus required></h10></td></tr><br />
				<tr><td><h10>Last Name :  <input type='text' name="nsapellido" value='' size=40 required></h10></td></tr><br />
				<tr><td><h10>Date :  <input type='date' name="nsbirth" value='' size=10></h10></td></tr><br />

				<tr><td><h10>Gender :  
				<input type="radio" name="nsgender" value="male">Male
				<input type="radio" name="nsgender" value="female">Female</h10></td></tr><br />

				<tr><td><h10>HomeTown :  <input type='text' name="nshtown" value='' size=50></h10></td></tr><br />
				<tr><td><h10>Address :  <input type='text' name="nsaddr" value='' size=50></h10></td></tr><br />
			</div>
		</article>

		<article id="columna_der">
			<div class="titul">
				<tr>
					<td align=left><u>SETTINGS</u></td>
				</tr>
			</div>
			<div class="subtitul">			
				<tr><td><h10>Native Language :  <input type='text' name="nsnlang" value='' size=20></h10></td></tr><br />
				<tr><td><h10>City :  <input type='text' name="nscity" value='' size=20></h10></td></tr><br />
				<tr><td><h10>Country :  <input type='text' name="nscountry" value='' size=30></h10></td></tr><br />
				<tr><td><h10>Time Zone :  </h10></td></tr><br />
				<tr><td><h10>Actual Work :  <input type='text' name="nsawork" value='' size=40></h10></td></tr><br />
			</div>			
		</article>

		<article id="columna_izq">
			<div class="titul">	
				<tr><td><u>MEDIA SETTINGS</u></td>	
				</tr>	
			</div>
			<div class="subtitul">			
				<tr><td><h10>Phone :  <input type='text' name="nstelefono" value='' size=30></h10></td></tr><br />
				<tr><td><h10>Mobile phone :  <input type='text' name="nscelular" value='' size=30></h10></td></tr><br />
				<tr><td><h10>Skype :  <input type='text' name="nsskype" value='' size=50></h10></td></tr><br />
				<tr><td><h10>e-mail :  <input type='text' name="nsemail" value='' size=50 required></h10></td></tr><br />
			</div>			
		</article>

		<article id="columna_der">
			<div class="titul">
				<tr>
					<td align=left><u>LOGIN & PASSWORD</u></td>
				</tr>
			</div>
			<div class="subtitul">			
				<tr><td><h10>User :  <input type='text' name="nsusuario" value='' size=20 required></h10></td></tr><br />
				<tr><td><h10>Password :  <input type='text' name="nspassword" value='' size=20 required></h10></td></tr><br />
				<tr><td><h10>Last Trainer : </h10></td></tr><br />
				<tr><td><h10>Code :  <input type='text' name="nscode" value='' size=25></h10></td></tr><br />
			</div>			
		</article>			
	</section>

</form>
<!-- end info basica -->
<br />	
<!-- FOOTER -->
	<div id="footer">
		<p>Copyright 2012 &copy;<a href="http://www.fluentspeaking.de">FLUENTSPEAKING</a>. All rights reserved.</p>
		<!--<p><strong>AdminPortal </strong> by &copy;<a href="http://www.fluentspeaking.com"> QUANTICA SOFT, LLC</a></p>-->
	</div> 
<!-- end footer -->

</body>
</html>

<!-- end webPage -->

