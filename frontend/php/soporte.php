<?php session_start();?>
<?php

	//Recupero variables
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$email = $_POST['email'];
		$mensaje = $_POST['mje'];

	//Defino variables		
		//$filter_student = $_SESSION['filterStudent'];
		$sendTo = "torrim@supernet.com.bo"; 
		$subject = " SOPORTE";

		$header = 'From: ' . $email . " \r\n"; 
		$header .= "X-Mailer: PHP/" . phpversion() . " \r\n"; 
		$header .= "Mime-Version: 1.0 \r\n"; 
		$header .= "Content-Type: text/plain";

	//envia el email
		//$headers .= ""; 
		$message = "\nNombre: " . $nombre . "\nApellido: " . $apellido . "\nemail: " . $email . "\nMensaje: " . $mensaje; 

		mail($sendTo, $subject, $message, $header); 

	//saca el mensaje de enviado	
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>FluentSpeaking</title>

	<link rel="stylesheet" type="text/css" href="css/normalize.css"/>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
	<link rel="stylesheet" type="text/css" href="css/estilos.css"/>
	<link rel="shortcut icon" href="img/favicon.ico">

	<script src="js/prefixfree.min.js"></script>
	<script src="js/jquery.js"></script>
	<!--<script src="js/codiguito.js"></script> -->

	<!--<muestra el banner>-->
	<script type="text/javascript">					
				$( function(){   
				    //Muestro el primer div
				    $("#fotos div:eq(0)").show();
				    //cada 2 segundo ejecuto la función mostrar()
				    setInterval("mostrar1()",7000);
				});
				mostrar1 = function(){
				    //Oculto el div que se encuentra vivisble
				    var div = $("#fotos div:visible").hide();
				    //Selecciono el siguiente div que oculte en el paso anterior
				    divNext = div.next();
				    //Si existe otro div después lo muestro, si no existe quiere decir que es el último, entonces muestro el primero para que la próxima vez que se ejecute la función continue con el segundo
				    if(divNext.length){
				        divNext.show();
				    } else {
				        $("#fotos div:eq(0)").show();
				    }
				};
	</script>

	<!--<muestra el testimonio>-->
	<script type="text/javascript">					
				$( function(){   
				    //Muestro el primer div
				    $("#columnas div:eq(0)").show();
				    //cada 2 segundo ejecuto la función mostrar()
				    setInterval("mostrar()",5000);
				});
				mostrar = function(){
				    //Oculto el div que se encuentra vivisble
				    var div = $("#columnas div:visible").hide();
				    //Selecciono el siguiente div que oculte en el paso anterior
				    divNext = div.next();
				    //Si existe otro div después lo muestro, si no existe quiere decir que es el último, entonces muestro el primero para que la próxima vez que se ejecute la función continue con el segundo
				    if(divNext.length){
				        divNext.show();
				    } else {
				        $("#columnas div:eq(0)").show();
				    }
				};
	</script>

	<!--<formulario para information>-->
	<script>
		$(document).ready(function() {
		    $('#showlogin').click(function() {
		        $('#loginpanel').slideToggle('fast', function() {
		            $("#triangle_down").toggle(); 
		            $("#triangle_up").toggle();
		        });
		    });
			$('#nombre').focus(function(){  
				$(this).val('');   
			});  
			$('#apellido').focus(function(){  
				$(this).val('');  
			});
			$('#email').focus(function(){  
				$(this).val('');  
			});
			$('#deseo').focus(function(){  
				$(this).val('');  
			});
		});
	</script>
</head>

