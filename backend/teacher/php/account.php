<?php 
	session_start();

//echo" ".$_SESSION['usuario']." ".$_SESSION['password']." ";
	//if(($_SESSION['adlogin'])=="si"){

	//Crear variables
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$teacherid = $_SESSION['teacherid'];
	$filter_student = $_SESSION['filterStudent'];
	$actual_month = $_SESSION['mes'];	//11;//$_SESSION['mes'];
	$actual_year = $_SESSION['ano'];	//2012;//$_SESSION['ano'];

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
		<!--<strong><?php echo" ".$_SESSION['title']." : ".$_SESSION['nombre']." ".$_SESSION['apellido']." "; ?></strong>-->
					<ul>
						<li><a href="#">My Profile</a></li>
						<li><a href="#">User Settings</a></li>
						<li><a href="#">Change Password</a></li>
						<li><a href="#">Account Summary</a></li>
						<li><a href="/backend/logout.php">Log out</a></li>
					</ul> 
				</li>
			
				<!--<li><a href="#" class="round button dark menu-email-special image-left">3 new messages</a></li>-->
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
				<li><a href="overview.php" >Overview</a></li>
				<li><a href="calendar.php" >Your Calendar</a></li>
				<!--<li><a href="#">Virtual Class</a></li>-->
				<li><a href="profile.php">Student Profile</a></li>
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
	
	
	
<!--------------------- MAIN CONTENT ---------------------->

