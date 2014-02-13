<?php session_start();?>
<?php

	//Recupero variables	
	//$sid = $_POST['sid'];
	$trastatus = $_POST['ntrastatus'];
	$tralang = $_POST['ntralang'];
	$trausuario = $_POST['ntrausuario'];
	$trapassword = $_POST['ntrapassword'];
	$tranombre = $_POST['ntranombre'];
	$traapellido = $_POST['ntraapellido'];
	$tracelular = $_POST['ntracelular'];
	$traemail = $_POST['ntraemail'];
	$traskype = $_POST['ntraskype'];
	$traolp = $_POST['ntraolp'];
	$tracountry = $_POST['ntracountry'];

	$traidantiguo = $_SESSION['idtra'];

	//conexion
		$conexion = mysql_connect("localhost","dbo469629526","~marco123");
		if(!$conexion){
			die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("db469629526",$conexion);

		mysql_query("UPDATE trainers SET status='".$trastatus."', 
		lang='".$tralang."', usuario='".$trausuario."', 
		password='".$trapassword."', nombre='".$tranombre."', 
		apellido='".$traapellido."', celular='".$tracelular."',
		email='".$traemail."', skype='".$traskype."',
		olp='".$traolp."', country='".$tracountry."'
		WHERE id=".$traidantiguo."");

	//cerrar
		mysql_close($conexion);
		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=trainer.php">';

?>