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

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>FluentSpeaking - StudentPortal</title>

    <link rel="stylesheet" type="text/css" href="/fluent/backend/admin/css/normalize.css"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
    <link rel="stylesheet" type="text/css" href="/fluent/backend/student/css/style.css"/>
    <link rel="shortcut icon" href="/fluent/frontend/img/favicon.ico">


    <script src="/fluent/backend/student/js/prefixfree.min.js"></script>
    <script src="/fluent/backend/student/js/jquery.js"></script>
    <script src="/fluent/backend/student/js/fluent.js"></script>
    <script src="/fluent/backend/student/js/script.js"></script> 

<!--<formulario para ? help>-->
    <script>                                        
        $(document).ready(function() {
            
            $('.icon_tray #help_center').click(function() { 
                $('#help_drop').slideToggle('fast', function() {
                    $(".icon").css({"background-color":"#595e72","color":"#FFF"});
                });

            });
            $('form').focus(function(){  
                $(this).val('');   
            }); 
        });
    </script>      

</head>

<body>
    <header id="header">
        <div class="wrapper">
            <a href="/" class="logo"><img src="/fluent/backend/student/img/logo.png" alt="Bluehost - Professional Web Hosting"></a>
            <aside class="logged_in">
                <table border="0" align=right>
                    <tr style="height:100px;">
                        <td style="width:100px;"><!-- Picture Profile -->
                            <div id="picture"><!--<picture>-->
                                <a href="#"><img src="img/mark.jpg" width="96" height="96"></a>
                            </div>
                        </td>
                        <td style="width:250px;"><!-- description -->
                            <div>
                                <div><h11><b><?=$_SESSION['snombre']?></h11>  <h11><?=$_SESSION['sapellido']?></h11></b></div>
                                <div><h12><?=$_SESSION['scity']?></h12> - <h12><?=$_SESSION['scountry']?></h12></div>
                                <div><a href="profile.php"><b>Profile</b></a> | <a style="text-decoration: none;" href="/fluent/backend/logout.php">Logout</a></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </aside>
        </div>

        <div id="submenu">
            <div class="wrapper">
                <aside class="icon_tray">
                    <a href="#" id="new_event" target="_blank" class="icon1">Schedule your NEW LESSON!</a>                  
                    <a href="#" id="help_center" class="icon">Help</a>
                    <div id="help_drop">
                        <form action='mje.php' method = 'POST'>
                            <p>Need Help? Send Us a Message.<!-- (
                                <a id="visit_help" class="small" href="#" target="_blank">Visit Now</a>)-->
                            </p>
                            <!--<input id="help_search" name="search" type="text">-->
                            <textarea id="help_mje" name="mje" placeholder="message" style="width:250px;height:70px;" autofocus required></textarea>
                            <input class="btn_primary" type="submit" value="Send">
                        </form>
                        <div id="help_more">
                            <p class="small">Still need help? Call us directly. Our top-rated customer service agents will be happy to assist you any time.</p>
                            <p><small>Toll-free GERMANY</small>
                                <a href="tel:711-59600660">711-59600660</a>
                            </p>
                            <p><small>Outside</small>
                                <a href="tel:711 5960066-9 ">(+49) 711-59600669</a>
                            </p>
                        </div>
                    </div>
                </aside>

                <nav class="main_nav">
                    <ul class="clear">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Evaluation & Test</a></li>
                    </ul>
                </nav>
            </div>
        </div>     
    </header>
