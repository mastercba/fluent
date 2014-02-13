<?php 

    require("../config.php"); 

    // If it has, then the registration code is run, otherwise the form is displayed 
    
    //recupero variable
		$newusuario = $_POST['nsusuario']; 
		$newpassword = $_POST['nspassword'];

		$newnombre = $_POST['nsnombre'];
		$newapellido = $_POST['nsapellido'];
        $newbirth = $_POST['nsbirth'];
        $newgender = $_POST['nsgender'];
        $newhtown = $_POST['nshtown'];
        $newaddr = $_POST['nsaddr'];
        $newlang = $_POST['nsnlang'];
        $newcity = $_POST['nscity'];		
		$newcountry = $_POST['nscountry'];
        $newawork = $_POST['nsawork'];
        $newtelefono = $_POST['nstelefono'];
        $newcelular = $_POST['nscelular'];
        $newskype = $_POST['nsskype'];
		$newemail = $_POST['nsemail'];
        $newcode = $_POST['nscode'];

    //creo variables
        $addate = $_SESSION['fecha'];

    if(!empty($_POST)) 

    { 

        // Ensure that the user has entered a non-empty username 

        if(empty($_POST['nsusuario'])) 
        	{ 
            	die("Please enter a username."); 
        	} 
    // Ensure that the user has entered a non-empty password 
        if(empty($_POST['nspassword'])) 
        	{ 
            	die("Please enter a password."); 
        	} 
        // Make sure the user entered a valid E-Mail address 
        // filter_var is a useful PHP function for validating form input, see: 
        // http://us.php.net/manual/en/function.filter-var.php 
        // http://us.php.net/manual/en/filter.filters.php 
        if(!filter_var($_POST['nsemail'], FILTER_VALIDATE_EMAIL)) 
        	{ 
            	die("Invalid E-Mail Address"); 
        	} 

        // We will use this SQL query to see whether the username entered by the 
        // user is already in use.  A SELECT query is used to retrieve data from the database. 
        // :username is a special token, we will substitute a real value in its place when 
        // we execute the query. 

        $query = " 
            SELECT 
                1 
            FROM usuario 
            WHERE 
                username_usuario = :nsusuario 
        "; 

         
        // This contains the definitions for any special tokens that we place in 
        // our SQL query.  In this case, we are defining a value for the token 
        // :username.  It is possible to insert $_POST['username'] directly into 
        // your $query string; however doing so is very insecure and opens your 
        // code up to SQL injection exploits.  Using tokens prevents this. 
        // For more information on SQL injections, see Wikipedia: 
        // http://en.wikipedia.org/wiki/SQL_Injection 

        $query_params = array( 
            ':nsusuario' => $_POST['nsusuario'] 
        ); 

        try 
        	{ 
            // These two statements run the query against your database table. 
            	$stmt = $db->prepare($query); 
            	$result = $stmt->execute($query_params); 
        	} 
        catch(PDOException $ex) 
        	{ 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            	die("Failed to run query: " . $ex->getMessage()); 
        	} 

        // The fetch() method returns an array representing the "next" row from 
        // the selected results, or false if there are no more rows to fetch. 
        $row = $stmt->fetch(); 

        // If a row was returned, then we know a matching username was found in 
        // the database already and we should not allow the user to continue. 
        if($row) 
	        { 
    	        die("This username is already in use"); 
        	} 

        // Now we perform the same type of check for the email address, in order 
        // to ensure that it is unique. 
        $query = " 
            SELECT 
                1 
            FROM usuario 
            WHERE 
                email_usuario = :nsemail 
        "; 
        $query_params = array( 
            ':nsemail' => $_POST['nsemail'] 
        ); 

        try 
        	{ 
            	$stmt = $db->prepare($query); 
            	$result = $stmt->execute($query_params); 
        	} 

        catch(PDOException $ex) 
        	{ 
            	die("Failed to run query: " . $ex->getMessage()); 
        	} 
        $row = $stmt->fetch(); 

        if($row) 
        	{ 
            	die("This email address is already registered"); 
        	} 

        // An INSERT query is used to add new rows to a database table. 
        // Again, we are using special tokens (technically called parameters) to 
        // protect against SQL injection attacks. 
        $query = " 
            INSERT INTO usuario ( 
                username_usuario, 
                password_usuario, 
                salt_usuario, 
                email_usuario 
            ) VALUES ( 
                :nsusuario, 
                :nspassword, 
                :adsalt, 
                :nsemail 
            ) 
        "; 

        // A salt is randomly generated here to protect again brute force attacks 
        // and rainbow table attacks.  The following statement generates a hex 
        // representation of an 8 byte salt.  Representing this in hex provides 
        // no additional security, but makes it easier for humans to read. 
        // For more information: 
        // http://en.wikipedia.org/wiki/Salt_%28cryptography%29 
        // http://en.wikipedia.org/wiki/Brute-force_attack 
        // http://en.wikipedia.org/wiki/Rainbow_table 

        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        // This hashes the password with the salt so that it can be stored securely 
        // in your database.  The output of this next statement is a 64 byte hex 
        // string representing the 32 byte sha256 hash of the password.  The original 
        // password cannot be recovered from the hash.  For more information: 
        // http://en.wikipedia.org/wiki/Cryptographic_hash_function 

        $password = hash('sha256', $_POST['nspassword'] . $salt);
        // Next we hash the hash value 65536 more times.  The purpose of this is to 
        // protect against brute force attacks.  Now an attacker must compute the hash 65537 
        // times for each guess they make against a password, whereas if the password 
        // were hashed only once the attacker would have been able to make 65537 different  
        // guesses in the same amount of time instead of only one. 

        for($round = 0; $round < 65536; $round++) 
            { 
                $password = hash('sha256', $password . $salt); 
            } 

        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store 
        // the salt (in its plaintext form; this is not a security risk). 
        $query_params = array( 
            ':nsusuario' => $_POST['nsusuario'], 
            ':nspassword' => $password, 
            ':adsalt' => $salt, 
            ':nsemail' => $_POST['nsemail'] 
        ); 
         
        try 
            { 
            // Execute the query to create the user 
                $stmt1 = $db->prepare($query); 
                $result1 = $stmt1->execute($query_params); 
            } 

        catch(PDOException $ex) 
            { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
                die("Failed to run query: " . $ex->getMessage()); 
            } 


        //trae los datos de usuario creado! 
            $query = " 
                SELECT 
                    id_usuario  
                FROM usuario
                WHERE
                    email_usuario = :nsemail 
            ";
            $query_params = array( 
                ':nsemail' => $_POST['nsemail'] 
            );             
            try 
            { 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) 
            {  
                die("Failed to run query: " . $ex->getMessage()); 
            } 
            $row = $stmt->fetch(); 
            $new_user = $row['id_usuario']; //para tabla tipo


        //inserto en la tabla tipo todos los datos        
        $result3 = mysql_query(("INSERT INTO tipo (id_usuario, superadm_tipo, adm_tipo, teacher_tipo, student_tipo)
         VALUES('$new_user', '0', '0', '0', '1')"), $conexion);

        //trae los datos de la tabla tipo creado! 
            $query = " 
                SELECT 
                    id_tipo  
                FROM tipo
                WHERE
                    id_usuario = :new_user 
            ";
            $query_params = array( 
                ':new_user' => $new_user 
            );             
            try 
            { 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) 
            {  
                die("Failed to run query: " . $ex->getMessage()); 
            } 
            $row = $stmt->fetch(); 
            $new_idtipo = $row['id_tipo']; //para tabla students


        //inserto en la tabla students los datos        
        $result = mysql_query(("INSERT INTO students (id_tipo, usuario_students, nombre_students, apellido_students, birth_students, gender_students, htown_students, addr_students, nlang_students, city_students, country_students, awork_students, telefono_students, celular_students, skype_students, email_students, code_students)
         VALUES('$new_idtipo','$newusuario','$newnombre','$newapellido','$newbirth','$newgender','$newhtown','$newaddr','$newlang','$newcity','$newcountry','$newawork','$newtelefono','$newcelular','$newskype','$newemail','$newcode')"), $conexion);


        // This redirects the user back to the login page after they register 
        header("Location: student.php"); 

        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        die("Redirecting to formlogin.html");        

    } 

?> 
