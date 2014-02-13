<?php 

	require("../config.php");

	//recupero variables

	//creo variables
    
    // At the top of the page we check to see whether the user 
    if(empty($_SESSION['usuario'])){ //is logged in or not 
        // If they are not, we redirect them to the login page. 
        header("Location: /fluent/formlogin.html");          
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to /fluent/formlogin.html"); 
    }     
    // Everything below this point in the file is secured by the login system

	//Recupero Variables	
	$idacc = $_GET['acid'];
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
						<td><strong>Date</strong></td>
						<td align=left><strong>Description</strong></td>
						<td><strong>#</strong></td>
						<td><strong>Income</strong></td>
						<td><strong>Egress</strong></td>
						<td><strong>Balance</strong></td>
						<td><strong>Class</strong></td>
						<td><strong>Number</strong></td>
						<td><strong>Actions</strong></td>
					</tr>
<?php
		$result = mysql_query("SELECT * FROM account", $conexion);

		while($row = mysql_fetch_array($result)){
				$accid = $row['id_account'];
			if($idacc == $accid){
			
				    $accid = $row['id_account'];
				echo"<tr align=center>
				<form action='saveacc.php' method = 'POST'>
				<td>".$accid."</td>
				<td><input type='text' name='nfecha' value='".$row['fecha_account']."' size=8></td>
				<td align=left><input type='text' name='ndetalle' value='".$row['detalle_account']."' size=25></td>
				<td><input type='text' name='ntransaccion' value='".$row['transaccion_account']."' size=7></td>
				<td><input type='text' name='ningresos' value='".$row['ingresos_account']."' size=7></td>
				<td><input type='text' name='negresos' value='".$row['egresos_account']."' size=7></td>
				<td><input type='text' name='nsaldo' value='".$row['saldo_account']."' size=7></td>
				<td><input type='text' name='ntipo' value='".$row['tipo_account']."' size=3></td>
				<td><input type='text' name='nnumero' value='".$row['numero_account']."' size=3></td>
			    <td><input type='image' src='img/tick.png' width='14' height=14'/>
				|<a href='account.php'><img src='img/backward.png' width='14' height=14'></a></td>
				</form>
				</tr>";
		
		$_SESSION['idacc'] = $idacc;
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
