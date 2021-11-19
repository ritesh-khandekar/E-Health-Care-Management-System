<?php
if(!isset($_POST["login_btn"])) return;
session_start();
$type = isset($_POST["type"]) ? $_POST["type"]: "";
$nexturl = isset($_POST["next"])?($_POST["next"]!=''? $_POST["next"]:''):'';
$next = urlencode($nexturl);
    $email = secure($_POST["email"]);
    $pass = secure($_POST["password"]);
   
    if($email=="" || $pass==""){
        $_SESSION["last_login_email"] = secure($email);
        if($type == "ADMIN" ) {header("location: adminlogin.html?valerrno=0&next=$next");return;};
        if($type == "PHARMACY" ) {header("location: pharmacylogin.html?valerrno=0&next=$next");return;};
       
        header($type == "DOCTOR" ?"location: doctorlogin.html?valerrno=0&next=$next": "location: patientlogin.html?valerrno=0&next=$next");
        return;
    }
    require("conn.php");
    $pharmacy = $type=="PHARMACY";
    $type = $type=="PHARMACY"?"ADMIN":$type;
    $q = "SELECT * FROM users WHERE type='$type' AND email='$email' AND password='$pass'";
    $res = $con->query($q);
    
    if(mysqli_num_rows($res)==1){
        while($row=mysqli_fetch_array($res)){
            $fname = $row["fname"];
            $lname =  $row["lname"];
            $email = $row["email"];
            $gender = $row["gender"];
            $type = $row["type"];
            $uid = $row["id"];
        }
        login($fname,$lname,$email,$gender,$type=="DOCTOR",$type=="ADMIN",$uid,$pharmacy);
        if($next!='') {header("location: $nexturl");return;}
        header("location: patienthome.html?success");
        return;
    }else{
        $_SESSION["last_login_email"] = secure($email);
        if($type == "ADMIN" ) {header("location: adminlogin.html?valerrno=1&next=$next");return;};
        header($type == "DOCTOR" ?"location: doctorlogin.html?valerrno=1&next=$next": "location: patientlogin.html?valerrno=1&next=$next");
        return;
    }

    function secure($str){
        require("conn.php");
        $str = mysqli_real_escape_string($con,$str);
        return $str;
    }
    function login($fname,$lname,$email,$gender,$booldoctor,$booladmin,$uid,$pharmacy){
        $_SESSION["hms_login"] = true;
        $_SESSION["hms_login_fname"] = $fname;
        $_SESSION["hms_login_lname"] = $lname;
        $_SESSION["hms_login_email"] = $email;
        $_SESSION["hms_login_gender"] = $gender;
        $_SESSION["hms_doctor"] = $booldoctor;
        $_SESSION["hms_admin"] = $booladmin;
        $_SESSION["hms_user_id"] = $uid;
        if($pharmacy){
            $_SESSION["hms_pharmacy"] = true;
        }
    }
?>