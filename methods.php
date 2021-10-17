<?php
    function login(){
        session_start();
        $_SESSION["hms_login"] = true;
        $_SESSION["hms_login_fname"] = $fname;
        $_SESSION["hms_login_lname"] = $lname;
        $_SESSION["hms_login_email"] = $email;
        $_SESSION["hms_login_gender"] = $gender;
    }
    function secure($str){
        global $con;
        $str = mysqli_real_escape_string($con,$str);
        return $str;
    }
?>