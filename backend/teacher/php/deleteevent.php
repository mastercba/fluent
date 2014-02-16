<?php session_start();?>
<?php
	//Crear variables	
		$idevent5 = $_GET['eventid'];
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
			if($idevent5 == $row['id']){
				$idstudent_found = $row['idstudent'];
				$idunit_found = $row['idunit'];
			}else{}
		}

	//reseteo el status_unit de la tabla:units_asigned   pasa a unit disponible!
		mysql_query("UPDATE units_asigned SET status_unit='0' 
		WHERE idstudent=".$idstudent_found." AND idunit=".$idunit_found."");

	//Borra en la tabla events
		$result = mysql_query("DELETE FROM events WHERE id='".$idevent5."'", $conexion);

	//Borra en la tabla trainer_report
		$result = mysql_query("DELETE FROM trainer_report WHERE idevents='".$idevent5."'", $conexion);

	//Borra en la tabla Calendar
		//$result = mysql_query("DELETE FROM calendar WHERE event_id='".$idevent."'", $conexion);
	//update units_asigned table.......support db....habilita el status_num para programar nuevamente la unidad
	//0: open FREE   1: Schedule  2: Done
	//Conexion
		//mysql_select_db("quantid0_fluent",$conexion); 		
	// ponemos disponible nuevamente la unidad para realizarla status_unit = 0
		//mysql_query("UPDATE units_asigned SET status_unit= 0
		//WHERE event_num=".$idevent."");

	//cerrar
		mysql_close($conexion);
		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=overview.php">';
//	$_SESSION['adlogin'] = "no";
//	}else{
//	echo '<meta http-equiv="REFRESH" content="0,url=../formlogin.html">';
//
//	}
?>
