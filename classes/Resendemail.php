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


class Resendemail{
    private $db;
    private $fr;

   public function __construct()
   {
     $this->db = new Database();
     $this->fr = new Format();
   }
   public function resendEmail($email){


    function resend_email_verifi($name, $email, $v_token){
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
      <h2>You have register with blogs site</h2>
       <h5>Verify your email address to login please click the link below</h5>
      <a href='http://localhost/blogs/admin/verify-email.php?token=$v_token'>Click Here</a>
    ";
    $mail->Body    = $email_template;
    $mail->send();
    }

    $email = $this->fr->validation($email);
    $email = mysqli_real_escape_string($this->db->link, $email);

    if(empty($email)){
        $error = "Email fild must not be Empty";
        return $error;
    }else{
        $checkemail = "SELECT * FROM tbl_users wHERE email= '$email'";
        $emailResult = $this->db->select($checkemail);

        if(mysqli_num_rows($emailResult) > 0){
            $row = mysqli_fetch_assoc($emailResult);
            if($row['v_status'] == 0){
                $name = $row['username'];
                $email = $row['email'];
                $v_token = $row['v_token'];
                resend_email_verifi($name, $email, $v_token);
                $success = "Verification Email link has been sent in your email";
                return $success;

            }else{
                $error = "Email already verified please login";
                return $error;
            }



        }else{
            $error = "Email is not register please resgister first ";
            return $error;
        }
    }
   }
}
?>