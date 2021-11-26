<?php
require("methods.php");

$next = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"]:'';
$next = isset($_GET['next'])?$_GET['next']:'';
$login = false;
if(islogin()){
   global $login;
   $login = true;
}
require("conn.php");
if(isset($_GET["paymentid"])){
  $pid = $_GET["paymentid"];
  $q = "SELECT * FROM medicines WHERE paymentid='$pid'";
  $q = $con->query($q);
  $row=mysqli_fetch_array($q);
}else{
  header("location: pharmacy.php");
  return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt E-HEALTH-CARE MANAGEMENT SYSTEM</title>
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
      <style>
        pre{
          line-height: 0.6em;
        }
      </style>
    <main class="container p-2 pt-4 mt-4">
      <h3 class="text-primary">Payment Details:</h3>
      <div id="qrcode" class="p-4"></div>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">Medicine Name</th>
      <th scope="col">Description</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Medicine ID</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>

  <?php
    if($_SESSION["hms_user_id"]==$row["uid"]){
      $meds = $row["medicines"];
      $meds = json_decode($meds,true);
      $total = 0;
      $datetime = $row["time"];
      foreach($meds as $med){
          $medid = $med["dataid"];
          $medq = $med["quantity"];
          $q = "SELECT * FROM pharmacy WHERE medicineid='$medid'";
          $r = mysqli_fetch_array($con->query($q));
          echo "<tr>";
          echo "<td>".$r["name"]."</td>";
          echo "<td>".$r["description"]."</td>";
          echo "<td>".$r["price"]."</td>";
          echo "<td>".$medq."</td>";
          echo "<td data-id='".$r["medicineid"]."'>".substr($r["medicineid"],0,20)."...</td>";
          $p = ((int)$medq)*((int)$r["price"]);
          echo "<td><b>".$p."</b></td>";
          $total += $p;
          echo "</tr>";
      }
      }else{
      header("location: pharmacy.php");
      return;
    }
    ?>

  </tbody>
</table>
<pre class="p-3 mt-4">
<b>Patient Name:</b> <?=$_SESSION["hms_login_fname"]." ".$_SESSION["hms_login_lname"]?><br>
<b>Payment ID:</b> <?=$pid?><br>
<b>Date: </b> <?=date("m-d-Y",$datetime)?><br>
<b>Time: </b> <?=date("h:i:s",$datetime)?><br>
<b>Total:</b> <?=$total?><br>
</pre>
      
      <div class="w-100 text-center"><button class="btn btn-primary" onclick="window.print()">Print</button></div>
    </main>
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>© 2017-2018 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
      </footer>
<script src="appointment/assets/js/qrcode.js"></script>
<script src="appointment/assets/js/qrcode.min.js"></script>
<script type="text/javascript">
new QRCode("qrcode", {
    text: "<?=$pid?>",
    width: 128,
    height: 128,
    colorDark : "#000000",
    colorLight : "#ffffff",
    correctLevel : QRCode.CorrectLevel.H
});
</script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
</body>
</html>