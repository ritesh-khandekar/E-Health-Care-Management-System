<?php
require("methods.php");

$login = false;
if (islogin()) {
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
  <title>About Hospital Management System</title>
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
        <li class="nav-item"><a class="nav-link m-1 active btn bg-secondary text-white" style="color: #000;text-decoration:none" href="about.php">About</a></li>
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
  <main class="container p-2 pt-5 mt-4">
    <h2 class="text-white pd-3 my-4">
      Introduction of Hospital Management System
    </h2>
    <div class="bg-blur p-4 rounded shadow">
      <p class="text-white h5 py-3">
        This project deals with the Healthcare Management. This project is very helpful to both Medicare staff as well as to the public. All the branches of the Medicare can be integrated with one to another. So any body can get the status of each branch easily from the Medicare center.
      </p>
      <p class="text-white h5 py-3">
        People can take appointments online by approaching the website. That site also includes Information about the Facilities, Specialties available in every Medicare Branch. So they can also send their problems about their health and get some useful tips from the doctors.
      </p>
    </div>
  </main>
  <footer class="container text-white pt-4 mt-5 p-3 rounded shadow">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>© 2017-2018 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>