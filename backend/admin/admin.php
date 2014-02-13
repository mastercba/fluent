<?php 

	require("../config.php");

	//recupero variables

	//creo variables
 		$actual_month = $_SESSION['mes'];
		$actual_year = $_SESSION['ano'];    
    // At the top of the page we check to see whether the user 
    if(empty($_SESSION['usuario'])){ //is logged in or not 
        // If they are not, we redirect them to the login page. 
        header("Location: /fluent/formlogin.html");          
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to /fluent/formlogin.html"); 
    }     
    // Everything below this point in the file is secured by the login system

    // update 'lastvisit' date de la db
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>FluentSpeaking - AdminPortal</title>

	<link rel="stylesheet" type="text/css" href="/fluent/backend/admin/css/normalize.css"/>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
	<link rel="stylesheet" type="text/css" href="/fluent/backend/admin/css/estilos_adm.css"/>
	<link rel="shortcut icon" href="/fluent/frontend/img/favicon.ico">


	<script src="/fluent/backend/admin/js/prefixfree.min.js"></script>
	<script src="/fluent/backend/admin/js/jquery.js"></script>
	<script src="/fluent/backend/admin/js/fluent.js"></script>
	<script src="/fluent/backend/admin/js/script.js"></script> 
</head>

<body>
	<div id="top_menu"><!--<menu superior>-->
		<div id="menu">
			<a href="/fluent/backend/logout.php" title="Salir!">Logout</a>
		</div>        
	</div>
	<div id="logo"><!--<logo>-->
		<a style="text-decoration: none; margin-left: 12px;" href="http://www.fluentspeaking.com" title="FluentSpeaking">
		    <img style="margin-top: 2px;" height="39" src="/fluent/frontend/img/logo_last.png" alt="Fluent Speaking" />
		</a>
	</div>
	<br />
	<ul class="tabrow"><!--- Tabs Menu -->
		<li class="selected"><a href="/fluent/backend/admin/admin.php">WEBPAGE</a></li>
		<li><a href="/fluent/backend/admin/account.php">ACCOUNTING</a></li>
		<li><a href="/fluent/backend/admin/admins.php">ADMINs</a></li>
		<li><a href="/fluent/backend/admin/trainer.php">TRAINERs</a></li>
		<li><a href="/fluent/backend/admin/student.php">STUDENTs</a></li>
		<li><a href="#">UNITs</a></li>
	</ul>
	<br />
	
	<!-- MAIN CONTENT -->
	<section>
		<div id="table_web_stats">
			<center>					
				<table border=0 width=100%>					
					<tr align=center>
						<td><strong>ID</strong></td>
						<td><strong>IP</strong></td>
						<td><strong>Date</strong></td>
						<td><strong>Time</strong></td>
					</tr>
<?php
	//conexion
		//$conexion = mysql_connect("localhost","dbo469629526","~marco123");
		//if(!$conexion){
		//	die ("No he podido conectar por la siguiente razon: ".mysql_error());
		//}	
		//mysql_select_db("db469629526",$conexion); 
		$result = mysql_query("SELECT * FROM visitas", $conexion);	
	
		while($row = mysql_fetch_array($result)){
				    $webid = $row['id'];
				    $webip = $row['ip'];
				    $webfecha = $row['fecha'];
				    $webhora = $row['hora'];

			echo"<tr align=center><td>".$webid."</td><td>".$webip."</td><td>".$webfecha."</td>
			<td>".$webhora."</td></tr>";			
		}		   	
		//mysql_close($conexion);
?>
				</table>					
			</center>			
		</div> <!-- end content -->
	<br /><br />
	</section>
	
<!-- FOOTER -->
	<div id="footer">
		<p>Copyright 2012 &copy;<a href="http://www.fluentspeaking.de">FLUENTSPEAKING</a>. All rights reserved.</p>
		<!--<p><strong>AdminPortal </strong> by &copy;<a href="http://www.fluentspeaking.com"> QUANTICA SOFT, LLC</a></p>-->
	</div> 
<!-- end footer -->

</body>
</html>

<!-- end webPage -->

