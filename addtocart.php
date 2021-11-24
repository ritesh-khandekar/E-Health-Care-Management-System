<?php
require("methods.php");
$login = false;
if(islogin()){
   global $login;
   $login = true;
}else{
    echo "!login";
    return;
}
if(isset($_POST["medjson"])){
    $_SESSION["hms_medicines"] = $_POST["medjson"];
    echo "true";
}
?>
