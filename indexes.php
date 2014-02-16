<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<title>FluentSpeaking</title>

	<link rel="stylesheet" type="text/css" href="frontend/css/normalize.css"/>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
	<link rel="stylesheet" type="text/css" href="frontend/css/estilos.css"/>
	<link rel="shortcut icon" href="frontend/img/favicon.ico">


	<script src="frontend/js/prefixfree.min.js"></script>
	<script src="frontend/js/jquery.js"></script>
	<script src="frontend/js/fluent.js"></script>
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
				    setInterval("mostrar()",20000);
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

<body>
	<header>
		<div id="up_menu"><!--<menu superior>-->
			<div id="menu">
			    <a href="frontend/html/soporte.html"> Contáctenos </a>|
			    <a href="frontend/html/qsomos.html"> ¿Quiénes Somos? </a>|
			    <!--<a href="certifica.html"> Certificaciones </a>|-->
			    <a href="frontend/html/tduso.html"> Política de Privacidad </a>|
			    <a href="formlogin.html"> Entrar </a>
			</div>        
		</div>

		<div id="logo"><!--<logo>-->
			<a style="text-decoration: none; margin-left: 12px;" href="http://www.fluentspeaking.com" title="FluentSpeaking">
			    <img style="margin-top: 2px;" src="frontend/img/logo_last.png" alt="FS-logo">
			</a>
		</div>

		<div id="lang"><!--<cambio de idioma>-->
			<div id="lang-wrapper">
			    <a style=" text-decoration: none; margin-left: 12px;" href="index.php" title="Alemán">
			        <img style="margin-top: 2px; opacity:0.2;" src="frontend/img/de.png" width="18" height="18" alt="Deutsch-logo">
			    </a>
			    <a style=" text-decoration: none;margin-left: 8px;" href="indexen.php" title="Inglés">
			        <img style="margin-top: 2px; opacity:0.2;" src="frontend/img/uk.png" width="18" height="18" alt="Englisch-logo">
			    </a>
			    <a style=" text-decoration: none; margin-left: 5px;" href="indexes.php" title="Español">
			        <img style="margin-top: 2px;" src="frontend/img/sp.png" width="20" height="20" alt="Español-logo">
			    </a>
			</div>        
		</div>

		<div id="logolangua"><!--<languacom group>-->

			<a href="http://www.languacom.de"><img src="frontend/img/logolanguagroup.png"></a>
		</div>

		<hgroup><!--<menu>-->
			<nav>
					<ul>
						<li><a href="frontend/html/funciona.html" id="personalizar">Cómo Funciona</a></li>
						<li><a href="#">Curso Alemán</a>
							<ul>
								<li><a href="frontend/html/alestesp.html">Estudiantes</a></li>
								<li><a href="frontend/html/alprivesp.html">Privados</a></li>
								<li><a href="frontend/html/alempesp.html">Empresas</a></li>
							</ul>
						</li>
						<li><a href="#">Curso Inglés</a><!--<ensp.html>-->
							<ul>
								<li><a href="frontend/html/examenes.html">Preparación Exámenes</a></li>
								<li><a href="frontend/html/inestesp.html">Estudiantes</a></li>
								<li><a href="frontend/html/inprivesp.html">Privados</a></li>
								<li><a href="frontend/html/inempesp.html">Empresas</a></li>
							</ul>
						</li>	
						<li><a href="#">Curso Español</a>
							<ul>
								<li><a href="frontend/html/espturesp.html">Español para Turismo</a></li>
								<li><a href="frontend/html/espestesp.html">Estudiantes</a></li>
								<li><a href="frontend/html/espprivesp.html">Privados</a></li>
							</ul>
						</li>
						<li><a href="#">Curso Francés</a>
							<ul>
								<li><a href="frontend/html/frestesp.html">Estudiantes</a></li>
								<li><a href="frontend/html/frprivesp.html">Privados</a></li>
							</ul>
						</li>
					</ul>	
			</nav>
		</hgroup>

		<div id="phone"><img class="country_flags" id="flag-eeuu" src="frontend/img/de.png" width="10" height="10" alt="(DE Flag)">
			<span id="phone_number">+49 711 59600-662</span>
		</div>	

		<div id="info"><!--<solicitar mas informacion>-->
	   		    <a href="#" id="showlogin"> SOLICITAR MAS INFORMACIÓN
	   		    	<span id="triangle_down">&#9660;</span>
	   		    	<span id="triangle_up" style="display:none;">&#9650;</span>
	   		    </a>	
				<div id="loginpanel" style="display:none;">
				    <form action="frontend/php/info.php" method="post">
				        Nombre Completo</br>
				        <input type="text" name="nombre" value="Nombre" id="nombre" size="12px"/>
				        <input type="text" name="apellido" value="Apellido" id="apellido" size="12px"/></br>
				        e-mail </br>
				        <input type="text" name="email" value="correo@ejemplo.com" id="email" size="25px"/></br>
				        ¿Cuál es el idioma de su interes? </br>
						<select id="deseo" name="deseo" value="[seleccione uno]">
						  <option value="aleman">Alemán</option>
						  <option value="ingles">Inglés</option>
						  <option value="espanol">Español</option>
						  <option value="frances">Francés</option>
						</select></br>
				        <button type="submit" id="submit">Enviar</button>					
				    </form>
				</div>
		</div>	
	</header>

	<section>
	</section>

	<section> <!--Banner-->			<!--<br>ñ<br>-->	
		<div id="banner">
		<article id="tels">
			<ul id="fotos">
				<div id="un"><img src="frontend/img/ban2.png" /><figcaption><h3>FluentSpeaking ofrece cursos de inglés, alemán, francés y español.</h3></figcaption></div>
								
				<div id="do"><img src="frontend/img/ban3.png" /><figcaption><h3>Los cursos de FluentSpeaking se desarrollan online en forma personalizada con clases en vivo.</h3></figcaption></div>

				<div id="tre"><img src="frontend/img/ban7.png" /><figcaption><h3>FluentSpeaking cuenta con un equipo de profesores certificados para enseñar su idioma nativo.</h3></figcaption></div>
			</ul>
		</article>
		</div>	
	</section>

	<section> <!--pgm-->
		<div id="pgm">
			<article id="pgm1"><a style=" text-decoration: none;" title="Alemán"><img src="frontend/img/spde.png"/></a></article>
			<article id="pgm2"><a style=" text-decoration: none;" title="Inglés"><img src="frontend/img/spen.png"/></a></article>
			<article id="pgm3"><a style=" text-decoration: none;" title="Español"><img src="frontend/img/spsp.png"/></a></article>
			<article id="pgm4"><a style=" text-decoration: none;" title="Francés"><img src="frontend/img/spfr.png"/></a></article>
		</div>	
	</section>

	<section> <!--Intro & Video-->
		<div id="introyvideo">
			<article id="intro">
				<div id="introfs">
					<p>Bienvenido a la escuela europea pionera en la enseñanza de idiomas por telefono e internet, ¡desde la comodidad de su hogar o su oficina!</p>
					<p>•Clases en vivo a través de Teléfono o Internet • Enseñanza personalizada • Profesores nativos y certificados • Horarios segun su conveniencia</P>
				</div>	
			</article>

			<article id="video2">
				<div style="text-align:center"> 
				  <!--<video id="video1" width="350" height="250" poster="frontend/img/first.png" controls>   autoplay controls-->
				  					  <!-- <img src="frontend/img/play_O.png" width="46" height="46">-->

				  	<iframe width="350" height="250" src="//www.youtube.com/embed/SgmuOAO4PC8" frameborder="0" allowfullscreen></iframe> 

				  	<!--<span class="play"></span>				  
				    <source src="frontend/media/four.mp4" type="video/mp4">
				    <source src="video/one.ogg" type="video/ogg"> 
				    Ihr Browser unterstützt keine HTML5 video. 
				  </video>-->
				</div> 
			</article>
		</div>
	</section>

	<section> <!--Testimonials-->
		<div id="testyvideo">
			<article id="testimonials">
			<h2 class="tac pb30">Qué dicen de nosotros</h2>      <!--What customers say about Us-->

				<ul id="columnas">
				        <div id="uno">
								<blockquote class="pl40 mb30"> <p>Estimado equipo LANGUACOM, para fortalecer mis conocimientos de inglés,
								 he participado en un entrenamiento de teléfono. La formación telefónica de 30 minutos fue i.d.R. 1 x semana.
								  El nombramiento de decisiones y ha trabajado bien. El programa de capacitación fue muy interesante. Se incluye 
								  tanto la conversación cotidiana, así como de ejercicios específicos para mejorar y fortalecer mis conocimientos
								   de Inglés. M. E. esta es una buena mezcla. Me dio un montón de diversión con mi entrenador para trabajar juntos.
								    El ambiente era muy agradable. Es ventajoso que mi entrenador de "hablante nativo", y fue toda la conversación 
								    fue sólo en Inglés. Mi experiencia con LANGUACOM fueron muy positivos. Mi instructor fue muy bien informado y 
								    era capaz de transmitir bien el idioma. Debido a la muy positiva experiencia, puedo recomendar felizmente LANGUACOM. 
								    Saludos cordiales</p> <cite><strong>Andreas Fröhlich</strong> T-Systems GEI GmbH  <a href="http://www.fluentspeaking.de/"></a> </cite> - Integración de Sistemas </blockquote>
				        </div>
					    <div id="dos">
								<blockquote class="pl40 mb30"> <p>Sehr geehrte Damen und Herren,
								ich kann Ihnen das Training mit Languacom nur empfehlen. Ich genieße das Face-To-Face-Training von Languacom seit langem und auch mit unterschiedlichen TrainerInnen. Das Training ist absolut professionell und die Betreuung in jeder Hinsicht vorbildlich und auf meine Anforderungen ausgerichtet. Die Lernziele sind sehr flexibel ausgelegt und orientieren sich genau an meinen Interessen- und Lernschwerpunkten. Der Lernstoff ist immer mit aktuellen Begebenheiten und Themen aus meinem beruflichen, dem gesellschaftlichen und privaten Umfeld verbunden. Dabei schätze ich insbesondere die Möglichkeit der freien und spontanen Konversation und nicht dem Festhalten an einem starren Lehrplan. Das Verhältnis zu den TrainerInnen ist absolut vertrauensvoll und hervorzuheben ist auch die außergewöhnliche terminliche Flexibilität.</p> <cite><strong>T-Systems Executive</strong> <a href="http://www.fluentspeaking.de/"></a> </cite> </blockquote>
					    </div>
					    <div id="tres">
					    		<blockquote class="pl40 mb30"> <p>An das Languacom Team.
								An dieser Stelle möchte ich mich einmal für das professionelle Sprach-Training bedanken, dass ich für einige Monaten erfahren habe. Sowohl für das Face to Face als auch das Telefon Training wurde von sehr engagierten fähigen Trainern mit einigen kreativen Ideen durchgeführt. Es hat mir besonders geholfen, dass die Trainer den Unterricht an die Themen und Unterlagen aus meinem Tagesgeschäft angelehnt haben. Dadurch konnte ich manch kniffligen Sprachknoten aus meinem beruflichen Umfeld entwirren und deutlich selbstsicherer auf die nächste Präsentation oder Moderation zugehen. Die "Zusammenarbeit" war vertrauensvoll, das Verlegen von Terminen immer unkompliziert. Auch dafür meinen Dank.
								Ich kann das Training mit gutem Gewissen weiterempfehlen und werde das Training fortsetzen.
								Beste Grüße</p> <cite><strong>P. Schnettler</strong> T-Systems International GmbH </cite> - Sales</blockquote>
					    </div>
					    <div id="cuatro">
					    		<blockquote class="pl40 mb30"> <p> Languacom hat sich im Rahmen meines Face-to-Face Trainings hervorragend auf meine spezifischen Bedürfnisse eingestellt. Meine persönliche Trainerin überzeugt durch sehr gutes Verständnis für meine Aufgaben und Herausforderungen als Manager in einer IT-Company. Der Unterricht ist sehr lebendig, kurzweilig und absolut fordernd. Die Trainingszeit wird wirklich für Themen verwendet, die wichtig sind und mich weiterbringen. Auch schafft es Languacom meine terminlichen Belange flexibel zu meistern. Und – last but not least – der Unterricht macht Spaß!</p> <cite><strong>Robert Lang</strong> T-Systems GEI GmbH </cite> - Service Unit Systems Integration </blockquote>
					    </div>
				</ul>
			</article>
		</div>
	</section>

	<section> <!--certificaciones-->
		<div id="cert">
			<article id="cert1"><img src="frontend/img/ielts.png"/></article>
			<article id="cert2"><img src="frontend/img/gre.png"/></article>
			<article id="cert3"><img src="frontend/img/toefl.png"/></article>
			<article id="cert4"><img src="frontend/img/bulats.png"/></article>
		</div>	
	</section>

	<footer> <!--footer-->
		<div id="footer_wrap"> 
			<div id="footer_content">
				<div class="logo-tel">
					<div id="footer_logo_img"></div>
					<div id="footer-phone"><img class="country_flags" id="flag-eeuu" src="frontend/img/de.png" alt="(DE Flag)"><span id="phone_number">+49 711 59600-662</span></div>
				</div>
	
				<div class="social-icons">
					<div id="letras">
					</div>
					<div id="iconos">	
						<div id="fb">
							<a href="http://www.facebook.com/FluentSpeaking">
								<img src="frontend/img/fb.png" width="38" height="38" >
							</a>
						</div>
						<div id="tw">
							<a href="http://twitter.com/#!/FluentSpeaking">
								<img src="frontend/img/tw.png" width="35" height="35" >
							</a>
						</div>
						<div id="gp">
							<a href="https://plus.google.com/11779826902388336983/posts">
								<img src="frontend/img/g+.png" width="35" height="35" >
							</a>
						</div>
					</div>	
				</div>

				<!--<div>
					<a href="http://www.languacom.de">
						<img src="img/fslang1.png" width="212" height="26" > 400x45
					</a>
				</div>-->

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