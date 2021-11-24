<?php
session_start();
if(!isset($_SESSION["hms_login"])){
    header("location: ./");
}
   if($_SESSION["hms_doctor"]){
      echo $_SESSION["hms_doctor"];
      header("location: doctorhome.html?".$_SERVER['QUERY_STRING']);
      return;
   }
   if($_SESSION["hms_admin"]){
      header("location: adminhome.html?".$_SERVER['QUERY_STRING']);
      return;
   }
   require("methods.php");
   $login = false;
   if(islogin()){
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
    <title>Cart E-HEALTH-CARE MANAGEMENT SYSTEM</title>
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
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="home.html">HOME</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="about.html">ABOUT</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="alldoctors.html">ALL_DOCTORS</a></li>
            <?php
               if($login):
               ?>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="dashboard.html">DASHBOARD</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="logout.php">LOGOUT</a></li>
            <?php else: ?>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="register.html">REGISTER</a></li>
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="login.html">LOGIN</a></li>
            <?php endif ?>
          </ul>
          
        </div>
      </nav>
      <br>
    <main class="container p-2">
      <div class="d-none">
        <div class="h3 text-primary m-4">Selected Medicines:</div>
        <table class="table table-bordered table-striped" id="updatetable">
          <thead>
            <tr>
              <th>Medicine Name</th>
              <th>Description</th>
              <th>Remaining</th>
              <th>Price</th>
              <th>Medicine ID</th>
              <th>Quantity</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
        <div class="h3 text-primary m-4">Selected Medicines:</div>
 
  <table class="table table-bordered" id="updatetable">
    <thead>
      <tr>
        <th>Medicine Name</th>
        <th>Description</th>
        <th>Price</th>

        <th>Medicine ID</th>
        <th>Quantity</th>
      </tr>
    </thead>
    <tbody>
        <?php
        require("conn.php");
        $price = 0;
        $meds = $_SESSION["hms_medicines"];
        var_dump($meds);
        foreach($meds as $o){
        $id = $o["dataid"];
        $quan = $o["quantity"];
        $q = "SELECT*FROM pharmacy WHERE medicineid='$id'";
        $q = $con->query($q);
        if(0==mysqli_num_rows($q)){
          header("location:cart.php");
          return;
        }
        while($row=mysqli_fetch_array($q)){
                echo "<tr>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["description"]."</td>";
                echo "<td>".$row["price"]."</td>";
                echo "<td data-id='".$row["medicineid"]."'>".substr($row["medicineid"],0,20)."...</td>";
                echo "<td>";
                echo $quan;
                echo "</td>";
                echo "</tr>";
                $price += (int)$row["price"] *((int) $quan);
                
            }
        }
            ?>
    </tbody>
  </table>
  <div class = "w-100 text-center">
    <button class= "btn btn-outline-success p-2" id="addtocartbtn" onclick="window.location.href='medicinepayment.php'">Buy Medicines Now <br><b>Total: ₹<?= $price?></b></button>
    <br>
    <button class= "btn btn-warning p-2 m-4" onclick="window.history.back()">Go Back</button>

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

