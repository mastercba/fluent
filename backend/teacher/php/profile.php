<?php 
	session_start();

//echo" ".$_SESSION['usuario']." ".$_SESSION['password']." ";
	//if(($_SESSION['adlogin'])=="si"){

	//Crear variables
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$teacherid = $_SESSION['teacherid'];
	$filter_student = $_SESSION['filterStudent'];

?>
<!---------- start webPage ---------------->
<!DOCTYPE HTML>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>LANGUACOM - Trainer Portal</title>
	
	<!-- Stylesheets -->
	<!--<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>-->
	<link rel="stylesheet" href="../css/style.css">
	<LINK REL="SHORTCUT ICON" HREF="../images/favicon.ico">
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<script src="../js/jquery.js"></script>
	<script src="../js/script.js"></script>  
</head>
<body>
<!------------------------------------------------------- TOP BAR -------------------------------------------------------->
	<div id="top-bar">
		
		<div class="page-full-width cf">

			<ul id="nav" class="fl">
	
			<!--<li class="v-sep"><a href="#" class="round button dark ic-left-arrow image-left">Go to website</a></li>-->
				<li class="v-sep"><a href="#" class="round button dark menu-user image-left">Logged in 
				<strong><?php echo" : ".$_SESSION['nombre']." ".$_SESSION['apellido']." "; ?></strong></a>
					<ul>
						<li><a href="#">My Profile</a></li>
						<li><a href="#">User Settings</a></li>
						<li><a href="#">Change Password</a></li>
						<li><a href="account.php">Account Summary</a></li>
						<li><a href="/backend/logout.php">Log out</a></li>
					</ul> 
				</li>
			
				<!--<li><a href="#" class="round button dark menu-email-special image-left">3 new messages</a></li> -->
				<li class="v-sep"><a href="/backend/logout.php" class="round button dark menu-logoff image-left">Log out</a></li>
				<li class="v-sep" class="fr"><h1 class="round button dark"><strong>STUDENT :<?php echo" ".$_SESSION['snombre']." ".$_SESSION['sapellido']." "; ?></strong></h1></li>				

			</ul> <!-- end nav -->

					
			<!--<form action="#" method="POST" id="search-form" class="fr">
				<fieldset>
					<input type="text" id="search-keyword" class="round button dark ic-search image-right" placeholder="Search..." />
					<input type="hidden" value="SUBMIT" />
				</fieldset>
			</form>-->

		</div> <!-- end full-width -->	
	
	</div> <!-- end top-bar -->
<!------------------------------------------------------- END TOP BAR -------------------------------------------------------->	
	
	<!--------- HEADER TABS -------->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
	
			<ul id="tabs" class="fl">
				<li><a href="overview.php">Overview</a></li>
				<li><a href="#">Your Calendar</a></li>
				<!--<li><a href="#">Virtual Class</a></li> -->
				<li><a href="profile.php" class="active-tab dashboard-tab">Student Profile</a></li>
				<li><a href="report.php">Training Report</a></li>
				<li><a href="support.php">Training Information & Resources</a></li>
			</ul> <!-- end tabs -->
			
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 30px height. -->
			<a href="#" id="company-branding" class="fr">
			<img src="/backend/images/logo2.png" alt="Fluent Speaking" /></a>	
			
		</div> <!-- end full-width -->	

	</div> 
	<!--------- END HEADER -------->	
	
	
	<!-- MAIN CONTENT -->
