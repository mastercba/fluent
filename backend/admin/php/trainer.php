<?php 
	session_start();

	if(($_SESSION['adlogin'])=="si" && $_SESSION['level'] == "0"){

	//Crear variables
	$actual_month = $_SESSION['mes'];
	$actual_year = $_SESSION['ano'];
	//$filter_student = $_SESSION['filterStudent'];

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
		<li><a href="/fluent/backend/admin/php/account.php">ACCOUNTING</a></li>
		<li><a href="/fluent/backend/admin/php/admins.php">ADMINs</a></li>
		<li class="selected"><a href="/fluent/backend/admin/php/trainer.php">TRAINERs</a></li>
		<li><a href="#">STUDENTs</a></li>
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
	//conexion
		$conexion = mysql_connect("localhost","dbo469629526","~marco123");
		if(!$conexion){
			die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("db469629526",$conexion); 
		$result1 = mysql_query("SELECT * FROM trainers", $conexion);	
	
		while($row2 = mysql_fetch_array($result1)){
				    $tid = $row2['id'];
				    $tstatus = $row2['status'];
				    $tlang = $row2['lang'];
				    $tusuario = $row2['usuario'];
				    $tpassword = $row2['password'];
				    $tnombre = $row2['nombre'];
				    $tapellido = $row2['apellido'];
				    $tcelular = $row2['celular'];
				    $temail = $row2['email'];
				    $tskype = $row2['skype'];
				    $tolp = $row2['olp'];
				    $tcountry = $row2['country'];
			echo"<tr><td align=center>".$tid."</td><td align=center>".$tstatus."</td>
			<td align=center>".$tlang."</td><td>".$tusuario."</td><td>".$tpassword."</td>
			<td>".$tnombre."</td><td>".$tapellido."</td><td align=center>".$tcelular."</td>
			<td>".$temail."</td><td>".$tskype."</td><td>".$tolp."</td>
			<td align=center>".$tcountry."</td>
			<td align=center><a href='edittra.php?trid=".$tid."'><img src='../img/pencil.png' width='14' height=14'></a>
			|<a href='eliminartra.php?trid=".$tid."'><img src='../img/trash.png' width='14' height=14'></a>
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
					<td><p></p><input type='image' src='../img/add.png' width='14' height=14'/></td>
				</tr>";
		   	
		mysql_close($conexion);
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
<?php	
//	$_SESSION['adlogin'] = "no";
	}else{

	echo '<meta http-equiv="REFRESH" content="0,url=/fluent/formlogin.html">';

	}
?>
