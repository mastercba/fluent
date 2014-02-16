<?php 
	session_start();

//echo" ".$_SESSION['usuario']." ".$_SESSION['password']." ";
	//if(($_SESSION['adlogin'])=="si"){

	//Crear variables
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$teacherid = $_SESSION['teacherid'];
	$filter_student = $_SESSION['filterStudent'];
/////////////////////////////////////////////////////////////////////////////////////////////////////
	if($filter_student == 0){
					$_SESSION['snombre']="";
					$_SESSION['sapellido']="";		
	}else{
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
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////

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
						<li><a href="account.php">Account Management</a></li>
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
	
	</div> 
<!------------------------------------------------------- END TOP BAR -------------------------------------------------------->	
	
	<!--------- HEADER TABS -------->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
	
			<ul id="tabs" class="fl">
				<li><a href="overview.php">Overview</a></li>
				<li><a href="#" >Your Calendar</a></li>
				<!--<li><a href="#">Virtual Class</a></li> -->
				<li><a href="profile.php">Student Profile</a></li>
				<li><a href="report.php" class="active-tab dashboard-tab">Training Report</a></li>
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
	<div id="content">
		
		<div class="page-full-width cf">

		<!-- link to edit profile -->
			<h1>
			<div class="fl">
			<?php echo"<tr><td>LANGUACOM® Training Code: ".$_SESSION['scode']."</td><br />
			<td>TRAINING REPORT</td><br />
			</tr><br />";?>	
			</div> <!-- end side-menu -->
			</h1>
			<br />
			<div class="side-content fr">
<!------------------------------------------------------------------------------------------------------------------>
<!---------------------------------------------------------------------------------------------- PARTICIPANT ------->			
	<div class="half-size-column fl">
				
		<div class="content-module">
					
			<div class="content-module-heading cf">
				<h3 class="fl">PARTICIPANT:</h3>
				<span class="fr expand-collapse-text">Click to collapse</span>
				<span class="fr expand-collapse-text initial-expand">Click to expand</span>
			</div> <!-- end content-module-heading -->
						
						
			<div class="content-module-main">
				<h2>
				<?php
									
					if($_SESSION['filterStudent'] == 0){


					}else{

						//conect
					?>
					<?php echo" ".$_SESSION['snombre']." ".$_SESSION['sapellido']." ";?><br />
					<?php echo" Position: ".$_SESSION['sposition']." ";?><br />
					<?php echo" Company: ".$_SESSION['sawork']." ";?><br />
					<?php echo" Address: ".$_SESSION['saddr']." ";?><br />
					<?php echo" Tel.: ".$_SESSION['stelefono']." ";?><br />	
					<?php echo" E-Mail: ".$_SESSION['semail']." ";?><br />
					<?php echo" Skype: ".$_SESSION['sskype']." ";?><br />

				<?php
					}
						//close db?>

				</h2>							
			</div> <!-- end content-module-main -->
					
		</div> <!-- end content-module -->
				
	</div> <!--end half-size-column-->
		

<!------------------------------------------------------------------------------------------ END PARTICIPANT ------->
<!------------------------------------------------------------------------------------------------------------------>


<!------------------------------------------------------------------------------------------------------------------>
<!-------------------------------------------------------------------------------------------------- TRAINER ------->
				<div class="half-size-column fr">
				
					<div class="content-module">
					
						<div class="content-module-heading cf">
						
							<h3 class="fl">TRAINER:</h3>
							<span class="fr expand-collapse-text">Click to collapse</span>
							<span class="fr expand-collapse-text initial-expand">Click to expand</span>
						
						</div> <!-- end content-module-heading -->
						
						
						<div class="content-module-main cf">
<?php
	// dbcon.................
		$conexion = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conexion){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("quantid0_fluent",$conexion); 
		$result = mysql_query("SELECT * FROM trainers", $conexion);

		while ($row = mysql_fetch_array($result)){

			if($row['id'] == $teacherid){

					//$_SESSION['sid']=$row['id'];
					$name=$row['nombre'];
					$olp=$row['olp'];
					$email=$row['email'];
					$skype=$row['skype'];
					//$telefono=$row['telefono'];
					
			}else{}
		}

		//cerrar
			mysql_close($conexion);
?>
							<h2>
							<div class="half-size-column fl">
								<?php echo" ".$_SESSION['nombre']." ".$_SESSION['apellido']." ";?><br />
								<?php echo" Online - Profile: ".$olp." ";?><br />
								<?php echo" E-Mail: ".$email." ";?><br />
								<?php echo" Skype: ".$skype." ";?><br />					
							</div>
							</h2>
							<div class="half-size-column fr">
								
							
							</div>
							
						</div> <!-- end content-module-main -->
						
					</div> <!-- end content-module -->

				</div> <!--end half-size-column-->
				<!-- END FILTROS -->
	
			</div> <!-- end side-content -->
		
		</div> <!-- end full-width -->


<!---------------------------------------------------------------------------------------------- END TRAINER ------->
<!------------------------------------------------------------------------------------------------------------------>


<!------------------------------------------------------------------------------------------------------------------>
<!----------------------------------------------------------------------- Student SUMMARY -------------------------->
		<div class="page-full-width cf">

			<div class="content-module">
			
				<div class="content-module-heading cf">
				
					<h3 class="fl">Student Summary</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				
				
				<div class="content-module-main">

<?php

	//Crear variables	
		$usuario = $_SESSION['usuario'];
		$password = $_SESSION['password'];
		$teacherid = $_SESSION['teacherid'];		//teacher logged id , ej 2,3....

		if($_SESSION['filterStudent'] == 0){
?>					
					<table>
						<thead>
							<tr>
								<!--<th><input type="checkbox" id="table-select-all"></th>-->
								<th>#</th>
								<th>TRAINER</th>
								<th>EVENT</th>
								<th>LENGTH min.</th>
								<th>STATUS</th>
								<th>ADD</th>
								<th>USED/CCL/Available</th>
								<th>Training Agenda/Comments</th>
								<th>After Work Study</th>	
							</tr>
						</thead>

						<!--<tfoot>
						 
						</tfoot>-->
						
						<tbody>
			
<?php
		}else{
?>			
					<table>	
						<thead>
							<tr align=center>
								<!--<th><input type="checkbox" id="table-select-all"></th>-->
								<th>EVENT date/time</th>
								<th>TRAINER</th>
								<th>LENGTH</th>
								<th>STATUS</th>
								<th>CREDIT(min.)</th>
								<th>USED | CCL | AVAILABLE</th>
								<th>TRAINING AGENDA/COMMENTS</th>
								<th>AFTER WORK STUDY</th>
							</tr>
						</thead>

						<tfoot>
							<!--<tr>
							
								<td colspan="5" class="table-footer">
								
									<label for="table-select-actions">With selected:</label>

									<select id="table-select-actions">
										<option value="option1">Delete</option>
										<option value="option2">Export</option>
										<option value="option3">Archive</option>
									</select>
									
									<a href="#" class="round button blue text-upper small-button">Apply to selected</a>	

								</td>
								
							</tr>-->
						</tfoot>
						
						<tbody>
<?php

	//	
	$add = 0;
	$ccl = 0;
	$used = 0;
	$ava = 0;
	//conexion
		$conexion = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conexion){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("quantid0_fluent",$conexion); 

	//credit
		$query5 = "select * from credit_summary"; 
		$result5 = mysql_query($query5);
			while($row5 = mysql_fetch_array($result5)){
				if($filter_student == $row5['idstudent']){
					$date = $row5['date'];
					$tname = "-";
					$tapellido = "-";
					$length = "-";
					$status = "-";
					$add = $row5['credit'];
					$used = "-"; $ccl = "-"; $ava = $ava + $row5['credit']; 
					$comm = "-";
					$w_study = "-";

		echo"<tr align=center><td>".$date."</td><td>".$tname."  ".$tapellido."</td>
		<td>".$length."</td><td>".$status."</td><td>".$add."</td>
		<td>".$used." | ".$ccl." | ".$ava."</td><td>".$comm."</td><td>".$w_study."</td></tr>";
					
				}else{}
			}

	//events
		$result = mysql_query("SELECT * FROM events order by event_date", $conexion);
		$event = mysql_fetch_array($result);		
		do{
		   if($event['idstudent'] == $filter_student){
				$teacher= $event['idteacher'];

				//teacher name
				$query4 = "select * from trainers"; 
				$result4 = mysql_query($query4);
				while($row4 = mysql_fetch_array($result4)){
					if($teacher == $row4['id']){
						$tname = $row4['nombre'];
						$tapellido = $row4['apellido'];
						break;	
					}else{}
				}

					$date = $event['event_date'];
					$time = $event['event_time'];
					$tname = $row4['nombre'];
					$tapellido = $row4['apellido'];
					$length = $event['hrs'];
					$status = $event['idstatus'];

			switch ($status) {
			   case "CCL":
				$ava = $ava-$length;
				$used = "-";
				$ccl = $length;
				$comm = "-";
				$w_study = "-";
				 break;
			   case "COT":
				$used = "-";
				$ccl = "-";
				$comm = "-";				
				$w_study = "-";
				 break;
			   case "SCHEDULE":
				$ava = $ava-$length;
				$used = $length;
				$ccl = "-";
				$comm = "-";
				$w_study = "-";
				 break;
			   case "DONE":
				$ava = $ava-$length;
				$used = $length;
				$ccl = "-";

				//leo de la db comm y w_study
				$query9 = "select * from trainer_report order by date"; 
				$result9 = mysql_query($query9);
				while($row9 = mysql_fetch_array($result9)){
					if($filter_student == $row9['idstudent'] AND $date == $row9['date']){
						$comm = $row9['comments'];
						$w_study = $row9['w_study'];
						break;	
					}else{
						//no tiene reporte!
						$comm = "-";
						$w_study = "-";
					}
				}

				//$query9 = "select * from trainer_report order by date"; 
				//$result9 = mysql_query($query9);
				//while($row9 = mysql_fetch_array($result9)){
				//	if($filter_student == $row9['idstudent'] AND $date == $row9['date']){
				//		$comm = $row9['comments'];
				//		$w_study = $row9['w_study'];
				//		break;	
				//	}else{}
				//}
				 break;
			}

					$add = "-";
					  

		echo"<tr align=center><td>".$date." | ".$time."</td><td>".$tname."  ".$tapellido."</td>
		<td>".$length."</td><td>".$status."</td><td>".$add."</td>
		<td>".$used." | ".$ccl." | ".$ava."</td><td align=left>".$comm."</td><td align=left>".$w_study."</td></tr>";
	
		   }
		}while($event = mysql_fetch_array($result));

		   
	//cerrar db
		mysql_close($conexion);
		}
?>

					
						</tbody>
						
					</table>
					
					<div class="stripe-separator"><!--  --></div>
					
					<p>COT (Cancelled On Time) - CCL(Client Cancelled Late).</p>
					
				</div> <!-- end content-module-main -->
			
			</div> <!-- end content-module -->
		
		</div> <!-- end full-width -->

<!--------------------------------------------------------------------- End Student SUMMARY ---------------------->
<!---------------------------------------------------------------------------------------------------------------->

<!---------------------------------------------------------------------------------------------------------------->	
<!------------------------------------------------------------------------------------------------------ FOOTER -->
	<div id="footer">

		<p>Copyright 2012 <a href="http://www.languacom.de">&copy; LANGUACOM</a>. All rights reserved.</p>
		<!--<p><strong>TeacherPortal </strong> by &copy;<a href="http://www.fluentspeaking.com"> QUANTICA SOFT, LLC</a></p>-->
	
	</div> 
<!-------------------------------------------------------------------------------------------------- end footer -->
</body>
</html>
<!---------- end webPage ---------------->
<?php	

//	$_SESSION['adlogin'] = "no";
//	}else{

//	echo '<meta http-equiv="REFRESH" content="0,url=../index.php">';

//	}
?>
