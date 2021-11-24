<?php
        if(is_session_started()==FALSE){
            session_start();
            }
    // function login(){

    //     $_SESSION["hms_login"] = true;
    //     $_SESSION["hms_login_fname"] = $fname;
    //     $_SESSION["hms_login_lname"] = $lname;
    //     $_SESSION["hms_login_email"] = $email;
    //     $_SESSION["hms_login_gender"] = $gender;
    // }
    function secure($str){
        require("conn.php");
        $str = mysqli_real_escape_string($con,$str);
        return $str;
    }
    function islogin(){
        if(isset($_SESSION["hms_login"])){
            return true;
        }
            
            /**if($_SESSION["hms_login"]){
                foreach($_SESSION as $key=>$val){
                    if($val==""){
                        echo $val;
                        return false;
                    }
                }
                return true;
            }**/
        
        return false;
    }
    function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}
?>