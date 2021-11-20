<?php
require_once "conn.php";
require("methods.php");
function getRandomHex($num_bytes=4) {
    return bin2hex(openssl_random_pseudo_bytes($num_bytes));
  }
session_start();
$login = false;
if(islogin()){
   global $login;
   $login = true;
   if(!$_SESSION["hms_pharmacy"]){
     header("location:./");
     return;
   }else{
    if(isset($_POST["insertdata"])){
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
        }else{
            echo "false";
        }
    }
       else if(isset($_POST["data"])){
           
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
           }else{
               echo "false";
           }
       }
   }

}
?>