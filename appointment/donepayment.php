<?php
session_start();
$login = false;
if (isset($_SESSION["hms_login"]))
{
    if (!isset($_SESSION["hms_admin"]) || !isset($_SESSION["hms_doctor"]))
    {
        header("location: ../alldoctors.php");
    }
    global $login;
    $login = true;
}
else
{
    header("location: ../");
}
require ("../conn.php");
$status = "false";
if (isset($_GET["appointmentid"]))
{
    $appid = secure($_GET["appointmentid"]);
    $patientid = $_SESSION["hms_user_id"];
    $q = "SELECT * FROM appointments WHERE id='$appid' AND patientid='$patientid'";
    if ($_SESSION["hms_admin"])
    {
        $q = "SELECT * FROM appointments WHERE id='$appid'";
    }
    $app = $con->query($q);
    if (mysqli_num_rows($app) < 1)
    {
        header("location: ../myappointments.php");
        return;
    }
    $appo = 1;
    while ($row = mysqli_fetch_array($app))
    {
        $appo = $row;
    }
    $docid = $appo["doc-id"];
    $q = "SELECT * FROM doctors WHERE `doc-id`='$docid'";
    $doc = $con->query($q);
    if (mysqli_num_rows($doc) < 1)
    {
        header("location: ../alldoctors.php");
        return;
    }
    $doctor = 1;
    while ($row = mysqli_fetch_array($doc))
    {
        $doctor = $row;
    }
    $patientid = $appo["patientid"];
    $q = "SELECT * FROM users WHERE `id`='$patientid'";
    $patient = $con->query($q);
    if (mysqli_num_rows($patient) < 1)
    {
        header("location: ../alldoctors.php");
        return;
    }
    $user = 1;
    while ($row = mysqli_fetch_array($patient))
    {
        $user = $row;
    }

    $fullname = $user['fname'] . ' ' . $user['lname'];
    $phone = $user['phone'];
    $email = $user['email'];
    $date = $appo['date'];
    $time = $appo['time'];
    $id = $appo['id'];
    $status = $appo['done'];
}
else
{
    $docid = secure($_POST['doc-id']);
    $spec = secure($_POST['spec']);
    $fullname = secure($_POST['fullname']);
    $phone = secure($_POST['phone']);
    $email = secure($_POST['email']);
    $date = secure($_POST['date']);
    $area = secure($_POST['area']);
    $city = secure($_POST['city']);
    $state = secure($_POST['state']);
    $time = secure($_POST['time']);
    $postalcode = secure($_POST['postalcode']);
    $uid = $_SESSION["hms_user_id"];
    $id = '';
    $q = "SELECT * FROM doctors WHERE `doc-id`='$docid' AND `spec`='$spec'";
    $doc = $con->query($q);
    if (mysqli_num_rows($doc) < 1)
    {
        header("location: ../alldoctors.php");
        return;
    }
    $doctor = 1;
    while ($row = mysqli_fetch_array($doc))
    {
        $doctor = $row;
    }
    $b = true;
    $q = "SELECT * FROM appointments WHERE patientid = '$uid' AND date='$date' AND time='$time'";
    $app = $con->query($q);
    if (mysqli_num_rows($app) >= 1)
    {
        while ($row = mysqli_fetch_array($app))
        {
            $appointment = $row;
        }
        $id = $appointment["id"];
        global $b;
        $b = false;
    };

    foreach ($_POST as $key => $val)
    {
        if ($val == '')
        {
            $b = false;
        }
    }

    if ($b && isset($_POST["time"]))
    {

        $id = getRandomHex(20);
        $fees = $doctor["fees"];
        $q = "INSERT INTO appointments VALUES ('','$docid','$uid','$date','$time','$area','$city','$state','$postalcode','$id','PAID','$fees','false')";
        if ($con->query($q))
        {

        }
        else
        {
            echo "Error in booking Appointment!";
        }
    }
}
function secure($str)
{
    global $con;
    $str = mysqli_real_escape_string($con, $str);
    return $str;
}
function getRandomHex($num_bytes = 4)
{
    return bin2hex(openssl_random_pseudo_bytes($num_bytes));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About E-HEALTH-CARE MANAGEMENT SYSTEM</title>
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
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="../home.php">HOME</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="../about.php">ABOUT</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="../alldoctors.php">ALL_DOCTORS</a></li>
            <?php
if ($login):
?>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="../dashboard.php">DASHBOARD</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="../logout.php">LOGOUT</a></li>
            <?php
else: ?>
          <?php
endif ?>
          </ul>
          
        </div>
      </nav>
      <br>
    <main id="printarea" class="container p-2 pt-4 mt-4">
        <style>
            @media print {
              body * {
                visibility: hidden;
              }
              #printarea, #printarea * {
                visibility: visible;
              }
              #printarea {
                position: absolute;
                left: 0;
                top: 0;
              }
            }
            </style>
        <h4 class="p-2 m-2 text-primary">Book Appointment with Dr. <?=$doctor['name'] ?> <?=$doctor['lname'] ?>:</h4>
