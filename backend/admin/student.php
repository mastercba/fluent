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
		$filter_student = $_SESSION['FilterStudent'];
		$filter_trainer = $_SESSION['FilterTrainer'];
  
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
		<li><a href="/fluent/backend/admin/trainer.php">TRAINERs</a></li>
		<li class="selected"><a href="/fluent/backend/admin/student.php">STUDENTs</a></li>
		<li><a href="#">UNITs</a></li>
	</ul>
	<br />
	
<!-- MAIN CONTENT -->

<!-- linea de control -->
<center>
	<table>			
	<td><td>
		Trainer :</td><td>
		<form action="filterteacher.php" method="POST">
				<?php			 	
				$result = mysql_query("SELECT * FROM trainers ORDER BY nombre_trainers", $conexion);
		
				//declare the combo box
				$rows = array();
				$idx = 0;?>
				<select name="name">
							<option value="0"<?php if ($idx==0) echo 'selected="selected"';?>>all</option>;				
						<?php
						//list all of the other elements
						while ($row = mysql_fetch_array($result)){
						      $rows[$idx++] = array('value' => $row['id_trainers'], 'text' => $row['apellido_trainers']);?>
						<option value<?php echo"= ".$row['id_trainers']." ";?><?php if ($filter_trainer==$row['id_trainers']) echo 'selected="selected"';?>><?php echo" ".$row['nombre_trainers']." ".$row['apellido_trainers']." ";?></option>
						<?php
					}
					//close the combo box
					echo "</select>";
					?>
				<input type='image' src='img/tick.png' width='14' height='14'/>	
		</form>		

	</td><td>
		|  Student:</td><td>
		<form action="filterstudent.php" method="POST">
				<?php
						$result = mysql_query("SELECT * FROM students ORDER BY apellido_students", $conexion);
						
						//declare the combo box
						$rows = array();
						$idx = 0;?>
						<select name="name">
							<option value="0"<?php if ($idx==0) echo 'selected="selected"';?>>all</option>;				
						<?php
						//list all of the other elements
						while ($row = mysql_fetch_array($result)){
						      $rows[$idx++] = array('value' => $row['id_students'], 'text' => $row['apellido_students']);?>
						<option value<?php echo"= ".$row['id_students']." ";?><?php if ($filter_student==$row['id_students']) echo 'selected="selected"';?>><?php echo" ".$row['nombre_students']." ".$row['apellido_students']." ";?></option>
						<?php
						}
						//close the combo box
						echo "</select>";
						?>
				<input type='image' src='img/tick.png' width='14' height='14' />	
		</form>		
	</td><td>

	| <a href="addstudent.php" ><img src="img/add.png" width="14" height="14"/></a>
<!--	| <a href="delstudent.php"><img src="img/trash.png" width="14" height="14"></a>-->
	| <a href="#"><img src="img/pdf.png" width="14" height="14"></a>
	</td>
	</table>
</center>
<!-- end linea de control -->
<!-- Tabs Menu -->
	<ul class="tabrow">
		<li class="selected"><a href="#">General Information</a></li>
		<li><a href="booking.php">Booking Information</a></li>
		<li><a href="credit.php">Credit Summary</a></li>
		<li><a href="sunit.php">Units</a></li>
		<li><a href="sagenda.php">Training Agenda/Report</a></li>
	</ul>
<!-- end Tabs Menu -->
<!-- lee base de datos -->
		<?php
				$result = mysql_query("SELECT * FROM students", $conexion);	
			
				while($row = mysql_fetch_array($result)){
					if($row['id_students'] == $filter_student){

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
							$_SESSION['stelefono']=$row['telefono_students'];
							$_SESSION['scelular']=$row['celular_students'];
							$_SESSION['semail']=$row['email_students'];
							$_SESSION['sskype']=$row['skype_students'];
							$_SESSION['scountry']=$row['country_students'];			
							$_SESSION['scode']=$row['code_students'];
							$_SESSION['sasig']=$row['asig_students'];

		//recupera el nombre del entrenador
						$result4 = mysql_query("SELECT * FROM trainers", $conexion);	
						while($row4 = mysql_fetch_array($result4)){
							if($_SESSION['sasig'] == $row4['id_trainers']){
								$tname = $row4['nombre_trainers'];
								$tapellido = $row4['apellido_trainers'];	
								$_SESSION['sasig'] = "".$tname." ".$tapellido."";
								//$sasig = "".$tname." ".$tapellido."";
							}else{}
						}

						    //$sasig = $row['asig'];
					}else{}
				}

		?>
