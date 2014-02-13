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
	
	$scode = $_POST['scode'];
	$sphone = $_POST['sphone'];
	$sext = $_POST['sext'];
	$scelular = $_POST['scelular'];
	$sskype = $_POST['sskype'];
	$semail = $_POST['semail'];

	$sid = $_SESSION['sid'];

	//creo variables
	//$phone = "+(".$scode.")".$sphone."-".$sext;

		mysql_query("UPDATE students SET phonecode_students='".$scode."', telefono_students='".$sphone."', phoneext_students='".$sext."', 
		celular_students='".$scelular."', skype_students='".$sskype."', email_students='".$semail."'
		WHERE id_students=".$sid."");

if($sphone == " "){
		$_SESSION['sphonecode']="";
		$_SESSION['stelefono']="";
		$_SESSION['sphoneext']="";
}else{
		$_SESSION['sphonecode']=$scode;
		$_SESSION['stelefono']=$sphone;
		$_SESSION['sphoneext']=$sext;
}
if($scelular == " "){		
		$_SESSION['scelular']="";
}else{$_SESSION['scelular']=$scelular;}
if($sskype == " "){		
		$_SESSION['sskype']="";
}else{$_SESSION['sskype']=$sskype;}
if($semail == " "){		
		$_SESSION['semail']="";
}else{$_SESSION['semail']=$semail;}
		
		

		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=profile.php">';

?>