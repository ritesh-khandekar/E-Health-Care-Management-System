<?php
session_start();
$login = false;
if(isset($_SESSION["hms_login"])){
  if($_SESSION["hms_admin"] || $_SESSION["hms_doctor"]){
    header("location: ../");
  }
  if(!isset($_SESSION["hms_admin"]) || !isset($_SESSION["hms_doctor"])){
    header("location: ../alldoctors.php");
  }
   global $login;
   $login = true;
}else{
  header("location: ../");
}
require("../conn.php");
foreach($_POST as $key => $val){
  if($val=="") header("location: ".isset($_SERVER["HTTP_REFERER"])? $_SERVER["HTTP_REFERER"]: "../");
}
$docid = secure($_POST['doc-id']);
$spec = secure($_POST['spec']);
$fullname = secure($_POST['fullname']);
$phone = secure($_POST['phone']);
$email = secure($_POST['email']);
$date = secure($_POST['date']);
$time = secure($_POST['time']);
$area = secure($_POST['area']);
$city = secure($_POST['city']);
$state = secure($_POST['state']);
$postalcode = secure($_POST['postalcode']);
$q = "SELECT * FROM doctors WHERE `doc-id`='$docid' AND `spec`='$spec'";
$doc = $con->query($q);
if(mysqli_num_rows($doc)<1){
  header("location: ../alldoctors.php");
  return;
}
$doctor=1;
while($row=mysqli_fetch_array($doc)){
$doctor = $row;
}
$sessionemail = secure($_SESSION["hms_login_email"]);
$sessionfname = secure($_SESSION["hms_login_fname"]);
$sessionlname = secure($_SESSION["hms_login_lname"]);

$q = "SELECT id FROM users WHERE `fname`='$sessionfname' AND `lname`='$sessionlname' AND `email`='$sessionemail'";
$user = $con->query($q);
if(mysqli_num_rows($user)<1){
  header("location: ../alldoctors.php");
  return;
}
$hms_user=1;
while($row=mysqli_fetch_array($user)){
$hms_user = $row;
}
$_SESSION["hms_user_id"] = $hms_user["id"];

function secure($str){
  global $con;
  $str = mysqli_real_escape_string($con,$str);
  return $str;
}

