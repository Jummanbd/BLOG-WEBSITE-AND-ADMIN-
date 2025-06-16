<?php
include_once "../lib/Database.php";
include_once "../helpers/Format.php";

//  PHPMailer
 include_once  '../PHPmailer/PHPMailer.php';
 include_once  '../PHPmailer/Exception.php';
 include_once  '../PHPmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class passwordReset{
    private $db;
    private $fr;

   public function __construct()
   {
     $this->db = new Database();
     $this->fr = new Format();
   }

   public  function passwordReset($email) {


    function send_password_reset($name, $email, $v_token){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //
     //Enable SMTP authentication
    $mail->Username   = 'jummanahomedbd@gmail.com';                     //SMTP username
    $mail->Password   = 'enizdfzrxezxilva';              //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('safayatahmodrumman22@gmail.com', $name);
    $mail->addAddress($email);               //Name is optional

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email Varification From Web Master';
    $email_template = "
      <h2>You have Password Reset</h2>
       <h5>Verify your email address to login please click the link below</h5>
      <a href='http://localhost/blogs/admin/password-change.php?token=$v_token&email=$email'>Click Here</a>
    ";
    $mail->Body    = $email_template;
    $mail->send();
    }


    $email = $this->fr->validation($email);
    $v_token = md5(rand());
    if(empty($email)){
      $error = "Email fild must be empty";
      return $error;
    }else{
      $checkEmail = "SELECT * FROM tbl_users WHERE email = '$email'";
      $email_result = $this->db->select($checkEmail);

      if(mysqli_num_rows($email_result) > 0){
        $row = mysqli_fetch_assoc($email_result);
        $name = $row['username'];
        $email = $row['email'];
        $query = "UPDATE tbl_users SET v_token = '$v_token' WHERE email = '$email' LIMIT  1";

        $update_token = $this->db->update($query);

        if($update_token){
          send_password_reset($name, $email, $v_token);
          $success = "Password reset email send in your email";
          return $success;

        }else{
          $error = "Something Wrong Token Is Not Update";
          return $error;
        }




      } else{
        $error = "Email Not Found";
        return $error;
      }
    }
   }
}
?>