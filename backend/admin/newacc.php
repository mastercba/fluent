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

    // update 'lastvisit' date de la db
  
	//Crear variables

	//Recupero variables
		$addfecha = $_POST['accfecha'];
		$adddetalle = $_POST['accdetalle'];
		$addtransaccion = $_POST['acctransaccion'];
		$addingresos = $_POST['accingresos'];
		$addegresos = $_POST['accegresos'];
		$addsaldo = $_POST['accsaldo'];		
		$addtipo = $_POST['acctipo'];
		$addnumero = $_POST['accnumero'];
 
		$result = mysql_query(("INSERT INTO account (fecha_account, detalle_account, transaccion_account, ingresos_account, egresos_account, saldo_account, tipo_account, numero_account)
		 VALUES('$addfecha','$adddetalle','$addtransaccion','$addingresos','$addegresos','$addsaldo','$addtipo','$addnumero')"), $conexion);

		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=account.php">';

?>