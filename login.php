<?php
if(!isset($_POST["login_btn"])) return;

    $email = secure($_POST["email"]);
    $pass = secure($_POST["password"]);
    if($email=="" || $pass==""){
        header("location: login.html?valerrno=0");
        return;
    }
    require("conn.php");
    $q = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
    $res = $con->query($q);
    
    if(mysqli_num_rows($res)==1){
        login();
    }
    while($row=mysqli_fetch_array($res)){
        $fname = $row["fname"];
        $lname =  $row["lname"];
        $email = $row["email"];
        $gender = $row["gender"];
    }
    function secure($str){
        global $con;
        $str = mysqli_real_escape_string($con,$str);
        return $str;
    }
    function login(){
        session_start();
        $_SESSION["hms_login"] = true;
        $_SESSION["hms_login_fname"] = $fname;
        $_SESSION["hms_login_lname"] = $lname;
        $_SESSION["hms_login_email"] = $email;
        $_SESSION["hms_login_gender"] = $gender;
    }
?>