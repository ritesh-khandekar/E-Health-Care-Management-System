<?php
if(!isset($_POST["login_btn"])) return;

$type = isset($_POST["type"]) ? $_POST["type"]: "";

    $email = secure($_POST["email"]);
    $pass = secure($_POST["password"]);
   
    if($email=="" || $pass==""){
        if($type == "ADMIN" ) {header("location: adminlogin.html?valerrno=0");return;};
        header($type == "DOCTOR" ?"location: doctorlogin.html?valerrno=0": "location: patientlogin.html?valerrno=0");
        return;
    }
    require("conn.php");
    $q = "SELECT * FROM users WHERE type='$type' AND email='$email' AND password='$pass'";
    $res = $con->query($q);
    
    if(mysqli_num_rows($res)==1){
        while($row=mysqli_fetch_array($res)){
            $fname = $row["fname"];
            $lname =  $row["lname"];
            $email = $row["email"];
            $gender = $row["gender"];
            $type = $row["type"];
        }
        login($fname,$lname,$email,$gender,$type=="DOCTOR",$type=="ADMIN");
        header("location: patienthome.html?success");
        return;
    }else{
        if($type == "ADMIN" ) {header("location: adminlogin.html?valerrno=1");return;};
        header($type == "DOCTOR" ?"location: doctorlogin.html?valerrno=1": "location: patientlogin.html?valerrno=1");
        return;
    }

    function secure($str){
        require("conn.php");
        $str = mysqli_real_escape_string($con,$str);
        return $str;
    }
    function login($fname,$lname,$email,$gender,$booldoctor,$booladmin){
        session_start();
        $_SESSION["hms_login"] = true;
        $_SESSION["hms_login_fname"] = $fname;
        $_SESSION["hms_login_lname"] = $lname;
        $_SESSION["hms_login_email"] = $email;
        $_SESSION["hms_login_gender"] = $gender;
        $_SESSION["hms_doctor"] = $booldoctor;
        $_SESSION["hms_admin"] = $booladmin;
    }
?>