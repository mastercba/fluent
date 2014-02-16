<?php 
	session_start();
//echo" ".$_SESSION['usuario']." ".$_SESSION['password']." ";
	if(($_SESSION['adlogin'])=="si"){

	//Crear variables
		$addeidstudent = $_SESSION['filterStudent'];
		$addeidteacher = $_SESSION['teacherid'];
		$addeidmedia = $_POST['eidmedia'];
		$addeidstatus = $_POST['eidstatus'];
		$addehrs = $_POST['ehrs'];
		$addunit = $_POST['select_unit'];
		$addeevent_date = $_POST['eevent_date'];
		$addeevent_time = $_POST['eevent_time'];
		$addename = '';
		$addeidstudentname = '';

	//Conexion
		$conexion = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conexion){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("quantid0_fluent",$conexion); 
		//Lee de la tabla de students el nombre y apellido del estudiante
		$query = "select * from students"; 
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)){
			if($addeidstudent == $row['id']){
				$addeidstudentname = $row['nombre']." ".$row['apellido'];	
			}else{}
		}		
		//Crea la descripcion para el calendar 
		$addename .= $addeidstudentname.'&#8226;'.$addeidstatus.'&#8226;'.$addeevent_time.'&#8226;'.$addehrs.'min.&#8226;';
  
	//Prepara el estado de la unidad
	  if($addeidstatus == "DONE"){$estado = 2; }else{}
	  if($addeidstatus == "CCL"){$estado = 0; }else{}
 	  if($addeidstatus == "COT"){$estado = 0; }else{}


	//Cambio el estado de la unidad a DONE - no disponible "1", tabla units_asigned!
  	mysql_select_db("quantid0_fluent",$conexion); 
	  $estado = 1;
		mysql_query("UPDATE units_asigned SET status_unit='".$estado."'
		WHERE idstudent=".$addeidstudent." AND idunit=".$addunit."");
	  
	//Inserta a la 'tabla events' el nuevo evento creado 	
		$result = mysql_query(("INSERT INTO events (idstudent, idteacher, idmedia, idstatus, hrs, idunit, status_unit, name, event_date, event_time, report)
		 VALUES('$addeidstudent','$addeidteacher','$addeidmedia','$addeidstatus','$addehrs','$addunit', '$estado','$addename','$addeevent_date','$addeevent_time','0')"), $conexion);
		
		//select table events db and get id for event_id
		$query = "select * from events"; 
		$resu = mysql_query($query);
		while($rw = mysql_fetch_array($resu)){
			$new_event_id = $rw['id'];
		}

	//Update tabla calendar
		//select table db
		$query = "select * from calendar"; 
		$res = mysql_query($query);
		//Case 30, 45, 60, 75,90			
			switch ($addehrs) {
			   case "30":
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','1')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);				
					break;
			   case "45":
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','1')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);
					break;
			   case "60":
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','1')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);	
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);			 
					break;
			   case "75":
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','1')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);	
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);
					break;
			   case "90":
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','1')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);	
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);
					$res = mysql_query(("INSERT INTO calendar (event_id, event_date, event_time, slot)
					VALUES('$new_event_id','$addeevent_date','$addeevent_time','0')"), $conexion);
					break;
			}

	//cerrar
		mysql_close($conexion);

		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=overview.php">';

//	$_SESSION['adlogin'] = "no";
	}else{

	echo '<meta http-equiv="REFRESH" content="0,url=../formlogin.html">';

	}
?>
