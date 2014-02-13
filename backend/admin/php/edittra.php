<?php 
	session_start();

	if(($_SESSION['adlogin'])=="si" && $_SESSION['level'] == "0"){

	//Recupero Variables	
	$idtra = $_GET['trid'];
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
		$result = mysql_query("SELECT * FROM trainers", $conexion);

		while($row = mysql_fetch_array($result)){
				$traid = $row['id'];
			if($idtra == $traid){
			
				    $traid = $row['id'];
				echo"<tr align=center>
				<form action='savetra.php' method = 'POST'>
				<td>".$traid."</td>
				<td><input type='text' name='ntrastatus' value='".$row['status']."' size=2></td>
				<td><input type='text' name='ntralang' value='".$row['lang']."' size=4></td>
				<td><input type='text' name='ntrausuario' value='".$row['usuario']."' size=7></td>
				<td><input type='text' name='ntrapassword' value='".$row['password']."' size=7></td>
				<td><input type='text' name='ntranombre' value='".$row['nombre']."' size=7></td>
				<td><input type='text' name='ntraapellido' value='".$row['apellido']."' size=7></td>
				<td><input type='text' name='ntracelular' value='".$row['celular']."' size=6></td>
				<td><input type='text' name='ntraemail' value='".$row['email']."' size=8></td>
				<td><input type='text' name='ntraskype' value='".$row['skype']."' size=8></td>
				<td><input type='text' name='ntraolp' value='".$row['olp']."' size=8></td>
				<td><input type='text' name='ntracountry' value='".$row['country']."' size=6></td>
			    <td><input type='image' src='../img/tick.png' width='14' height=14'/>
				|<a href='trainer.php'><img src='../img/backward.png' width='14' height=14'></a></td>
				</form>
				</tr>";
					
	//cerrar
		mysql_close($conexion);
		
		$_SESSION['idtra'] = $idtra;
//		break;

//		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=trainer.php">';

			}else{}

		}		   			 
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