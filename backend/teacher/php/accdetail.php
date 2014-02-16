<?php 
	session_start();

//echo" ".$_SESSION['usuario']." ".$_SESSION['password']." ";
	//if(($_SESSION['adlogin'])=="si"){

	//Recupero variables
	$month_id = $_GET['monthid'];	

	//Crear variables
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$teacherid = $_SESSION['teacherid'];
	$filter_student = $_SESSION['filterStudent'];
	$ano_actual = $_SESSION['ano'];
	$_SESSION['mes'] = $month_id;
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
			
				<li><a href="#" class="round button dark menu-email-special image-left">3 new messages</a></li>
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
				<li><a href="calendar.php" >Calendar</a></li>
				<li><a href="virtualclass.php">Virtual Class</a></li>
				<li><a href="profile.php">Student Profile</a></li>
				<li><a href="report.php">Training Report</a></li>
				<li><a href="support.php">Resources</a></li>
			</ul> <!-- end tabs -->
			
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 30px height. -->
			<a href="#" id="company-branding" class="fr">
			<img src="/backend/images/logo2.png" alt="Fluent Speaking" /></a>
			
		</div> <!-- end full-width -->	

	</div> 
	<!--------- END HEADER -------->
	
	
	
<!--------------------- MAIN CONTENT ---------------------->

<!-- lee el mes actual, y lo pone por defecto -->
<?php
	//$fecha_actual = date("d/m/Y");
	//$str = '4/11/2012';
	$str_hoy = date("d/m/Y");
	$fecha_hoy = (explode('/', $str_hoy, 3));
	//valido dia
	$dia_hoy = $fecha_hoy[0];
	$mes_hoy = $fecha_hoy[1];
	$ano_hoy = $fecha_hoy[2];
	//inicia variables
	$ccl_total = 0;
	$cot_total = 0;
	$schedule_total = 0;
	$completed_total = 0;
	$hrs_total = 0;
	$total_events = 0;
	$con = mysql_connect("localhost","quantid0_marco","~marco");
	if (!$con)  {
		    die('Could not connect: ' . mysql_error());
	}

	mysql_select_db("quantid0_fluent",$con); 
	$result = mysql_query("SELECT * FROM events", $con);//$teacherid
	$event = mysql_fetch_array($result);							
	//add CCL, COT, SCHEDULE, COMPLETED & Hrs
	do{
		if($event['idteacher'] == $teacherid){
			$total_events++;
			switch ($event['idstatus']) {
		   case "CCL":
				 $ccl_total++;
				 $hrs_total = $hrs_total + $event['hrs'];
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
				 $hrs_total = $hrs_total + $event['hrs'];
				 break;
			}
				//$hrs_total = $hrs_total + $event['hrs'];
		}else{}	
	}while($event = mysql_fetch_array($result));

	//close db
	mysql_close($con);?>				
<!---------------------------------------------------------------------------------------------------------------->	
<!----------------------------------------------------------------------------------------------- report detail -->			
							
	<div id="content">
		<div class="page-full-width cf">

			<div class="content-module">
			
				<div class="content-module-heading cf">
				
					<h3 class="fl">TRAINER ACCOUNT -<?php echo" ".$month_id."/".$ano_actual." ";?>EVENT's DETAIL</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!-- end content-module-heading -->
				

<!------------------------------------------------------------------------------------------------- linea de control -->

<div align="center">	
	<tr>
	<td></td><td> <a href="creapdf.php">send to coordinator</a></td>
	<td>|</td><td><a href="account.php"><img src="../images/backward.png" width="14" height="14" align="center"></a></td>	
	</tr>
	
</div>

<!--------------------------------------------------------------------------------------------- end linea de control -->

					
<!--------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------------------------------------------------------------------- crea pdf -->
<?php
require('fpdf.php');

$pdf = new FPDF('P', 'mm', 'Letter' );
//$pdf->AddPage();

//$pdf->SetFont('courier','',12);
//$pdf->Cell(10,10,'Name: ', 0,0,'L');
//$pdf->SetX(90);
//$pdf->Cell(90,10,'DETAIL OF PAYMENT FOR SERVICES PROVIDED', 1,0,'C');
//$pdf->ln(10);
//$pdf->Cell(10,10,'TRAINER', 0,0,'L');
//$pdf->ln(11);
//$pdf->Cell(10,10,'PERIOD:', 0,0,'L');

$pdf->Output();

?>
<!----------------------------------------------------------------------------------------------------- end crea pdf -->
<!--------------------------------------------------------------------------------------------------------------------->


				<div class="content-module-main">
					<table>
					
						<thead>
					
							<tr>
								<!--<th><input type="checkbox" id="table-select-all"></th>-->
								<th>EVENT DATE</th>
								<th>STUDENT's NAME</th>
								<th>COMPANY</th>
								<th>MIN</th>
								<th>STATUS</th>

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
		$result = mysql_query("SELECT * FROM events order by event_date", $conexion);
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

		   if($row['idteacher'] == $teacherid AND $month_id == $mes_db){	

			$date= $row['event_date'];
					$result1 = mysql_query("SELECT * FROM students", $conexion);
					$who = mysql_fetch_array($result1);		
						do{
							if($row['idstudent']== $who['id']){
								$student = " ".$who['nombre']." ".$who['apellido']." ";
								$company = $who['awork'];
							}else{}
			   			}while($who = mysql_fetch_array($result1));

			$min = $row['hrs'];
			$stat = $row['idstatus'];

			echo"<tr><td>".$date."</td><td>".$student."</td><td>".$company."</td><td>".$min."</td>
			<td>".$stat."</td></tr>";		
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
	
		
<!------------------------------------------------------------------------------------------- end report detail -->
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
