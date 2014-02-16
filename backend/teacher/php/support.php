<?php session_start();?>
<?php
//echo" ".$_SESSION['usuario']." ".$_SESSION['password']." ";
	if(($_SESSION['adlogin'])=="si"){

	//Crear variables
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$teacherid = $_SESSION['teacherid'];
	$filter_student = $_SESSION['filterStudent'];
	$actual_month = $_SESSION['mes'];
	$actual_year = $_SESSION['ano'];

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
				
		</div> <!-- end full-width -->	
	
	</div> 
<!------------------------------------------------------- END TOP BAR --------------------------------------------------->	
	
	<!--------- HEADER TABS -------->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
	
			<ul id="tabs" class="fl">
				<li><a href="overview.php" >Overview</a></li>
				<li><a href="#" >Your Calendar</a></li>
				<!--<li><a href="#">Virtual Class</a></li> -->	
				<li><a href="profile.php">Student Profile</a></li>
				<li><a href="report.php">Training Report</a></li>
				<li><a href="support.php" class="active-tab dashboard-tab">Training Information & Resources</a></li>
			</ul> <!-- end tabs -->
			
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 30px height. -->
			<a href="#" id="company-branding" class="fr">
			<img src="/backend/images/logo2.png" alt="Fluent Speaking" /></a>
			
		</div> <!-- end full-width -->	

	</div> 
	<!--------- END HEADER -------->
	
	


	<div id="content"> <!--1->
<br />
<br />

<!------------------------------------------------------------------------------------------------------------------>
<!----------------------------------------------------------------------------------------- training modules ------->		

		<div class="page-full-width cf">

			<div class="content-module">
				<div class="content-module-heading cf">
				
					<h3 class="fl">Training Program – LANGUACOM® Training Modules</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				
				
				<div class="content-module-main">
<!-- empieza contenido -->
					<table>

<?php		if($_SESSION['filterStudent'] == 0){

		}else{
		
			// dbcon.................
			$conexion = mysql_connect("localhost","quantid0_marco","~marco");
			if(!$conexion){
			die ("No he podido conectar por la siguiente razon: ".mysql_error());
			}	
			mysql_select_db("quantid0_fluent",$conexion); 
			$result = mysql_query("SELECT * FROM units_asigned", $conexion);
?>
<center>
	<table border=0 width=10%>
		<tr>
<?php			
			while ($row = mysql_fetch_array($result)){

				if($row['idstudent'] == $filter_student){
					//leo id de la unidad
					$unidad = $row['idunit'];
					//busco y leo el codigo de la unidad
					$ans = mysql_query("SELECT * FROM units", $conexion);
					while ($fila = mysql_fetch_array($ans)){
						if($unidad == $fila['id']){
							
							$id1 = $fila['id'];
							$unid1 = $fila['unit'];
							$des1 = $fila['description'];
							$unitpdf = $fila['file'];
							$unit2show = "/backend/units/$unitpdf";
	
?>
		<td id="pdfsquare">
		<img src='../images/pdf1.jpg' alt='edit' width='48' height=48'>
		<a href<?php echo"= '#?id1=".$unit2show."'";?>><?php echo" ".$unid1." "; ?></a>
<!----------------------------------------------------------------------------------------- show the module -------->
<a href = "javascript:void(0)" onclick = "document.getElementById('light2')
.style.display='block';document.getElementById('fade').style.display='block'">
</a>

	<div id="light2" class="white_content2">
		
			<iframe src<?php echo"=$unit2show";?> style="border:1px #FFFFFF dotted;" 
			width = 1050px height = 480px frameborder="0" marginheight="0px" marginwidth="0px"
			scrolling="no"></iframe>

	<a href = "javascript:void(0)" onclick = "document.getElementById('light2')
	.style.display='none';document.getElementById('fade').style.display='none'">Close</a>
	</div>

<div id="fade" class="black_overlay2"></div>
<!----------------------------------------------------------------------------------------- end show the module ---->
		</td>
<?php
						}else{}
					}
				}else{}
			}
?>
		</tr>
	</table>
</center>
<?php	
			//cerrar
			mysql_close($conexion);
		}
?>
					</table>
<!-- termina contenido -->					
					<div class="stripe-separator"><!--  --></div>
					<p></p>
					
				</div> <!-- end content-module-main -->
			
			</div> <!-- end content-module -->
		
		</div> <!-- end full-width -->

<!------------------------------------------------------------------------------------- end training modules ------->
<!-------------------------------------------------------------------------------------------- 0 information ------->		
<?php 
//		<div class="page-full-width cf">
//
//			<div class="content-module">
//				<div class="content-module-heading cf">
//				
//					<h3 class="fl">GENERAL INFORMATION</h3>
//					<span class="fr expand-collapse-text">Click to collapse</span>
//					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
//				
//				</div> <!-- end content-module-heading -->
//				
//				
//				<div class="content-module-main">
//<!--  -->
//<!--  -->					
//					<div class="stripe-separator"><!--  --></div>
//					<p></p>
					
//				</div> <!-- end content-module-main -->
			
//			</div> <!-- end content-module -->
		
//		</div> <!-- end full-width -->
?>
<!------------------------------------------------------------------------------------------ end infromation ------->
<!------------------------------------------------------------------------------------------------------------------>

<br />
<!------------------------------------------------------------------------------------------------------------------>
<!--------------------------------------------------------------------------------------------- 6 vocabulary ------->		
<?php
//		<div class="page-full-width cf">

//			<div class="content-module">
//				<div class="content-module-heading cf">
//				
//					<h3 class="fl">ESSENTIAL VOCABULARY</h3>
//					<span class="fr expand-collapse-text">Click to collapse</span>
//					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
//				
//				</div> <!-- end content-module-heading -->
//				
//				
//				<div class="content-module-main">
//
//					
//					<div class="stripe-separator"><!--  --></div>					
//
//					<p></p>
//					
//				</div> <!-- end content-module-main -->
//			
//			</div> <!-- end content-module -->
//		
//		</div> <!-- end full-width -->
?>
<!------------------------------------------------------------------------------------------- end vocabulary ------->
<!------------------------------------------------------------------------------------------------------------------>
			
	</div> <!--1->

<!----------------------------------------------------------------------------------------- end event list ------->	
<!---------------------------------------------------------------------------------------------------------------->	
<!------------------------------------------------------------------------------------------------------ FOOTER -->	
<!-- FOOTER -->
	<div id="footer">

		<p>Copyright 2012 <a href="http://www.languacom.de">&copy; LANGUACOM</a>. All rights reserved.</p>
		<!--<p><strong>TeacherPortal </strong> by &copy;<a href="http://www.fluentspeaking.com"> QUANTICA SOFT, LLC</a></p>-->
	
	</div>
<!-------------------------------------------------------------------------------------------------- end footer -->
</body>
</html>
<!---------- end webPage ---------------->


<?php
//		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=students.php">';

//	$_SESSION['adlogin'] = "no";
	}else{

	echo '<meta http-equiv="REFRESH" content="0,url=../formlogin.html">';

	}
?>