<!------------------------ UPDATE db ----------------------->
<?php
	//inicia variables
	$ccl_total = 0;
	$cot_total = 0;
	$schedule_total = 0;
	$completed_total = 0;
	$hrs_total = 0;
	$total = 0;
	$flag = 0;
	//
	//conexion
		$conexion = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conexion){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("quantid0_fluent",$conexion); 
		$result1 = mysql_query("SELECT * FROM teacher_account", $conexion);
		$row1 = mysql_fetch_array($result1);
	//crea nuevo registro en la tabla
		do{
			if($row1['idteacher'] == $teacherid AND $actual_month == $row1['month'] AND $actual_year == $row1['year']){			
				$flag = 1;
			}else{}
		}while($row1 = mysql_fetch_array($result1));
	//inicia el nuevo mes.....
		if($flag == 0){
			mysql_select_db("quantid0_fluent",$conexion); 
			$vuelta = mysql_query(("INSERT INTO teacher_account (idteacher, month, year, min, total_event, done, schedule, ccl, cot, status)
		 	VALUES('$teacherid','$actual_month','$actual_year','$hrs_total','$total','$completed_total','$schedule_total','$ccl_total','$cot_total','UNPAID')"), $conexion);
		}else{}

	//muestra el detalle del mes
		$result = mysql_query("SELECT * FROM events", $conexion);
		$row = mysql_fetch_array($result);		

		do{
			//tranforma la fecha del evento de la db para ver el mes
			$str_db = $row['event_date'];                //'2012/11/4';   //$row['event_date'];
			$str = date("d-m-Y",strtotime($str_db));
			$fecha_db = (explode('-', $str, 3));
			//valido dia
			$dia_db = $fecha_db[0];
			$mes_db = $fecha_db[1];
			$ano_db = $fecha_db[2];

		   if($row['idteacher'] == $teacherid AND $actual_month == $mes_db AND $actual_year == $ano_db){	
				$total++;
				switch ($row['idstatus']) {
			   case "CCL":
					 $ccl_total++;
					 $hrs_total = $hrs_total + $row['hrs'];
					 break;
			   case "COT":
					 $cot_total++;
					 //$hrs_total = $hrs_total + $event['hrs'];
					 break;
			   case "SCHEDULE":
					 $schedule_total++;
					 //$hrs_total = $hrs_total + $event['hrs'];
					 break;
			   case "DONE":
					 $completed_total++;
					 $hrs_total = $hrs_total + $row['hrs'];
					 break;
				}		
		   }else{}
		}while($row = mysql_fetch_array($result));

	//graba en la tabla teacher_account
	
		mysql_select_db("quantid0_fluent",$conexion); 

		mysql_query("UPDATE teacher_account SET min='".$hrs_total."', total_event='".$total."', 
		done='".$completed_total."', schedule='".$schedule_total."', ccl='".$ccl_total."', cot='".$cot_total."'
		WHERE (idteacher=".$teacherid." AND month=".$actual_month.")");
	//cerrar		   
			mysql_close($conexion);
?>
<!---------------------- end update db --------------------->
										

<!---------------------------------------------------------------------------------------------------------------->	
<!----------------------------------------------------------------------------------------------------- summary -->	


	<div id="content">
		<div class="page-full-width cf">

			<div class="content-module">
			
				<div class="content-module-heading cf">
				
					<h3 class="fl">TRAINER ACCOUNT SUMMARY</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				
				<div class="content-module-main">
					<table>
						<thead>
							<tr>
								<th>MONTH/YEAR</th>
								<th>TOTAL MIN.</th>
								<th>TOTAL EVENTS</th>
								<th>DONE</th>
								<th>SCHEDULE</th>
								<th>COT</th>
								<th>CCL</th>
								<th>STATUS</th>
								<th>ACTIONS</th>
							</tr>
						</thead>
						<tbody>
<?php
	//
	//conexion
		$conexion = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conexion){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("quantid0_fluent",$conexion); 
	//muestra el detalle del mes
		$result = mysql_query("SELECT * FROM teacher_account", $conexion);
		$row = mysql_fetch_array($result);		

		do{
		   if($row['idteacher'] == $teacherid){	

			$month = $row['month'];
			$year = $row['year'];

	//prepara la variable $mesyano = $month & $year para enviar por GET
	$mesyano = $month." ".$year;

			$totalmin = $row['min'];
			$total = $row['total_event'];
			$done = $row['done'];
			$schedule = $row['schedule'];
			$cot = $row['cot'];
			$ccl = $row['ccl'];
			$stat = $row['status'];
			//pregunta si status es PAID o UNPAID
			if($stat == "PAID"){
				echo"<tr><td>".$month."/".$year."</td><td>".$totalmin."</td><td>".$total."</td>
				<td>".$done."</td><td>".$schedule."</td><td>".$cot."</td><td>".$ccl."</td>
				<td>".$stat."</td>
				<td>
				
				<a href='#'><img src='../images/sign_sussess.gif' width='14' height=14'></a>
				|<a href='creapdf.php?monthid=".$mesyano."'target='_blank' rel='nofollow'>
				<img src='../images/pdf.png' alt='edit' width='14' height=14'></a></td></tr>";			
			}else{
				echo"<tr><td>".$month."/".$year."</td><td>".$totalmin."</td><td>".$total."</td>
				<td>".$done."</td><td>".$schedule."</td><td>".$cot."</td><td>".$ccl."</td>
				<td>".$stat."</td>
				<td>
				
				<a href='#'><img src='../images/sign_sussess.gif' width='14' height=14'></a>
				|<a href='creapdf.php?mesyano=".$mesyano."' target='_blank' rel='nofollow'>
				<img src='../images/pdf.png' alt='edit' width='14' height=14'></a></td></tr>";
			}

		   }else{}
		}while($row = mysql_fetch_array($result));
	
	//cerrar		   
			mysql_close($conexion);
?>								
						</tbody>
						
					</table>
					
					<div class="stripe-separator"><!--  --></div>
					
					<p></p>
					
				</div> <!-- end content-module-main -->
			
			</div> <!-- end content-module -->
		
		</div> <!-- end full-width -->
		

			
	</div> <!-- end content -->
	
<!------------------------------------------------------------------------------------------------- end summary -->
<!---------------------------------------------------------------------------------------------------------------->		
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

//	$_SESSION['adlogin'] = "no";
//	}else{

//	echo '<meta http-equiv="REFRESH" content="0,url=../index.php">';

//	}
?>
