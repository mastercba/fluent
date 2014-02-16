<?php session_start();?>
<?php
	//Recupero variables	
	//$snombre = $_POST['snombre'];
	//$sapellido = $_POST['sapellido'];
	$commts = $_POST['comments'];
	$wstudy = $_POST['w_study'];
	//Crear variables
	$filter_student = $_SESSION['filterStudent'];
	$evnt_id = $_SESSION['evntid'];
	$estudiante = $_SESSION['estudiante1'];
	//bandera_alta "1" para ese reporte de evento en events db
         //Conexion
		$conexion = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conexion){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("quantid0_fluent",$conexion); 
	//lo seteo como evento reportado
		mysql_query("UPDATE events SET report='1' WHERE id=".$evnt_id."");

	//Guardo el reporte en trainer_report table!	
		$result = mysql_query(("INSERT INTO trainer_report (idstudent, comments, w_study, idevents)
		 VALUES('$estudiante', '$commts','$wstudy','$evnt_id')"), $conexion);

	//cerrar
		mysql_close($conexion);
		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=overview.php">';

?>
