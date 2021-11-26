<?php
require_once "conn.php";
require("methods.php");
function getRandomHex($num_bytes=4) {
    return bin2hex(openssl_random_pseudo_bytes($num_bytes));
  }
$login = false;
if(islogin()){
   global $login;
   $login = true;
{
    if(isset($_POST["insertdata"])){
      if(!$_SESSION["hms_pharmacy"]){
        header("location:./");
        return;
      }
        $data = $_POST["data"];
        $json = json_decode($data,true);
        $id = getRandomHex(50);
        $json["data"] = explode(",",$json["data"]);
        $name = $json["data"][0];
        $desc = $json["data"][1];
        
        $unit =(int) $json["data"][2];
        $price =(int) $json["data"][3];
        $q = "INSERT INTO pharmacy VALUES('','$id','$name','$desc',$unit,$price)";
        if($con->query($q)){
            echo "true";
            return;
        }else{
            echo "false";
            return;
        }
    }
       else if(isset($_POST["data"])){
        if(!$_SESSION["hms_pharmacy"]){
          header("location:./");
          return;
        }
           $data = $_POST["data"];
           $json = json_decode($data,true);
           $id = $json["medicineid"];
           $json["data"] = explode(",",$json["data"]);
           $name = $json["data"][0];
           $desc = $json["data"][1];
           $unit =(int) $json["data"][2];
           $price =(int) $json["data"][3];
           $q = "UPDATE pharmacy SET name='$name',description='$desc',unit=$unit,price=$price WHERE medicineid='$id'";
           if($con->query($q)){
               echo "true";
               return;
           }else{
               echo "false";
               return;
           }
       }
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEdicines E-HEALTH-CARE MANAGEMENT SYSTEM</title>
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
    <main class="container p-2 pt-4 mt-4">
        <div class="h3 text-primary py-4">Ordered Medicines</div>
        <div class="row">
        
        <div class="col-md-6">
        <?php
        $uid = $_SESSION["hms_user_id"];
        $q = "SELECT * FROM medicines WHERE uid='$uid'";
        $q = $con->query($q);
        if(mysqli_num_rows($q)!=0){
        while($row=mysqli_fetch_array($q)){
            echo '<a class="btn btn-primary p-2 m-1 w-100" href="receipt.php?paymentid='.$row["paymentid"].'">Date: '.date('d-m-Y H:i:s',$row["time"]).' Price:'.$row["price"].'</a>';
        }
    }
        ?>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
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