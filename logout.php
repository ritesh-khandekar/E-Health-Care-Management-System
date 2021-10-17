<?php
        session_start();
        unset($_SESSION["hms_login"]);
        unset($_SESSION["hms_login_fname"]);
        unset($_SESSION["hms_login_lname"]);
        unset($_SESSION["hms_login_email"]);
        unset($_SESSION["hms_login_gender"]);
        echo "Logged out!";
        echo "<script>setTimeout(function(){window.location.href = 'home.html';},2000)</script>";
?>