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
		
		$result = mysql_query("SELECT * FROM students", $conexion);

		while ($row = mysql_fetch_array($result)){
			if($row['usuario_students'] == $student){

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
					$_SESSION['sphonecode']=$row['phonecode_students'];
					$_SESSION['stelefono']=$row['telefono_students'];
					$_SESSION['sphoneext']=$row['phoneext_students'];
					$_SESSION['scelular']=$row['celular_students'];
					$_SESSION['semail']=$row['email_students'];
					$_SESSION['sskype']=$row['skype_students'];
					$_SESSION['scountry']=$row['country_students'];			
					$_SESSION['scode']=$row['code_students'];
					//$_SESSION['sposition']=$row['teacher_asig'];    //student position
					$_SESSION['sasig']=$row['asig_students'];	
			}else{}
		}
  
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
            <a href="/" class="logo"><img src="/fluent/backend/student/img/logo.png" alt="FluentSpeaking"></a>
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

	                <a href="javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"
	                id="new_event" class="icon1">Schedule your NEW LESSON!</a>
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

<!-- ADD a NEW Schedule! -->
			

<form action='savenew.php' method = 'POST'>
				<div id="light" class="white_content">
				<h10><span>CREATE A NEW EVENT</span><br /></h10>
								
				<hr><div class="hr"></div></hr>
			
			<td></td>
			<th></th><br />
			<span>TEACHER:</span><br /><br />
			<td></td>
			<th></th>
			<span>STUDENT:</span><br /><br />

			<span>DATE: </span>			
			<th><input type='date' name='eevent_date' value=''></th>
			<th></th>
			<span>TIME: </span>
			<th><input type='time' name='eevent_time' value=''></th>
			<th></th>			
			<br /><br />
			<span>LENGTH: </span>
			<th><input type='number' name='ehrs' min='15' max='90' step='15' value='30'></th>
			<th></th>
			
			<span>MEDIA: </span>
			<th><select name=eidmedia>
				<option>select</option>
    				<option>SKYPE</option>
    				<option>PHONE</option>
    				<option>nPHONE</option>
    			    </select></th>
			<span> STATUS: </span>
			<th><select name=eidstatus>
				<option>select</option>
    				<option>SCHEDULE</option>
    				<option>DONE</option>
    				<option>CCL</option>
    				<option>COT</option>
    			    </select></th>
			<td></td>
			<th></th>
			<br /><br />
			<span>UNIT: </span>
						

			<br /><br /><br /></h1>
			<center><th>
				<a href = "javascript:void(0)" onclick = "document.getElementById('light')
				.style.display='none';document.getElementById('fade').style.display='none'"
				/>CLOSE</a> 

				<span> | </span>
				<input href = "javascript:void(0)" onclick = "document.getElementById('light')
				.style.display='none';document.getElementById('fade').style.display='none'" 
				type="submit" value="ADD" />
			</th></center>
				</div>
		
			<div id="fade" class="black_overlay"></div>
</form>	

<!-- END..... ADD a NEW Schedule! -->					




	               	            	


                <nav class="main_nav">
                    <ul class="clear">
                        <li class="current"><a href="#">Home</a></li>
                        <li><a href="csummary.php">My Account</a></li>
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
		<div id="sub">
			<div id="notices">
				<h9>Notices</h9>
				<div id="noticeboard">
					<div align="center">
						<a href="#" id="global_news_link" target="_blank">
        					<img src="img/toefl1.png" id="global_news_image" border="0">
    					</a>	
					</div>	
				</div>	
			</div>
			<!-- end notices -->
			<div id="content_stats">
				<div id="stats-header"></div>
				<table id="stats" cellspacing="0" cellpadding="0"></table>
				<div id="content-stats-end"></div>
			</div>
			<!-- end content_stats -->
		</div>

		<div id="main">
			<div id="boxes">
				<div id="next" class="itembox">
					<!--<div id="mail-bdrop" class="celldrop">&nbsp;</div>-->
					<div class="cellbox">
						<div class="cellbox-header">
							<h6 id="next-header" title="Double click to collapse/expand. Click to drag." class="index_box_header" ondblclick="rollbox(this);">Next Lessons</h6>
							<div id="next-expander" class="box-collapse-control" onclick="rollbox(this);">&nbsp;</div>
						</div>
						<div class="next-body" class="cellbox-body">
								<p>ksjdskjfsdkjfhsdjkg</p>
								<!-- next detail -->
						</div>	
					</div>	
					<!--<div id="mail-adrop" class="celldrop">&nbsp;</div>-->
				</div>
				<div id="recent" class="itembox">
					<div id="mail-bdrop" class="celldrop">&nbsp;</div>
					<div class="cellbox">
						<div class="cellbox-header">
							<h6 id="mail-header" title="Double click to collapse/expand. Click to drag." class="index_box_header" ondblclick="rollbox(this);">Recent Lessons</h6>
							<div id="mail-expander" class="box-collapse-control" onclick="rollbox(this);">&nbsp;</div>
						</div>
						<div class="mail-body" class="cellbox-body">
								<p>ksjdskjfsdkjfhsdjkg</p>
								<!-- next detail -->
						</div>	
					</div>	
					<div id="mail-adrop" class="celldrop">&nbsp;</div>					
				</div>
				<div id="archived" class="itembox">
					<div id="mail-bdrop" class="celldrop">&nbsp;</div>
					<div class="cellbox">
						<div class="cellbox-header">
							<h6 id="mail-header" title="Double click to collapse/expand. Click to drag." class="index_box_header" ondblclick="rollbox(this);">Archived Lessons</h6>
							<div id="mail-expander" class="box-collapse-control" onclick="rollbox(this);">&nbsp;</div>
						</div>
						<div class="mail-body" class="cellbox-body">
								<p>ksjdskjfsdkjfhsdjkg</p>
								<!-- next detail -->
						</div>	
					</div>	
					<div id="mail-adrop" class="celldrop">&nbsp;</div>					
				</div>	
			</div>			
		</div>
	</div>	

<!-- FOOTER -->
	<div id="footer">
			<p>Copyright 2012 &copy;<a href="http://www.fluentspeaking.de">FLUENTSPEAKING</a>. All rights reserved.</p>
	</div> 

</body>
</html>

<!-- end webPage -->

