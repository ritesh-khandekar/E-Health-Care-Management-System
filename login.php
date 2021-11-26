<?php
if(isset($_POST["login_btn"])){
session_start();
$type = isset($_POST["type"]) ? $_POST["type"]: "";
$nexturl = isset($_POST["next"])?($_POST["next"]!=''? $_POST["next"]:''):'';
$next = urlencode($nexturl);
    $email = secure($_POST["email"]);
    $pass = secure($_POST["password"]);
   
    if($email=="" || $pass==""){
        $_SESSION["last_login_email"] = secure($email);
        if($type == "ADMIN" ) {header("location: adminlogin.php?valerrno=0&next=$next");return;};
        if($type == "PHARMACY" ) {header("location: pharmacylogin.php?valerrno=0&next=$next");return;};
       
        header($type == "DOCTOR" ?"location: doctorlogin.php?valerrno=0&next=$next": "location: patientlogin.php?valerrno=0&next=$next");
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
        header("location: patienthome.php?success");
        return;
    }else{
        $_SESSION["last_login_email"] = secure($email);
        if($type == "ADMIN" ) {header("location: adminlogin.php?valerrno=1&next=$next");return;};
        header($type == "DOCTOR" ?"location: doctorlogin.php?valerrno=1&next=$next": "location: patientlogin.php?valerrno=1&next=$next");
        return;
    }
    return;
}else{
$next = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"]:'';
$next = isset($_GET['next'])?$_GET['next']:'';
$login = false;
if(isset($_SESSION["hms_login"])){
   global $login;
   $login = true;
}
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login E-HEALTH-CARE MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="pt-4">
    <nav class="navbar navbar-expand-lg p-3 fixed-top navbar-light bg-white shadow-sm" >
        <a class="navbar-brand h5" href="#">E-HEALTH-CARE MANAGEMENT SYSTEM</b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav ml-auto mr-0 mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="home.php">HOME</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="about.php">ABOUT</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="pharmacy.php">PHARMACY</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="alldoctors.php">ALL_DOCTORS</a></li>
            <?php
               if($login):
               ?>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="dashboard.php">DASHBOARD</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="logout.php">LOGOUT</a></li>
            <?php else: ?>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="register.php">REGISTER</a></li>
            <?php endif ?>
          </ul>
          
        </div>
      </nav>
      <br>
    <main class="container p-2 pt-4 mt-4">
        <h3 class="text-warning mx-auto text-center">Please login to continue</h3>
        <div class="text-center w-100">
            <a href="./patientlogin.php<?= $next!='' ? '?next='.urlencode($next):''?>" class="btn btn-primary p-4 w-25 m-3">
                Patient Login
            </a>
        </div>
        <div class="text-center w-100">
            <a href="./doctorlogin.php<?= $next!='' ? '?next='.urlencode($next):''?>" class="btn btn-primary p-4 w-25 m-3">
                Doctor Login
            </a>
        </div>
        <div class="text-center w-100">
            <a href="./adminlogin.php<?=$next!='' ? '?next='.urlencode($next):''?>" class="btn btn-primary p-4 w-25 m-3">
                Administrator Login
            </a>
        </div>
        <div class="text-center w-100">
          <a href="./pharmacylogin.php<?=$next!='' ? '?next='.urlencode($next):''?>" class="btn btn-primary p-4 w-25 m-3">
              Pharmacy Login
          </a>
      </div>
        <small><div class="pt-4 mt-4"><?=$next!='' ? '<b>Next URL: </b><div class="text-info d-inline">'.$next.'</div>':''?></div></small>
    </main>
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>© 2017-2018 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
      </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
</body>
</html>