<table class="table">
  <tbody>
    <tr>
      <td rowspan="4"><img width="250px" src='../<?=$doctor["imagesrc"] ?>'></td>
      <td>Name</td>
      <td><b>Dr. <?=$doctor['name'] ?> <?=$doctor['lname'] ?></b></td>
    </tr>
    <tr>
      <td>Fees</td>
      <td><b><?='₹' . $doctor['fees'] ?></b></td>
    </tr>
    <tr>
      <td>Qualification</td>
      <td><b><?=$doctor['qualification'] ?></b></td>
    </tr>
    <tr>
      <td>Specialization</td>
      <td><b><?=$doctor['spec'] ?></b></td>
    </tr>
  </tbody>
</table>

<h4 class="p-2 m-2 text-primary">Your Appointment Details: </h4>
<table class="table">
  <tbody>
    <tr>
      <td>Patient Name</td>
      <td><b><?=$fullname ?></b></td>
    </tr>
    <tr>
      <td>Patient Email</td>
      <td><b><?=$email ?></b></td>
    </tr>
    <tr>
      <td>Patient Contact</td>
      <td><b><?=$phone ?></b></td>
    </tr>
    <tr>
      <td>Fees Paid</td>
      <td><b><?='₹' . $doctor["fees"] ?></b></td>
    </tr>
    <tr>
      <td>Appointment Date</td>
      <td><b><?=$date ?></b></td>
    </tr>
    <tr>
      <td>Appointment Time</td>
      <td><b><?=$time ?></b></td>
    </tr>
    <tr>
      <td>Appointment ID</td>
      <td><b><?=$id ?></b></td>
    </tr>
    <tr>
      <td>Done</td>
      <td><b><?=$status ?></b></td>
    </tr>
  </tbody>
</table>


<div class="text-center w-100">
  <div class="row">
  <div id="qrcode" class="m-2 col"></div>
  <div class="col"></div>
  
  <div class="col-lg-6 text-success">
    <?php
    if($status=="true"):?>
    <svg xmlns="http://www.w3.org/2000/svg" width="100" fill="currentColor" class="bi bi-check" viewBox="0 0 16 16">
      <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
    </svg>
    <div class="text-success h4">Done</div>
    <?php endif?>
    
  </div>
  </div>
  <button class="printhide btn btn-primary p-2 m-2 w-25" onclick="printdiv('printarea')"> Print </button>
</div>
<script src="assets/js/qrcode.js"></script>
<script src="assets/js/qrcode.min.js"></script>
<script type="text/javascript">
new QRCode("qrcode", {
    text: "<?=$id ?>",
    width: 128,
    height: 128,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
});
</script>
<script>
function printdiv(divName) {
  var printContents = document.getElementById(divName).innerHTML;
//   var originalContents = document.body.innerHTML;

//   document.body.innerHTML = printContents;
//   document.body.innerHTML = originalContents;
//   document.body.innerHTML = printContents;
  window.print();
//   document.body.innerHTML = originalContents;
}
</script>
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
