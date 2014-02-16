<?php 
	session_start();

//echo" ".$_SESSION['usuario']." ".$_SESSION['password']." ";
	//if(($_SESSION['adlogin'])=="si"){

	//Recupero variables
	$event_id1 = $_GET['eventid'];
	$_SESSION['evntid'] = $event_id1;

//Crear variables
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$teacherid = $_SESSION['teacherid'];
	$filter_student = $_SESSION['filterStudent'];
	$actual_month = $_SESSION['mes'];
	$actual_year = $_SESSION['ano'];

//asigna el filterstudent, para all o para el student asignado
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

					$_SESSION['snombre']=$row['nombre'];
					$_SESSION['sapellido']=$row['apellido'];
					
			}else{}
		}	
		//cerrar
		mysql_close($conexion);
	}

?>
<!---------------------------------------- start webPage ------------------------------------->
<!DOCTYPE HTML>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>LANGUACOM - Trainer Portal</title>
	
	<!- Stylesheets -->
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
						<li><a href="account.php">Account Summary</a></li>
						<li><a href="/backend/logout.php">Log out</a></li>
					</ul> 
				</li>
			
				<!--<li><a href="#" class="round button dark menu-email-special image-left">3 new messages</a></li>-->
				<li class="v-sep"><a href="/backend/logout.php" class="round button dark menu-logoff image-left">Log out</a></li>
				<li class="v-sep" class="fr"><h1 class="round button dark"><strong>STUDENT :<?php echo" ".$_SESSION['snombre']." ".$_SESSION['sapellido']." "; ?></strong></h1></li>

			</ul> <!-- end nav -->
<?php if($_SESSION['filterStudent'] == 0){ }else{?>

<!------------------------------------------------------------------------------------------ ADD a NEW Event! ------->
			
			<fieldset>
			<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"
			class="round button dark menu-add32 image-left" />ADD a NEW Event!</a>
			</fieldset>
<form action='savenew.php' method = 'POST'>
				<div id="light" class="white_content">
				<h10>
				<span>CREATE A NEW EVENT</span><br /></h10>
								
				<hr><div class="hr">
				</div></hr>
			<h1>
			<td></td>
			<th></th><br />
			<span>TEACHER:<?php echo" ".$_SESSION['nombre']." ".$_SESSION['apellido']." "; ?></span><br /><br />
			<td></td>
			<th></th>
			<span>STUDENT:<?php echo" ".$_SESSION['snombre']." ".$_SESSION['sapellido']." "; ?></span><br /><br />

			<span>DATE: </span>			
			<th><input type='date' name='eevent_date' value=''></th>
			<th></th>
			<span>TIME: </span>
			<th><input type='time' name='eevent_time' value=''></th>
			<th></th>			
			<br /><br />
			<span>LENGTH: </span>
			<th><input type='number' name='ehrs' min='15' max='90' step='15' value='30'></th>
			<th></th>
			<!- <br /><br /> -->
			<span>MEDIA: </span>
			<th><select name=eidmedia>
				<option>select</option>
    				<option>SKYPE</option>
    				<option>PHONE</option>
    				<option>nPHONE</option>
    			    </select></th>
			<span> STATUS: </span>
			<th><select name=eidstatus>
				<option>select</option>
    				<option>SCHEDULE</option>
    				<option>DONE</option>
    				<option>CCL</option>
    				<option>COT</option>
    			    </select></th>
			<td></td>
			<th></th>
			<br /><br />
			<span>UNIT: </span>
						<?php
						$con = mysql_connect("localhost","quantid0_marco","~marco");
						if (!$con)  {
						    die('Could not connect: ' . mysql_error());
						}
						mysql_select_db("quantid0_fluent",$con);
						$query = "select * from units_asigned where idstudent = $filter_student AND status_unit = 0 order by id";//order by numero
						$result = mysql_query($query);
		
						//declare the combo box
						$rows = array();
						$idx = 0;?>
						<select name="select_unit">
										
						<?php
						//list all of the other elements
						while ($row = mysql_fetch_array($result)){
							//if($_SESSION['filterStudent'] == $row['idstudent'] AND $row['status_unit'] == 0){ 
						      $rows[$idx++] = array('value' => $row['idunit'], 'text' => $row['idstudent']);?>
							<?php 
							$rest = mysql_query("SELECT * FROM units", $con);
							$filita = mysql_fetch_array($rest);		
							do{
								if($row['idunit']== $filita['id']){
									$unidad = $filita['unit'];
									$descri = $filita['description'];
								}else{}
				   			}while($filita = mysql_fetch_array($rest));

							?>
						<option value<?php echo"= ".$row['idunit']." ";?>><?php echo" ".$unidad." ".$descri." ";?></option>
						<?php
							//}else{}
						}
						//close the combo box
						echo "</select>";
						//close db
						mysql_close($con);
						?>

			<br /><br /><br /></h1>
			<center><th>
				<a href = "javascript:void(0)" onclick = "document.getElementById('light')
				.style.display='none';document.getElementById('fade').style.display='none'"
				class="button round blue" />CLOSE</a> 

				<span> | </span>
				<input href = "javascript:void(0)" onclick = "document.getElementById('light')
				.style.display='none';document.getElementById('fade').style.display='none'" 
				type="submit" value="ADD" class="button round blue" />
			</th></center>
				</div>
		
			<div id="fade" class="black_overlay"></div>
</form>	

<!--------------------------------------------------------------------------------- END..... ADD a NEW Event! ------->					
<?php } ?> 
		</div> <!-- end full-width -->	
	
	</div> 
