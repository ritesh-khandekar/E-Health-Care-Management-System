<?php
if (!isset($_GET['doctorid'])) header("location: alldoctors.php");
require("conn.php");
$docid = secure($_GET['doctorid']);

$q = "SELECT * FROM doctors WHERE `doc-id`='$docid'";
$doc = $con->query($q);
if (mysqli_num_rows($doc) < 1) {
  header("location: alldoctors.php");
  return;
}
$doctor = 1;
while ($row = mysqli_fetch_array($doc)) {
  $doctor = $row;
}
function secure($str)
{
  global $con;
  $str = mysqli_real_escape_string($con, $str);
  return $str;
}
session_start();
$login = false;
if (isset($_SESSION["hms_login"])) {
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
  <title>About</title>
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
        <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="home.php">Home</a></li>
        <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="about.php">About</a></li>
        <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="alldoctors.php">All Doctors</a></li>
        <li class="nav-item"><a class="nav-link m-1mr-5" style="color: #000;text-decoration:none" href="pharmacy.php">Pharmacy</a></li>
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
  <br>
  <main class="container p-2 pt-4 mt-4">
    <div class="h3 text-white">Details of Dr. <?= $doctor["name"] . ' ' . $doctor["lname"] ?>: </div>
    <hr>
    <div class="row">
      <div class="col-lg-4 text-center">
        <img src="<?= $doctor["imagesrc"] ?>" class="p-2 w-75 rounded shadow">
        <a class="btn shadow p-3 m-2 w-75 btn-book text-white" href="./appointment/?doctorid=<?= urlencode($doctor['doc-id']) ?>&spec=<?= urlencode($doctor['spec']) ?>">Book Appointment</a>
      </div>
      <div class="col-lg-8 shadow bg-blur">
        <table class="table table-stripped text-white bg-blur">
          <tbody>
            <tr>
              <td>Name</td>
              <td><b>Dr. <?= $doctor["name"] . ' ' . $doctor["lname"] ?></b></td>
            </tr>
            <tr>
              <td>Fees</td>
              <td><b>₹<?= $doctor["fees"] ?></b></td>
            </tr>
            <tr>
              <td>Qualification</td>
              <td><b><?= $doctor["qualification"] ?></b></td>
            </tr>
            <tr>
              <td>Specialization</td>
              <td><b><?= $doctor["spec"] ?></b></td>
            </tr>
            <tr>
              <td>Email ID</td>
              <td><b><?= $doctor["email"] ?></b></td>
            </tr>
            <tr>
              <td>Contact No.</td>
              <td><b><?= $doctor["phone"] ?></b></td>
            </tr>
            <tr>
              <td>Address</td>
              <td><b><?= $doctor["address"] ?></b></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
  <footer class="container text-white pt-4 bg-blur p-3 rounded shadow">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>© 2017-2018 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>