<!-- end db read -->
<!-- info basica -->

	<section>

		<article id="columna_izq">
			<div class="titul">	
				<tr><td><u>BASIC INFORMATION </u></td>	
					<td>
						<a href="editstud1.php" ><img src="img/pencil.png" width="14" height="14"/></a>
					</td>
				</tr>	
			</div>
			<div class="subtitul">			
					<tr><td><h10>First Name :  </h10><h9><b><?=$_SESSION['snombre']?></b></h9></td></tr><br />
					<tr><td><h10>Last Name :  </h10><h9><b><?=$_SESSION['sapellido']?></b></h9></td></tr><br />
					<tr><td><h10>Date of birth :  </h10><h9><b><?=$_SESSION['sbirth']?></b></h9></td></tr><br />
					<tr><td><h10>Gender :  </h10><h9><b><?=$_SESSION['sgender']?></b></h9></td></tr><br />
					<tr><td><h10>HomeTown :  </h10><h9><b><?=$_SESSION['shtown']?></b></h9></td></tr><br />
					<tr><td><h10>Address :  </h10><h9><b><?=$_SESSION['saddr']?></b></h9></td><td></td></tr><br />
			</div>
		</article>

		<article id="columna_der">
			<div class="titul">
				<tr>
					<td align=left><u>SETTINGS</u></td>
					<td>
						<a href="editstud2.php" ><img src="img/pencil.png" width="14" height="14"/></a>
					</td>
				</tr>
			</div>
			<div class="subtitul">			
					<tr><td><h10>Native Language :  </h10><h9><b><?=$_SESSION['snlang']?></b></h9></td></tr><br />
					<tr><td><h10>City :  </h10><h9><b><?=$_SESSION['scity']?></b></h9></td></tr><br />
					<tr><td><h10>Country :  </h10><h9><b><?=$_SESSION['scountry']?></b></h9></td></tr><br />
					<tr><td><h10>Time Zone :  </h10><h9><b><?=$_SESSION['stzone']?></b></h9></td></tr><br />
					<tr><td><h10>Actual Work :  </h10><h9><b><?=$_SESSION['sawork']?></b></h9></td></tr><br />
			</div>			
		</article>

		<article id="columna_izq">
			<div class="titul">	
				<tr><td><u>MEDIA SETTINGS</u></td>	
					<td>
						<a href="editstud3.php" ><img src="img/pencil.png" width="14" height="14"/></a>
					</td>
				</tr>	
			</div>
			<div class="subtitul">			
					<tr><td><h10>Phone :  </h10><h9><b><?=$_SESSION['stelefono']?></b></h9></td></tr><br />
					<tr><td><h10>Mobile phone :  </h10><h9><b><?=$_SESSION['scelular']?></b></h9></td></tr><br />
					<tr><td><h10>Skype :  </h10><h9><b><?=$_SESSION['sskype']?></b></h9></td></tr><br />
					<tr><td><h10>e-mail :  </h10><h9><b><?=$_SESSION['semail']?></b></h9></td></tr><br />
			</div>			
		</article>

		<article id="columna_der">
			<div class="titul">
				<tr>
					<td align=left><u>LOGIN & PASSWORD</u></td>
					<td>
						<a href="editstud4.php" ><img src="img/pencil.png" width="14" height="14"/></a>
					</td>
				</tr>
			</div>
			<div class="subtitul">			
					<tr><td><h10>User :  </h10><h9><b><?=$_SESSION['susuario']?></b></h9></td></tr><br />
					<tr><td><h10>Password :  </h10><h9><b>*******</b></h9></td></tr><br />
					<tr><td><h10>Last Trainer : </h10><h9><b><?=$_SESSION['sasig']?></b></h9></td></tr><br />
					<tr><td><h10>Code :  </h10><h9><b><?=$_SESSION['scode']?></b></h9></td></tr><br />
			</div>			
		</article>			

	</section>

<!-- end info basica -->
<br />	
<!-- FOOTER -->
	<div id="footer">
		<p>Copyright 2012 &copy;<a href="http://www.fluentspeaking.de">FLUENTSPEAKING</a>. All rights reserved.</p>
		<!--<p><strong>AdminPortal </strong> by &copy;<a href="http://www.fluentspeaking.com"> QUANTICA SOFT, LLC</a></p>-->
	</div> 
<!-- end footer -->

</body>
</html>

<!-- end webPage -->



















