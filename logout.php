<?php
        // if(!isset($_SESSION["hms_login"])){
        //         header("location: ./");
        // }
        if(isset($_GET["logout"])){
        session_start();
        // unset($_SESSION["hms_login"]);
        // unset($_SESSION["hms_login_fname"]);
        // unset($_SESSION["hms_login_lname"]);
        // unset($_SESSION["hms_login_email"]);
        // unset($_SESSION["hms_login_gender"]);
        // unset($_SESSION["hms_user_id"]);
        // unset($_SESSION["hms_doctor"]);
        // unset($_SESSION["hms_admin"]);
        // unset($_SESSION["last_login_email"]);
        // unset($_SESSION["hms_pharmacy"]);
        $_SESSION=array();
        echo "<body><h1 style='margin: 0 auto;display:table'>Logged out!</h1></body>";
        echo "<script>setTimeout(function(){window.location.href = 'home.php';},1000)</script>";
        return;
}
$login = false;
if(isset($_SESSION["hms_login"])){
   global $login;
   $login = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout E-HEALTH-CARE MANAGEMENT SYSTEM</title>
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
    <main class="container p-2 pt-4 text-center mt-4">
            <div class="h3 p-4 text-primary">
                    Are you sure?
            </div>
            <a href="logout.php?logout" class="m-2 btn btn-warning">
                    Yes
            </a>
            <a href="./" class="m-2 btn btn-primary">
                    No
            </a>
            <br><br><br><br>
            <br><br><br><br>
            <br><br><br><br>
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