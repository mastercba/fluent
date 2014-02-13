<?php 

    require("../config.php"); 

    // If it has, then the registration code is run, otherwise the form is displayed 
    
    //recupero variable
		$addtstatus = $_POST['tstatus'];
		$addtlang = $_POST['tlang'];
		$addtusuario = $_POST['tusuario']; 
		$addtpassword = $_POST['tpassword'];
		$addtnombre = $_POST['tnombre'];
		$addtapellido = $_POST['tapellido'];		
		$addtcelular = $_POST['tcelular'];
		$addtemail = $_POST['temail'];
		$addtskype = $_POST['tskype'];
		$addtolp = $_POST['tolp'];
		$addtcountry = $_POST['tcountry'];

    //creo variables
        $addate = $_SESSION['fecha'];

    if(!empty($_POST)) 

    { 

        // Ensure that the user has entered a non-empty username 

        if(empty($_POST['tusuario'])) 
        	{ 
            	die("Please enter a username."); 
        	} 
    // Ensure that the user has entered a non-empty password 
        if(empty($_POST['tpassword'])) 
        	{ 
            	die("Please enter a password."); 
        	} 
        // Make sure the user entered a valid E-Mail address 
        // filter_var is a useful PHP function for validating form input, see: 
        // http://us.php.net/manual/en/function.filter-var.php 
        // http://us.php.net/manual/en/filter.filters.php 
        if(!filter_var($_POST['temail'], FILTER_VALIDATE_EMAIL)) 
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
                username_usuario = :tusuario 
        "; 

         
        // This contains the definitions for any special tokens that we place in 
        // our SQL query.  In this case, we are defining a value for the token 
        // :username.  It is possible to insert $_POST['username'] directly into 
        // your $query string; however doing so is very insecure and opens your 
        // code up to SQL injection exploits.  Using tokens prevents this. 
        // For more information on SQL injections, see Wikipedia: 
        // http://en.wikipedia.org/wiki/SQL_Injection 

        $query_params = array( 
            ':tusuario' => $_POST['tusuario'] 
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
                email_usuario = :temail 
        "; 
        $query_params = array( 
            ':temail' => $_POST['temail'] 
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
                :tusuario, 
                :tpassword, 
                :adsalt, 
                :temail 
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

        $password = hash('sha256', $_POST['tpassword'] . $salt);
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
            ':tusuario' => $_POST['tusuario'], 
            ':tpassword' => $password, 
            ':adsalt' => $salt, 
            ':temail' => $_POST['temail'] 
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
                    email_usuario = :temail 
            ";
            $query_params = array( 
                ':temail' => $_POST['temail'] 
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
         VALUES('$new_user', '0', '0', '1', '0')"), $conexion);

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
            $new_idtipo = $row['id_tipo']; //para tabla trainers


        //inserto en la tabla trainers los datos        
        $result = mysql_query(("INSERT INTO trainers (id_tipo, status_trainers, lang_trainers, usuario_trainers, nombre_trainers, apellido_trainers, celular_trainers, email_trainers, skype_trainers, olp_trainers, country_trainers)
         VALUES('$new_idtipo','$addtstatus','$addtlang','$addtusuario','$addtnombre','$addtapellido','$addtcelular','$addtemail','$addtskype','$addtolp','$addtcountry')"), $conexion);


        // This redirects the user back to the login page after they register 
        header("Location: admin1.php"); 

        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        die("Redirecting to formlogin.html");        

    } 

?> 
