<!------------------------------------------------------- END TOP BAR -------------------------------------------------------->	
	
	<!--------- HEADER TABS -------->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
	
			<ul id="tabs" class="fl">
				<li><a href="overview.php" class="active-tab dashboard-tab">Overview</a></li>
				<li><a href="#" >Your Calendar</a></li>
				<!--<li><a href="#">Virtual Class</a></li> -->
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
	
	
	<!-- MAIN CONTENT -->

	<div id="content">
		
		<div class="page-full-width cf">

<!-- head left overview --------------------------------------------------------------------------------------->
<?php
if($_SESSION['filterStudent'] == 0){
									$ccl_total = 0;
									$cot_total = 0;
									$schedule_total = 0;
									$completed_total = 0;
									$hrs_total = 0;
								$con = mysql_connect("localhost","quantid0_marco","~marco");
									if (!$con)  {
									    die('Could not connect: ' . mysql_error());
	    								}

								mysql_select_db("quantid0_fluent",$con); 
								$result = mysql_query("SELECT * FROM events", $con);//$teacherid
								$event = mysql_fetch_array($result);							

								//add CCL, COT, SCHEDULE, COMPLETED & Hrs
								do{
									//tranforma la fecha del evento de la db para ver el mes
									$str_db = $event['event_date'];                //'2012/11/4';   //$row['event_date'];
									$str = date("d-m-Y",strtotime($str_db));
									$fecha_db = (explode('-', $str, 3));
									//mes valido
									$mes_db = $fecha_db[1]; 
									//ano valido
									$year_db = $fecha_db[2]; 
									if($event['idteacher'] == $teacherid AND $mes_db == $actual_month AND $year_db == $actual_year){
										switch ($event['idstatus']) {
										   case "CCL":
											 $ccl_total++;
											 $hrs_total = $hrs_total + $event['hrs'];
											 break;
										   case "COT":
											 $cot_total++;
											 break;
										   case "SCHEDULE":
											 $schedule_total++;
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
								mysql_close($con);

}else{
	$ccl_total = 0;
	$cot_total = 0;
	$schedule_total = 0;
	$completed_total = 0;
	$hrs_total = 0;
	$con = mysql_connect("localhost","quantid0_marco","~marco");
		if (!$con)  {
		    die('Could not connect: ' . mysql_error());
		}

	mysql_select_db("quantid0_fluent",$con); 
	$result = mysql_query("SELECT * FROM events", $con);//$teacherid
	$event = mysql_fetch_array($result);							

	//add CCL, COT, SCHEDULE, COMPLETED & Hrs
	do{
		//tranforma la fecha del evento de la db para ver el mes
		$str_db = $event['event_date'];                //'2012/11/4';   //$row['event_date'];
		$str = date("d-m-Y",strtotime($str_db));
		$fecha_db = (explode('-', $str, 3));
		//mes valido
		$mes_db = $fecha_db[1]; 
		//ano valido
		$year_db = $fecha_db[2]; 
		if($event['idteacher'] == $teacherid AND $event['idstudent'] == $_SESSION['filterStudent'] AND $mes_db == $actual_month AND $year_db == $actual_year){
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
	mysql_close($con);
}
?>


	<div class="fl">
<br />

		<td> </td><td> </td>
				
		    <nav>
		      <ul>
			<li><a href="#">DONE<span class="badge"><?php echo" ".$completed_total." "; ?></span></a></li>
			<li><a href="#">SCHEDULE<span class="badge green"><?php echo" ".$schedule_total." "; ?></span></a></li>
			<li><a href="#">CANCELLED ON TIME(COT)<span class="badge yellow"><?php echo" ".$cot_total." "; ?></span></a></li>
			<li><a href="#">CLIENT CANCELLED LATE(CCL)<span class="badge red"><?php echo" ".$ccl_total." "; ?></span></a></li>
			<li><a href="#">TOTAL(min.)<span class="badge white"><?php echo" ".$hrs_total." "; ?></span></a></li>
		      </ul>
		    </nav>
					

	</div>
<!- head left overview --------------------------------------------------------------------------------------------->

<!- head right overview -------------------------------------------------------------------------------------------->						
			<div class="fr">
<br />
			<h2>
			<td>
				<form action="filter.php" method="POST">
			
			<td>Student:</td>
			<td>
						<?php
						$con = mysql_connect("localhost","quantid0_marco","~marco");
						if (!$con)  {
						    die('Could not connect: ' . mysql_error());
						}
						mysql_select_db("quantid0_fluent",$con);
						$query = "select * from students where asig = $teacherid order by apellido";//$teacherid
						$result = mysql_query($query);
		
						//declare the combo box
						$rows = array();
						$idx = 0;?>
						<select name="name">
							<option value="0"<?php if ($idx==0) echo 'selected="selected"';?>>all</option>;				
						<?php
						//list all of the other elements
						while ($row = mysql_fetch_array($result)){
						      $rows[$idx++] = array('value' => $row['id'], 'text' => $row['apellido']);?>
						<option value<?php echo"= ".$row['id']." ";?><?php if ($filter_student==$row['id']) echo 'selected="selected"';?>><?php echo" ".$row['nombre']." ".$row['apellido']." ";?></option>
						<?php
						}
						//close the combo box
						echo "</select>";
						//close db
						mysql_close($con);
						?>
					</td><td></td><td><input type='image' src='../images/tick.png' width='14' height=14' /></td>
				</form>			
			</td>
			<td>					
				<form action='filtra.php' method = 'POST'>
			<td>Month:</td>

			<td><select name="mes">
			    <option value="1"<?php if ($_SESSION['mes']==1) echo 'selected="selected"';?>>Jan</option>
			    <option value="2"<?php if ($_SESSION['mes']==2) echo 'selected="selected"';?>>Feb</option>
			    <option value="3"<?php if ($_SESSION['mes']==3) echo 'selected="selected"';?>>Mar</option>
			    <option value="4"<?php if ($_SESSION['mes']==4) echo 'selected="selected"';?>>Apr</option>
			    <option value="5"<?php if ($_SESSION['mes']==5) echo 'selected="selected"';?>>May</option>	
			    <option value="6"<?php if ($_SESSION['mes']==6) echo 'selected="selected"';?>>Jun</option>
			    <option value="7"<?php if ($_SESSION['mes']==7) echo 'selected="selected"';?>>Jul</option>
			    <option value="8"<?php if ($_SESSION['mes']==8) echo 'selected="selected"';?>>Aug</option>
			    <option value="9"<?php if ($_SESSION['mes']==9) echo 'selected="selected"';?>>Sep</option>
			    <option value="10"<?php if ($_SESSION['mes']==10) echo 'selected="selected"';?>>Oct</option>	
			    <option value="11"<?php if ($_SESSION['mes']==11) echo 'selected="selected"';?>>Nov</option>
			    <option value="12"<?php if ($_SESSION['mes']==12) echo 'selected="selected"';?>>Dec</option>
			    </select>
			</td>
			<td>| </td><td>Year:</td>
			<td><select name="ano">
			    <option value="2012"<?php if ($_SESSION['ano']==2012) echo 'selected="selected"';?>>2012</option>
			    <option value="2013"<?php if ($_SESSION['ano']==2013) echo 'selected="selected"';?>>2013</option>
			</select>
			</td>
			<td></td><td><input type='image' src='../images/tick.png' width='14' height=14'/></td>
				</form>
			</td>
<br />			
			</h2>	
			</div>
			 
			
<!-- head right overview -------------------------------------------------------------------------------------------->

<br />
<br />
<br />
<br />
<br />

<!------------------------------------------------------------------------------------------------------------>
<!----------------------------------------------------------------------------------------- event list ------->		

		<div class="page-full-width cf">

			<div class="content-module">
				<div class="content-module-heading cf">
				
					<h3 class="fl">EVENTs LIST</h3>
					<span class="fr expand-collapse-text">Click to collapse</span>
					<span class="fr expand-collapse-text initial-expand">Click to expand</span>
				
				</div> <!- end content-module-heading -->
				
				
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
								<th>NAME</th>
								<th>EVENT</th>
								<th>Training Agenda / Comments</th>
								<th>After Work Study</th>
								<th>ACTIONS</th>
							</tr>
						</thead>
						<!--<tfoot>
						
						</tfoot>-->
						<tbody>
<?php
	//
	//conexion
		$conexion = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conexion){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("quantid0_fluent",$conexion); 
		$result = mysql_query("SELECT * FROM events order by event_date", $conexion);
		$event = mysql_fetch_array($result);		
		do{
			//tranforma la fecha del evento de la db para ver el mes
			$str_db = $event['event_date'];                //'2012/11/4';   //$row['event_date'];
			$str = date("d-m-Y",strtotime($str_db));
			$fecha_db = (explode('-', $str, 3));
			//mes valido
			$mes_db = $fecha_db[1];
			//anho valido
			$year_db = $fecha_db[2];  
		   if($event['idteacher'] == $teacherid AND $mes_db == $actual_month AND $year_db == $actual_year){
			$result1 = mysql_query("SELECT id, usuario, password, nombre, apellido, email FROM students", $conexion);
			$student = mysql_fetch_array($result1);		
			   do{
				if($event['idstudent']== $student['id']){
				    $snombre = $student['nombre'];
				    $sapellido = $student['apellido'];
				    $sdate= $event['event_date'];
				    $stime= $event['event_time'];
				    //$edate= $event['edate'];
				    $hrs= $event['hrs'];
				    $status= $event['idstatus'];
				    $email= $student['email'];
				    $media= $event['idmedia'];
				    $eventid = $event['id'];

///////AQUI pregunta para editar esa fila!////////////////////////////////////////////////////////////////////////////////////
					if($event['id'] == $event_id1){
						$_SESSION['evntid']=$event['id'];
						$_SESSION['estudiante1']=$event['idstudent'];
						echo"<tr>
						<form action='savereport.php' method = 'POST'>

						<td>".$snombre." ".$sapellido."</td>
						<td>".$sdate." | ".$stime."</td>
						<td><input type='text' name='comments' value='' size=90px></td>
						
						<td><input type='text' name='w_study' value='' size=40px></td>
						
			        		<td><input type='image' src='../images/tick.png' width='14' height=14'/>
						|<a href='overview.php'><img src='../images/backward.png' width='14' height=14'></a></td>
						</form>
						</tr>";	
				    		break;	
					}else{}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

				    break;	
				}else{}
			   }while($student = mysql_fetch_array($result1));
		   }
		}while($event = mysql_fetch_array($result));
		   

			mysql_close($conexion);
?>
	
			
<?php
		}else{
?>			
					<table>
						<thead>
							<tr>
								<th>NAME</th>
								<th>EVENT</th>
								<th>Training Agenda / Comments</th>
								<th>After Work Study</th>
								<th>ACTIONS</th>
							</tr>
						</thead>
						<!--<tfoot>
						
						</tfoot>-->
						<tbody>
<?php
	//
	//conexion
		$conexion = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conexion){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("quantid0_fluent",$conexion); 
		$result = mysql_query("SELECT * FROM events order by event_date", $conexion);
		$event = mysql_fetch_array($result);		

		do{
			//tranforma la fecha del evento de la db para ver el mes
			$str_db = $event['event_date'];                //'2012/11/4';   //$row['event_date'];
			$str = date("d-m-Y",strtotime($str_db));
			$fecha_db = (explode('-', $str, 3));
			//mes valido
			$mes_db = $fecha_db[1];
			//anho valido
			$year_db = $fecha_db[2];   
		   if($event['idteacher'] == $teacherid AND $mes_db == $actual_month AND $year_db == $actual_year){
			$result1 = mysql_query("SELECT id, usuario, password, nombre, apellido, email FROM students", $conexion);
			$student = mysql_fetch_array($result1);		
			   do{
				if($event['idstudent']== $student['id'] AND $student['id'] == $_SESSION['filterStudent']){
				    $snombre = $student['nombre'];
				    $sapellido = $student['apellido'];
				    $sdate= $event['event_date'];
				    $stime= $event['event_time'];
				    //$edate= $event['edate'];
				    $hrs= $event['hrs'];
				    $status= $event['idstatus'];
				    $email= $student['email'];
				    $media= $event['idmedia'];
				    $eventid = $event['id'];

///////AQUI pregunta para editar esa fila!////////////<td width=100px>".$sdate."</td>////////////////////////////////////////////////////////////////////////value='".$old_idstatus."'
					if($event['id'] == $event_id1){
						$_SESSION['evntid']=$event['id'];
						$_SESSION['estudiante1']=$event['idstudent'];
						echo"<tr>
						<form action='savereport.php' method = 'POST'>

						<td>".$snombre." ".$sapellido."</td>
						<td>".$sdate." | ".$stime."</td>
						
						<td><input type='text' name='comments' value='' size=90px></td>
						
						<td><input type='text' name='w_study' value='' size=40px></td>
						
			        		<td><input type='image' src='../images/tick.png' width='14' height=14'/>
						|<a href='overview.php'><img src='../images/backward.png' width='14' height=14'></a></td>
						</form>
						</tr>";	
				    		break;	
					}else{}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					break;	
				}else{}
			   }while($student = mysql_fetch_array($result1));
		   }
		}while($event = mysql_fetch_array($result));
		   

			mysql_close($conexion);
		}
?>					
						</tbody>
						
					</table>
					
					<div class="stripe-separator"><!--  --></div>

					<p><img src='../images/sign.gif' width='14' height=14'>not reported.
						<img src='../images/vc2.jpg' width='14' height=14'>learn center.
						<img src='../images/report.png' width='14' height=14'>reported.
						<img src='../images/pencil.png' width='14' height=14'>edit.
						<img src='../images/trash.png' width='14' height=14'>delete.</p>					
					
				</div> <!-- end content-module-main -->
			
			</div> <!-- end content-module -->
		
		</div> <!-- end full-width -->
			
	</div> <!-- end content -->

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

//	$_SESSION['adlogin'] = "no";
//	}else{

//	echo '<meta http-equiv="REFRESH" content="0,url=../index.php">';

//	}
?>

