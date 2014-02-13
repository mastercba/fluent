<?php 

	require("../config.php");

	//recupero variables

	//creo variables

    // At the top of the page we check to see whether the user 
    if(empty($_SESSION['usuario'])){ //is logged in or not 
        // If they are not, we redirect them to the login page. 
        header("Location: /fluent/formlogin.html");          
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to /fluent/formlogin.html"); 
    }     
    // Everything below this point in the file is secured by the login system

	//recupero variables
		$idtra = $_GET['trid'];


 		$result1 = mysql_query("SELECT id_tipo FROM trainers WHERE id_trainers='".$idtra."'", $conexion);
 		$idtipo = mysql_fetch_row($result1);
		
		$result2 = mysql_query("SELECT id_usuario FROM tipo WHERE id_tipo='".$idtipo[0]."'", $conexion);
		$idusuario = mysql_fetch_row($result2);

		//borra usuario de la tabla trainers 
		$result = mysql_query("DELETE FROM trainers WHERE id_trainers='".$idtra."'", $conexion);

		//borra usuario de la tabla tipo 
		$result = mysql_query("DELETE FROM tipo WHERE id_tipo='".$idtipo[0]."'", $conexion);

		//borra usuario de la tabla usuario 
		$result = mysql_query("DELETE FROM usuario WHERE id_usuario='".$idusuario[0]."'", $conexion);

		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=admin1.php">';

?>