<body class="soporte">
	<header>
		
		<div id="up_menu"><!--<menu superior>-->
			<div id="menu">
			    <a href="#" id="actual_top"> Contáctenos </a>|
			    <a href="qsomos.html"> ¿Quiénes Somos? </a>|
			    <!--<a href="certifica.html"> Certificaciones </a>|-->
			    <a href="tduso.html"> Política de Privacidad </a>|
			    <a href="formlogin.html"> Entrar </a>
			</div>        
		</div>

		<div id="logo"><!--<logo>-->
			<a style="text-decoration: none; margin-left: 12px;" href="http://www.fluentspeaking.com" title="FluentSpeaking">
			    <img style="margin-top: 2px;" src="img/logo_last.png" alt="FS-logo">
			</a>
		</div>

		<div id="lang"><!--<cambio de idioma>-->
			<div id="lang-wrapper">
			    <a style=" text-decoration: none; margin-left: 12px;" href="index.html" title="Aleman">
			        <img style="margin-top: 2px; opacity:0.2;" src="img/de.png" width="18" height="18" alt="Deutsch-logo">
			    </a>
			    <a style=" text-decoration: none;margin-left: 8px;" href="indexen.html" title="Ingles">
			        <img style="margin-top: 2px; opacity:0.2;" src="img/uk.png" width="18" height="18" alt="Englisch-logo">
			    </a>
			    <a style=" text-decoration: none; margin-left: 5px;" href="indexes.php" title="Español">
			        <img style="margin-top: 2px;" src="img/sp.png" width="20" height="20" alt="Español-logo">
			    </a>
			</div>        
		</div>

		<div id="logolangua"><!--<languacom group>-->

			<a href="http://www.languacom.de"><img src="img/logolanguagroup.png"></a>
		</div>

		<hgroup><!--<menu>-->
			<nav>
					<ul>
						<li><a href="indexes.php">Inicio</a></li>
						<li><a href="funciona.html" id="personalizar">Cómo Funciona</a></li>
						<li><a href="#">Curso Alemán</a>
							<ul>
								<li><a href="alestesp.html">Estudiantes</a></li>
								<li><a href="alprivesp.html">Privados</a></li>
								<li><a href="alempesp.html">Empresas</a></li>
							</ul>
						</li>
						<li><a href="#">Curso Inglés</a><!--<ensp.html>-->
							<ul>
								<li><a href="examenes.html">Preparación Exámenes</a></li>
								<li><a href="inestesp.html">Estudiantes</a></li>
								<li><a href="inprivesp.html">Privados</a></li>
								<li><a href="inempesp.html">Empresas</a></li>
							</ul>
						</li>	
						<li><a href="#">Curso Español</a>
							<ul>
								<li><a href="espturesp.html">Español para Turismo</a></li>
								<li><a href="espestesp.html">Estudiantes</a></li>
								<li><a href="espprivesp.html">Privados</a></li>
							</ul>
						</li>
						<li><a href="#">Curso Francés</a>
							<ul>
								<li><a href="frestesp.html">Estudiantes</a></li>
								<li><a href="frprivesp.html">Privados</a></li>
							</ul>
						</li>
						<li><a href="#">Nuestro Método</a></li>
					</ul>	
			</nav>
		</hgroup>
	
	</header>

	<section>
		<div id="top_title">
			<h15 id="top_font">Contáctenos</h15>
		</div>
		<article id="columna_izq">
			<p>GRACIAS!.....Su mensaje fue enviado con exito.</p></br>
			<!--GET IN TOUCH fill in the form below, and we will get back to you within 24 hrs-->
			<div id="soporte"><!--<soporte continuar>-->	
				<a style="text-decoration: none; margin-left: 12px;" href="../index.html" title="continuar">
			    <img style="margin-top: 2px;margin-left: 6em" src="../img/oki.jpg" alt="continuar"></a>			
			</div>
		</article>
		<article id="columna_der">
			<article><img src="../img/window_der.png"/></article>
			<div id="columna_der_down">
					<p><strong>FLUENTSPEAKING</strong></br> 
					Fasanenweg 5</br>
					70771 Leinfelden-Echterdingen</br>
					Tel.: +49 711 5960066-3</br>
					Fax: +49 711 2620614</br>
					infoservice@fluentspeaking.de</br>
					ALEMANIA</p>
			</div>
		</article>		
	</section>

	<footer> <!--footer-->
		<div id="footer_wrap"> 
			<div id="footer_content">
				<div class="logo-tel">
					<div id="footer_logo_img"></div>
					<div id="footer-phone"><img class="country_flags" id="flag-eeuu" src="img/de.png" alt="(DE Flag)"><span id="phone_number">+49 711 59600-662</span></div>
				</div>	
				<div class="social-icons">
					<div id="letras">
					</div>
					<div id="iconos">	
						<div id="fb">
							<a href="http://www.facebook.com/FluentSpeaking">
								<img src="img/fb.png" width="38" height="38" >
							</a>
						</div>
						<div id="tw">
							<a href="http://twitter.com/#!/FluentSpeaking">
								<img src="img/tw.png" width="35" height="35" >
							</a>
						</div>
						<div id="gp">
							<a href="https://plus.google.com/11779826902388336983/posts">
								<img src="img/g+.png" width="35" height="35" >
							</a>
						</div>
					</div>	
				</div>
				<div class="copy">
					<p id="fs-copyright">
					    Copyright © 2013 FluentSpeaking. Todos los derechos reservados.
					</p>
				</div>
			</div>	
		</div>		
	</footer>

</body>
</html>

<?php
	//vuelve al index
		//echo '<meta http-equiv="REFRESH" content="0,url=../index.html">';
?>