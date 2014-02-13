<?php 

	require("../config.php");
    
    // At the top of the page we check to see whether the user 
    if(empty($_SESSION['usuario'])){ //is logged in or not 
        // If they are not, we redirect them to the login page. 
        header("Location: /fluent/formlogin.html");          
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to /fluent/formlogin.html"); 
    }     
    // Everything below this point in the file is secured by the login system

	//recupero variables

	//creo variables
 		$actual_month = $_SESSION['mes'];
		$actual_year = $_SESSION['ano'];

//leo todos los datos del student
    $idusuario = $_SESSION['id_usr_actual'];
    $result = mysql_query("SELECT * FROM usuario", $conexion);
		while ($row = mysql_fetch_array($result)){
			if($row['id_usuario'] == $idusuario){
					$_SESSION['susername']=$row['username_usuario'];	
			}else{}
		}
	//Recupero variables
		$student = $_SESSION['susername'];
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>FluentSpeaking - StudentPortal</title>

	<link rel="stylesheet" type="text/css" href="/fluent/backend/admin/css/normalize.css"/>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
	<link rel="stylesheet" type="text/css" href="/fluent/backend/student/css/style.css"/>
	<link rel="shortcut icon" href="/fluent/frontend/img/favicon.ico">


	<script src="/fluent/backend/student/js/prefixfree.min.js"></script>
	<script src="/fluent/backend/student/js/jquery.js"></script>
	<script src="/fluent/backend/student/js/fluent.js"></script>
	<script src="/fluent/backend/student/js/script.js"></script>

<!--<formulario para ? help>-->
	<script>                                        
		$(document).ready(function() {
			
		    $('.icon_tray #help_center').click(function() { 
		        $('#help_drop').slideToggle('fast', function() {
		         	$(".icon").css({"background-color":"#595e72","color":"#FFF"});
		        });

		    });
			$('form').focus(function(){  
				$(this).val('');   
			}); 
		});
	</script> 
</head>

<body>
	<header id="header">
        <div class="wrapper">
            <a href="/" class="logo"><img src="/fluent/backend/student/img/logo.png" alt="Bluehost - Professional Web Hosting"></a>
            <aside class="logged_in">
				<table border="0" align=right>
					<tr style="height:100px;">
			            <td style="width:100px;"><!-- Picture Profile -->
							<div id="picture"><!--<picture>-->
								<a href="#"><img src="img/mark.jpg" width="96" height="96"></a>
							</div>
			            </td>
			            <td style="width:250px;"><!-- description -->
							<div>
								<div><h11><b><?=$_SESSION['snombre']?></h11>  <h11><?=$_SESSION['sapellido']?></h11></b></div>
								<div><h12><?=$_SESSION['scity']?></h12> - <h12><?=$_SESSION['scountry']?></h12></div>
								<div><a style="text-decoration: none;" href="profile.php">Profile</a> | <a style="text-decoration: none;" href="/fluent/backend/logout.php">Logout</a></div>
							</div>
			            </td>
			        </tr>
				</table>
            </aside>
        </div>

        <div id="submenu">
            <div class="wrapper">
				<aside class="icon_tray">
	                <a href="#" id="new_event" class="current">Schedule your NEW LESSON!</a>	            	
	                <a href="#" id="help_center" class="icon">Help</a>
	                <div id="help_drop">
	                	<form action='mje.php' method = 'POST'>
	                	    <p>Need Help? Send Us a Message.<!-- (
	                	    	<a id="visit_help" class="small" href="#" target="_blank">Visit Now</a>)-->
	                	    </p>
	                	    <!--<input id="help_search" name="search" type="text">-->
	                	    <textarea id="help_mje" name="mje" placeholder="message" style="width:250px;height:70px;" autofocus required></textarea>
	                	    <input class="btn_primary" type="submit" value="Send">
	                	</form>
	                	<div id="help_more">
							<p class="small">Still need help? Call us directly. Our top-rated customer service agents will be happy to assist you any time.</p>
							<p><small>Toll-free GERMANY</small>
								<a href="tel:711-59600660">711-59600660</a>
							</p>
							<p><small>Outside</small>
								<a href="tel:711 5960066-9 ">(+49) 711-59600669</a>
							</p>
	                	</div>
	                </div>
				</aside>

                <nav class="main_nav">
                    <ul class="clear">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Evaluation & Test</a></li>
                    </ul>
                </nav>
            </div>
        </div>
			<?php 	$ccl_total = 0;	$cot_total = 5; $schedule_total = 3;$completed_total = 10;$hrs_total = 0;?>
	    <div class="wrapper_overview">
	        <div class="events">
	        	<nav>
			  		<ul>
						<li>DONE<span class="badge"><?php echo" ".$completed_total." "; ?></span></li>
						<li>SCHEDULE<span class="badge green"><?php echo" ".$schedule_total." "; ?></span></li>
						<li>CANCELLED ON TIME(COT)<span class="badge yellow"><?php echo" ".$cot_total." "; ?></span></li>
						<li>CLIENT CANCELLED LATE(CCL)<span class="badge red"><?php echo" ".$ccl_total." "; ?></span></li>
						<li>TOTAL(min.)<span class="badge white"><?php echo" ".$hrs_total." "; ?></span></li>
			   		</ul>
			   	</nav>
			</div>
		</div>		
    </header>
	
<!-- MAIN CONTENT -->
	<div id="content">



	</div>	

<!-- FOOTER -->
	<div id="footer">
			<p>Copyright 2012 &copy;<a href="http://www.fluentspeaking.de">FLUENTSPEAKING</a>. All rights reserved.</p>
	</div> 

</body>
</html>

<!-- end webPage -->