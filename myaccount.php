<?php
session_start();
if (!isset($_SESSION["hms_login"])) {
  header("location: ./");
} else {
  $login = true;
}
if (isset($_SESSION["hms_pharmacy"]) && $_SESSION["hms_pharmacy"]) {
  header("location: ./adminlogin.php");
}
/**   if($_SESSION["hms_doctor"]){
      echo $_SESSION["hms_doctor"];
      header("location: doctorhome.php?".$_SERVER['QUERY_STRING']);
      return;
   }
   if($_SESSION["hms_admin"]){
      header("location: adminhome.php?".$_SERVER['QUERY_STRING']);
      return;
   }**/

require("conn.php");
$err = "";
$suc = "";
$oldpass = '';
$newpass = '';
$newpass2 = '';
if (isset($_POST["oldpass"])) {
  $oldpass = secure($_POST["oldpass"]);
  $newpass = secure($_POST["newpass"]);
  $newpass2 = secure($_POST["newpass2"]);
  if ($oldpass == "") {
    $err = "Please enter Old Password";
  } else if ($newpass == "") {
    $err = "Please enter New Password";
  } else if ($newpass2 != $newpass) {
    $err = "New Passwords are not Matching";
    $newpass = "";
    $newpass = "";
  } else {
    $uid = $_SESSION["hms_user_id"];
    $q = "SELECT email from users where id='$uid' AND password='$oldpass'";
    $r = $con->query($q);
    if (0 == mysqli_num_rows($r)) {
      $err = "Incorrect Old Password";
      $oldpass = "";
    } else {
      $con->query("UPDATE users SET password='$newpass2' WHERE id='$uid'");
      $suc = '<div class="alert alert-success">Password Changed Successfully!</div>';
    }
  }
}
if ($err != '') {
  $err = '<div class="alert alert-danger">' . $err . '</div>';
}
function secure($str)
{
  global $con;
  $str = mysqli_real_escape_string($con, $str);
  return $str;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Account HOSPITAL MANAGEMENT SYSTEM</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="./css/theme.css">

</head>

<body class="pt-4">
  <nav class="navbar navbar-expand-lg p-2 px-4 fixed-top navbar-light bg-white shadow-sm">
    <a class="navbar-brand" href="#"><img src="./images/logo.png" height="50px" alt="Logo of Hospital Management System"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav ml-auto mr-0 mt-2 mt-lg-0">
        <li class="nav-item"><a class="nav-link m-1 active btn bg-secondary text-white" style="color: #000;text-decoration:none" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="alldoctors.php">All Doctors</a></li>
        <li class="nav-item"><a class="nav-link m-1 mr-5" style="color: #000;text-decoration:none" href="pharmacy.php">Pharmacy</a></li>
        <?php
        if ($login) :
        ?>
          <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="dashboard.php">DASHBOARD</a></li>
          <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="logout.php">LOGOUT</a></li>
        <?php else : ?>
          <li class="nav-item"><a class="nav-link m-1 btn text-white btn-login shadow-sm" style="color: #000;text-decoration:none" href="register.php">REGISTER</a></li>
          <li class="nav-item"><a class="nav-link m-1 btn text-white btn-register shadow-sm" style="color: #000;text-decoration:none" href="login.php">LOGIN</a></li>
        <?php endif ?>
      </ul>

    </div>
  </nav>
  <main class="container p-2 py-4 pt-4 mt-5">
  <div class="bg-blur p-4 rounded shadow">
    <div class="h4 text-primary">
      Change Password:
    </div>

    <div class="row">
      <form class="col-lg-6 col-md-6 text-white" action="myaccount.php" method="post">
        <div class="text-center">
          <?= $err ?>
          <?= $suc ?>
        </div>
        <div class="form-group row">
          <label for="staticEmail" class="col-lg-4 col-form-label">Email</label>
          <div class="col-lg-8">
            <input type="text" readonly class="text-white form-control-plaintext" id="staticEmail" value="<?= $_SESSION["hms_login_email"] ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-lg-4 col-form-label">Old Password</label>
          <div class="col-lg-8">
            <input type="password" class="form-control" id="inputPassword" name="oldpass" placeholder="Password" value="<?= $oldpass ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword2" class="col-lg-4 col-form-label">New Password</label>
          <div class="col-lg-8">
            <input type="password" class="form-control" id="inputPassword2" name="newpass" placeholder="Password" value="<?= $newpass ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-lg-4 col-form-label">Confirm New Password</label>
          <div class="col-lg-8">
            <input type="password" class="form-control" id="inputPassword3" name="newpass2" placeholder="Password" value="<?= $newpass2 ?>">
          </div>
        </div>
        <div class="form-group row">
          <button class="btn btn-primary mx-auto">Change Password</button>
        </div>
      </form>
    </div>
  </div>
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