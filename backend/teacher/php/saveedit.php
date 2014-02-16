<?php session_start();?>
<?php
	//Recupero variables	
	$enewdate = $_POST['evnt_date'];
	$enewtime = $_POST['evnt_time'];
	$eidmedia = $_POST['neidmedia'];
	$eidstatus = $_POST['neidstatus']; 
	$ehrs = $_POST['nehrs'];

	//Crear variables
	$event_id4 = $_SESSION['eventid4'];	

//--------------------------------------------cambia el event-------------------------------------------------------
	//Conexion
		$conexion = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conexion){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}
  	mysql_select_db("quantid0_fluent",$conexion);

	//Recupero variables - idstudent - y - idunit - de la tabla events
		$query = "select * from events"; 
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)){
			if($event_id4 == $row['id']){
				$idstudent_fd = $row['idstudent'];
				$idunit_fd = $row['idunit'];
			}else{}
		}

	//Si el eidstatus = CCL o COT habilita nuevamente la unidad para reprogramar!
	// en la tabla : units_asigned
	  if($eidstatus == "CCL"){
	  		//habilita el status_unit :en la tabla units_asigned
			mysql_query("UPDATE units_asigned SET status_unit='0' 
			WHERE idstudent=".$idstudent_fd." AND idunit=".$idunit_fd."");
	  }else{} 

	  if($eidstatus == "COT"){
	  		//habilita el status_unit :en la tabla units_asigned
			mysql_query("UPDATE units_asigned SET status_unit='0' 
			WHERE idstudent=".$idstudent_fd." AND idunit=".$idunit_fd."");
	  }else{}

	//update the event - date, time, length, status, media
	mysql_query("UPDATE events SET event_date='".$enewdate."', event_time='".$enewtime."', 
								   idmedia='".$eidmedia."', idstatus='".$eidstatus."', 
								   hrs='".$ehrs."'
	WHERE id=".$event_id4."");

	//select table events db and get id for event_id
	//	$query = "select * from events"; 
	//	$resu = mysql_query($query);
	//	while($rw = mysql_fetch_array($resu)){
	//		$new_event_id = $rw['id'];
	//	}

	//Update tabla calendar
		//select table db
		$query = "select * from calendar"; 
		$res = mysql_query($query);
		//Case 30, 45, 60, 75,90			
			switch ($ehrs) {
			   case "30":
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','1')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);				
					break;
			   case "45":
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','1')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);
					break;
			   case "60":
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','1')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);	
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);			 
					break;
			   case "75":
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','1')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);	
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);
					break;
			   case "90":
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','1')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);	
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$eevent_date','$eevent_time','0')"), $conexion);
					break;
			}

	//cerrar
		//mysql_close($conexion);

		//DONE?...so report it!


		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=overview.php">';

?>
