<?php session_start();?>
<?php

	//Recupero variables	
	//$sid = $_POST['sid'];
	$aduser = $_POST['naduser'];
	$adpassword = $_POST['nadpassword'];
	$adname = $_POST['nadname'];
	$adlast = $_POST['nadlast'];
	$adlevel = $_POST['nadlevel'];
	$adlastvisit = $_POST['nadlastvisit'];
	$adstatus = $_POST['nadstatus'];

	$adidantiguo = $_SESSION['idadm'];

	//conexion
		$conexion = mysql_connect("localhost","dbo469629526","~marco123");
		if(!$conexion){
			die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("db469629526",$conexion);

		mysql_query("UPDATE administra SET user='".$aduser."', 
		password='".$adpassword."', name='".$adname."', 
		last='".$adlast."', level='".$adlevel."', 
		lastvisit='".$adlastvisit."', status='".$adstatus."'
		WHERE id=".$adidantiguo."");

	//cerrar
		mysql_close($conexion);
		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=admins.php">';

?>