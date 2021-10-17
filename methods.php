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
        require("conn.php");
        $str = mysqli_real_escape_string($con,$str);
        return $str;
    }
    function islogin(){
        session_start();
        if(isset($_SESSION["hms_login"])){
            if($_SESSION["hms_login"]){
                foreach($_SESSION as $key=>$val){
                    if($val==""){
                        return false;
                    }
                }
                return true;
            }
        }
        return false;
    }
?>