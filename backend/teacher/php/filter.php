<?php 
	session_start();

//echo" ".$_SESSION['usuario']." ".$_SESSION['password']." ";

	//if(($_SESSION['adlogin'])=="si"){

	//Recupero variables
		$_SESSION['filterStudent'] = $_POST['name'];
		$filter_student = $_SESSION['filterStudent'];
//echo"".$filter_student."";
		
		//$teacherid = $_SESSION['teacherid'];

	//Crear variables
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$teacherid = $_SESSION['teacherid'];

	//Si filtro all! =>filterStudent =0

	if($filter_student == '0'){
					$_SESSION['sid']= "";
					$_SESSION['susuario']= "";
					$_SESSION['spassword']= "";
					$_SESSION['snombre']= "";
					$_SESSION['sapellido']= "";
					$_SESSION['sbirth']= "";
					$_SESSION['sgender']= "";			
					$_SESSION['shtown']= "";
					$_SESSION['saddr']= "";
					$_SESSION['snlang']= "";
					$_SESSION['scity']= "";
					$_SESSION['stzone']= "";
					$_SESSION['sawork']= "";
					$_SESSION['stelefono']= "";
					$_SESSION['scelular']= "";
					$_SESSION['semail']= "";
					$_SESSION['sskype']= "";
					$_SESSION['scountry']= "";			
					$_SESSION['scode']= "";
					$_SESSION['sposition']= "";    //student position
					$_SESSION['sasig']= "";
			echo '<meta http-equiv="REFRESH" content="0,url=overview.php">';
	}else{}

	// dbcon.................
		$conexion = mysql_connect("localhost","quantid0_marco","~marco");
		if(!$conexion){
		die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("quantid0_fluent",$conexion); 
		$result = mysql_query("SELECT * FROM students where asig = $teacherid order by apellido", $conexion);

		while ($row = mysql_fetch_array($result)){

			if($row['id'] == $filter_student){

					$_SESSION['sid']=$row['id'];
					$_SESSION['susuario']=$row['usuario'];
					$_SESSION['spassword']=$row['password'];
					$_SESSION['snombre']=$row['nombre'];
					$_SESSION['sapellido']=$row['apellido'];
					$_SESSION['sbirth']=$row['birth'];
					$_SESSION['sgender']=$row['gender'];			
					$_SESSION['shtown']=$row['htown'];
					$_SESSION['saddr']=$row['addr'];
					$_SESSION['snlang']=$row['nlang'];
					$_SESSION['scity']=$row['city'];
					$_SESSION['stzone']=$row['tzone'];
					$_SESSION['sawork']=$row['awork'];
					$_SESSION['stelefono']=$row['telefono'];
					$_SESSION['scelular']=$row['celular'];
					$_SESSION['semail']=$row['email'];
					$_SESSION['sskype']=$row['skype'];
					$_SESSION['scountry']=$row['country'];			
					$_SESSION['scode']=$row['code'];
					$_SESSION['sposition']=$row['teacher_asig'];    //student position
					$_SESSION['sasig']=$row['asig'];

//echo"".$_SESSION['snombre']."";
//echo"".$_SESSION['sapellido']."";
					
					
			}else{
					$_SESSION['sid']= "";
					$_SESSION['susuario']= "";
					$_SESSION['spassword']= "";
					$_SESSION['snombre']= "";
					$_SESSION['sapellido']= "";
					$_SESSION['sbirth']= "";
					$_SESSION['sgender']= "";			
					$_SESSION['shtown']= "";
					$_SESSION['saddr']= "";
					$_SESSION['snlang']= "";
					$_SESSION['scity']= "";
					$_SESSION['stzone']= "";
					$_SESSION['sawork']= "";
					$_SESSION['stelefono']= "";
					$_SESSION['scelular']= "";
					$_SESSION['semail']= "";
					$_SESSION['sskype']= "";
					$_SESSION['scountry']= "";			
					$_SESSION['scode']= "";
					$_SESSION['sposition']= "";    //student position
					$_SESSION['sasig']= "";

			}
		}

		//cerrar
			mysql_close($conexion);

			echo '<meta http-equiv="REFRESH" content="0,url=overview.php">';
?>
	
