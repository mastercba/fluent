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
    <link rel="stylesheet" type="text/css" href="/fluent/backend/student/css/estilo_std.css"/>
    <link rel="stylesheet" type="text/css" href="/fluent/backend/student/css/style.css"/>
    <link rel="shortcut icon" href="/fluent/frontend/img/favicon.ico">

    <!-- Script by Josh Fraser (http://www.onlineaspect.com) -->
    <script language="javascript" src="/fluent/backend/student/js/detect_timezone.js"></script>

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
                        <div id="headL"><h10>Picture Profile</h10></div><div id="headR"><a href="eprofile1.php"><img src="img/edit.png"></a></div>
                        <br /><div id="line"><img src="img/raya.png"></div>
                        <div class="pfl_izq">
                            <ul class="lista_profile">

                            </ul>               
                        </div>
                    </div>
                </td>
                <td style="width:500px;"><!-- Location -->
                    <div style="height:250px; width: 500px; overflow:auto;">
                        <div id="headL"><h10>Location</h10></div><div id="headR">
                            <input type="image" form="form3" src="img/tick.png" onclick="location.href='profile.php';">
                            |<a href="profile.php"><img src="img/backward.png"></a></div>
                        <br /><div id="line"><img src="img/raya.png"></div>
                        <div class="details">
                            <div class="pfl_izq">
                                <ul class="lista_profile">
                                    <li>Address :</li>
                                    <li>Country :</li>
                                    <li>Time Zone :</li>   
                                </ul>               
                            </div>
                            <div class="pfl_der">
                                <form action='sp3.php' method = 'POST' id="form3">
                                    <ul class="lista_profile">
                                        <li><input type="text" name="saddr" placeholder="address" size="45" value="<?=$_SESSION['saddr']?>"></li>
                                        <li>
                                                <?php
                                                $wcr = array(
                                                    'AD' => 'Andorra',
                                                    'AE' => 'United Arab Emirates',
                                                    'AF' => 'Afghanistan',
                                                    'AG' => 'Antigua &amp; Barbuda',
                                                    'AI' => 'Anguilla',
                                                    'AL' => 'Albania',
                                                    'AM' => 'Armenia',
                                                    'AN' => 'Netherlands Antilles',
                                                    'AO' => 'Angola',
                                                    'AQ' => 'Antarctica',
                                                    'AR' => 'Argentina',
                                                    'AS' => 'American Samoa',
                                                    'AT' => 'Austria',
                                                    'AU' => 'Australia',
                                                    'AW' => 'Aruba',
                                                    'AZ' => 'Azerbaijan',
                                                    'BA' => 'Bosnia and Herzegovina',
                                                    'BB' => 'Barbados',
                                                    'BD' => 'Bangladesh',
                                                    'BE' => 'Belgium',
                                                    'BF' => 'Burkina Faso',
                                                    'BG' => 'Bulgaria',
                                                    'BH' => 'Bahrain',
                                                    'BI' => 'Burundi',
                                                    'BJ' => 'Benin',
                                                    'BM' => 'Bermuda',
                                                    'BN' => 'Brunei Darussalam',
                                                    'BO' => 'Bolivia',
                                                    'BR' => 'Brazil',
                                                    'BS' => 'Bahama',
                                                    'BT' => 'Bhutan',
                                                    'BU' => 'Burma (no longer exists)',
                                                    'BV' => 'Bouvet Island',
                                                    'BW' => 'Botswana',
                                                    'BY' => 'Belarus',
                                                    'BZ' => 'Belize',
                                                    'CA' => 'Canada',
                                                    'CC' => 'Cocos (Keeling) Islands',
                                                    'CF' => 'Central African Republic',
                                                    'CG' => 'Congo',
                                                    'CH' => 'Switzerland',
                                                    'CK' => 'Cook Iislands',
                                                    'CL' => 'Chile',
                                                    'CM' => 'Cameroon',
                                                    'CN' => 'China',
                                                    'CO' => 'Colombia',
                                                    'CR' => 'Costa Rica',
                                                    'CU' => 'Cuba',
                                                    'CV' => 'Cape Verde',
                                                    'CX' => 'Christmas Island',
                                                    'CY' => 'Cyprus',
                                                    'CZ' => 'Czech Republic',
                                                    'DE' => 'Germany',
                                                    'DJ' => 'Djibouti',
                                                    'DK' => 'Denmark',
                                                    'DM' => 'Dominica',
                                                    'DO' => 'Dominican Republic',
                                                    'DZ' => 'Algeria',
                                                    'EC' => 'Ecuador',
                                                    'EE' => 'Estonia',
                                                    'EG' => 'Egypt',
                                                    'EH' => 'Western Sahara',
                                                    'ER' => 'Eritrea',
                                                    'ES' => 'Spain',
                                                    'ET' => 'Ethiopia',
                                                    'FI' => 'Finland',
                                                    'FJ' => 'Fiji',
                                                    'FK' => 'Falkland Islands (Malvinas)',
                                                    'FM' => 'Micronesia',
                                                    'FO' => 'Faroe Islands',
                                                    'FR' => 'France',
                                                    'FX' => 'France, Metropolitan',
                                                    'GA' => 'Gabon',
                                                    'GB' => 'United Kingdom (Great Britain)',
                                                    'GD' => 'Grenada',
                                                    'GE' => 'Georgia',
                                                    'GF' => 'French Guiana',
                                                    'GH' => 'Ghana',
                                                    'GI' => 'Gibraltar',
                                                    'GL' => 'Greenland',
                                                    'GM' => 'Gambia',
                                                    'GN' => 'Guinea',
                                                    'GP' => 'Guadeloupe',
                                                    'GQ' => 'Equatorial Guinea',
                                                    'GR' => 'Greece',
                                                    'GT' => 'Guatemala',
                                                    'GU' => 'Guam',
                                                    'GW' => 'Guinea-Bissau',
                                                    'GY' => 'Guyana',
                                                    'HK' => 'Hong Kong',
                                                    'HM' => 'Heard &amp; McDonald Islands',
                                                    'HN' => 'Honduras',
                                                    'HR' => 'Croatia',
                                                    'HT' => 'Haiti',
                                                    'HU' => 'Hungary',
                                                    'ID' => 'Indonesia',
                                                    'IE' => 'Ireland',
                                                    'IL' => 'Israel',
                                                    'IN' => 'India',
                                                    'IO' => 'British Indian Ocean Territory',
                                                    'IQ' => 'Iraq',
                                                    'IR' => 'Islamic Republic of Iran',
                                                    'IS' => 'Iceland',
                                                    'IT' => 'Italy',
                                                    'JM' => 'Jamaica',
                                                    'JO' => 'Jordan',
                                                    'JP' => 'Japan',
                                                    'KE' => 'Kenya',
                                                    'KG' => 'Kyrgyzstan',
                                                    'KH' => 'Cambodia',
                                                    'KI' => 'Kiribati',
                                                    'KM' => 'Comoros',
                                                    'KN' => 'St. Kitts and Nevis',
                                                    'KR' => 'Korea, Republic of',
                                                    'KW' => 'Kuwait',
                                                    'KY' => 'Cayman Islands',
                                                    'KZ' => 'Kazakhstan',
                                                    'LA' => 'Lao',
                                                    'LB' => 'Lebanon',
                                                    'LC' => 'Saint Lucia',
                                                    'LI' => 'Liechtenstein',
                                                    'LK' => 'Sri Lanka',
                                                    'LR' => 'Liberia',
                                                    'LS' => 'Lesotho',
                                                    'LT' => 'Lithuania',
                                                    'LU' => 'Luxembourg',
                                                    'LV' => 'Latvia',
                                                    'LY' => 'Libyan Arab Jamahiriya',
                                                    'MA' => 'Morocco',
                                                    'MC' => 'Monaco',
                                                    'MD' => 'Moldova, Republic of',
                                                    'MG' => 'Madagascar',
                                                    'MH' => 'Marshall Islands',
                                                    'ML' => 'Mali',
                                                    'MN' => 'Mongolia',
                                                    'MM' => 'Myanmar',
                                                    'MO' => 'Macau',
                                                    'MP' => 'Northern Mariana Islands',
                                                    'MQ' => 'Martinique',
                                                    'MR' => 'Mauritania',
                                                    'MS' => 'Monserrat',
                                                    'MT' => 'Malta',
                                                    'MU' => 'Mauritius',
                                                    'MV' => 'Maldives',
                                                    'MW' => 'Malawi',
                                                    'MX' => 'Mexico',
                                                    'MY' => 'Malaysia',
                                                    'MZ' => 'Mozambique',
                                                    'NA' => 'Namibia',
                                                    'NC' => 'New Caledonia',
                                                    'NE' => 'Niger',
                                                    'NF' => 'Norfolk Island',
                                                    'NG' => 'Nigeria',
                                                    'NI' => 'Nicaragua',
                                                    'NL' => 'Netherlands',
                                                    'NO' => 'Norway',
                                                    'NP' => 'Nepal',
                                                    'NR' => 'Nauru',
                                                    'NU' => 'Niue',
                                                    'NZ' => 'New Zealand',
                                                    'OM' => 'Oman',
                                                    'PA' => 'Panama',
                                                    'PE' => 'Peru',
                                                    'PF' => 'French Polynesia',
                                                    'PG' => 'Papua New Guinea',
                                                    'PH' => 'Philippines',
                                                    'PK' => 'Pakistan',
                                                    'PL' => 'Poland',
                                                    'PM' => 'St. Pierre &amp; Miquelon',
                                                    'PN' => 'Pitcairn',
                                                    'PR' => 'Puerto Rico',
                                                    'PT' => 'Portugal',
                                                    'PW' => 'Palau',
                                                    'PY' => 'Paraguay',
                                                    'QA' => 'Qatar',
                                                    'RE' => 'Réunion',
                                                    'RO' => 'Romania',
                                                    'RU' => 'Russian Federation',
                                                    'RW' => 'Rwanda',
                                                    'SA' => 'Saudi Arabia',
                                                    'SB' => 'Solomon Islands',
                                                    'SC' => 'Seychelles',
                                                    'SD' => 'Sudan',
                                                    'SE' => 'Sweden',
                                                    'SG' => 'Singapore',
                                                    'SH' => 'St. Helena',
                                                    'SI' => 'Slovenia',
                                                    'SK' => 'Slovakia',
                                                    'SL' => 'Sierra Leone',
                                                    'SM' => 'San Marino',
                                                    'SN' => 'Senegal',
                                                    'SO' => 'Somalia',
                                                    'SR' => 'Suriname',
                                                    'ST' => 'Sao Tome &amp; Principe',
                                                    'SV' => 'El Salvador',
                                                    'SY' => 'Syrian Arab Republic',
                                                    'SZ' => 'Swaziland',
                                                    'TC' => 'Turks &amp; Caicos Islands',
                                                    'TD' => 'Chad',
                                                    'TF' => 'French Southern Territories',
                                                    'TG' => 'Togo',
                                                    'TH' => 'Thailand',
                                                    'TJ' => 'Tajikistan',
                                                    'TK' => 'Tokelau',
                                                    'TM' => 'Turkmenistan',
                                                    'TN' => 'Tunisia',
                                                    'TO' => 'Tonga',
                                                    'TP' => 'East Timor',
                                                    'TR' => 'Turkey',
                                                    'TT' => 'Trinidad &amp; Tobago',
                                                    'TV' => 'Tuvalu',
                                                    'TW' => 'Taiwan, Province of China',
                                                    'TZ' => 'Tanzania, United Republic of',
                                                    'UA' => 'Ukraine',
                                                    'UG' => 'Uganda',
                                                    'US' => 'United States of America',
                                                    'UY' => 'Uruguay',
                                                    'UZ' => 'Uzbekistan',
                                                    'VA' => 'Vatican City State (Holy See)',
                                                    'VC' => 'St. Vincent &amp; the Grenadines',
                                                    'VE' => 'Venezuela',
                                                    'VG' => 'British Virgin Islands',
                                                    'VI' => 'United States Virgin Islands',
                                                    'VN' => 'Viet Nam',
                                                    'VU' => 'Vanuatu',
                                                    'WF' => 'Wallis &amp; Futuna Islands',
                                                    'WS' => 'Samoa',
                                                    'YE' => 'Yemen',
                                                    'YT' => 'Mayotte',
                                                    'YU' => 'Yugoslavia',
                                                    'ZA' => 'South Africa',
                                                    'ZM' => 'Zambia',
                                                    'ZR' => 'Zaire',
                                                    'ZW' => 'Zimbabwe'
                                                );
                                                ?>                                            
                                            <select name="country">
                                            <option value="">please select a country</option>
                                            <?php
                                                asort($wcr);
                                                reset($wcr); 
                                                foreach($wcr as $p => $w):
                                                    echo '<option value="'.$w.'">'.$w.'</option>'; //close your tags!!
                                                endforeach;
                                            ?>
                                            </select></li>    
                                    </ul>

                            
                                    <select name="timezone" id="timezone" style="width:350px">
                                        <option value="-12:00,0">(-12:00) International Date Line West</option>
                                        <option value="-11:00,0">(-11:00) Midway Island, Samoa</option>
                                        <option value="-10:00,0">(-10:00) Hawaii</option>
                                        <option value="-09:00,1">(-09:00) Alaska</option>
                                        <option value="-08:00,1">(-08:00) Pacific Time (US &amp; Canada)</option>
                                        <option value="-07:00,0">(-07:00) Arizona</option>
                                        <option value="-07:00,1">(-07:00) Mountain Time (US &amp; Canada)</option>
                                        <option value="-06:00,0">(-06:00) Central America, Saskatchewan</option>
                                        <option value="-06:00,1">(-06:00) Central Time (US &amp; Canada), Guadalajara, Mexico city</option>
                                        <option value="-05:00,0">(-05:00) Indiana, Bogota, Lima, Quito, Rio Branco</option>
                                        <option value="-05:00,1">(-05:00) Eastern time (US &amp; Canada)</option>
                                        <option value="-04:00,1">(-04:00) Atlantic time (Canada), Manaus, Santiago</option>
                                        <option value="-04:00,0">(-04:00) Caracas, La Paz</option>
                                        <option value="-03:30,1">(-03:30) Newfoundland</option>
                                        <option value="-03:00,1">(-03:00) Greenland, Brasilia, Montevideo</option>
                                        <option value="-03:00,0">(-03:00) Buenos Aires, Georgetown</option>
                                        <option value="-02:00,1">(-02:00) Mid-Atlantic</option>
                                        <option value="-01:00,1">(-01:00) Azores</option>
                                        <option value="-01:00,0">(-01:00) Cape Verde Is.</option>
                                        <option value="00:00,0">(00:00) Casablanca, Monrovia, Reykjavik</option>
                                        <option value="00:00,1">(00:00) GMT: Dublin, Edinburgh, Lisbon, London</option>
                                        <option value="+01:00,1">(+01:00) Amsterdam, Berlin, Rome, Vienna, Prague, Brussels</option>
                                        <option value="+01:00,0">(+01:00) West Central Africa</option>
                                        <option value="+02:00,1">(+02:00) Amman, Athens, Istanbul, Beirut, Cairo, Jerusalem</option>
                                        <option value="+02:00,0">(+02:00) Harare, Pretoria</option>
                                        <option value="+03:00,1">(+03:00) Baghdad, Moscow, St. Petersburg, Volgograd</option>
                                        <option value="+03:00,0">(+03:00) Kuwait, Riyadh, Nairobi, Tbilisi</option>
                                        <option value="+03:30,0">(+03:30) Tehran</option>
                                        <option value="+04:00,0">(+04:00) Abu Dhadi, Muscat</option>
                                        <option value="+04:00,1">(+04:00) Baku, Yerevan</option>
                                        <option value="+04:30,0">(+04:30) Kabul</option>
                                        <option value="+05:00,1">(+05:00) Ekaterinburg</option>
                                        <option value="+05:00,0">(+05:00) Islamabad, Karachi, Tashkent</option>
                                        <option value="+05:30,0">(+05:30) Chennai, Kolkata, Mumbai, New Delhi, Sri Jayawardenepura</option>
                                        <option value="+05:45,0">(+05:45) Kathmandu</option>
                                        <option value="+06:00,0">(+06:00) Astana, Dhaka</option>
                                        <option value="+06:00,1">(+06:00) Almaty, Nonosibirsk</option>
                                        <option value="+06:30,0">(+06:30) Yangon (Rangoon)</option>
                                        <option value="+07:00,1">(+07:00) Krasnoyarsk</option>
                                        <option value="+07:00,0">(+07:00) Bangkok, Hanoi, Jakarta</option>
                                        <option value="+08:00,0">(+08:00) Beijing, Hong Kong, Singapore, Taipei</option>
                                        <option value="+08:00,1">(+08:00) Irkutsk, Ulaan Bataar, Perth</option>
                                        <option value="+09:00,1">(+09:00) Yakutsk</option>
                                        <option value="+09:00,0">(+09:00) Seoul, Osaka, Sapporo, Tokyo</option>
                                        <option value="+09:30,0">(+09:30) Darwin</option>
                                        <option value="+09:30,1">(+09:30) Adelaide</option>
                                        <option value="+10:00,0">(+10:00) Brisbane, Guam, Port Moresby</option>
                                        <option value="+10:00,1">(+10:00) Canberra, Melbourne, Sydney, Hobart, Vladivostok</option>
                                        <option value="+11:00,0">(+11:00) Magadan, Solomon Is., New Caledonia</option>
                                        <option value="+12:00,1">(+12:00) Auckland, Wellington</option>
                                        <option value="+12:00,0">(+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                        <option value="+13:00,0">(+13:00) Nuku'alofa</option>
                                    </select>
                            </div>
                                </form>


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
                        <div id="headL"><h10>Media</h10></div><div id="headR"><a href="eprofile4.php"><img src="img/edit.png"></a></div>
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
                                <ul class="lista_profile">
                                    <li><b>+(<?=$_SESSION['sphonecode']?>)<?=$_SESSION['stelefono']?>.<?=$_SESSION['sphoneext']?></b></li>
                                    <li><b><?=$_SESSION['scelular']?></b></li>
                                    <li><b><?=$_SESSION['sskype']?></b></li>
                                    <li><b><?=$_SESSION['semail']?></b></li>
                                </ul>                       
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