<!-- MAIN CONTENT -->

    <div id="content">
        <table border="0" align=center>
            <tr style="height:250px;">
                <td style="width:500px;"><!-- Picture Profile -->
                    <div style="height:250px; width: 500px;">
                        <div id="headL"><h10>Picture Profile</h10></div><div id="headR"><a href="eprofile2.php"><img src="img/edit.png"></a></div>
                        <br /><div id="line"><img src="img/raya.png"></div>
                        <div class="pfl_izq">
                            <ul class="lista_profile">

                            </ul>               
                        </div>
                    </div>
                </td>
                <td style="width:500px;"><!-- Location -->
                    <div style="height:250px; width: 500px; overflow:auto;">
                        <div id="headL"><h10>Location</h10></div><div id="headR"><a href="eprofile3.php"><img src="img/edit.png"></a></div>
                        <br /><div id="line"><img src="img/raya.png"></div>
                        <div class="details">
                            <div class="pfl_izq">
                                <ul class="lista_profile">
                                    <li>Address :</li>
                                    <li id="ctry">Country :</li>
                                    <li>Time Zone :</li>
                                </ul>               
                            </div>
                            <div class="pfl_der">
                                <ul class="lista_profile">
                                    <li style="height:45px; width: 300px; overflow:auto;"><b><?=$_SESSION['saddr']?></b></li>
                                    <li><b><?=$_SESSION['scountry']?></b></li>
                                    <li style="height:50px; width: 300px; overflow:auto;"><b><?=$_SESSION['stzone']?></b></li>
                                </ul>                       
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr style="height:250px;">    
                <td style="width:500px;"><!-- Basic Information -->
                    <div style="height:250px; width: 500px;">
                        <div id="headL"><h10>Basic Information</h10></div><div id="headR"><a href="eprofile2.php"><img src="img/edit.png"></a></div>
                        <br /><div id="line"><img src="img/raya.png"></div>
                        <div class="details">
                            <div class="pfl_izq">
                                <ul class="lista_profile">
                                    <li>First Name :</li>
                                    <li>Last Name :</li>
                                    <li>Password :</li>
                                    <li>Date of birth :</li>
                                    <li>Gender :</li>
                                    <li>Language :</li>
                                </ul>               
                            </div>
                            <div class="pfl_der">
                                <ul class="lista_profile">
                                    <li><b><?=$_SESSION['snombre']?></b></li>
                                    <li><b><?=$_SESSION['sapellido']?></b></li>
                                    <li><b>*******</b></li>
                                    <li><b><?=$_SESSION['sbirth']?></b></li>
                                    <li><b><?=$_SESSION['sgender']?></b></li>
                                    <li><b><?=$_SESSION['snlang']?></b></li>
                                </ul>                       
                            </div>
                        </div>        
                    </div>
                </td>
                <td style="width:500px;"><!-- Media -->
                    <div style="height:250px; width: 500px;">
                        <div id="headL"><h10>Media</h10></div><div id="headR">
                            <input type="image" form="form4" src="img/tick.png" onclick="location.href='profile.php';">
                            |<a href="profile.php"><img src="img/backward.png"></a></div>
                        <br /><div id="line"><img src="img/raya.png"></div>
                        <div class="details">   
                            <div class="pfl_izq">
                                <ul class="lista_profile">
                                    <li>Phone :</li>
                                    <li>Mobile :</li>
                                    <li>Skype :</li>
                                    <li>e-mail :</li>
                                </ul>               
                            </div>
                            <div class="pfl_der">
                                <form action='sp4.php' method = 'POST' id="form4">
                                    <ul class="lista_profile">
                                        <li><input type="text" name="scode" placeholder="code" size="4">
                                            <input type="text" name="sphone" placeholder="phone number" size="25">
                                            <input type="text" name="sext" placeholder="ext" size="6">
                                        </li>
                                        <li><input type="text" name="scelular" size="35" value="<?=$_SESSION['scelular']?>"></li>
                                        <li><input type="text" name="sskype" size="35" value="<?=$_SESSION['sskype']?>"></li>
                                        <li><input type="email" name="semail" size="35" value="<?=$_SESSION['semail']?>"></li>
                                    </ul>
                                </form>                       
                            </div>
                        </div>    
                    </div>
                </td>             
            </tr>
        </table>    
    </div>
<!-- FOOTER -->
    <div id="footer">
            <p>Copyright 2012 &copy;<a href="http://www.fluentspeaking.de">FLUENTSPEAKING</a>. All rights reserved.</p>
    </div> 

</body>
</html>

<!-- end webPage -->

