<?php 
	
	require("../config.php");

	//recupero variables

	//creo variables
    $idusuario = $_SESSION['id_usr_actual'];

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
		$_SESSION['FilterStudent'] = $_POST['name'];
		$filter_student = $_SESSION['FilterStudent'];

		$result = mysql_query("SELECT * FROM students", $conexion);

		while ($row = mysql_fetch_array($result)){

			if($row['usuario_students'] == $filter_student){

					$_SESSION['sid']=$row['id_students'];
					$_SESSION['susuario']=$row['usuario_students'];
					$_SESSION['snombre']=$row['nombre_students'];
					$_SESSION['sapellido']=$row['apellido_students'];
					$_SESSION['sbirth']=$row['birth_students'];
					$_SESSION['sgender']=$row['gender_students'];			
					$_SESSION['shtown']=$row['htown_students'];
					$_SESSION['saddr']=$row['addr_students'];
					$_SESSION['snlang']=$row['nlang_students'];
					$_SESSION['scity']=$row['city_students'];
					$_SESSION['stzone']=$row['tzone_students'];
					$_SESSION['sawork']=$row['awork_students'];
					$_SESSION['stelefono']=$row['telefono_students'];
					$_SESSION['scelular']=$row['celular_students'];
					$_SESSION['semail']=$row['email_students'];
					$_SESSION['sskype']=$row['skype_students'];
					$_SESSION['scountry']=$row['country_students'];			
					$_SESSION['scode']=$row['code_students'];
					//$_SESSION['sposition']=$row['teacher_asig'];    //student position
					$_SESSION['sasig']=$row['asig_students'];	
			}else{}
		}
	
	echo '<meta http-equiv="REFRESH" content="0,url=student.php">';
