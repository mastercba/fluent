<?php session_start();?>
<?php

	//Recupero variables
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email = $_POST['email'];
		$deseo = $_POST['deseo'];

	//Defino variables		
		//$filter_student = $_SESSION['filterStudent'];
		$sendTo = "torrim@supernet.com.bo"; 
		$subject = " SOLICITAR MAS INFORMACIÓN";

		$header = 'From: ' . $email . " \r\n"; 
		$header .= "X-Mailer: PHP/" . phpversion() . " \r\n"; 
		$header .= "Mime-Version: 1.0 \r\n"; 
		$header .= "Content-Type: text/plain";

	//envia el email
		//$headers .= ""; 
		$message = "\nNombre: " . $nombre . "\nApellido: " . $apellido . "\nemail: " . $email . "\nOpcion elegida: " . $deseo; 

		mail($sendTo, $subject, $message, $header); 

	//saca el mensaje de enviado	

	//vuelve al index
		echo '<meta http-equiv="REFRESH" content="0,url=../index.html">';
?>