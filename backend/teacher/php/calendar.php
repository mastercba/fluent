<?php 
	session_start();

//echo" ".$_SESSION['usuario']." ".$_SESSION['password']." ";
	if(($_SESSION['adlogin'])=="si"){

	//Crear variables
	$usuario = $_SESSION['usuario'];
	$password = $_SESSION['password'];
	$teacherid = $_SESSION['teacherid'];
?>
<!---------- start webPage ---------------->
<!DOCTYPE HTML>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>LANGUACOM - Trainer Portal</title>
	
	<!-- Stylesheets -->
	<!--<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>-->
	<link rel="stylesheet" href="../css/adm_style.css">
	<LINK REL="SHORTCUT ICON" HREF="../images/favicon.ico">
	
	
	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<!-- jQuery & JS files -->
	<script src="../js/jquery.js"></script>
	<script src="../js/script.js"></script>  
</head>
<body>
<!------------------------------------------------------- TOP BAR -------------------------------------------------------->
	<div id="top-bar">
		
		<div class="page-full-width cf">

			<ul id="nav" class="fl">
	
				<!--<li class="v-sep"><a href="#" class="round button dark ic-left-arrow image-left">Go to website</a></li>-->
				<li class="v-sep"><a href="#" class="round button dark menu-user image-left">Logged in 
				<strong><?php echo" : ".$_SESSION['nombre']." ".$_SESSION['apellido']." "; ?></strong></a>
					<ul>
						<li><a href="#">My Profile</a></li>
						<li><a href="#">User Settings</a></li>
						<li><a href="#">Change Password</a></li>
						<li><a href="account.php">Account Summary</a></li>
						<li><a href="/backend/logout.php">Log out</a></li>
					</ul> 
				</li>
			
				<!--<li><a href="#" class="round button dark menu-email-special image-left">3 new messages</a></li>-->
				<li class="v-sep"><a href="/backend/logout.php" class="round button dark menu-logoff image-left">Log out</a></li>
				<li class="v-sep" class="fr"><h1 class="round button dark"><strong>STUDENT :<?php echo" ".$_SESSION['snombre']." ".$_SESSION['sapellido']." "; ?></strong></h1></li>
				
			</ul> <!-- end nav -->

					
			<!--<form action="#" method="POST" id="search-form" class="fr">
				<fieldset>
					<input type="text" id="search-keyword" class="round button dark ic-search image-right" placeholder="Search..." />
					<input type="hidden" value="SUBMIT" />
				</fieldset>
			</form>-->

		</div> <!-- end full-width -->	
	
	</div> 
<!------------------------------------------------------- END TOP BAR -------------------------------------------------------->	
	<!--------- HEADER TABS -------->
	<div id="header-with-tabs">
		
		<div class="page-full-width cf">
	
			<ul id="tabs" class="fl">
				<li><a href="overview.php">Overview</a></li>
				<li><a href="calendar.php" class="active-tab dashboard-tab">Your Calendar</a></li>
				<!--<li><a href="#">Virtual Class</a></li> -->
				<li><a href="profile.php">Student Profile</a></li>
				<li><a href="report.php">Training Report</a></li>
				<li><a href="support.php">Training Information & Resources</a></li>
			</ul> <!-- end tabs -->
			
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 30px height. -->
			<a href="#" id="company-branding" class="fr">
			<img src="/backend/images/logo2.png" alt="Fluent Speaking" /></a>	
			
		</div> <!-- end full-width -->	

	</div>
	<!--------- END HEADER -------->		
<!--------------------- MAIN CONTENT ---------------------->
	<div id="content">
		<center>
		<tr><td>
		<?php

		    ## +-----------------------------------------------------------------------+
		    ## | 1. Creating & Calling:                                                | 
		    ## +-----------------------------------------------------------------------+
		    ## *** define a relative (virtual) path to calendar.class.php file  
		    ## *** and other files (relatively to the current file)
		    ## *** RELATIVE PATH ONLY *** Ex.: '', 'calendar/' or '../calendar/'
		    define ('CALENDAR_DIR', '../');                     
		    require_once(CALENDAR_DIR.'inc/connection.inc.php');
		    require_once(CALENDAR_DIR.'calendar.class.php');
		    
		    ## *** create calendar object
		    $objCalendar = new Calendar();
		    
		    ## +-----------------------------------------------------------------------+
		    ## | 2. General Settings:                                                  |
		    ## +-----------------------------------------------------------------------+
		    ## +-- Submission Settings & Debug Mode -----------------------------------
		    ## *** set PostBack method: 'get' or 'post'
		    $objCalendar->SetPostBackMethod('post');
		    ## *** show debug info - false|true
		    $objCalendar->Debug(false);

		    ## +-- Users Settings -----------------------------------------------------
		    ## *** set user ID (must be numeric value)
		    /// $user_id = 0;
		    /// $objCalendar->SetUserID($user_id);    

		    ## +-- Passing Parameters -------------------------------------------------
		    ## *** save http request variables between  calendar's sessions
		    /// $http_request_vars = array('param1', 'param2');
		    /// $objCalendar->SaveHttpRequestVars($http_request_vars);

		    ## +-- Cache Settings -----------------------------------------------------
		    ## *** define caching parameters:
		    ## *** 1st - allow caching or not, 2nd - caching lifetime in minutes
		    $objCalendar->SetCachingParameters(false, 15);
		    ## *** define all caching pages
		    /// $objCalendar->DeleteCache();
		    
		    ## +-- Languages ----------------------------------------------------------
		    ## *** set interface language (default - English)
		    ## *** (en) - English  (es) - Spanish     (de) - German  (fr) - French  
		    ## *** (it) - Italian  (pt) - Portuguese
		    $objCalendar->SetInterfaceLang('en');    

		    ## +-- Week Settings ------------------------------------------------------
		    ## *** set week day name length - 'short' or 'long'
		    $objCalendar->SetWeekDayNameLength('long');
		    ## *** set start day of the week: from 1 (Sunday) to 7 (Saturday)
		    $objCalendar->SetWeekStartedDay('1');
		    ## *** disable certain days of the week: from 1 (Sunday) to 7 (Saturday). Ex.: 1,2 or 7
		    /// $objCalendar->SetDisabledDays(6,7);
		    ## *** define showing a week number of the year
		    $objCalendar->ShowWeekNumberOfYear(true);


		    ## +-----------------------------------------------------------------------+
		    ## | 3. Events & Categories Settings:                                      |
		    ## +-----------------------------------------------------------------------+
		    ## +-- Events Actions & Operations ----------------------------------------
		    ## *** allow multiple occurrences for events in the same time slot: false|true - default
		     $objCalendar->SetEventsMultipleOccurrences(false);
		    /// $objCalendar->EditingEventsInPast(false);
		    ## *** allow deleting events in past
		    /// $objCalendar->DeletingEventsInPast(false);	
		    ## *** block deleting events before certain period of time (in hours)
		    // $objCalendar->BlockEventsDeletingBefore(24);
		    ## *** set (allow) calendar events operations
		    $events_operations = array(
			'add'=>false,
			'edit'=>false,
			'details'=>false,
			'delete'=>false,
			'delete_by_range'=>false,
			'manage'=>false,
		    );
		    $objCalendar->SetEventsOperations($events_operations);

		    ## +-- Categories Actions & Operations ------------------------------------
		    ## *** set (allow) using categories
		    $objCalendar->AllowCategories(false);
		    ## *** set calendar categories operations
		    $cat_operations = array(
			'add'=>true, 
			'edit'=>true,
			'details'=>true,
			'delete'=>true,
			'manage'=>true,
			'allow_colors'=>true
		    );
		    $objCalendar->SetCategoriesOperations($cat_operations);


		    ## +-----------------------------------------------------------------------+
		    ## | 4. Users Settings:                                                    | 
		    ## +-----------------------------------------------------------------------+
		    ## +-- Users Settings -----------------------------------------------------
		    ## *** set (allow) calendar users operations
		    $objCalendar->AllowUsers(false);
		    ## *** set users settings
		    $users_operations = array(
			'add'=>true,
			'edit'=>true,
			'details'=>true,
			'delete'=>true,
			'manage'=>true,
			'assign_to_events'=>true
		    );
		    $objCalendar->SetUsersOperations($users_operations);


		    ## +-----------------------------------------------------------------------+
		    ## | 5. Time Settings and Formatting:                                      | 
		    ## +-----------------------------------------------------------------------+
		    ## +-- TimeZone Settings --------------------------------------------------
		    ## *** set timezone
		    ## *** (list of supported Timezones - http://us3.php.net/manual/en/timezones.php)
		    $objCalendar->SetTimeZone('America/La_Paz');    
		    ## *** get current timezone
		    /// echo $objCalendar->GetCurrentTimeZone();
		    $objCalendar->GetCurrentTimeZone('America/La_Paz');

		    ## +-- Time Format & Settings ----------------------------------------------
		    ## *** define time format - 24|AM/PM
		    $objCalendar->SetTimeFormat('24');
		    ## *** define allowed hours frame (from, to). Possible values: 0...24
		    $objCalendar->SetAllowedHours(0, 22);
		    ## *** define time slot - 15|30|45|60|120 minutes
		    $objCalendar->SetTimeSlot('15');
		    ## *** set showing times in Daily, Weekly and List views
		    $objCalendar->ShowTime('true');
		    

		    ## +-----------------------------------------------------------------------+
		    ## | 6. Visual Settings:                                                   | 
		    ## +-----------------------------------------------------------------------+
		    ## +-- Calendar Views -----------------------------------------------------
		    ## *** set (allow) calendar Views
		    $views = array('daily'=>true, 
				   'weekly'=>false,
				   'monthly'=>true,
				   'monthly_double'=>false,
				   'yearly'=>false,
				   'list_view'=>false);                        
		    $objCalendar->SetCalendarViews($views);
		    ## *** set default calendar view - 'daily'|'weekly'|'monthly'|'yearly'|'list_view'|'monthly_small'|'monthly_double'
		    $objCalendar->SetDefaultView('monthly');    
		    ## *** Set action link for monthly small view - file2.php or ../file3.php etc.
		    /// $objCalendar->SetMonthlySmallLinks('');    

		    ## +-- Calendar Actions -----------------------------------------------------
		    ## *** set (allow) calendar actions
		    $calendar_actions = array(
			'statistics'=>false,
			'exporting'=>false,
			'printing'=>false
		    );
		    $objCalendar->SetCalendarActions($calendar_actions);
		    
		    ## *** set CSS style: 'green'|'brown'|'blue' - default
		    $objCalendar->SetCssStyle('green');
		    ## *** specify using of WYSIWYG editor
		    $objCalendar->AllowWYSIWYG(true);
		    ## *** set calendar width and height
		    $objCalendar->SetCalendarDimensions('1000px', '500px');
		    ## *** set type of displaying for events
		    ## *** possible values for daily   - 'inline'|'block'
		    ## *** possible values for weekly  - 'inline'|'tooltip'
		    ## *** possible values for monthly - 'inline'|'list'|'tooltip'
		    $events_display_type = array('daily'=>'block', 'weekly'=>'tooltip', 'monthly'=>'tooltip');
		    $objCalendar->SetEventsDisplayType($events_display_type);
		    ## *** set Sunday color - true|false
		    $objCalendar->SetSundayColor(true);    
		    ## *** set calendar caption
		    ##$objCalendar->SetCaption('ApPHP Calendar v'.Calendar::Version());


		    ## +-----------------------------------------------------------------------+
		    ## | 7. Draw Calendar:                                                     | 
		    ## +-----------------------------------------------------------------------+
		    ## *** drawing calendar
		    $objCalendar->Show();

		?>
		</td></tr>
		</center>
	</div>
				
		
<!----------- FOOTER ------------------->
	<div id="footer">

		<p>Copyright 2012 <a href="http://www.languacom.de">&copy; LANGUACOM</a>. All rights reserved.</p>
		<!--<p><strong>AdminPortal </strong> by &copy;<a href="http://www.fluentspeaking.com"> QUANTICA SOFT, LLC</a></p>-->
	
	</div> <!-- end footer -->

</body>
</html>
<!---------- end webPage ---------------->
<?php	

//	$_SESSION['adlogin'] = "no";
	}else{

	echo '<meta http-equiv="REFRESH" content="0,url=../formlogin.html">';

	}
?>
