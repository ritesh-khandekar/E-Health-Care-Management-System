<?php
require("methods.php");
$login = false;
if(islogin()){
   global $login;
   $login = true;
   if(isset($_SESSION["hms_pharmacy"]) && $_SESSION["hms_pharmacy"]){
    header("location: ./pharmacyhome.php");
   }
   if(!$_SESSION["hms_admin"]){
       header("location: ./");
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About HOSPITAL MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="pt-4">
    <nav class="navbar navbar-expand-lg p-3 fixed-top navbar-light bg-white shadow-sm" >
        <a class="navbar-brand h5" href="#">HOSPITAL MANAGEMENT SYSTEM</b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav ml-auto mr-0 mt-2 mt-lg-0">
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="home.php">HOME</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="about.php">ABOUT</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="alldoctors.php">ALL_DOCTORS</a></li>
            <?php
               if($login):
               ?>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="dashboard.php">DASHBOARD</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="logout.php">LOGOUT</a></li>
            <?php else: ?>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="register.php">REGISTER</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="login.php">LOGIN</a></li>
            <?php endif ?>
          </ul>
          
        </div>
      </nav>
      <br>
    <main class="container p-2 pt-4 mt-4">
        <?php
        if(isset($_GET["success"])):
        ?>
        <div class="row">
        <div class="alert alert-success col-md-4">Login Successful </div>
      </div>
        <?php endif ?>
        <?php
        if(isset($_GET["docadded"])):
        ?>
        <div class="row">
        <div class="alert alert-success mw-50">Doctor Added </div>
        </div>
        <?php endif ?>
        <div class="h3 text-primary"><b>Welcome to E-Health Care Management System</b></div>
        <div class="row py-3 my-4">
            <a href="./adddoctor.php" class="btn btn-primary p-3 m-2 col-md-4">Add new Doctor</a>
<a href="register.php" class="btn btn-primary p-3 m-2 col-md-4">Add new Patient</a>
<a href="alldoctors.php" class="btn btn-primary p-3 m-2 col-md-4">All Doctors</a>
    <a href="allpatients.php" class="btn btn-primary p-3 m-2 col-md-4">All Patients</a>
<a href="allappointments.php" class="btn btn-primary p-3 m-2 col-md-4">All Appointments</a>
<a href="myaccount.php" class="btn btn-primary p-3 m-2 col-md-4">Change Password</a>
        </div>
    </main>
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>© 2017-2018 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
      </footer>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
</body>
</html>