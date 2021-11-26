<?php
if(isset($_POST["register"])){
    require("conn.php");
    $fname = secure($_POST["fname"]);
    $lname = secure($_POST["lname"]);
    $email = secure($_POST["email"]);
    $pass = secure($_POST["password"]);
    $repass = secure($_POST["repassword"]);
    $phone = secure($_POST["phone"]);
    $gender = secure($_POST["gender"]);
    $gender = strtoupper($gender);
    foreach($_POST as $key=>$val){
        if($val==""){
            header("location: register.php?valerrno=0");
            break;
        }
    }
    if($pass!=$repass){
        header("location: register.php?valerrno=1");
        return;
    }

    $q = "SELECT * FROM users WHERE email='$email'";
    $res = $con->query($q);
    if(mysqli_num_rows($res)>=1){
        header("location: register.php?valerrno=3");
        return;
    }
    $q = "INSERT INTO users VALUES('','$fname','$lname','$email','$pass','$phone','$gender','','')";

    if($con->query($q)){
        //login();
        header("location: patientlogin.php?success");
        return;
    }
    return;
    //header("location: register.php");
}
    // function login(){
    //     session_start();
    //     $_SESSION["hms_login"] = true;
    //     $_SESSION["hms_login_fname"] = $fname;
    //     $_SESSION["hms_login_lname"] = $lname;
    //     $_SESSION["hms_login_email"] = $email;
    //     $_SESSION["hms_login_gender"] = $gender;
    //     $_SESSION["hms_doctor"] = false;
    //     $_SESSION["hms_admin"] = false;
    //     $_SESSION["hms_user_id"] = '';
    // }
    function secure($str){
        global $con;
        $str = mysqli_real_escape_string($con,$str);
        return $str;
    }
    $err = '';
    if(isset($_GET["valerrno"])){
      $n = $_GET["valerrno"];
      if($n==0){
        $err = "Please fill all details!";
      }
      if($n==1){
        $err = "Passwords Mismatch!";
      }
      if($n==3){
        $err = "Account already Exists on this Email!";
      }
    }
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link rel="stylesheet" href="./css/register.css">

</head>
<body>
<!-- partial:index.partial.php -->
<div class="form_wrapper">
  <div class="form_container">
    <div class="title_container">
      <h2>Patient Registration</h2>
    </div>
    <div class="row clearfix">
      <div class="">
        <form method="POST" action="register.php">
          <div><?= $err!=""? "<div style='padding:10px;color:red'>$err</div>":""?></div>
          <div class="row clearfix">
            <div class="col_half">
              <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                <input type="text" name="fname" placeholder="First Name" />
              </div>
            </div>
            <div class="col_half">
              <div class="input_field"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                <input type="text" name="lname" placeholder="Last Name" required />
              </div>
            </div>
          </div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
            <input type="email" name="email" placeholder="Email" required />
          </div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
            <input type="password" name="password" placeholder="Password" required />
          </div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
            <input type="password" name="repassword" placeholder="Re-type Password" required />
          </div>
          <div class="input_field"> <span><i aria-hidden="true" class="fa "><b>+91</b></i></span>
            <input type="text" name="phone" placeholder="Phone No." required />
          </div>


            	<div class="input_field radio_option">
              <input type="radio" name="gender" value="male" id="rd1" required>
              <label for="rd1">Male</label>
              <input type="radio" name="gender" value="female" id="rd2" required>
              <label for="rd2">Female</label>
              </div>
              <!--<div class="input_field select_option">
                <select>
                  <option>Select a country</option>
                  <option>Option 1</option>
                  <option>Option 2</option>
                </select>
                <div class="select_arrow"></div>
              </div>
            <div class="input_field checkbox_option">
            	<input type="checkbox" id="cb1">
    			<label for="cb1">I agree with terms and conditions</label>
            </div>
            <div class="input_field checkbox_option">
            	<input type="checkbox" id="cb2">
    			<label for="cb2">I want to receive the newsletter</label>
            </div>-->
          <input class="button" name="register" type="submit" value="Register" />
        </form>
      </div>
    </div>
  </div>
</div>
<p class="credit"><a href="http://www.designtheway.com" target="_blank"></a></p>
<!-- partial -->
  <script src='https://use.fontawesome.com/4ecc3dbb0b.js'></script>
</body>
</html>
