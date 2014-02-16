<?php
	session_start();

//echo" ".$_SESSION['usuario']." ".$_SESSION['password']." ";
	//if(($_SESSION['adlogin'])=="si"){
	
	//Recupera variables
	$llego = $_GET['unidos'];
	
	//Crear variables
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$teacherid = $_SESSION['teacherid'];

	//separa las variable
	$code_unit = strtok($llego," ");
	$eventid = strtok(" "); 
	//pone .pdf al codigo del modulo
	$ext_unit = ".pdf";
	$unit2dis = $code_unit.$ext_unit;
	
	$unit2open = "/backend/units/$unit2dis";
	//crea variables de SESSION
	$_SESSION['eventid'] = $eventid;
	//$mark = '45';
	//echo"$mark";

?>
<!---------- start webPage ---------------->
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>LANGUACOM - Trainer Portal</title>
	
	<!-- Stylesheets -->
<style type="text/css">
@import "jquery.countdown.css";

#highlightCountdown { width: 100px; height: 15px; }
</style>


	<!--<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>-->
	<link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/style4.css" />				<!--tab izquierdo  -->
	<LINK REL="SHORTCUT ICON" HREF="../images/favicon.ico">					  <!--  -->

	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<script src="../js/jquery.js"></script>
	<script src="../js/script.js"></script>  
	<script type="text/javascript" src="../js/jquery.countdown.js"></script>		<!-- countdown -->

	<script type="text/javascript" src="../js/modernizr.custom.04022.js"></script>		<!--tab izquierdo-->

												<!-- countdown -->
	<script type="text/javascript">					
		$(function () {
			$('#highlightCountdown').countdown({until: 0, compact: true, 
			    onTick: highlightLast5}); 
			     
			function highlightLast5(periods) { 
			    if ($.countdown.periodsToSeconds(periods) == 300) { 
				$(this).addClass('highlight'); 
			    } 
			} 
 
			$('#highlightButton').click(function() { 
			    $('#highlightCountdown').removeClass('highlight'). 
				countdown('option', {until: +(2700), compact: true}); 
			});


			//$('#pauseResume').countdown({onTick: highlightCountdown}); 
 
			//$('#pauseButton').toggle(function() { 
			//	$(this).text('Resume'); 
			//	$('#pauseResume').countdown('pause'); 
			//}, 
			//			function() { 
			//	$(this).text('Pause'); 
			//	$('#pauseResume').countdown('resume'); 
			//}); 
 
//function showPauseTime(periods) { 
//    $('#showPauseTime').text(periods[4] + ':' + twoDigits(periods[5]) + 
//        ':' + twoDigits(periods[6])); 
//}
		});
	</script>

</head>
<body>
<!------------------------------------------------------- TOP BAR -------------------------------------------------------->
	<div id="top-bar">
		
		<div class="page-full-width cf">

			<ul id="nav" class="fl">
	
				<!--<li class="v-sep"><a href="#" class="round button dark ic-left-arrow image-left">Go to website</a></li>-->
				<li class="v-sep"><a href="#" class="round button dark menu-user image-left">Logged in 
				<strong><?php echo" : ".$_SESSION['nombre']." ".$_SESSION['apellido']." "; ?></strong></a>
					<ul>
						<li><a href="#">My Profile</a></li>
						<li><a href="#">User Settings</a></li>
						<li><a href="#">Change Password</a></li>
						<li><a href="account.php">Account Summary</a></li>
						<li><a href="/backend/logout.php">Log out</a></li>
					</ul> 
				</li>
			
				<!--<li><a href="#" class="round button dark menu-email-special image-left">3 new messages</a></li> -->
				<li class="v-sep"><a href="/backend/logout.php" class="round button dark menu-logoff image-left">Log out</a></li>
				<li class="v-sep" class="fr"><h1 class="round button dark"><strong>STUDENT :<?php echo" ".$_SESSION['snombre']." ".$_SESSION['sapellido']." "; ?></strong></h1></li>
				
			</ul> <!-- end nav -->

					
			<!--<form action="#" method="POST" id="search-form" class="fr">
				<fieldset>
					<input type="text" id="search-keyword" class="round button dark ic-search image-right" placeholder="Search..." />
					<input type="hidden" value="SUBMIT" />
				</fieldset>
			</form>-->

		</div> <!-- end full-width -->	
	
	</div> 
<!------------------------------------------------------- END TOP BAR -------------------------------------------------------->	
		
	<!--------- HEADER TABS -------->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
	
			<ul id="tabs" class="fl">
				<li><a href="#">Overview</a></li>
				<li><a href="#"> Your Calendar</a></li>
				<!--<li><a href="virtualclass.php" class="active-tab dashboard-tab">Virtual Class</a></li> -->
				<li><a href="#">Student Profile</a></li>
				<li><a href="#">Training Report</a></li>
				<li><a href="#">Training Information & Resources</a></li>
			</ul> <!-- end tabs -->
			
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 30px height.
			<a href="#" id="company-branding" class="fr"><img src="/backend/images/logo1.png" alt="Fluent Speaking" />
			<img src="/backend/images/logo2.png" alt="Fluent Speaking" /></a>-->
			<a href="#" id="company-branding" class="fr">
			<img src="/backend/images/logo2.png" alt="Fluent Speaking" /></a>	
			
		</div> <!-- end full-width -->	

	</div>
	<!--------- END HEADER -------->
		
<!--------------------- MAIN CONTENT ---------------------->
<div id="content">
<div class="page-full-width cf">
	<center>	
		<div id="leftup">
		<tr>
			<iframe src<?php echo"=$unit2open";?> style="border:1px #FFFFFF dotted;" width = 1000px height = 440px
			frameborder="0" marginheight="0px" marginwidth="0px" scrolling="no"></iframe>

		</tr>			
		</div>

		<div id="tools">
		<tr>			
				<!--<td width='2'>[]</td> -->
				<td>
				<a href="reportevent.php?eventid<?php echo'='.$eventid.'';?>"><img src="../images/tick.png" width="14" height="14"/></a>
				| <a href="overview.php" ><img src="../images/log_out.png" width="14" height="14"/></a>
				<!-- timer -->
				| 
				</td> 
		</tr>		
		</div>

		<div id="timer1">
		<tr>
			<span id="highlightCountdown" class="countdown"></span>
			<button id="highlightButton">Restart</button>
			<!--<button type="button" id="pauseButton">Resume</button> -->
		</tr>
		</div>

		<div id="rightone">
		<tr>


		</tr>		
		</div>

		<div id="righttwo">
		<tr>



		</tr>		
		</div>

		<div id="rightthree">
		<tr>
			<td><h8></h8></td><br /><td></td>
			<td></td>
		</tr>		
		</div>

		<div id="leftall">
		<tr>
			<td><h8></h8></td><br /><td></td>
			<td></td>
		</tr>		
		</div>
	</center>
</div>
</div> <!-- end content -->
	
<!---------------------- FOOTER --------------------------->
	<div id="footer">

		<p>Copyright 2012 <a href="http://www.languacom.de">&copy; LANGUACOM</a>. All rights reserved.</p>
		<!--<p><strong>TeacherPortal </strong> by &copy;<a href="http://www.fluentspeaking.com"> QUANTICA SOFT, LLC</a></p>-->
	
	</div> <!-- end footer -->
<!---------------------- END FOOTER --------------------------->

</body>
</html>
<!---------- end webPage ---------------->
<?php	

//	$_SESSION['adlogin'] = "no";
//	}else{

//	echo '<meta http-equiv="REFRESH" content="0,url=../index.php">';

//	}
?>
