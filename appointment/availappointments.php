<?php
require("../conn.php");
if(!isset($_POST["date"])) return;
$date = secure($_POST["date"]);
$time = isset($_POST["time"]) ? secure($_POST["time"]):"";

$q = "SELECT * FROM appointments WHERE date='$date'";
$num = mysqli_num_rows($con->query($q));
if($num>=60){
    echo '{"avail":false}';
}else{
    $q = "SELECT * FROM appointments WHERE date='$date' AND time='$time'";
    $num = mysqli_num_rows($con->query($q));
    echo $num<12 ? '{"avail":true}':'{"avail":false}';
    return;
}
function secure($str){
    global $con;
    $str = mysqli_real_escape_string($con,$str);
    return $str;
  }
?>