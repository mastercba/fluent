<?php 

	require("../config.php");

	//recupero variables

	//creo variables

		//$filter_student = $_SESSION['filterStudent'];

    // At the top of the page we check to see whether the user 
    if(empty($_SESSION['usuario'])){ //is logged in or not 
        // If they are not, we redirect them to the login page. 
        header("Location: /fluent/formlogin.html");          
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to /fluent/formlogin.html"); 
    }     
    // Everything below this point in the file is secured by the login system  
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
		<li class="selected"><a href="/fluent/backend/admin/admins.php">ADMINs</a></li>
		<li><a href="/fluent/backend/admin/trainer.php">TRAINERs</a></li>
		<li><a href="/fluent/backend/admin/student.php">STUDENTs</a></li>
		<li><a href="#">UNITs</a></li>
	</ul>
	<br />
	
	<!-- MAIN CONTENT -->

<?php
	    $query = " 
	        SELECT 
	            id_admins, 
	            user_admins,
	            name_admins,
	            last_admins,
	            level_admins,
	            lastvisit_admins,
	            status_admins, 
	            email_admins 
	        FROM admins 
	    "; 
	    try 
		    { 
		        // These two statements run the query against your database table. 
		        $stmt = $db->prepare($query); 
		        $stmt->execute(); 
		    } 
	    catch(PDOException $ex) 
		    { 
		        // Note: On a production website, you should not output $ex->getMessage(). 
		        // It may provide an attacker with helpful information about your code.  
		        die("Failed to run query: " . $ex->getMessage()); 
		    } 
	         
	    // Finally, we can retrieve all of the found rows into an array using fetchAll 
	    $rows = $stmt->fetchAll(); 
?> 
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
						<td><strong>e-mail</strong></td>
						<td><strong>Level</strong></td>
						<td><strong>LastVisit</strong></td>
						<td><strong>Status</strong></td>
						<td><strong>Actions</strong></td>
					</tr>
					
<?php 
		$result = mysql_query("SELECT * FROM admins", $conexion);	
	
		while($row = mysql_fetch_array($result)){
				    $admid = $row['id_admins'];
				    $admiuser = $row['user_admins'];
				    $admname = $row['name_admins'];
				    $admlast = $row['last_admins'];
				    $admemail = $row['email_admins'];
				    $admlevel = $row['level_admins'];
				    $admlastvisit = $row['lastvisit_admins'];
				    $admstatus = $row['status_admins'];
				    
			echo"<tr align=center><td>".$admid."</td><td>".$admiuser."</td>
			<td>*******</td><td align=left>".$admname."</td><td align=left>".$admlast."</td><td align=left>".$admemail."</td>
			<td>".$admlevel."</td><td>".$admlastvisit."</td><td>".$admstatus."</td>
			<td><a href='eliminaradm.php?admid=".$admid."'><img src='img/trash.png' width='14' height=14'></a>
			</td>
			</tr>";			
		}
	//Anadir un nuevo registro
			echo"
				<tr align=center>
					<form action='newadm.php' method = 'POST'>
					<td></td>
					<td><input type='text' name='aduser' value='' size=3></td>
					<td><input type='text' name='adpassword' value='' size=5></td>
					<td><input type='text' name='adname' value='' size=7></td>
					<td><input type='text' name='adlast' value='' size=7></td>
					<td><input type='text' name='ademail' value='' size=20></td>
					<td><input type='text' name='adlevel' value='' size=2></td>
					<td>".$_SESSION['fecha']."</td>
					<td><input type='text' name='adstatus' value='' size=2></td>
					<td><p></p><input type='image' src='img/add.png' width='14' height=14'/></td>
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
