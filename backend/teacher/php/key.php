<?php 
	session_start();

	if(($_SESSION['adlogin'])=="si"){
		//$_SESSION['adlogin'] = "no";

		echo '<meta http-equiv="REFRESH" content="0,url=overview.php">';			
	}else{

		echo '<meta http-equiv="REFRESH" content="0,url=../formlogin.html">';

	}
?>
