<?php
require_once "conn.php";
require("methods.php");
session_start();
$login = false;
if(islogin()){
   global $login;
   $login = true;
   if(!$_SESSION["hms_doctor"]){
     header("location:./");
     return;
   }else{
       
       if(isset($_POST["appid"]) && isset($_POST["tick"])){
           $aid = secure($_POST["appid"]);
           $tick = secure($_POST["tick"]);
           $tick = filter_var($tick,FILTER_VALIDATE_BOOLEAN);
           $uid = $_SESSION["hms_user_id"];
           $docid= '';
                $q = "SELECT doctors.`doc-id` FROM doctors INNER JOIN users ON doctors.`doc-id` = users.`docid` WHERE users.id = '$uid'";
                $q = $con->query($q);
                if(1==mysqli_num_rows($q)){
                   while($row=mysqli_fetch_array($q)){
                       $docid = $row["doc-id"];
                   }
                }
           $q = "UPDATE appointments SET done='$tick' WHERE id='$aid' AND `doc-id`='$docid'";
           if($con->query($q)){
               echo "true";
           }else{
               echo "false";
           }
       }
   }
}
?>