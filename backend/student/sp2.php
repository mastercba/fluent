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
	
	$sbirth = $_POST['nsbirth'];
	$sgender = $_POST['nsgender'];
	$slang = $_POST['nslang'];

	$sid = $_SESSION['sid'];


		mysql_query("UPDATE students SET birth_students='".$sbirth."', 
		gender_students='".$sgender."', nlang_students='".$slang."'
		WHERE id_students=".$sid."");

		$_SESSION['sbirth']=$sbirth;
		$_SESSION['sgender']=$sgender;			
		$_SESSION['snlang']=$slang;

		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=profile.php">';

?>