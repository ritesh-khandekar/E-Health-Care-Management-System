<?php
require("methods.php");
$login = false;
if(islogin()){
   global $login;
   $login = true;
   if(!$_SESSION["hms_doctor"]){
     header("location:./");
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor  HOSPITAL MANAGEMENT SYSTEM</title>
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
            <li class="nav-item"><a class="nav-link m-1" style="color: #000;text-decoration:none" href="docappointments.php">APPOINTMENTS</a></li>
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
      <div class="h3 text-primary py-2">
        Today's Appointments:
      </div>

      <?php
                require("conn.php");
                $i = 0;
                $uid = $_SESSION["hms_user_id"];
                $docid= '';
                $q = "SELECT doctors.`doc-id` FROM doctors INNER JOIN users ON doctors.`doc-id` = users.`docid` WHERE users.id = '$uid'";
                $q = $con->query($q);
                if(1==mysqli_num_rows($q)){
                   while($row=mysqli_fetch_array($q)){
                       $docid = $row["doc-id"];
                   }
                }
                
                $q = "SELECT users.*,appointments.* FROM appointments INNER JOIN users ON appointments.`patientid` = users.`id` WHERE appointments.`doc-id`='$docid' AND appointments.date='".date("m/d/Y")."' ORDER BY appointments.count DESC";
                
                $q = $con->query($q);
                if(0==mysqli_num_rows($q)):?>
                <div class="text-secondary h4 ml-3 pl-3">No Appointments Today</div>
                 <a class="btn btn-primary m-4" href="./docappointments.php">Show All Appointments</a>
                <?php else:?>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Time</th>
                      <th scope="col">Name</th>
                      <th scope="col">Appointment ID</th>
                      <th scope="col">Mark as Done</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    endif;
                while($row=mysqli_fetch_array($q)){
                    $i++;
                        echo "<tr>";
                        echo "<td>".$row["time"]."</td>";
                        echo "<td>".$row["fname"]." ".$row["lname"]."</td>";
                        echo "<td>".$row["id"]."</td>";
                        echo "<td><button class='btn ".($row["done"]!="true"?'btn-outline-success':'btn-success')."' data-appid='".$row["id"]."'>Done</button></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
          </table>

         <?php
         for($n=0;$n<(10-$i);$n++){
             echo '<br><br>';
         }?>
    </main>
    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>© 2017-2018 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
      </footer>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script>
        $("table").find("button").each(function(){
            $(this).click(function(){
                let btn = $(this);
                $.ajax({
                    type: "post",
                    url:"doneappointment.php",
                    data: {"appid":$(this).attr("data-appid"),"tick":$(this).hasClass("btn-outline-success")},
                    success:function(d){
                        
                        if(!!d){
                            btn.toggleClass("btn-outline-success");
                            btn.toggleClass("btn-success");
                        }else{
                            alert("Something went wrong!")
                        }
                    }
                })
                $(this).attr("data-id");
            })
        })
    </script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>    
</body>
</html>