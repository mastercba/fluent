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

	//Recupero variables	
	//$sid = $_POST['sid'];
	$accfecha = $_POST['nfecha'];
	$accdetalle = $_POST['ndetalle'];
	$acctransaccion = $_POST['ntransaccion'];
	$accingresos = $_POST['ningresos'];
	$accegresos = $_POST['negresos'];
	$accsaldo = $_POST['nsaldo'];
	$acctipo = $_POST['ntipo'];
	$accnumero = $_POST['nnumero'];

	$accidantiguo = $_SESSION['idacc'];

		mysql_query("UPDATE account SET fecha_account='".$accfecha."', 
		detalle_account='".$accdetalle."', transaccion_account='".$acctransaccion."', 
		ingresos_account='".$accingresos."', egresos_account='".$accegresos."', 
		saldo_account='".$accsaldo."', tipo_account='".$acctipo."',
		numero_account='".$accnumero."'
		WHERE id_account=".$accidantiguo."");

		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=account.php">';

?>