?>
<!DOCTYPE html><html lang=""><head><script type="text/javascript" class="silex-json-styles" data-silex-static="">
    window.silex = window.silex || {}
    window.silex.data = {"site":{"width":1225},"pages":[{"id":"page-home","displayName":"Home","link":{"linkType":"LinkTypePage","href":"#!page-home"},"canDelete":true,"canProperties":true,"canMove":true,"canRename":true,"opened":false},{"id":"page-vacations","displayName":"Vacations","link":{"linkType":"LinkTypePage","href":"#!page-vacations"},"canDelete":true,"canProperties":true,"canMove":true,"canRename":true,"opened":false},{"id":"page-flights","displayName":"Flights","link":{"linkType":"LinkTypePage","href":"#!page-flights"},"canDelete":true,"canProperties":true,"canMove":true,"canRename":true,"opened":false},{"id":"page-hotels","displayName":"Hotels","link":{"linkType":"LinkTypePage","href":"#!page-hotels"},"canDelete":true,"canProperties":true,"canMove":true,"canRename":true,"opened":false},{"id":"page-contact","displayName":"Contact","link":{"linkType":"LinkTypePage","href":"#!page-contact"},"canDelete":true,"canProperties":true,"canMove":true,"canRename":true,"opened":false}]}</script>
      
      <meta charset="UTF-8">
      <!-- generator meta tag -->
      <!-- leave this for stats and Silex version check -->
      <meta name="generator" content="Silex v2.2.13">
      <!-- End of generator meta tag -->
      <script type="text/javascript" src="https://editor.silex.me/static/2.12/jquery.js" data-silex-static=""></script>
      <script type="text/javascript" src="https://editor.silex.me/static/2.12/jquery-ui.js" data-silex-static="" data-silex-remove-publish=""></script>
      <script type="text/javascript" src="https://editor.silex.me/static/2.12/pageable.js" data-silex-static="" data-silex-remove-publish=""></script>
      <script type="text/javascript" src="https://editor.silex.me/static/2.12/front-end.js" data-silex-static=""></script>
      <link rel="stylesheet" href="https://editor.silex.me/static/2.12/normalize.css" data-silex-static="">
      <link rel="stylesheet" href="https://editor.silex.me/static/2.12/front-end.css" data-silex-static="">
      <style type="text/css" class="silex-style">body .editable-style.column-section.container-element {padding: 0; margin: 0;}div.column-section {width: 100%; color: #33bbff;}div.column-section > a {width: 100%;}@media (min-width:481px) {.silex-editor div.column-section {padding: 50px 0;}div.column-section > a {width: 33.333%;}}</style>
      <script type="text/javascript" class="silex-script"></script>
      <style class="silex-inline-styles" type="text/css">.body-initial {background-color: rgba(255,255,255,1); position: static;}.silex-id-1478366444112-1 {background-color: transparent; min-width: 1200px; position: static; margin-top: -1px;}.silex-id-1478366444112-0 {background-color: transparent; min-height: 92px; position: relative; margin-left: auto; margin-right: auto;}.silex-id-1552765147494-1 {width: 33px; background-color: transparent; top: 100px; left: 686px; min-height: 27px; position: absolute;}.silex-id-1537545843556-0 {width: 231px; background-color: transparent; top: 0px; left: 0px; min-height: 90px; position: absolute;}.silex-id-1537542841131-2 {width: 206px; top: 22px; left: 48.999996185302734px; min-height: 115px; position: absolute; opacity: 1; background-color: transparent;}.silex-id-1537543262916-6 {width: 664px; top: 17px; left: 535px; min-height: 55px; position: absolute; background-color: transparent;}.silex-id-1537729669184-95 {width: 100px; background-color: transparent; top: 3267px; left: 944px; min-height: 100px; position: absolute;}.silex-id-1545056415237-3 {min-width: 1200px; position: static; margin-top: -1px;}.silex-id-1545056415233-2 {min-height: 791px; position: relative; margin-left: auto; margin-right: auto;}.silex-id-1545056530213-6 {width: 276px; top: 0px; left: 0px; min-height: 139px; position: absolute;}.silex-id-1548870370847-0 {height: 496px; width: 777px; background-color: transparent; top: 132px; left: 0px; position: absolute;}.silex-id-1548871340538-0 {width: 400px; height: 488px; background-color: transparent; top: 136px; left: 800px; position: absolute;}.silex-id-1545056569614-8 {min-width: 1200px; position: static; margin-top: -1px;}.silex-id-1545056569608-7 {min-height: 517px; position: relative; margin-left: auto; margin-right: auto;}.silex-id-1545056587321-9 {width: 854px; top: 0px; left: 179px; min-height: 137px; position: absolute;}.silex-id-1545056612457-10 {min-width: 1200px; position: static; margin-top: -1px;}.silex-id-1545056612458-11 {min-height: 517px; position: relative; margin-left: auto; margin-right: auto;}.silex-id-1545056612459-12 {width: 854px; top: 0px; left: 179px; min-height: 137px; position: absolute;}.silex-id-1545056615878-13 {min-width: 1200px; position: static; margin-top: -1px;}.silex-id-1545056615879-14 {min-height: 517px; position: relative; margin-left: auto; margin-right: auto;}.silex-id-1545056615879-15 {width: 854px; top: 0px; left: 179px; min-height: 137px; position: absolute;}.silex-id-1632995709425-2 {width: 100px; min-height: 100px; position: absolute;}.silex-id-1633598767769-0 {width: 100px; min-height: 100px; background-color: rgb(255, 255, 255); position: absolute; top: 956.3333129882812px; left: 221.99999743700027px;}.silex-id-1633599106564-23 {position: static; background-color: rgba(224,230,246,1);}.silex-id-1633599106582-24 {min-height: 465.65625px; background-color: rgba(224,230,246,1); position: relative; margin-left: auto; margin-right: auto;}.silex-id-1633599129580-25 {width: 247px; top: 129.67689514160156px; left: 49.00028610229492px; background-image: url(240_F_260040900_oO6YW1sHTnKxby4GcjCvtypUCWjnQRg5.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: rgba(133,133,133,1); min-height: 290px; position: absolute; border-width: 1px 1px 1px 1px; border-style: solid; border-color: transparent;}.silex-id-1633599179552-27 {width: 247px; top: 130.01036071777344px; left: 324px; background-image: url(240_F_260040900_oO6YW1sHTnKxby4GcjCvtypUCWjnQRg5.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: rgba(133,133,133,1); min-height: 290px; position: absolute;}.silex-id-1633599181033-28 {width: 247px; top: 130px; left: 605.9895629882812px; background-image: url(240_F_260040900_oO6YW1sHTnKxby4GcjCvtypUCWjnQRg5.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: rgba(133,133,133,1); min-height: 290px; position: absolute;}.silex-id-1633599188186-29 {width: 247px; top: 130px; left: 893.3333129882812px; background-image: url(240_F_260040900_oO6YW1sHTnKxby4GcjCvtypUCWjnQRg5.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: rgba(133,133,133,1); min-height: 290px; position: absolute;}.silex-id-1633599236093-31 {width: 414px; min-height: 56px; position: absolute; top: 31px; left: 49px;}.silex-id-1634036410444-0 {position: static; background-color: rgba(255,255,255,1);}.silex-id-1634036410445-1 {min-height: 1097.3333740234375px; background-color: rgba(255,255,255,1); position: relative; margin-left: auto; margin-right: auto;}.silex-id-1634036436572-2 {width: 497px; min-height: 82px; background-color: transparent; position: absolute; top: -1px; left: -1px;}.silex-id-1634036447925-3 {width: 329px; min-height: 77px; position: absolute; top: 18px; left: 29px;}.silex-id-1634036867391-5 {width: 267px; height: 40px; position: absolute; top: 616px; left: 286px;}.silex-id-1634036942748-7 {width: 1217px; min-height: 20px; background-color: transparent; position: absolute; top: 81px; left: 8px;}.silex-id-1634098891983-0 {width: 1028px; min-height: 676px; background-color: rgb(255, 255, 255); position: absolute; top: 110px; left: 94px;}@media only screen and (max-width: 480px) {.silex-id-1552765147494-1 {left: -12px; top: 11246px;}.silex-id-1537545843556-0 {top: 0px; left: 148px; width: 269px; min-height: 90px;}.silex-id-1537542841131-2 {top: 4px; left: 122px; width: 205px; min-height: 83px;}.silex-id-1545056415237-3 {top: 89px; left: 0px;}.silex-id-1545056415233-2 {min-height: 1543px;}.silex-id-1545056530213-6 {top: 56px; left: 11px; width: 424px; min-height: 139px;}.silex-id-1633599129580-25 {min-height: 424px; top: 0px; left: 0px; width: 380px;}.silex-id-1633599179552-27 {min-height: 424px; top: 0px; left: 0px; width: 380px;}.silex-id-1633599181033-28 {min-height: 424px; top: 0px; left: 0px; width: 380px;}.silex-id-1633599188186-29 {min-height: 424px; top: 0px; left: 0px; width: 380px;}}</style>
      <title></title>
      <link href="https://fontlibrary.org/face/glacial-indifference" rel="stylesheet" class="silex-custom-font">
      <style type="text/css" class="silex-style-settings">.website-width {width: 1225px;}@media (min-width: 481px) {.silex-editor {min-width: 1425px;}}</style>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="twitter:title" content="Silex template">
      <meta name="og:title" content="Silex template">
      <meta name="twitter:description" content="your description here">
      <meta name="og:description" content="your description here">
      <meta name="twitter:card" content="summary">
      <link data-dependency="" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/css/ol.css" rel="stylesheet" type="text/css">
      <script data-dependency="" type="text/javascript" src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/build/ol.js"></script>
      <style class="silex-prodotype-style" type="text/css" data-style-id="all-style">.text-element > .silex-element-content {font-family: GlacialIndifferenceRegular, sans-serif;}a {text-decoration: none;}[data-silex-href] {text-decoration: none;}@media only screen and (max-width: 480px) {p {font-size: 1.5em;}}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="footer">.footer.text-element > .silex-element-content {font-size: 20px; color: #E8E8E8; text-align: left;}.footer a {color: #858585; text-decoration: none;}.footer [data-silex-href] {color: #858585; text-decoration: none;}@media only screen and (max-width: 480px) {}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="header">.header h1 {font-size: 32px; color: #F78536; text-transform: uppercase; letter-spacing: -1px;}.header p {font-size: 17px; color: #393535; text-align: right; word-spacing: 40px; letter-spacing: 1px;}.header a {font-weight: bold; color: #505050; text-decoration: none;}.header [data-silex-href] {font-weight: bold; color: #505050; text-decoration: none;}.header .page-link-active {color: #F78536;}.header a:hover {color: #F78536;}.header [data-silex-href]:hover {color: #F78536;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="text-style-1">.text-style-1 h2 {font-weight: normal; font-size: 45px; text-transform: capitalize;}.text-style-1 h3 {font-weight: normal; font-size: 25px;}.text-style-1.text-element > .silex-element-content {color: #ffffff;}.text-style-1 b {font-weight: bold; font-size: 50px;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="tab">.tab.text-element > .silex-element-content {font-weight: bold; color: #ffffff; text-align: center;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="tab2">.tab2.text-element > .silex-element-content {font-weight: bold; color: #F78536; text-align: center;}.tab2.text-element > .silex-element-content:hover {background-color: #e0e0e0;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="inputs">.inputs.text-element > .silex-element-content {font-weight: bold; color: #F78536; background-color: #e8e8e8; text-indent: 10px;}.inputs p {line-height: 2;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="label">.label.text-element > .silex-element-content {font-weight: bold; font-size: 14px; color: #585858; line-height: 1px;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="button">.button.text-element > .silex-element-content {font-weight: bold; font-size: 20px; color: #ffffff; background-color: #F78536; text-align: center;}.button p {line-height: 2;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="text-style-2">.text-style-2 h2 {font-weight: normal; font-size: 45px; color: #414141; text-transform: capitalize; line-height: 1;}.text-style-2.text-element > .silex-element-content {text-align: center;}.text-style-2 p {font-size: 20px; color: #858585;}@media only screen and (max-width: 480px) {.text-style-2 p {font-size: 2em;}}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="card">.card h3 {font-weight: normal; font-size: 35px; line-height: 0.1;}.card.text-element > .silex-element-content {color: #ffffff; text-indent: 22px;}.card a {font-size: 18px; color: #ffffff; background-color: #F78536; text-decoration: none; text-transform: uppercase;}.card [data-silex-href] {font-size: 18px; color: #ffffff; background-color: #F78536; text-decoration: none; text-transform: uppercase;}.card b {font-size: 29px;}.card u {font-size: 18px; text-decoration: none;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="button-light">.button-light.text-element > .silex-element-content {font-weight: normal; font-size: 16px; color: #ffffff; background-color: #F78536; text-align: center; text-transform: uppercase;}.button-light p {line-height: 3;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="button-invert">.button-invert.text-element > .silex-element-content {font-weight: bold; font-size: 20px; color: #F78536; text-align: center;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="button-inverted-light">.button-inverted-light.text-element > .silex-element-content {font-weight: normal; font-size: 16px; color: #ffffff; text-align: center; text-transform: uppercase;}.button-inverted-light p {line-height: 1;}@media only screen and (max-width: 480px) {.button-inverted-light.text-element > .silex-element-content {color: #000000;}}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="card-text">.card-text h3 {font-weight: normal; font-size: 25px; color: #414141; line-height: 0.1;}.card-text.text-element > .silex-element-content {color: #858585; text-align: justify; column-gap: 50px;}.card-text a {font-size: 18px; color: #F78536; text-decoration: none; text-transform: capitalize;}.card-text [data-silex-href] {font-size: 18px; color: #F78536; text-decoration: none; text-transform: capitalize;}.card-text b {font-size: 29px;}.card-text u {font-size: 18px; text-decoration: none;}@media only screen and (max-width: 480px) {.card-text.text-element > .silex-element-content {text-align: left;}}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="label-image">.label-image.text-element > .silex-element-content {font-weight: bold; font-size: 25px; color: #ffffff; text-align: center; line-height: 4;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="text-style-3">.text-style-3.text-element > .silex-element-content {columns: 3;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="card-text-2">.card-text-2 h3 {font-weight: normal; font-size: 25px; color: #414141; line-height: 0.1;}.card-text-2.text-element > .silex-element-content {color: #858585; text-align: justify; columns: 3; column-gap: 50px;}.card-text-2 p {text-indent: 12px;}.card-text-2 a {font-size: 18px; color: #F78536; text-decoration: none; text-transform: capitalize; text-indent: 31px;}.card-text-2 [data-silex-href] {font-size: 18px; color: #F78536; text-decoration: none; text-transform: capitalize; text-indent: 31px;}.card-text-2 b {font-size: 29px;}.card-text-2 u {font-size: 18px; text-decoration: none;}</style>
      <style class="silex-prodotype-style" type="text/css" data-style-id="hamburger-menu">@media only screen and (max-width: 480px) {.hamburger-menu.text-element > .silex-element-content {font-size: 1.5em; text-indent: 15px;}.hamburger-menu a {color: #000000; line-height: 2;}.hamburger-menu [data-silex-href] {color: #000000; line-height: 2;}.hamburger-menu ul li {list-style-type: none;}.hamburger-menu .page-link-active {color: #f78536;}}</style>
   </head>
   <body data-silex-id="body-initial" class="body-initial all-style enable-mobile prevent-resizable prevent-selectable editable-style silex-runtime" data-silex-type="container-element" style="">
      
      
      
      
      
      
      
     
   
<section data-silex-type="container-element" class="container-element editable-style silex-id-1478366444112-1 section-element prevent-resizable" data-silex-id="silex-id-1478366444112-1" style="">
         <div data-silex-type="container-element" class="editable-style silex-element-content silex-id-1478366444112-0 container-element website-width" data-silex-id="silex-id-1478366444112-0" style="">
            
            
            
         <div data-silex-type="text-element" class="editable-style silex-id-1552765147494-1 text-element silex-component prevent-resizable hide-on-desktop hamburger-menu prevent-auto-z-index" data-silex-id="silex-id-1552765147494-1">
               <div class="silex-element-content normal"><style>.hamburger-menu_1634100463424_142 {position: absolute; z-index: 20;}.silex-editor .hamburger-menu_1634100463424_142 nav {left: -9999px;}.hamburger-menu_1634100463424_142 nav ul {margin-top: 80px;}.hamburger-menu_1634100463424_142 nav {opacity: 0; position: absolute; background-color: #ededed; transition: left 1s ease, height 0s ease 1s; left: -300px; width: 300px; height: 20px;}.hamburger-menu_1634100463424_142.open nav {opacity: 1; height: 100vh; left: 0; transition: left 1s ease, height 0s ease 0s;}.hamburger-menu_1634100463424_142 .nav-container {z-index: 10; position: absolute;}.hamburger-menu_1634100463424_142.open .nav-container {}.hamburger-menu_1634100463424_142 .hamburger-btn {z-index: 20; cursor: pointer; position: absolute;}.hamburger-menu_1634100463424_142 .hamburger-btn span {display: block; width: 30px; height: 5px; margin-bottom: 3px; position: relative; background-color: #000000; border: 1px solid #ffffff; border-radius: 3px; transition: border-color 0.1s ease-in,
      opacity 0.1s ease-in,
      transform 0.1s ease-in,
      background 0.1s ease-in;}.hamburger-menu_1634100463424_142.open .hamburger-btn span {border-color: rgba(255, 255, 255, 0);}.hamburger-menu_1634100463424_142 .hamburger-btn span:first-child {transform-origin: 4px -2px;}.hamburger-menu_1634100463424_142.open .hamburger-btn span:first-child {transform: rotate(45deg) translate(7px, -4px);}.hamburger-menu_1634100463424_142.open .hamburger-btn span:nth-last-child(2) {opacity: 0;}.hamburger-menu_1634100463424_142 .hamburger-btn span:nth-child(3) {transform-origin: -11px 4px;}.hamburger-menu_1634100463424_142.open .hamburger-btn span:nth-child(3) {transform: rotate(-45deg) translate(0, 12px);}</style>

</div>
            </div><div data-silex-type="text-element" class="editable-style silex-id-1537542841131-2 text-element header" data-silex-id="silex-id-1537542841131-2" style="" href="null">
               <div class="silex-element-content normal">
                  <h3>E-HEALTH-CARE MANAGEMENT SYSTEM<br><br></h3>
                  <h3></h3>
                  <h3></h3>
               </div>
            </div><div data-silex-type="text-element" class="editable-style silex-id-1537543262916-6 text-element header hide-on-mobile" data-silex-id="silex-id-1537543262916-6" style="" href="null">
               <div class="silex-element-content normal">
                  <p><a style="color: #fff;cursor:pointer;text-decoration:none" onclick="window.location.href='../HOME'.toLowerCase()+'.php'">HOME</a>
 <a style="color: #fff;cursor:pointer;text-decoration:none" onclick="window.location.href='../allDOCTORS'.toLowerCase()+'.php'">ALL_DOCTORS</a>
<a style="color: #fff;cursor:pointer;text-decoration:none" onclick="window.location.href='../PATIENTHOME'.toLowerCase()+'.php'">DASHBOARD</a>
<a style="color: #fff;cursor:pointer;text-decoration:none" onclick="window.location.href='../LOGOUT'.toLowerCase()+'.php'">LOGOUT</a>
</p>
               </div>
            </div></div>
      </section>


      <section data-silex-type="container-element" class="editable-style section-element silex-id-1634036410444-0 page-home paged-element" data-silex-id="silex-id-1634036410444-0" style=""><div data-silex-type="container-element" class="editable-style container-element silex-id-1634036410445-1 silex-element-content website-width prevent-draggable" data-silex-id="silex-id-1634036410445-1" style=""><div data-silex-type="container-element" class="editable-style container-element silex-id-1634036436572-2" data-silex-id="silex-id-1634036436572-2" style=""><div data-silex-type="text-element" class="editable-style text-element silex-id-1634036447925-3" data-silex-id="silex-id-1634036447925-3" style="" href="null"><div class="silex-element-content normal"><h2><b>Make Payment:&nbsp;</b></h2></div></div></div><div data-silex-type="html-element" class="editable-style html-element silex-id-1634036942748-7" data-silex-id="silex-id-1634036942748-7" style=""><div class="silex-element-content"><hr></div></div><div data-silex-type="image-element" class="editable-style image-element silex-id-1634036867391-5" data-silex-id="silex-id-1634036867391-5" style=""><img src="../paymenthms.png"></div><div data-silex-type="html-element" class="editable-style html-element silex-id-1634098891983-0" data-silex-id="silex-id-1634098891983-0" style=""><div class="silex-element-content"><style>*,
*::before,
*::after {box-sizing: border-box;}body,
.bold{display:inline-block;color:rgb(0, 89, 255);font-weight: 700;} html {height: 100%; font-family: 'Quicksand', sans-serif; font-weight: 400; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;}body {background: linear-gradient(to bottom, rgba(37,44,65,1) 0%, rgba(37,44,65,1) 60%, rgba(221,223,230,1) 60%, rgba(221,223,230,1) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#252c41', endColorstr='#dddfe6', GradientType=0 );}.subject {font-family: 'Playfair Display', serif; color: rgba(255,255,255,0.02); font-size: 16vw; letter-spacing: -4px; line-height: 0.9; z-index: -1;}h1, h2, h3, h4, h5, h6 {margin: 0; line-height: 1.4;}h1 {font-size: 42px; color: #6d819c; text-align: left;}h2 {font-size: 28px; letter-spacing: -2px; color: #6d819c; text-align: center; line-height: 2.8;}h3 {font-size: 16px; color: #dddfe6; letter-spacing: 1px; text-align: left;}h4 {font-size: 16px; color: #7495aa; letter-spacing: 1px; text-align: left; line-height: 2;}h5 {font-size: 11px; font-weight: 700; color: #c9d6de; letter-spacing: 1px; text-align: left; text-transform: uppercase;}h5 > span {margin-left: 87px;}h5.total {margin-top: 20px;}h6 {font-family: 'PT Mono'; font-size: 18px; font-weight: 400; color: #f4f5f9; letter-spacing: 0px; text-align: left; text-transform: uppercase; line-height: 1.8;}h6 > span {margin-left: 64px;}.checkout {width: 670px; height: 485px; position: absolute; top: 38%; left: 50%; background-color: #dddfe6; overflow: hidden; -webkit-transform: translate(-50%, -50%); transform: translate(-50%, -50%); -webkit-border-radius: 12px; -moz-border-radius: 12px; border-radius: 12px; -webkit-box-shadow: 0 30px 48px rgba(37,44,65,0.32); -moz-box-shadow: 0 30px 48px rgba(37,44,65,0.32); box-shadow: 0 30px 48px rgba(37,44,65,0.32);}.order {width: 300px; height: 485px; padding: 0 30px; float: left; background-color: #f4f5f9; z-index: 1; -webkit-box-shadow: 0 15px 24px rgba(37,44,65,0.16); -moz-box-shadow: 0 15px 24px rgba(37,44,65,0.16); box-shadow: 0 15px 24px rgba(37,44,65,0.16);}ul.order-list {width: 100%; height: 205px; list-style: none; overflow-y: scroll; padding-right: 12px;}ul.order-list li {height: 60px; margin-left: -40px; overflow: hidden; border-bottom: 1px solid #e9ebf2;}ul.order-list li > img {width: 60px; height: 60px; float: left;}ul.order-list li > h4 {margin-top: 16px; line-height: 1; letter-spacing: 1px; text-align: right; -webkit-transition: all 0.3s; -moz-transition: all 0.3s; -ms-transition: all 0.3s; -o-transition: all 0.3s; transition: all 0.3s;}ul.order-list li:hover > h4 {margin-top: 8px;}ul.order-list li > h5 {margin-top: 0px; text-align: right; display: none; -webkit-transition: all 0.3s; -moz-transition: all 0.3s; -ms-transition: all 0.3s; -o-transition: all 0.3s; transition: all 0.3s;}ul.order-list li:hover > h5 {margin-top: 3px; display: block;}.payment {z-index: 0; width: 370px; position: relative; float: right;}.card {width: 300px; height: 178px; position: relative; margin: 0 auto; background-color: #f1404b; overflow: hidden; z-index: 1; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; -webkit-box-shadow: 0 15px 24px rgba(37,44,65,0.32); -moz-box-shadow: 0 15px 24px rgba(37,44,65,0.32); box-shadow: 0 15px 24px rgba(37,44,65,0.32);}.card-content {width: 100%; padding: 20px; position: relative; float: left; z-index: 1;}#logo-visa {position: relative; margin-top: -20px; left: 190px;}.card-form {width: 100%; position: relative; float: right; padding: 15px 35px;}.card-form > p.field {height: 48px; padding: 2px 10px; margin-bottom: 2px; background-color: #f4f5f9; border: 1px solid #d2d4de; display: inline-block; -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px;}input[type=text] {height: 32px; position: relative; padding: 0px 10px 0px 6px; background-color: transparent; border: none; color: #000; font-family: 'PT Mono'; font-size: 18px; font-weight: 400; z-index: 0;}input[type=text]:focus {outline: none;}::-webkit-input-placeholder {color: #dddfe6;}:-moz-placeholder {color: #dddfe6;}::-moz-placeholder {color: #dddfe6;}:-ms-input-placeholder {color: #dddfe6;}#i-cardfront, #i-cardback, #i-calendar {position: relative; top: 8px; z-index: 1;}#cardnumber {width: 244px;}#cardexpiration {width: 114px;}#cardcvc {width: 60px;}.space {margin-right: 10px;}button:focus {outline: 0;}.button-cta {width: 100%; height: 65px; position: absolute; float: right; right: 0px; bottom: -68px; padding: 10px 20px; background-color: #f1404b; border: 1px solid #f1404b; font-family: 'Quicksand', sans-serif; font-weight: 700; font-size: 24px; color: #f4f5f9; z-index: -1; -webkit-transition: all 0.3s; -moz-transition: all 0.3s; -ms-transition: all 0.3s; -o-transition: all 0.3s; transition: all 0.3s;}.button-cta:hover {background: rgba(193,14,26,1); border: 1px solid rgba(193,14,26,1);}.button-cta span {display: inline-block; position: relative; -webkit-transition: all 0.3s; -moz-transition: all 0.3s; -ms-transition: all 0.3s; -o-transition: all 0.3s; transition: all 0.3s;}.button-cta span:after {content: '→'; color: #f4f5f9; position: absolute; opacity: 0; top: 0; right: -40px;}.button-cta:hover span {padding-right: 45px;}.button-cta:hover span:after {opacity: 1; right: 0;}.wave {height: 300px; width: 300px; position: relative; background: #780910; z-index: -1;}.wave:before, .wave:after {content: ""; display: block; position: absolute; background: linear-gradient(to bottom, rgba(193,14,26,1) 0%, rgba(241,64,76,0.3) 100%); filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#c10e1a', endColorstr='#f1404c', GradientType=0 ); -webkit-border-radius: 50% 50%; -moz-border-radius: 50% 50%; border-radius: 50% 50%;}.wave:after {height: 300px; width: 300px; left: 30%; top: 20%; opacity: 0.8;}.wave:before {height: 360px; width: 360px; left: -5%; top: -70%;}.paid {z-index: 0; width: 370px; position: relative; float: right; padding: 30px; text-align: center; display: none;}.paid > h2 {line-height: 1; margin-top: 10px; color: #3ac569;}.icon-credits {width: 100%; position: absolute; bottom: 4px; font-family: 'Open Sans', 'Helvetica Neue', Helvetica, sans-serif; font-size: 12px; color: rgba(0,0,0,0.08); text-align: center; z-index: -1;}.icon-credits a {text-decoration: none; color: rgba(0,0,0,0.12);}</style>
<div class="subject">DailyUI #002 <br><strong>Credit Card Checkout</strong></div>

<div class="checkout">
  <form method="POST" id="formpayment" action="donepayment.php">
    <?php
    foreach($_POST as $key => $val){
      echo '<input type="hidden" name="'.secure($key).'" value="'.secure($val).'"/>';
    }
      ?>
  </form>
  <div class="order">
    <?php //var_dump($_POST)
    ?>
    <h2>Book Appointment</h2>
    <h4>Name: <div class="bold"><?= $fullname ?></div></h4>
    <h4>Address: <div class="bold"><?= $area ?>, <?= $city ?> - <?= $postalcode ?>, <?= $state ?></div></h4>
    <h4>Appointment Date: <div class="bold"><?= $date ?></div></h4>
    <h4>Time: <div class="bold"><?= $time ?></div></h4>
    <h4>Doctor: </h4><h4><div class="bold"><?='Dr. '.$doctor['name']?> <?=$doctor['lname']?></div> </h4>
    <h4 class="total">Total</h4><h2><div class="bold"><?='₹'.$doctor["fees"]?></div></h2>
  </div>
  <h2>Payment</h2>
  <div id="payment" class="payment">
    <div class="card">
      <div class="card-content">
        <svg id="logo-visa" enable-background="new 0 0 50 70" height="70px" version="1.1" viewBox="0 0 50 50" width="70px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><polygon clip-rule="evenodd" fill="#f4f5f9" fill-rule="evenodd" points="17.197,32.598 19.711,17.592 23.733,17.592     21.214,32.598   "></polygon><path clip-rule="evenodd" d="M35.768,17.967c-0.797-0.287-2.053-0.621-3.596-0.621    c-3.977,0-6.752,2.029-6.776,4.945c-0.023,2.154,1.987,3.358,3.507,4.08c1.568,0.738,2.096,1.201,2.076,1.861    c0,1.018-1.238,1.471-2.395,1.471c-1.604,0-2.455-0.232-3.773-0.787l-0.53-0.248l-0.547,3.348    c0.929,0.441,2.659,0.789,4.462,0.811c4.217,0,6.943-2.012,6.979-5.135c0.025-1.692-1.053-2.999-3.369-4.071    c-1.393-0.685-2.246-1.134-2.246-1.844c0-0.645,0.723-1.306,2.295-1.306c1.314-0.024,2.268,0.271,3.002,0.58l0.365,0.167    L35.768,17.967z" fill="#f4f5f9" fill-rule="evenodd"></path><path clip-rule="evenodd" d="M46.055,17.616h-3.102c-0.955,0-1.688,0.272-2.117,1.24    l-5.941,13.767h4.201c0,0,0.688-1.869,0.852-2.262c0.469,0,4.547,0,5.133,0c0.123,0.518,0.49,2.262,0.49,2.262h3.711    L46.055,17.616 M41.1,27.277c0.328-0.842,1.609-4.175,1.609-4.175c-0.041,0.043,0.328-0.871,0.529-1.43l0.256,1.281    c0,0,0.773,3.582,0.938,4.324H41.1z" fill="#f4f5f9" fill-rule="evenodd"></path><path clip-rule="evenodd" d="M13.843,17.616L9.905,27.842l-0.404-2.076    c-0.948-2.467-2.836-4.634-5.53-6.163l3.564,12.995h4.243l6.312-14.982H13.843z" fill="#f4f5f9" fill-rule="evenodd"></path><path clip-rule="evenodd" d="M7.232,17.174H0.755l-0.037,0.333    c5.014,1.242,8.358,4.237,9.742,7.841l-1.42-6.884C8.798,17.507,8.105,17.223,7.232,17.174L7.232,17.174z" fill="#f4f5f9" fill-rule="evenodd"></path></g></g></svg>
        <h5>Card Number</h5>
        <h6 id="label-cardnumber">0000 0000 0000 0000</h6>
        <h5>Expiration<span>CVC</span></h5>
        <h6 id="label-cardexpiration">00 / 0000<span>000</span></h6>
      </div>
      <div class="wave"></div>
    </div>
    <div class="card-form">
        <p class="field">
        <svg id="i-cardfront" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 28 28;" xml:space="preserve" width="28px" height="28px"><g>
          <path d="M471.5,88h-432C17.72,88,0,105.72,0,127.5v256C0,405.28,17.72,423,39.5,423h432c21.78,0,39.5-17.72,39.5-39.5v-256   C511,105.72,493.28,88,471.5,88z M496,383.5c0,13.509-10.991,24.5-24.5,24.5h-432C25.991,408,15,397.009,15,383.5v-256   c0-13.509,10.991-24.5,24.5-24.5h432c13.509,0,24.5,10.991,24.5,24.5V383.5z" fill="#dddfe6"></path>
            <path d="M239.5,352h-176c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5,7.5,7.5h176c4.142,0,7.5-3.358,7.5-7.5S243.642,352,239.5,352z" fill="#dddfe6"></path>
            <path d="M343.5,352h-72c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5,7.5,7.5h72c4.142,0,7.5-3.358,7.5-7.5S347.642,352,343.5,352z" fill="#dddfe6"></path>
            <path d="M79.5,239h48c12.958,0,23.5-10.542,23.5-23.5v-32c0-12.958-10.542-23.5-23.5-23.5h-48C66.542,160,56,170.542,56,183.5v32   C56,228.458,66.542,239,79.5,239z M136,183.5v8.5h-8.5c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5,7.5,7.5h8.5v8.5   c0,4.687-3.813,8.5-8.5,8.5H111v-49h16.5C132.187,175,136,178.813,136,183.5z M79.5,175H96v49H79.5c-4.687,0-8.5-3.813-8.5-8.5V207   h8.5c4.142,0,7.5-3.358,7.5-7.5s-3.358-7.5-7.5-7.5H71v-8.5C71,178.813,74.813,175,79.5,175z" fill="#dddfe6"></path>
            <path d="M63.5,319c4.142,0,7.5-3.358,7.5-7.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16C56,315.642,59.358,319,63.5,319   z" fill="#dddfe6"></path>
            <path d="M80,295.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16c0-4.142-3.358-7.5-7.5-7.5S80,291.358,80,295.5z" fill="#dddfe6"></path>
            <path d="M104,295.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16c0-4.142-3.358-7.5-7.5-7.5S104,291.358,104,295.5z" fill="#dddfe6"></path>
            <path d="M128,295.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16c0-4.142-3.358-7.5-7.5-7.5S128,291.358,128,295.5z" fill="#dddfe6"></path>
            <path d="M167.5,319c4.142,0,7.5-3.358,7.5-7.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16   C160,315.642,163.358,319,167.5,319z" fill="#dddfe6"></path>
            <path d="M191.5,319c4.142,0,7.5-3.358,7.5-7.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16   C184,315.642,187.358,319,191.5,319z" fill="#dddfe6"></path>
            <path d="M215.5,319c4.142,0,7.5-3.358,7.5-7.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16   C208,315.642,211.358,319,215.5,319z" fill="#dddfe6"></path>
            <path d="M239.5,288c-4.142,0-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16   C247,291.358,243.642,288,239.5,288z" fill="#dddfe6"></path>
            <path d="M271.5,319c4.142,0,7.5-3.358,7.5-7.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16   C264,315.642,267.358,319,271.5,319z" fill="#dddfe6"></path>
            <path d="M295.5,319c4.142,0,7.5-3.358,7.5-7.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16   C288,315.642,291.358,319,295.5,319z" fill="#dddfe6"></path>
            <path d="M319.5,319c4.142,0,7.5-3.358,7.5-7.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16   C312,315.642,315.358,319,319.5,319z" fill="#dddfe6"></path>
            <path d="M343.5,288c-4.142,0-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16   C351,291.358,347.642,288,343.5,288z" fill="#dddfe6"></path>
            <path d="M375.5,288c-4.142,0-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16   C383,291.358,379.642,288,375.5,288z" fill="#dddfe6"></path>
            <path d="M399.5,288c-4.142,0-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16   C407,291.358,403.642,288,399.5,288z" fill="#dddfe6"></path>
            <path d="M423.5,288c-4.142,0-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16   C431,291.358,427.642,288,423.5,288z" fill="#dddfe6"></path>
            <path d="M447.5,288c-4.142,0-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16   C455,291.358,451.642,288,447.5,288z" fill="#dddfe6"></path>
            <path d="M415.5,160h-48c-21.78,0-39.5,17.72-39.5,39.5s17.72,39.5,39.5,39.5h48c21.78,0,39.5-17.72,39.5-39.5S437.28,160,415.5,160   z M415.5,224h-48c-13.509,0-24.5-10.991-24.5-24.5s10.991-24.5,24.5-24.5h48c13.509,0,24.5,10.991,24.5,24.5S429.009,224,415.5,224   z" fill="#dddfe6"></path>
          </g>
        </svg>
        <input type="text" id="cardnumber" name="cardnumber" placeholder="1234 5678 9123 4567" pattern="\d*" title="Card Number">
      </p>
        <p class="field space">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="i-calendar" x="0px" y="0px" viewBox="0 0 191.259 191.259" style="enable-background:new 0 0 191.259 191.259;" xml:space="preserve" width="28px" height="28px">
          <g>
            <circle cx="59.768" cy="83.634" r="3.985" fill="#dddfe6"></circle>
            <circle cx="83.676" cy="83.634" r="3.985" fill="#dddfe6"></circle>
          <circle cx="107.583" cy="83.634" r="3.985" fill="#dddfe6"></circle>
          <circle cx="35.861" cy="107.541" r="3.984" fill="#dddfe6"></circle>
          <circle cx="59.768" cy="107.541" r="3.984" fill="#dddfe6"></circle>
          <circle cx="83.676" cy="107.541" r="3.984" fill="#dddfe6"></circle>
          <circle cx="107.583" cy="107.541" r="3.984" fill="#dddfe6"></circle>
          <circle cx="155.398" cy="107.541" r="3.984" fill="#dddfe6"></circle>
          <circle cx="131.49" cy="83.634" r="3.985" fill="#dddfe6"></circle>
          <circle cx="155.398" cy="83.634" r="3.985" fill="#dddfe6"></circle>
          <circle cx="35.861" cy="131.449" r="3.985" fill="#dddfe6"></circle>
          <circle cx="59.768" cy="131.449" r="3.985" fill="#dddfe6"></circle>
          <circle cx="83.676" cy="131.449" r="3.985" fill="#dddfe6"></circle>
          <circle cx="107.583" cy="131.449" r="3.985" fill="#dddfe6"></circle>
          <circle cx="131.49" cy="131.449" r="3.985" fill="#dddfe6"></circle>
          <circle cx="155.398" cy="131.449" r="3.985" fill="#dddfe6"></circle>
          <circle cx="35.861" cy="155.356" r="3.985" fill="#dddfe6"></circle>
          <circle cx="59.768" cy="155.356" r="3.985" fill="#dddfe6"></circle>
          <circle cx="83.676" cy="155.356" r="3.985" fill="#dddfe6"></circle>
          <circle cx="107.583" cy="155.356" r="3.985" fill="#dddfe6"></circle>
            <path d="M131.49,119.495c6.603,0,11.954-5.351,11.954-11.954s-5.351-11.954-11.954-11.954   c-6.603,0-11.954,5.351-11.954,11.954S124.887,119.495,131.49,119.495z M131.49,103.557c2.199,0,3.985,1.786,3.985,3.984   s-1.786,3.984-3.985,3.984s-3.984-1.786-3.984-3.984S129.292,103.557,131.49,103.557z" fill="#dddfe6"></path>
            <path d="M175.321,15.98h-7.969v-3.985c0-6.601-5.354-11.954-11.954-11.954   c-6.603,0-11.954,5.352-11.954,11.954v3.985h-95.63v-3.985c0-6.601-5.354-11.954-11.954-11.954   c-6.603,0-11.954,5.352-11.954,11.954v3.985h-7.969C7.136,15.98,0,23.116,0,31.918v15.854v7.969v119.537   c0,8.802,7.136,15.938,15.938,15.938h159.382c8.802,0,15.938-7.136,15.938-15.938V55.742v-7.969V31.918   C191.259,23.116,184.123,15.98,175.321,15.98z M151.413,23.949V15.98v-3.985c0-2.201,1.782-3.985,3.985-3.985   c2.198,0,3.984,1.784,3.984,3.985v3.985v7.969v3.984c0,2.2-1.786,3.985-3.984,3.985c-2.202,0-3.985-1.784-3.985-3.985V23.949z    M31.876,23.949V15.98v-3.985c0-2.201,1.782-3.985,3.985-3.985c2.199,0,3.985,1.784,3.985,3.985v3.985v7.969v3.984   c0,2.2-1.786,3.985-3.985,3.985c-2.202,0-3.985-1.784-3.985-3.985V23.949z M183.29,175.279c0,4.399-3.564,7.969-7.969,7.969H15.938   c-4.405,0-7.969-3.57-7.969-7.969V55.742H183.29V175.279z M183.29,47.773H7.969V31.918c0-4.403,3.564-7.969,7.969-7.969h7.969   v3.984c0,6.601,5.35,11.954,11.954,11.954c6.6,0,11.954-5.352,11.954-11.954v-3.984h95.63v3.984c0,6.601,5.35,11.954,11.954,11.954   c6.599,0,11.954-5.352,11.954-11.954v-3.984h7.969c4.405,0,7.969,3.566,7.969,7.969V47.773z" fill="#dddfe6"></path>
            </g>
          </svg>
          <input type="text" id="cardexpiration" name="cardexpiration" placeholder="MM / YYYY" pattern="\d*" title="Card Expiration Date">
      </p>
        <p class="field">
          <svg id="i-cardback" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 28 28;" xml:space="preserve" width="28px" height="28px">
          <g>
            <path d="M63.5,288c-4.142,0-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16C71,291.358,67.642,288,63.5,288   z" fill="#dddfe6"></path>
            <path d="M87.5,288c-4.142,0-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16C95,291.358,91.642,288,87.5,288   z" fill="#dddfe6"></path>
            <path d="M111.5,288c-4.142,0-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16   C119,291.358,115.642,288,111.5,288z" fill="#dddfe6"></path>
            <path d="M135.5,288c-4.142,0-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16   C143,291.358,139.642,288,135.5,288z" fill="#dddfe6"></path>
            <path d="M167.5,319c4.142,0,7.5-3.358,7.5-7.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16   C160,315.642,163.358,319,167.5,319z" fill="#dddfe6"></path>
            <path d="M199,311.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5S199,315.642,199,311.5z" fill="#dddfe6"></path>
            <path d="M223,311.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5S223,315.642,223,311.5z" fill="#dddfe6"></path>
            <path d="M239.5,288c-4.142,0-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16   C247,291.358,243.642,288,239.5,288z" fill="#dddfe6"></path>
            <path d="M271.5,319c4.142,0,7.5-3.358,7.5-7.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16   C264,315.642,267.358,319,271.5,319z" fill="#dddfe6"></path>
            <path d="M303,311.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5S303,315.642,303,311.5z" fill="#dddfe6"></path>
            <path d="M327,311.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5S327,315.642,327,311.5z" fill="#dddfe6"></path>
            <path d="M351,311.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5S351,315.642,351,311.5z" fill="#dddfe6"></path>
            <path d="M383,311.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5S383,315.642,383,311.5z" fill="#dddfe6"></path>
            <path d="M407,311.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5S407,315.642,407,311.5z" fill="#dddfe6"></path>
            <path d="M431,311.5v-16c0-4.142-3.358-7.5-7.5-7.5s-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5S431,315.642,431,311.5z" fill="#dddfe6"></path>
            <path d="M447.5,288c-4.142,0-7.5,3.358-7.5,7.5v16c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5v-16   C455,291.358,451.642,288,447.5,288z" fill="#dddfe6"></path>
            <path d="M447.5,216h-384C50.542,216,40,226.542,40,239.5v8c0,12.958,10.542,23.5,23.5,23.5h384c12.958,0,23.5-10.542,23.5-23.5v-8   C471,226.542,460.458,216,447.5,216z M456,247.5c0,4.687-3.813,8.5-8.5,8.5h-384c-4.687,0-8.5-3.813-8.5-8.5v-8   c0-4.687,3.813-8.5,8.5-8.5h384c4.687,0,8.5,3.813,8.5,8.5V247.5z" fill="#dddfe6"></path>
            <path d="M447.5,352h-176c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5,7.5,7.5h176c4.142,0,7.5-3.358,7.5-7.5S451.642,352,447.5,352z" fill="#dddfe6"></path>
            <path d="M239.5,352h-72c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5,7.5,7.5h72c4.142,0,7.5-3.358,7.5-7.5S243.642,352,239.5,352z" fill="#dddfe6"></path>
            <path d="M511,159.498V127.5c0-21.78-17.72-39.5-39.5-39.5h-432C17.72,88,0,105.72,0,127.5v47.998c0,0.001,0,0.003,0,0.005V383.5   C0,405.28,17.72,423,39.5,423h432c21.78,0,39.5-17.72,39.5-39.5V159.502C511,159.501,511,159.499,511,159.498z M496,184h-6.394   l6.394-6.394V184z M449.606,184l41-41H496v13.394L468.394,184H449.606z M409.606,184l41-41h18.787l-41,41H409.606z M369.606,184   l41-41h18.787l-41,41H369.606z M329.606,184l41-41h18.787l-41,41H329.606z M289.606,184l41-41h18.787l-41,41H289.606z M249.606,184   l41-41h18.787l-41,41H249.606z M209.606,184l41-41h18.787l-41,41H209.606z M169.606,184l41-41h18.787l-41,41H169.606z M129.606,184   l41-41h18.787l-41,41H129.606z M89.606,184l41-41h18.787l-41,41H89.606z M49.606,184l41-41h18.787l-41,41H49.606z M15,184v-5.394   L50.606,143h18.787l-41,41H15z M15,143h14.394L15,157.394V143z M39.5,103h432c13.509,0,24.5,10.991,24.5,24.5v0.5h-8.497   c-0.002,0-0.003,0-0.005,0h-39.995c-0.002,0-0.003,0-0.005,0h-39.995c-0.002,0-0.003,0-0.005,0h-39.995c-0.002,0-0.003,0-0.005,0   h-39.995c-0.002,0-0.003,0-0.005,0h-39.995c-0.002,0-0.004,0-0.005,0h-39.995c-0.001,0-0.003,0-0.005,0h-39.995   c-0.001,0-0.003,0-0.005,0h-39.995c-0.001,0-0.003,0-0.005,0h-39.995c-0.001,0-0.003,0-0.005,0H87.502c-0.001,0-0.003,0-0.005,0   H47.502c-0.001,0-0.003,0-0.005,0H15v-0.5C15,113.991,25.991,103,39.5,103z M471.5,408h-432C25.991,408,15,397.009,15,383.5V199   h481v184.5C496,397.009,485.009,408,471.5,408z" fill="#dddfe6"></path>
            </g>
          </svg>
          <input type="text" id="cardcvc" name="cardcvc" placeholder="123" pattern="\d*" title="CVC Code">
      </p>
      <button class="button-cta" title="Confirm your aAppointment" onclick="gateway()"><span>BOOK APPOINTMENT</span></button>
    </div>
  </div>
  <style>
    .loader {
      margin-top: 20%;
      display: inline-block;
      border: 5px solid #dbdbdb;
      border-radius: 50%;
      clear: both;
      border-top: 5px solid #000000;
      width: 60px;
      height: 60px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }
    
    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    </style>
  <div id="paid" class="paid">
    <svg id="icon-paid" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 310.277 310.277" style="enable-background:new 0 0 310.277 310.277;" xml:space="preserve" width="180px" height="180px">
    <g>	<path d="M155.139,0C69.598,0,0,69.598,0,155.139c0,85.547,69.598,155.139,155.139,155.139   c85.547,0,155.139-69.592,155.139-155.139C310.277,69.598,240.686,0,155.139,0z M144.177,196.567L90.571,142.96l8.437-8.437   l45.169,45.169l81.34-81.34l8.437,8.437L144.177,196.567z" fill="#3ac569"></path>
    </g></svg>
    <h2>Your payment was completed.</h2>
    <h2>Thank you!</h2>
  </div>
</div>
<div id="cover" style="display:none;text-align:center;width:100%;height:100%;position:fixed;top:0;left:0;background:rgba(63, 63, 63, 0.6)">
<div class="loader"></div>
</div>
<script>
  function gateway(){
    setTimeout(() => {
      document.querySelector(".payment").style.display="none";
      document.querySelector(".paid").style.display="block";
    }, 4000);
    setTimeout(() => {
      document.querySelector("#cover").style.display="block";
    }, 5000);
    setTimeout(() => {
      document.querySelector("#formpayment").submit();
    }, 6000);
    window.open('gateway.php','_blank');
  }
</script>
</div></div></div></section>
<section data-silex-type="container-element" class="container-element editable-style section-element silex-id-1545056615878-13 prevent-resizable page-hotels paged-element" data-silex-id="silex-id-1545056615878-13">
         <div data-silex-type="container-element" class="editable-style container-element silex-element-content website-width silex-id-1545056615879-14" data-silex-id="silex-id-1545056615879-14">
            <div data-silex-type="text-element" class="editable-style text-element text-style-2 silex-id-1545056615879-15" data-silex-id="silex-id-1545056615879-15" style="">
               <div class="silex-element-content normal">
                  <h2>Your content Here<br></h2>
               </div>
               ﻿﻿
            </div>
         </div>
      </section></body></html>