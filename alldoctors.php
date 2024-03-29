<?php
require("conn.php");
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
  <title>All Doctors HOSPITAL MANAGEMENT SYSTEM</title>
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
        <li class="nav-item"><a class="nav-link m-1 active btn bg-secondary text-white" style="color: #000;text-decoration:none" href="alldoctors.php">All Doctors</a></li>
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
  <br>
  <main class="container p-2 pt-4 mt-4">
    <h2 class="py-2 text-primary">ALL DOCTORS:</h2>
    <?php
    $q = "SELECT * FROM DOCTORS ORDER BY POINTS DESC,ID DESC,FEES ASC";
    $res = $con->query($q);
    $n = mysqli_num_rows($res);
    if ($n % 3 == 0) {
      $n = 3;
    } else if ($n % 4 == 0) {
      $n = 4;
    }
    $i = 1;
    while ($row = mysqli_fetch_array($res)) {

      if (($i == 1) || ($i >= $n && $i % ($n + 1) == 0)) {
        echo '<div class="row mx-auto">';
      }
      echo '<div class="col-sm-4 my-2 my-lg-0">';
      echo '<summary class="card shadow my-3" style="width: 18rem;" onclick="window.location.href = \'info.php?doctorid=' . $row["doc-id"] . '\'">';
      echo '<img class="card-img-top border-bottom border-primary" height="300px" src="' . $row["imagesrc"] . '" alt="">';
      echo '<div class="card-body">';
      echo '<h4 class="card-text">Dr. ' . $row["name"] . ' ' . $row["lname"] . '</h4>';
      echo '<p class="card-text"><b>' . $row["spec"] . '</b></p>';
      echo '<p class="card-text">Fees: <b>₹' . $row["fees"] . '</b></p>';
      echo '</div>';
      echo '</summary>';
      echo '</div>';

      if (($i >= $n && $i % $n == 0)) {
        echo '</div>';
      }
      $i++;
    }
    ?>
  </main>
  <style>
    .card{
      transition: .4s;
    }
    .card:hover {
      box-shadow: 3px 3px 5px #959595;
      transform: scale(1.05);
    }
  </style>
  <footer class="container text-white pt-4 bg-blur p-3 rounded shadow">
    <p class="float-right"><a href="#">Back to top</a></p>
    <p>© 2017-2018 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
  </footer>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>