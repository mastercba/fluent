<?php 
	session_start();

	if(($_SESSION['adlogin'])=="si" && $_SESSION['level'] == "0"){

	//Recupero Variables	
	$idadm = $_GET['admid'];

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
		<li class="selected"><a href="/fluent/backend/admin/php/admins.php">ADMINs</a></li>
		<li><a href="/fluent/backend/admin/php/trainer.php">TRAINERs</a></li>
		<li><a href="#">STUDENTs</a></li>
		<li><a href="#">UNITs</a></li>
	</ul>
	<br />
	
	<!-- MAIN CONTENT -->
	<section>
		<div id="table_admins">
			<center>					
				<table border=0 width=100%>					
					<tr align=center>
						<td><strong>ID</strong></td>
						<td><strong>User</strong></td>
						<td><strong>Password</strong></td>
						<td><strong>Name</strong></td>
						<td><strong>Last</strong></td>
						<td><strong>Level</strong></td>
						<td><strong>LastVisit</strong></td>
						<td><strong>Status</strong></td>
						<td><strong>Actions</strong></td>
					</tr>
<?php
	//conexion
		$conexion = mysql_connect("localhost","dbo469629526","~marco123");
		if(!$conexion){
			die ("No he podido conectar por la siguiente razon: ".mysql_error());
		}	
		mysql_select_db("db469629526",$conexion); 
		$result = mysql_query("SELECT * FROM administra", $conexion);

		while($row = mysql_fetch_array($result)){
				$adid = $row['id'];
			if($idadm == $adid){
			
				    $adid = $row['id'];

				echo"<tr>
				<form action='saveadm.php' method = 'POST'>
				<td>".$adid."</td>
				<td><input type='text' name='naduser' value='".$row['user']."' size=3></td>
				<td><input type='text' name='nadpassword' value='".$row['password']."' size=5></td>
				<td><input type='text' name='nadname' value='".$row['name']."' size=7></td>
				<td><input type='text' name='nadlast' value='".$row['last']."' size=7></td>
				<td><input type='text' name='nadlevel' value='".$row['level']."' size=2></td>
				<td><input type='text' name='nadlastvisit' value='".$row['lastvisit']."' size=10></td>
				<td><input type='text' name='nadstatus' value='".$row['status']."' size=2></td>
			    <td><input type='image' src='../img/tick.png' width='14' height=14'/>
				|<a href='admins.php'><img src='../img/backward.png' width='14' height=14'></a></td>
				</form>
				</tr>";
					
	//cerrar
		mysql_close($conexion);
		
		$_SESSION['idadm'] = $adid;
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
