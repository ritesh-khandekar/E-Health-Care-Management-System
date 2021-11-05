<?php
if(!isset($_POST["register"])) header("location: register.html");
    require("conn.php");
    $fname = secure($_POST["fname"]);
    $lname = secure($_POST["lname"]);
    $email = secure($_POST["email"]);
    $pass = secure($_POST["password"]);
    $repass = secure($_POST["repassword"]);
    $phone = secure($_POST["phone"]);
    $gender = secure($_POST["gender"]);
    $gender = strtoupper($gender);
    foreach($_POST as $key=>$val){
        if($val==""){
            header("location: register.html?valerrno=0");
            break;
        }
    }
    if($pass!=$repass){
        header("location: register.html?valerrno=1");
        return;
    }

    $q = "SELECT * FROM users WHERE email='$email'";
    $res = $con->query($q);
    if(mysqli_num_rows($res)>=1){
        header("location: register.html?valerrno=3");
        return;
    }
    $q = "INSERT INTO users VALUES('','$fname','$lname','$email','$pass','$phone','$gender','','')";

    if($con->query($q)){
        //login();
        header("location: patientlogin.html?success");
        return;
    }
    //header("location: register.html");
    function login(){
        session_start();
        $_SESSION["hms_login"] = true;
        $_SESSION["hms_login_fname"] = $fname;
        $_SESSION["hms_login_lname"] = $lname;
        $_SESSION["hms_login_email"] = $email;
        $_SESSION["hms_login_gender"] = $gender;
        $_SESSION["hms_doctor"] = false;
        $_SESSION["hms_admin"] = false;
        $_SESSION["hms_user_id"] = '';
    }
    function secure($str){
        global $con;
        $str = mysqli_real_escape_string($con,$str);
        return $str;
    }
?>