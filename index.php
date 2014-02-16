<!DOCTYPE html>
<html lang="al">
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
			    <a href="frontend/html/ale-soporte.html"> Kontaktieren Sie uns </a>|
			    <a href="frontend/html/ale-qsomos.html">Über uns </a>|
			    <!--<a href="certifica.html"> Certificaciones </a>|-->
			    <a href="frontend/html/ale-tduso.html"> Datenschutz </a>|
			    <a href="formlogin.html"> Geben </a>
			</div><!--c571c6--><!--/c571c6-->



        
		</div>

		<div id="logo"><!--<logo>-->
			<a style="text-decoration: none; margin-left: 12px;" href="http://www.fluentspeaking.com" title="FluentSpeaking">
			    <img style="margin-top: 2px;" src="frontend/img/logo_last.png" alt="FS-logo">
			</a>
		</div>

		<div id="lang"><!--<cambio de idioma>-->
			<div id="lang-wrapper">
			    <a style=" text-decoration: none; margin-left: 12px;" href="index.php" title="Deutsch">
			        <img style="margin-top: 2px; " src="frontend/img/de.png" width="18" height="18" alt="Deutsch-logo">
			    </a>
			    <a style=" text-decoration: none;margin-left: 8px;" href="indexen.php" title="Englisch">
			        <img style="margin-top: 2px; opacity:0.2;" src="frontend/img/uk.png" width="18" height="18" alt="Englisch-logo">
			    </a>
			    <a style=" text-decoration: none; margin-left: 5px;" href="indexes.php" title="Spanisch">
			        <img style="margin-top: 2px; opacity:0.2;" src="frontend/img/sp.png" width="20" height="20" alt="Español-logo">
			    </a>
			</div>        
		</div>

		<div id="logolangua"><!--<languacom group>-->

			<a href="http://www.languacom.de"><img src="frontend/img/logolanguagroup.png"></a>
		</div>

		<hgroup><!--<menu>-->
			<nav>
					<ul>
						<li><a href="frontend/html/ale-funciona.html" id="personalizar">Wie es funktioniert</a></li>
						<li><a href="#">Deutsch-Kurs</a>
							<ul>
								<li><a href="frontend/html/ale-alestesp.html">Students</a></li>
								<li><a href="frontend/html/ale-alprivesp.html">Privat</a></li>
								<li><a href="frontend/html/ale-alempesp.html">Firmen</a></li>
							</ul>
						</li>
						<li><a href="#">Englisch-Kurs</a><!--<ensp.html>-->
							<ul>
								<li><a href="frontend/html/ale-examenes.html">Prüfungsvorbereitung</a></li>
								<li><a href="frontend/html/ale-inestesp.html">Students</a></li>
								<li><a href="frontend/html/ale-inprivesp.html">Privat</a></li>
								<li><a href="frontend/html/ale-inempesp.html">Firmen</a></li>
							</ul>
						</li>	
						<li><a href="#">Spanischkurs</a>
							<ul>
								<li><a href="frontend/html/ale-espturesp.html">Spanisch für den Tourismus</a></li>
								<li><a href="frontend/html/ale-espestesp.html">Students</a></li>
								<li><a href="frontend/html/ale-espprivesp.html">Privat</a></li>
							</ul>
						</li>
						<li><a href="#">Französisch-Kurs</a>
							<ul>
								<li><a href="frontend/html/ale-frestesp.html">Students</a></li>
								<li><a href="frontend/html/ale-frprivesp.html">Privat</a></li>
							</ul>
						</li>						
					</ul>	
			</nav>
		</hgroup>

		<div id="phone"><img class="country_flags" id="flag-eeuu" src="frontend/img/de.png" width="10" height="10" alt="(DE Flag)">
			<span id="phone_number">+49 711 59600-662</span>
		</div>	

		<div id="info"><!--<solicitar mas informacion>-->
	   		    <a href="#" id="showlogin"> Fordern Sie weitere Informationen
	   		    	<span id="triangle_down">&#9660;</span>
	   		    	<span id="triangle_up" style="display:none;">&#9650;</span>
	   		    </a>	
				<div id="loginpanel" style="display:none;">
				    <form action="frontend/php/info.php" method="post">
				        Voller Name</br>
				        <input type="text" name="nombre" value="Name" id="nombre" size="12px"/>
				        <input type="text" name="apellido" value="Nachname" id="apellido" size="12px"/></br>
				        e-mail </br>
				        <input type="text" name="email" value="Mail@Beispiel.com" id="email" size="25px"/></br>
				        Was ist die Sprache der Ihr Interesse geweckt?</br>
						<select id="deseo" name="deseo" value="[wählen Sie eine]">
						  <option value="aleman">Deutsch</option>
						  <option value="ingles">Englisch</option>
						  <option value="espanol">Spanisch</option>
						  <option value="frances">Französisch</option>
						</select></br>
				        <button type="submit" id="submit">Senden</button>					
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
				<div id="un"><img src="frontend/img/ban2.png" /><figcaption><h3>FluentSpeaking bietet Kurse in Englisch, Deutsch, Französisch und Spanisch.</h3></figcaption></div>
								
				<div id="do"><img src="frontend/img/ban3.png" /><figcaption><h3>FluentSpeaking Kurse entwickeln eine personalisierte Online-Live-Klassen.</h3></figcaption></div>

				<div id="tre"><img src="frontend/img/ban7.png" /><figcaption><h3>FluentSpeaking verfügt über ein Team von zertifizierten Lehrer, ihre Muttersprache zu unterrichten.</h3></figcaption></div>
			</ul>
		 </article>
		</div>	
	</section>

	<section> <!--pgm-->
		<div id="pgm">
			<article id="pgm1"><a style=" text-decoration: none;" title="Deutsch"><img src="frontend/img/dede.png"/></a></article>
			<article id="pgm2"><a style=" text-decoration: none;" title="Englisch"><img src="frontend/img/deen.png"/></a></article>
			<article id="pgm3"><a style=" text-decoration: none;" title="Spanisch"><img src="frontend/img/desp.png"/></a></article>
			<article id="pgm4"><a style=" text-decoration: none;" title="Französisch"><img src="frontend/img/defr.png"/></a></article>
		</div>	
	</section>

	<section> <!--Intro & Video-->
		<div id="introyvideo">
			<article id="intro">
				<div id="introfs">
					<p>Willkommen auf der bahnbrechenden europäischen Schule Sprachunterricht per Telefon und Internet, bequem von zu Hause oder im Büro!</p>
					<p>• Live-Unterricht via Telefon oder Internet • Personalisierte Lehre • Muttersprachler und Zertifikate • Termine nach Ihrer Bequemlichkeit</P>
				</div>	
			</article>

			<article id="video2">
				<div style="text-align:center"> 
				  <!--<video id="video1" width="350" height="250" poster="frontend/img/first.png" controls>   autoplay controls-->
				  					  <!-- <img src="frontend/img/play_O.png" width="46" height="46">-->

				  	 

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
			<h2 class="tac pb30">Was sie über uns sagen</h2>      <!--What customers say about Us-->

				<ul id="columnas">
				        <div id="uno">
								<blockquote class="pl40 mb30"> <p>Sehr geehrtes LANGUACOM-Team,
								Zur Intensivierung meiner Englisch Sprachkenntnisse, nahm ich an einem Telefontraining teil. Das 30-minütige Telefontraining fand i.d.R. 1x wöchentlich statt. Die
								Terminabsprache und -findung funktionierte problemlos.
								Das Schulungsprogramm war sehr interessant. Es bestand sowohl aus Alltagskonversation als auch aus gezielten Übungen zur Verbesserung und Festigung meiner
								Englischkenntnisse. M .E. ist dies eine gelungene Mischung. Es bereitete mir sehr Spaß mit meiner Trainerin zusammen zu arbeiten. Die Atmosphäre war sehr angenehm.
								Vorteilhaft ist, dass meine Trainerin ein "Native Speaker" war und die gesamte Konversation ausschließlich auf Englisch lief.
								Meine Erfahrungen mit LANGUACOM waren sehr positiv. Meine Trainerin war sehr kompetent und konnte die Sprache gut vermitteln.
								Aufgrund der sehr positiven Erfahrungen, kann Ich LANGUACOM gerne weiterempfehlen.
								Herzliche Grüße</p> <cite><strong>Andreas Fröhlich</strong> T-Systems GEI GmbH  <a href="http://www.fluentspeaking.de/"></a> </cite> - Systems Integration </blockquote>
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
					    Copyright © 2013 FluentSpeaking. Alle Rechte vorbehalten.
					</p>
				</div>
			</div>	
		</div>		
	</footer>

</body>
</html>