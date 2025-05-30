<?php
include_once '../lib/Session.php';
session::init();
include_once '../lib/Database.php';
$db = new Database();



if(isset($_GET['token'])){
 $token = $_GET['token'];

 $query = "SELECT v_token, v_status FROM tbl_users WHERE '$token'";

 $result = $db->select($query);

 if($result !== false){

     $row = mysqli_fetch_assoc($result);
     if($row['v_status'] == 0){

      $click_token = $row['v_token'];



       $update_status = "UPDATE tbl_users SET v_status='1' WHERE v_token='$click_token'";

       $update_result = $db->update($update_status);

      if($update_result){
        $_SESSION['status'] = "Your account has been virified Successfully";
        header('location:login.php');
      }else{
         $_SESSION['status'] = "Virified Filed!";
        header('location:login.php');
      }




    }else {
     $_SESSION['status'] = "This Email Is Already varified Please Login";
        header('location:login.php');

    }
 }else{
   $_SESSION['status'] = "This Token Does Not Exsist";
   header('location:login.php');
 }
}else{
    $_SESSION['status']  = "Not Allowed";
    header('location:login.php');

}
?>