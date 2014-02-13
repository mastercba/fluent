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

	//Recupero variables
	$image_caption = $_POST['image_caption'];
	$image_username = $_POST['image_username'];
	$image_tmpname = $_FILES['image_filename']['name'];
	//$today = date("Y-m-d");

	//Creo variables
	$imgdir = "../blob/uploads/";
	$imgname = $imgdir.$image_tmpname;
	$sid = $_SESSION['sid'];


if(move_uploaded_file($_FILES['image_filename']['tmp_name'], $imgname))
{
list($width,$height,$type,$attr)= getimagesize($imgname);
switch($type)
{
 case 1:
  $ext = ".gif"; break;
 case 2:
  $ext = ".jpg"; break;
 case 3:
  $ext = ".png"; break;
 default:
   echo "Not acceptable format of image";
}
$insert = "insert into images (image_caption, image_username, image_date)
   values ('$image_caption','$image_username','$today')";
$insertresults = mysql_query($insert) or die(mysql_error());

$last_pic_id = mysql_insert_id();
$newfilename = $imgdir.$last_pic_id.$ext;
rename($imgname,$newfilename); 
}

		echo '<meta HTTP-EQUIV="REFRESH" content="0; url=profile.php">';

?>