<?php
	// dbcon.................
		$conexion = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conexion){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("quantid0_fluent",$conexion); 
		$result = mysql_query("SELECT * FROM students", $conexion);

		while ($row = mysql_fetch_array($result)){

			if($row['id'] == $filter_student){

					$_SESSION['sid']=$row['id'];
					$_SESSION['snombre']=$row['nombre'];
					$_SESSION['sapellido']=$row['apellido'];
					$_SESSION['sbirth']=$row['birth'];
					$_SESSION['sgender']=$row['gender'];
					$_SESSION['shtown']=$row['htown'];
					$_SESSION['saddr']=$row['addr'];
					$_SESSION['snlang']=$row['nlang'];
					$_SESSION['scity']=$row['city'];
					$_SESSION['stzone']=$row['tzone'];
					$_SESSION['sawork']=$row['awork'];

					$_SESSION['stelefono']=$row['telefono'];
					$_SESSION['scelular']=$row['celular'];			
					$_SESSION['semail']=$row['email'];
					$_SESSION['sskype']=$row['skype'];
					$_SESSION['scountry']=$row['country'];
					$_SESSION['scode']=$row['code'];
					$_SESSION['susuario']=$row['usuario'];
					$_SESSION['spassword']=$row['password'];
					$_SESSION['na']="N/A";
					
			}else{}
		}

		//cerrar
			mysql_close($conexion);
	//}else{

	//echo '<meta http-equiv="REFRESH" content="0,url=../index.php">';

	
?>


	<div id="content">
		
		<div class="page-full-width cf">

			<div>
<!-- link to edit profile -->
			<a href="#" class="fl"><img src='../images/male.png' width='64' height=64' /><br />
		        <?php echo" ".$_SESSION['snombre']." ".$_SESSION['sapellido']." "; ?></a>

			</div> <!-- end side-menu -->
			
			<div class="side-content fr">

<!-- BASIC INFORMATION -->			
				<div class="half-size-column fl">
				
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
							<h3 class="fl">BASIC INFORMATION</h3>  <!--Headings &amp; Paragraphs-->
							<span class="fr expand-collapse-text">Click to collapse</span>
							<span class="fr expand-collapse-text initial-expand">Click to expand</span>
						
						</div> <!-- end content-module-heading -->
						
						
						<div class="content-module-main">

			<span>First Name:<?php echo" ".$_SESSION['snombre']." "; ?></span><br />
			<span>Last Name:<?php echo" ".$_SESSION['sapellido']." "; ?></span><br />
			<span>Birthday:<?php echo" ".$_SESSION['sbirth']." "; ?></span><br />		
			<span>Gender:<?php echo" ".$_SESSION['sgender']." "; ?></span><br />
			<span>HomeTown:<?php echo" ".$_SESSION['shtown']." "; ?></span><br />
			<span>Address:<?php echo" ".$_SESSION['saddr']." "; ?></span><br />
							
						</div> <!-- end content-module-main -->
					
					</div> <!-- end content-module -->
<!-- MEDIA SETTINGS -->

					<div class="content-module">
					
						<div class="content-module-heading cf">
						
							<h3 class="fl">MEDIA SETTINGS</h3>
							<span class="fr expand-collapse-text">Click to collapse</span>
							<span class="fr expand-collapse-text initial-expand">Click to expand</span>
						
						</div> <!-- end content-module-heading -->
						
						
						<div class="content-module-main cf">

			<span>Phone:<?php echo" ".$_SESSION['stelefono']." "; ?></span><br />
			<span>Mobile Phone:<?php echo" ".$_SESSION['scelular']." "; ?></span><br />
			<span>Skype:<?php echo" ".$_SESSION['sskype']." "; ?></span><br />
			<span>e-mail:<?php echo" ".$_SESSION['semail']." "; ?></span><br />
							
						</div> <!-- end content-module-main -->
						
					</div> <!-- end content-module -->
				
				</div> <!--end half-size-column-->


<!-- SETTINGS -->
				<div class="half-size-column fr">
				
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
							<h3 class="fl">SETTINGS</h3>
							<span class="fr expand-collapse-text">Click to collapse</span>
							<span class="fr expand-collapse-text initial-expand">Click to expand</span>
						
						</div> <!-- end content-module-heading -->
						
						
						<div class="content-module-main cf">
					
			<span>Native Language:<?php echo" ".$_SESSION['snlang']." "; ?></span><br />
			<span>Country:<?php echo" ".$_SESSION['scountry']." "; ?></span><br />
			<span>City:<?php echo" ".$_SESSION['scity']." "; ?></span><br />
			<span>Time Zone:<?php echo" ".$_SESSION['stzone']." "; ?></span><br />
			<span>Actual Work:<?php echo" ".$_SESSION['sawork']." "; ?></span><br />
							
						</div> <!-- end content-module-main -->
						
					</div> <!-- end content-module -->
<!-- LOGIN & PASSWORD -->
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
							<h3 class="fl">LOGIN & PASSWORD</h3>
							<span class="fr expand-collapse-text">Click to collapse</span>
							<span class="fr expand-collapse-text initial-expand">Click to expand</span>
						
						</div> <!-- end content-module-heading -->
						
						
						<div class="content-module-main cf">
					
			<span>User:<?php echo" ".$_SESSION['susuario']." "; ?></span><br /><br />
			<span>Password:<?php echo" ".$_SESSION['spassword']." "; ?></span><br /><br />		
							
						</div> <!-- end content-module-main -->
						
					</div> <!-- end content-module -->



				</div> <!--end half-size-column-->
	
			</div> <!-- end side-content -->
		
		</div> <!-- end full-width -->
<!--------------------------------------------- Booking Information ------------------------------------------------------->
		<div class="page-full-width cf">

			<div class="content-module">
			
				<div class="content-module-heading cf">
				
					<h3 class="fl">Booking Information</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				
				
				<div class="content-module-main">
<?php
	//Conexion
		$conex = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conex){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("quantid0_fluent",$conex); 

		$query = "select * from booking"; 
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)){
			if($filter_student == $row['idstudent']){
				echo"<tr><td></td>
				<td>Booking Date: ".$row['booking_date']."</td><br />
				<td>Language: ".$row['language']."</td><br />
				<td>Training Targets: ".$row['training_targets']."</td><br />
				<td>Language Level: ".$row['language_level']."</td><br />
				<td>Training Form / Events x Lenght: ".$row['form']." / ".$row['events']." x ".$row['length']."</td><br />
				<td>Cancellation Agreement: ".$row['cancellation_agreement']."</td><br />
				<td>Training Place: ".$row['place']."</td><br />
				<td>Deadline: ".$row['deadline']."</td><br />
				<td>Materials: ".$row['materials']."</td><br />
				<td>Event Coordination: ".$row['event_coordination']."</td>
				<td>Director of Studies/Quality Management: ".$row['director']."</td><br />
				</tr><br /><br />";
			}else{}
		}
	//cerrar
		mysql_close($conex);
?>
						<table>
						<thead>					
							<tr>

							</tr>
						</thead>

						<tfoot>
						 
						</tfoot>
						
						<tbody>

						</tbody>
						</table>
					
					<div class="stripe-separator"><!--  --></div>
					
					<p></p>
					
				</div> <!-- end content-module-main -->
			
			</div> <!-- end content-module -->
		
		</div> <!-- end full-width -->

<!-------------------------------------------- End Booking Information -------------------------------------------------->			
	</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<div id="footer">

		<p>Copyright 2012 <a href="http://www.languacom.de">&copy; LANGUACOM</a>. All rights reserved.</p>
		<!--<p><strong>TeacherPortal </strong> by &copy;<a href="http://www.fluentspeaking.com"> QUANTICA SOFT, LLC</a></p>-->
	
	</div> <!-- end footer -->

</body>
</html>
<!---------- end webPage ---------------->
<?php	

//	$_SESSION['adlogin'] = "no";
//	}else{

//	echo '<meta http-equiv="REFRESH" content="0,url=../index.php">';

//	}
?>
