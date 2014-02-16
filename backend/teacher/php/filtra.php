<?php 
	session_start();

//echo" ".$_SESSION['usuario']." ".$_SESSION['password']." ";

	//if(($_SESSION['adlogin'])=="si"){

	//Recupero variables
		$_SESSION['mes_requerido'] = $_POST['mes'];
		$_SESSION['ano_requerido'] = $_POST['ano'];
		//$_SESSION['mes_requerido'] = $_GET['pass_month'];
		//$_SESSION['ano_requerido'] = '2012';
	//Crear variables
		$_SESSION['mes'] = $_SESSION['mes_requerido'];
		$_SESSION['ano'] = $_SESSION['ano_requerido'];


			echo '<meta http-equiv="REFRESH" content="0,url=overview.php">';
?>
