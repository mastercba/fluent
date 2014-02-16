<?php session_start();?>
<?php
	//Recupero variables	
	$commts = $_POST['comments'];
	$wstudy = $_POST['w_study'];
	
	//Crear variables
	//$filter_student = $_SESSION['filterStudent'];
	//$date = $_SESSION['old_event_date'];
	$event_id = $_SESSION['evtid'];
	$id_report = $_SESSION['idreport'];
	$idstutrep = $_SESSION['idstudentrep'];

         //Conexion
		$conexion = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conexion){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("quantid0_fluent",$conexion);
	//busca la fila que necesitamos cambiar!
			//cambia!
			mysql_query("UPDATE trainer_report SET comments='".$commts."', w_study='".$wstudy."' 
			WHERE id=".$id_report."");
	 //cerrar
		mysql_close($conexion);
		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=overview.php">';

?>
