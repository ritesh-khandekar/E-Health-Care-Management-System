<?php
session_start();
$login = false;
if(isset($_SESSION["hms_login"])){
  if($_SESSION["hms_admin"] || $_SESSION["hms_doctor"]){
    header("location: ../");
  }
  if(!isset($_SESSION["hms_admin"]) || !isset($_SESSION["hms_doctor"])){
    header("location: ../alldoctors.php");
  }
   global $login;
   $login = true;
}else{
  header("location: ../login.php?next=".urlencode($_SERVER["HTTP_REFERER"]));

}
if(!isset($_GET['doctorid'])) header("location: ../alldoctors.php");
require("../conn.php");
$docid = secure($_GET['doctorid']);
$spec = secure($_GET['spec']);
$q = "SELECT * FROM doctors WHERE `doc-id`='$docid' AND `spec`='$spec'";
$doc = $con->query($q);
if(mysqli_num_rows($doc)<1){
  header("location: ../alldoctors.php");
  return;
}
$doctor=1;
while($row=mysqli_fetch_array($doc)){
$doctor = $row;
}
function secure($str){
  global $con;
  $str = mysqli_real_escape_string($con,$str);
  return $str;
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

    <body>
      <div class="inner-layer">
          <div class="container">
            <div class="row no-margin">
                <div class="col-sm-7">
                    <div class="content">
                        <h2>Book You Slot Now and Save your time</h2>
                        <img src="../<?=$doctor["imagesrc"]?>" height="300px">
                        <p>Qualification:  <?=$doctor["qualification"]?></p>
                        <p>Specialization:  <?=$doctor["spec"]?></p>
                        <p>Book Appointemnt with Dr. <?=$doctor["name"].' '.$doctor["lname"]?></p>
                        <!-- <h3>For Help Call : +###-###-####</h3> -->
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-data">
                        <div class="form-head">
                            <h2>Book Appointment</h2>
                        </div>
                        <form action="payment.php" method="post" >
                        <div class="form-body">
                            <div class="row form-row">
                              <select class="form-control disabled" disabled><option>Dr. <?=$doctor["name"].' '.$doctor["lname"]?></option></select>
                            </div>
                            <div class="row form-row">
                              <input type="text" name="fullname" placeholder="Enter Full name" class="form-control" disabled value="<?= $_SESSION['hms_login_fname'].' '.$_SESSION['hms_login_lname']?>" required>
                            </div>
                            <input type="hidden" name="doc-id" value="<?=$doctor['doc-id']?>"/>
                            <input type="hidden" name="spec" value="<?=$doctor['spec']?>"/>
                            <div class="row form-row">
                              <input type="text" name="phone" placeholder="Enter Mobile Number" class="form-control" >
                            </div>
                             <div class="row form-row">
                              <input type="text" name="email" placeholder="Enter Email Adreess" class="form-control" disabled value="<?= $_SESSION['hms_login_email']?>" required>
                            </div>
                           <div class="row form-row">
                              <input id="dat" name="date" autocomplete="off" type="text" placeholder="Appointment Date" pattern="[01][12]\/[0132][0-9]\/2021" class="form-control" required>
                              
                            </div>
                            <div class="row form-row">
                              <select name="time" placeholder="Appointment Time" class="form-control" required>
                                <option value="7am-10am" disabled selected>Select a time Slot (default: 7am-10pm)</option>
                                <option value="7am-10am">7am-10am</option>
                                <option value="10am-1pm">10am-1pm</option>
                                <option value="1pm-4pm">1pm-4pm</option>
                                <option value="4pm-7pm">4pm-7pm</option>
                                <option value="7pm-10pm">7pm-10pm</option>
                              </select>
                            </div>
                            
                            <h6>Address Details</h6>

                             <div class="row form-row">
                                <div class="col-sm-6">
                                   <input type="text" name="area" placeholder="Enter Area" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                   <input type="text" name="city" placeholder="Enter City" class="form-control" required>
                                </div>
                            </div>
                             <div class="row form-row">
                                <div class="col-sm-6">
                                   <input type="text" name="state" placeholder="Enter State" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                   <input type="text" name="postalcode" placeholder="Postal Code" class="form-control" required>
                                </div>
                            </div>

                             <div class="row form-row">
                               <button class="btn btn-success btn-appointment">
                                <span class="spinner-border spinner-border-sm" role="status" id="load" aria-hidden="true"></span>

                                Book Appointment<br> <b>Total:  ₹<?=$doctor["fees"]?></b> 
                               </button>
                               
                            </div>

                        </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
      </div>
      
    </body>
  
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <script>
      $(document).ready(function(){
        $('form').submit(function(e) {
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
});
          $("#load").hide();
          $("#dat").datepicker({startDate: new Date()});
          let flag = true;
          $("#dat").on("keyup keypress",function(){
            $("#load").show();
            if(($(this).val().length <10) && !flag) return;
            flag = false;
            setTimeout(() => {
              flag = true;
            }, 1000);
            $.ajax({
              type: "POST",
              data: {"date": $(this).val()},
              dataType: "JSON",
              url: "availappointments.php",
              success: function(d){
                $("#load").hide();
                if(!d.avail){
                alert("All slots are full!");
                $(this).val("");
                $("select[name='time']").attr("disabled",true);
                }else{
                $("select[name='time']").attr("disabled",false);
                }
              },
              error:function(e){
                alert(JSON.stringify(e));
              }
            });
            $("select[name='time']").each(function(){
            $.ajax({
              type: "POST",
              data: {"date": $("#dat").val(), "time": $(this).val()},
              URL: "availappointments.php",
              success: function(d){
                if(!d.avail){
                  $("#load").hide();
                  $(this).attr("disabled",true);
                }
              }
            });
          });
          })

      })
    </script>
    
  </body>
</html>