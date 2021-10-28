<?php
        session_start();
        unset($_SESSION["hms_login"]);
        unset($_SESSION["hms_login_fname"]);
        unset($_SESSION["hms_login_lname"]);
        unset($_SESSION["hms_login_email"]);
        unset($_SESSION["hms_login_gender"]);
        unset($_SESSION["hms_doctor"]);
        unset($_SESSION["hms_admin"]);
        echo "<body><h1 style='margin: 0 auto;display:table'>Logged out!</h1></body>";
        echo "<script>setTimeout(function(){window.location.href = 'home.html';},2000)</script>";
?>