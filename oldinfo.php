<?php
if(!isset($_GET['doctorid'])) header("location: alldoctors.php");
require("conn.php");
$docid = secure($_GET['doctorid']);

$q = "SELECT * FROM doctors WHERE `doc-id`='$docid'";
$doc = $con->query($q);
if(mysqli_num_rows($doc)<1){
  header("location: alldoctors.php");
  return;
}
$doctor=1;
while($row=mysqli_fetch_array($doc)){
$doctor = $row;
}
function secure($str){
  global $con;
  $str = mysqli_real_escape_string($con,$str);
  return $str;
}
session_start();
$login = false;
if(isset($_SESSION["hms_login"])){
   global $login;
   $login = true;
}
?>
<!DOCTYPE html><html lang=""><head><script type="text/javascript" class="silex-json-styles" data-silex-static="">
    window.silex = window.silex || {}
    window.silex.data = {"site":{"width":1200},"pages":[{"id":"page-home","displayName":"Home","link":{"linkType":"LinkTypePage","href":"#!page-home"},"canDelete":true,"canProperties":true,"canMove":true,"canRename":true,"opened":false},{"id":"page-vacations","displayName":"Vacations","link":{"linkType":"LinkTypePage","href":"#!page-vacations"},"canDelete":true,"canProperties":true,"canMove":true,"canRename":true,"opened":false},{"id":"page-flights","displayName":"Flights","link":{"linkType":"LinkTypePage","href":"#!page-flights"},"canDelete":true,"canProperties":true,"canMove":true,"canRename":true,"opened":false},{"id":"page-hotels","displayName":"Hotels","link":{"linkType":"LinkTypePage","href":"#!page-hotels"},"canDelete":true,"canProperties":true,"canMove":true,"canRename":true,"opened":false},{"id":"page-contact","displayName":"Contact","link":{"linkType":"LinkTypePage","href":"#!page-contact"},"canDelete":true,"canProperties":true,"canMove":true,"canRename":true,"opened":false}]}</script>
      
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
      <style type="text/css" class="silex-style">body .editable-style.column-section.container-element {padding: 0; margin: 0; color: aliceblue;}div.column-section {width: 100%;}div.column-section > a {width: 100%;}@media (min-width:481px) {.silex-editor div.column-section {padding: 50px 0;}div.column-section > a {width: 33.333%;}}</style>
      <script type="text/javascript" class="silex-script"></script>
      <style class="silex-inline-styles" type="text/css">.body-initial {background-color: rgba(255,255,255,1); position: static;}.silex-id-1478366444112-1 {background-color: transparent; min-width: 1200px; position: static; margin-top: -1px;}.silex-id-1478366444112-0 {background-color: transparent; min-height: 89px; position: relative; margin-left: auto; margin-right: auto;}.silex-id-1552765147494-1 {width: 33px; background-color: transparent; top: 100px; left: 686px; min-height: 27px; position: absolute;}.silex-id-1537545843556-0 {width: 231px; background-color: transparent; top: 0px; left: 0px; min-height: 90px; position: absolute;}.silex-id-1537542841131-2 {width: 206px; top: 5px; left: 49px; min-height: 115.4375px; position: absolute; opacity: 1; background-color: transparent;}.silex-id-1537543262916-6 {width: 664px; top: 17px; left: 535px; min-height: 55px; position: absolute; background-color: transparent;}.silex-id-1537729669184-95 {width: 100px; background-color: transparent; top: 3267px; left: 944px; min-height: 100px; position: absolute;}.silex-element-content.normal a{cursor:pointer}.card:hover{box-shadow:1px 1px 3px #959595;}.silex-id-1545056415237-3 {min-width: 1200px; position: static; margin-top: -1px;}.silex-id-1545056415233-2 {min-height: 791px; position: relative; margin-left: auto; margin-right: auto;}.silex-id-1545056530213-6 {width: 276px; top: 0px; left: 0px; min-height: 139px; position: absolute;}.silex-id-1548870370847-0 {height: 496px; width: 777px; background-color: transparent; top: 132px; left: 0px; position: absolute;}.silex-id-1548871340538-0 {width: 400px; height: 488px; background-color: transparent; top: 136px; left: 800px; position: absolute;}.silex-id-1545056569614-8 {min-width: 1200px; position: static; margin-top: -1px;}.silex-id-1545056569608-7 {min-height: 517px; position: relative; margin-left: auto; margin-right: auto;}.silex-id-1545056587321-9 {width: 854px; top: 0px; left: 179px; min-height: 137px; position: absolute;}.silex-id-1545056612457-10 {min-width: 1200px; position: static; margin-top: -1px;}.silex-id-1545056612458-11 {min-height: 517px; position: relative; margin-left: auto; margin-right: auto;}.silex-id-1545056612459-12 {width: 854px; top: 0px; left: 179px; min-height: 137px; position: absolute;}.silex-id-1545056615878-13 {min-width: 1200px; position: static; margin-top: -1px;}.silex-id-1545056615879-14 {min-height: 517px; position: relative; margin-left: auto; margin-right: auto;}.silex-id-1545056615879-15 {width: 854px; top: 0px; left: 179px; min-height: 137px; position: absolute;}.silex-id-1632995709425-2 {width: 100px; min-height: 100px; position: absolute;}.silex-id-1633598767769-0 {width: 100px; min-height: 100px; background-color: rgb(255, 255, 255); position: absolute; top: 956.3333129882812px; left: 221.99999743700027px;}.silex-id-1633599106564-23 {position: static; background-color: rgba(224,230,246,1);}.silex-id-1633599106582-24 {min-height: 465.65625px; background-color: rgba(224,230,246,1); position: relative; margin-left: auto; margin-right: auto;}.silex-id-1633599129580-25 {width: 247px; top: 129.67689514160156px; left: 49.00028610229492px; background-image: url(240_F_260040900_oO6YW1sHTnKxby4GcjCvtypUCWjnQRg5.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: rgba(133,133,133,1); min-height: 290px; position: absolute; border-width: 1px 1px 1px 1px; border-style: solid; border-color: transparent;}.silex-id-1633599179552-27 {width: 247px; top: 130.01036071777344px; left: 324px; background-image: url(240_F_260040900_oO6YW1sHTnKxby4GcjCvtypUCWjnQRg5.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: rgba(133,133,133,1); min-height: 290px; position: absolute;}.silex-id-1633599181033-28 {width: 247px; top: 130px; left: 605.9895629882812px; background-image: url(240_F_260040900_oO6YW1sHTnKxby4GcjCvtypUCWjnQRg5.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: rgba(133,133,133,1); min-height: 290px; position: absolute;}.silex-id-1633599188186-29 {width: 247px; top: 130px; left: 893.3333129882812px; background-image: url(240_F_260040900_oO6YW1sHTnKxby4GcjCvtypUCWjnQRg5.jpg); background-size: cover; background-position: center center; background-repeat: no-repeat; background-color: rgba(133,133,133,1); min-height: 290px; position: absolute;}.silex-id-1633599236093-31 {width: 414px; min-height: 56px; position: absolute; top: 31px; left: 49px;}.silex-id-1633601431476-0 {position: static; background-color: rgba(209,235,255,1);}.silex-id-1633601431477-1 {min-height: 503.66668701171875px; background-color: transparent; position: relative; margin-left: auto; margin-right: auto;}.silex-id-1633601452249-2 {width: 340px; min-height: 76px; position: absolute; top: -1px; left: 31.999998092651367px;}.silex-id-1633601614284-3 {width: 250px;  position: absolute; top: 75.00006103515625px; left: 100px;}.silex-id-1633601641321-4 {width: 557px; min-height: 346px; background-color: rgb(255, 255, 255); position: absolute; top: 75px; left: 483px;}.silex-id-1633601713437-5 {width: 260px; min-height: 66px; background-color: rgba(0,145,255,1); position: absolute; top: 354px; left: 87px;}.silex-id-1633601762339-6 {width: 223px; min-height: 69px; position: absolute; top: 0px; left: 18px;}.silex-id-1633601954163-7 {width: 557px; min-height: 100px; background-color: transparent; position: absolute; top: 0px; left: -0.00000762939453125px;}@media only screen and (max-width: 480px) {.silex-id-1552765147494-1 {left: -12px; top: 11246px;}.silex-id-1537545843556-0 {top: 0px; left: 148px; width: 269px; min-height: 90px;}.silex-id-1537542841131-2 {top: 4px; left: 122px; width: 205px; min-height: 83px;}.silex-id-1545056415237-3 {top: 89px; left: 0px;}.silex-id-1545056415233-2 {min-height: 1543px;}.silex-id-1545056530213-6 {top: 56px; left: 11px; width: 424px; min-height: 139px;}.silex-id-1633599129580-25 {min-height: 424px; top: 0px; left: 0px; width: 380px;}.silex-id-1633599179552-27 {min-height: 424px; top: 0px; left: 0px; width: 380px;}.silex-id-1633599181033-28 {min-height: 424px; top: 0px; left: 0px; width: 380px;}.silex-id-1633599188186-29 {min-height: 424px; top: 0px; left: 0px; width: 380px;}}</style>
      <title></title>
      <link href="https://fontlibrary.org/face/glacial-indifference" rel="stylesheet" class="silex-custom-font">
      <style type="text/css" class="silex-style-settings">.website-width {width: 1200px;}@media (min-width: 481px) {.silex-editor {min-width: 1400px;}}</style>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="twitter:title" content="Silex template">
      <meta name="og:title" content="Silex template">
      <meta name="twitter:description" content="your description here">
      <meta name="og:description" content="your description here">
      <meta name="twitter:card" content="summary">
      <link data-dependency="" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/css/ol.css" rel="stylesheet" type="text/css">
      <script data-dependency="" type="text/javascript" src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/build/ol.js"></script>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
   <style class="silex-prodotype-style" type="text/css" data-style-id="all-style">.text-element > .silex-element-content {font-family: GlacialIndifferenceRegular, sans-serif; color: #010204; text-decoration: none;}a {text-decoration: none;}[data-silex-href] {text-decoration: none;}@media only screen and (max-width: 480px) {p {font-size: 1.5em;}}</style><style class="silex-prodotype-style" type="text/css" data-style-id="footer">.footer.text-element > .silex-element-content {font-size: 20px; color: #E8E8E8; text-align: left;}.footer a {color: #858585; text-decoration: none;}.footer [data-silex-href] {color: #858585; text-decoration: none;}@media only screen and (max-width: 480px) {}</style><style class="silex-prodotype-style" type="text/css" data-style-id="header">.header h1 {font-size: 32px; color: #F78536; text-transform: uppercase; letter-spacing: -1px;}.header p {font-size: 17px; color: #393535; text-align: right; word-spacing: 40px; letter-spacing: 1px;}.header a {font-weight: bold; color: #505050; text-decoration: none;}.header [data-silex-href] {font-weight: bold; color: #505050; text-decoration: none;}.header .page-link-active {color: #F78536;}.header a:hover {color: #F78536;}.header [data-silex-href]:hover {color: #F78536;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="text-style-1">.text-style-1 h2 {font-weight: normal; font-size: 45px; text-transform: capitalize;}.text-style-1 h3 {font-weight: normal; font-size: 25px;}.text-style-1.text-element > .silex-element-content {color: #ffffff;}.text-style-1 b {font-weight: bold; font-size: 50px;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="tab">.tab.text-element > .silex-element-content {font-weight: bold; color: #ffffff; text-align: center;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="tab2">.tab2.text-element > .silex-element-content {font-weight: bold; color: #F78536; text-align: center;}.tab2.text-element > .silex-element-content:hover {background-color: #e0e0e0;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="inputs">.inputs.text-element > .silex-element-content {font-weight: bold; color: #F78536; background-color: #e8e8e8; text-indent: 10px;}.inputs p {line-height: 2;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="label">.label.text-element > .silex-element-content {font-weight: bold; font-size: 14px; color: #585858; line-height: 1px;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="button">.button.text-element > .silex-element-content {font-weight: bold; font-size: 20px; color: #ffffff; background-color: #F78536; text-align: center;}.button p {line-height: 2;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="text-style-2">.text-style-2 h2 {font-weight: normal; font-size: 45px; color: #414141; text-transform: capitalize; line-height: 1;}.text-style-2.text-element > .silex-element-content {text-align: center;}.text-style-2 p {font-size: 20px; color: #858585;}@media only screen and (max-width: 480px) {.text-style-2 p {font-size: 2em;}}</style><style class="silex-prodotype-style" type="text/css" data-style-id="card">.card h3 {font-weight: normal; font-size: 35px; line-height: 0.1;}.card.text-element > .silex-element-content {color: #ffffff; text-indent: 22px;}.card a {font-size: 18px; color: #ffffff; background-color: #F78536; text-decoration: none; text-transform: uppercase;}.card [data-silex-href] {font-size: 18px; color: #ffffff; background-color: #F78536; text-decoration: none; text-transform: uppercase;}.card b {font-size: 29px;}.card u {font-size: 18px; text-decoration: none;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="button-light">.button-light.text-element > .silex-element-content {font-weight: normal; font-size: 16px; color: #ffffff; background-color: #F78536; text-align: center; text-transform: uppercase;}.button-light p {line-height: 3;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="button-invert">.button-invert.text-element > .silex-element-content {font-weight: bold; font-size: 20px; color: #F78536; text-align: center;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="button-inverted-light">.button-inverted-light.text-element > .silex-element-content {font-weight: normal; font-size: 16px; color: #ffffff; text-align: center; text-transform: uppercase;}.button-inverted-light p {line-height: 1;}@media only screen and (max-width: 480px) {.button-inverted-light.text-element > .silex-element-content {color: #000000;}}</style><style class="silex-prodotype-style" type="text/css" data-style-id="card-text">.card-text h3 {font-weight: normal; font-size: 25px; color: #414141; line-height: 0.1;}.silex-id-1633601713437-5:hover{box-shadow:3px 3px 7px #959595;}.skillbar.clearfix .skill-bar-percent{font-size: 1em;color:#000;}.skillbar.clearfix:hover {box-shadow: 1px 1px 4px #959595;}.card-text.text-element > .silex-element-content {color: #858585; text-align: justify; column-gap: 50px;}.card-text a {font-size: 18px; color: #F78536; text-decoration: none; text-transform: capitalize;}.card-text [data-silex-href] {font-size: 18px; color: #F78536; text-decoration: none; text-transform: capitalize;}.card-text b {font-size: 29px;}.card-text u {font-size: 18px; text-decoration: none;}@media only screen and (max-width: 480px) {.card-text.text-element > .silex-element-content {text-align: left;}}</style><style class="silex-prodotype-style" type="text/css" data-style-id="label-image">.label-image.text-element > .silex-element-content {font-weight: bold; font-size: 25px; color: #ffffff; text-align: center; line-height: 4;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="text-style-3">.text-style-3.text-element > .silex-element-content {columns: 3;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="card-text-2">.card-text-2 h3 {font-weight: normal; font-size: 25px; color: #414141; line-height: 0.1;}.card-text-2.text-element > .silex-element-content {color: #858585; text-align: justify; columns: 3; column-gap: 50px;}.card-text-2 p {text-indent: 12px;}.card-text-2 a {font-size: 18px; color: #F78536; text-decoration: none; text-transform: capitalize; text-indent: 31px;}.card-text-2 [data-silex-href] {font-size: 18px; color: #F78536; text-decoration: none; text-transform: capitalize; text-indent: 31px;}.card-text-2 b {font-size: 29px;}.card-text-2 u {font-size: 18px; text-decoration: none;}</style><style class="silex-prodotype-style" type="text/css" data-style-id="hamburger-menu">@media only screen and (max-width: 480px) {.hamburger-menu.text-element > .silex-element-content {font-size: 1.5em; text-indent: 15px;}.hamburger-menu a {color: #000000; line-height: 2;}.hamburger-menu [data-silex-href] {color: #000000; line-height: 2;}.hamburger-menu ul li {list-style-type: none;}.hamburger-menu .page-link-active {color: #f78536;}}</style></head>
   <body data-silex-id="body-initial" class="body-initial all-style enable-mobile prevent-resizable prevent-selectable editable-style silex-runtime" data-silex-type="container-element" style="">
      
      
      
      
      
      
      
      <section data-silex-type="container-element" class="editable-style section-element silex-id-1632995861158-3 page-home paged-element" data-silex-id="silex-id-1632995861158-3">
         <div data-silex-type="container-element" class="editable-style container-element silex-id-1632995861159-4 silex-element-content website-width prevent-draggable" data-silex-id="silex-id-1632995861159-4"></div>
      </section>
   
<section data-silex-type="container-element" class="container-element editable-style silex-id-1478366444112-1 section-element prevent-resizable" data-silex-id="silex-id-1478366444112-1" style="">
         <div data-silex-type="container-element" class="editable-style silex-element-content silex-id-1478366444112-0 container-element website-width" data-silex-id="silex-id-1478366444112-0">
            <div data-silex-type="text-element" class="editable-style silex-id-1537542841131-2 text-element header" data-silex-id="silex-id-1537542841131-2" style="" href="null">
               <div class="silex-element-content normal">
                  <h3>HOSPITAL MANAGEMENT SYSTEM<br><br></h3>
                  <h3></h3>
                  <h3></h3>
               </div>
            </div>
            <div data-silex-type="text-element" class="editable-style silex-id-1552765147494-1 text-element silex-component prevent-resizable hide-on-desktop hamburger-menu prevent-auto-z-index" data-silex-id="silex-id-1552765147494-1">
               <div class="silex-element-content normal"><style>.hamburger-menu_1633602787054_708 {position: absolute; z-index: 20;}.silex-editor .hamburger-menu_1633602787054_708 nav {left: -9999px;}.hamburger-menu_1633602787054_708 nav ul {margin-top: 80px;}.hamburger-menu_1633602787054_708 nav {opacity: 0; position: absolute; background-color: #ededed; transition: left 1s ease, height 0s ease 1s; left: -300px; width: 300px; height: 20px;}.hamburger-menu_1633602787054_708.open nav {opacity: 1; height: 100vh; left: 0; transition: left 1s ease, height 0s ease 0s;}.hamburger-menu_1633602787054_708 .nav-container {z-index: 10; position: absolute;}.hamburger-menu_1633602787054_708.open .nav-container {}.hamburger-menu_1633602787054_708 .hamburger-btn {z-index: 20; cursor: pointer; position: absolute;}.hamburger-menu_1633602787054_708 .hamburger-btn span {display: block; width: 30px; height: 5px; margin-bottom: 3px; position: relative; background-color: #000000; border: 1px solid #ffffff; border-radius: 3px; transition: border-color 0.1s ease-in,
      opacity 0.1s ease-in,
      transform 0.1s ease-in,
      background 0.1s ease-in;}.hamburger-menu_1633602787054_708.open .hamburger-btn span {border-color: rgba(255, 255, 255, 0);}.hamburger-menu_1633602787054_708 .hamburger-btn span:first-child {transform-origin: 4px -2px;}.hamburger-menu_1633602787054_708.open .hamburger-btn span:first-child {transform: rotate(45deg) translate(7px, -4px);}.hamburger-menu_1633602787054_708.open .hamburger-btn span:nth-last-child(2) {opacity: 0;}.hamburger-menu_1633602787054_708 .hamburger-btn span:nth-child(3) {transform-origin: -11px 4px;}.hamburger-menu_1633602787054_708.open .hamburger-btn span:nth-child(3) {transform: rotate(-45deg) translate(0, 12px);}</style>
<!-- inspired by https://codepen.io/erikterwan/pen/EVzeRP -->

</div>
            </div>
            <div data-silex-type="text-element" class="editable-style silex-id-1537543262916-6 text-element header hide-on-mobile" data-silex-id="silex-id-1537543262916-6" style="" href="null">
               <div class="silex-element-content normal">
                <p><a style="color: #000;text-decoration:none" onclick="window.location.href='HOME'.toLowerCase()+'.php'">HOME</a>
                  <a style="color: #000;text-decoration:none" onclick="window.location.href='ABOUT'.toLowerCase()+'.php'">ABOUT</a>
                  <?php
                  if($login):
                  ?>
                  <a style="color: #000;text-decoration:none" onclick="window.location.href='patienthome'.toLowerCase()+'.php'">DASHBOARD</a>
                  
                  <a style="color: #000;text-decoration:none" onclick="window.location.href='LOGOUT'.toLowerCase()+'.php'">LOGOUT</a>
                  
                  <?php else: ?> 
                  <a style="color: #000;text-decoration:none" onclick="window.location.href='LOGIN'.toLowerCase()+'.php'">LOGIN</a>
                  <a style="color: #000;text-decoration:none" onclick="window.location.href='REGISTER'.toLowerCase()+'.php'">REGISTER</a>
                  <?php endif ?>
               </p>
               </div>
            </div>
         </div>
      </section>

      <section data-silex-type="container-element" class="editable-style section-element silex-id-1633601431476-0 page-home paged-element" data-silex-id="silex-id-1633601431476-0"><div data-silex-type="container-element" class="editable-style container-element silex-id-1633601431477-1 silex-element-content website-width prevent-draggable" data-silex-id="silex-id-1633601431477-1" style=""><div data-silex-type="image-element" class="editable-style image-element silex-id-1633601614284-3" data-silex-id="silex-id-1633601614284-3" style=""><img style="width: 200px;height: 300px;" src="<?=$doctor["imagesrc"]?>"></div><div data-silex-type="container-element" class="editable-style container-element silex-id-1633601641321-4" data-silex-id="silex-id-1633601641321-4" style=""><div data-silex-type="html-element" class="editable-style html-element silex-id-1633601954163-7 silex-component-skill-bars" data-silex-id="silex-id-1633601954163-7" style=""><div class="silex-element-content">
  <div class="skillbar clearfix " data-percent="0%">
    <div class="skillbar-title" style="background: #6adcfa;"><span>NAME</span></div>
    <div class="skillbar-bar" style="background-color: rgb(106, 220, 250); width: 0px; overflow: hidden;"></div>
    <div class="skill-bar-percent"><?=$doctor["name"].' '.$doctor["lname"]?></div>
  </div>

  <div class="skillbar clearfix " data-percent="0%">
    <div class="skillbar-title" style="background: #6adcfa;"><span>Fees</span></div>
    <div class="skillbar-bar" style="background-color: rgb(106, 220, 250); width: 0px; overflow: hidden;"></div>
    <div class="skill-bar-percent"> ₹<?=$doctor["fees"]?></div>
  </div>

  <div class="skillbar clearfix " data-percent="%">
    <div class="skillbar-title" style="background: #6adcfa;"><span>Qualification</span></div>
    <div class="skillbar-bar" style="background-color: rgb(106, 220, 250); overflow: hidden;"></div>
    <div class="skill-bar-percent"><?=$doctor["qualification"]?></div>
  </div>

  <div class="skillbar clearfix " data-percent="%">
    <div class="skillbar-title" style="background: #6adcfa;"><span>Specialization</span></div>
    <div class="skillbar-bar" style="background-color: rgb(106, 220, 250); overflow: hidden;"></div>
    <div class="skill-bar-percent"><?=$doctor["spec"]?></div>
  </div>

  <div class="skillbar clearfix " data-percent="%">
    <div class="skillbar-title" style="background: #6adcfa;"><span>Email ID</span></div>
    <div class="skillbar-bar" style="background-color: rgb(106, 220, 250); overflow: hidden;"></div>
    <div class="skill-bar-percent"><?=$doctor["email"]?></div>
  </div>

  <div class="skillbar clearfix " data-percent="%">
    <div class="skillbar-title" style="background: #6adcfa;"><span>Contact No</span></div>
    <div class="skillbar-bar" style="background-color: rgb(106, 220, 250); overflow: hidden;"></div>
    <div class="skill-bar-percent"><?=$doctor["phone"]?></div>
  </div>

  <div class="skillbar clearfix " data-percent="%">
    <div class="skillbar-title" style="background: #6adcfa;"><span>Address</span></div>
    <div class="skillbar-bar" style="background-color: rgb(106, 220, 250); overflow: hidden;"></div>
    <div class="skill-bar-percent"><?=$doctor["address"]?></div>
  </div>

<style type="text/css">.skillbar {position: relative; display: block; margin-bottom: 15px; width: 100%; background: #eee; height: 35px; border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; -webkit-transition: 0.4s linear; -moz-transition: 0.4s linear; -ms-transition: 0.4s linear; -o-transition: 0.4s linear; transition: 0.4s linear; -webkit-transition-property: width, background-color; -moz-transition-property: width, background-color; -ms-transition-property: width, background-color; -o-transition-property: width, background-color; transition-property: width, background-color;}.skillbar-title {position: relative; float: left; width: 40%; font-weight: bold; font-size: 13px; color: #ffffff; background: #6adcfa; -webkit-border-top-left-radius: 3px; -webkit-border-bottom-left-radius: 4px; -moz-border-radius-topleft: 3px; -moz-border-radius-bottomleft: 3px; border-top-left-radius: 3px; border-bottom-left-radius: 3px;}.skillbar-title span {display: block; text-align: center; background: rgba(0, 0, 0, 0.1); height: 35px; line-height: 35px; -webkit-border-top-left-radius: 3px; -webkit-border-bottom-left-radius: 3px; -moz-border-radius-topleft: 3px; -moz-border-radius-bottomleft: 3px; border-top-left-radius: 3px; border-bottom-left-radius: 3px;}.skillbar-bar {float: left; height: 35px; width: 0px; border-radius: 0 3px 3px 0; -moz-border-radius: 0 3px 3px 0; -webkit-border-radius: 0 3px 3px 0;}.skill-bar-percent {position: absolute; right: 10px; top: 0; font-size: 11px; height: 35px; line-height: 35px; color: rgba(0, 0, 0, 0.4);}</style>
<script type="text/javascript">
  var fillBarSize = $('.skillbar').width() * (1 - 40 / 100);
  var doc = $(document);
  doc.scroll(function() {
    var skillbars = $('.skillbar');
    // Start animation when the skillbars hit the middle of the screen
    if (skillbars.offset().top <= (doc.scrollTop() + $(window).height()/2)) {
      $('.skillbar').each(function(){
        $(this).find('.skillbar-bar').delay(500).animate({
          width: (fillBarSize * parseInt($(this).attr('data-percent')) / 100) + 'px'
        },6000);
      });
    }
  });
</script>
</div></div></div><div data-silex-type="container-element" class="editable-style container-element silex-id-1633601713437-5" data-silex-id="silex-id-1633601713437-5" style=""><div data-silex-type="text-element" style="cursor: pointer;" class="editable-style text-element silex-id-1633601762339-6" data-silex-id="silex-id-1633601762339-6" style="" href="null"><div class="silex-element-content normal"><h2 style="color:white">BOOK APPOINTMENT</h2><span class="_wysihtml-temp-caret-fix" style="position: absolute; display: block; min-width: 1px; z-index: 99999;">﻿</span></div></div></div><div data-silex-type="text-element" class="editable-style text-element silex-id-1633601452249-2" data-silex-id="silex-id-1633601452249-2" style="" href="null"><div class="silex-element-content normal"><h3><b>Details of Dr. <?=$doctor["name"].' '.$doctor["lname"]?>:</b></h3><span class="_wysihtml-temp-caret-fix" style="position: absolute; display: block; min-width: 1px; z-index: 99999;">﻿</span></div></div></div></section>
<script>
document.querySelector(".editable-style.text-element.silex-id-1633601762339-6").addEventListener("click",function(){window.location.href = "appointment/?doctor="+encodeURIComponent(document.querySelector(".silex-id-1633601954163-7").querySelector(".skill-bar-percent").textContent)+"&doctorid=<?=$doctor["doc-id"]?>&spec="+encodeURIComponent(document.querySelector(".silex-id-1633601954163-7").querySelectorAll(".skill-bar-percent")[3].textContent);});
</script>
</body></html>