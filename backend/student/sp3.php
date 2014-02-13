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
	
	$saddr = $_POST['saddr'];
	$scountry = $_POST['country'];
	$stzone = $_POST['timezone'];

	$sid = $_SESSION['sid'];

	//creo variables
	//$phone = "+(".$scode.")".$sphone."-".$sext;

		mysql_query("UPDATE students SET 
		addr_students='".$saddr."', country_students='".$scountry."', tzone_students='".$stzone."'
		WHERE id_students=".$sid."");

		$_SESSION['saddr']=$saddr;
		$_SESSION['scountry']=$scountry;
		$_SESSION['stzone']=$stzone;

		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=profile.php">';

?>