<?php
session_start();
$err = '';
$err0 = "Please Enter your Email and Password";
if(isset($_SESSION["last_login_email"])){
	if($_SESSION["last_login_email"]!=""){
		$err0 = "Please Enter your Password";
	}
}
if(isset($_GET["valerrno"])){
  $n = $_GET["valerrno"];
  if($n==0){
    $err =$err0;	
  }
  if($n==1){
    $err = "Email or Password Incorrect!";
  }
  if($n==3){
    $err = "Account already Exists on this Email!";
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Sign In - Hospital Management System</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="top">
			<h1 id="title" class="hidden"><span id="logo">Patient <span>Login</span></span></h1>
		</div>
		<div class="login-box animated fadeInUp"><form method="POST" action="login.php">
			<div class="box-header">
				<h2>Log In</h2>
			</div>
			<?php 
				require("methods.php");
				if(!$err==""){
					echo "<div style='padding:10px;color:red'>$err</div>";
				}
			?>

			<label for="username">Email</label>
			<br/>
			<input type="text" id="username" name = "email" value="<?=isset($_SESSION["last_login_email"])?secure($_SESSION["last_login_email"]):''?>">
			<br/>
			<label for="password">Password</label>
			<br/>
			<input type="password" id="password" name="password">
			<br/>
			<input type="hidden" name="next" value="<?=isset($_GET["next"])?secure($_GET["next"]):''?>">
			<button type="submit" name="login_btn">Sign In</button>
			<br/></form>
			<a href="#"><p class="small">Forgot your password?</p></a>
		</div>
	</div>
</body>

<script>
	$(document).ready(function () {
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
</script>

</html>