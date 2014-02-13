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
		<li><a href="/fluent/backend/admin/admin.php">WEBPAGE</a></li>
		<li><a href="/fluent/backend/admin/account.php">ACCOUNTING</a></li>
		<li><a href="/fluent/backend/admin/admins.php">ADMINs</a></li>
		<li class="selected"><a href="/fluent/backend/admin/trainer.php">TRAINERs</a></li>
		<li><a href="/fluent/backend/admin/student.php">STUDENTs</a></li>
		<li><a href="#">UNITs</a></li>
	</ul>
	<br />
	
	<!-- MAIN CONTENT -->

	<section>
		<div id="table_trainer">
			<center>					
				<table border=0 width=100%>					
					<tr align=center>
						<td><strong>ID</strong></td>
						<td><strong>Status</strong></td>
						<td><strong>lang</strong></td>
						<td><strong>user</strong></td>
						<td><strong>password</strong></td>
						<td><strong>Name</strong></td>
						<td><strong>Last</strong></td>
						<td><strong>Celular</strong></td>
						<td><strong>e-mail</strong></td>
						<td><strong>Skype</strong></td>
						<td><strong>CV</strong></td>
						<td><strong>Country</strong></td>
						<td><strong>Actions</strong></td>
					</tr>
<?php

		$result1 = mysql_query("SELECT * FROM trainers", $conexion);	
	
		while($row2 = mysql_fetch_array($result1)){
				    $tid = $row2['id_trainers'];
				    $tstatus = $row2['status_trainers'];
				    $tlang = $row2['lang_trainers'];
				    $tusuario = $row2['usuario_trainers'];
				    $tpassword = '*******';
				    $tnombre = $row2['nombre_trainers'];
				    $tapellido = $row2['apellido_trainers'];
				    $tcelular = $row2['celular_trainers'];
				    $temail = $row2['email_trainers'];
				    $tskype = $row2['skype_trainers'];
				    $tolp = $row2['olp_trainers'];
				    $tcountry = $row2['country_trainers'];
			echo"<tr><td align=center>".$tid."</td><td align=center>".$tstatus."</td>
			<td align=center>".$tlang."</td><td>".$tusuario."</td><td align=center>".$tpassword."</td>
			<td>".$tnombre."</td><td>".$tapellido."</td><td align=center>".$tcelular."</td>
			<td>".$temail."</td><td>".$tskype."</td><td>".$tolp."</td>
			<td align=center>".$tcountry."</td>
			<td align=center><a href='eliminartra.php?trid=".$tid."'><img src='img/trash.png' width='14' height=14'></a>
			</td></tr>";
		}		   	
		 
	//Anadir un registro
			echo"
				<tr>
					<form action='newtra.php' method = 'POST'>
					<td></td>
					<th><input type='text' name='tstatus' value='' size=2></th>
					<th><input type='text' name='tlang' value='' size=4></th>
					<th><input type='text' name='tusuario' value='' size=7></th>
					<th><input type='text' name='tpassword' value='' size=7></th>
					<th><input type='text' name='tnombre' value='' size=7></th>
					<th><input type='text' name='tapellido' value='' size=7></th>
					<th><input type='text' name='tcelular' value='' size=6></th>
					<th><input type='text' name='temail' value='' size=8></th>
					<th><input type='text' name='tskype' value='' size=8></th>
					<th><input type='text' name='tolp' value='' size=8></th>
					<th><input type='text' name='tcountry' value='' size=6></th>					
					<td align=center><p></p><input type='image' src='img/add.png' width='14' height=14'/></td>
				</tr>";
		   	
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

