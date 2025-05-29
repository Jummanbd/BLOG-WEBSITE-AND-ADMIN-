<?php
 include_once  '../lib/Database.php';
 include_once  '../helpers/Format.php';

//  PHPMailer
 include_once  '../PHPmailer/PHPMailer.php';
 include_once  '../PHPmailer/Exception.php';
 include_once  '../PHPmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

 class Register{
    public $db;
    public $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function addUser ($data){

    function sendemail_varifi($name, $email, $v_token){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth   = true;
    //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //
     //Enable SMTP authentication
    $mail->Username   = 'jummanahomedbd@gmail.com';                     //SMTP username
    $mail->Password   = 'enizdfzrxezxilva';                               //SMTP password
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

    $name = $this->fr->validation($data['name']);
    $email = $this->fr->validation($data['email']);
    $phone = $this->fr->validation($data['phone']);
    $password = $this->fr->validation(md5($data['password']));
    $v_token = md5(rand());


    if(empty($name) || empty($phone) || empty($email) || empty($password)){
        $error = "Fild Must Not Be Empty";
        return $error;
    }else{
        $e_query = "SELECT * FROM tbl_users WHERE email ='$email'";

        $check_email = $this->db->select($e_query);


    if($check_email > 0){
        $error = "This Email is Alrady Exisit";
        return $error;
        header("location:register.php");
    } else{

        $insert_query = "INSERT INTO tbl_users(username,email, phone,password, v_token) VALUES('$name',  '$email', '$phone', '$password', '$v_token')";

        $insert_row = $this->db->insert($insert_query);
        if($insert_row){
            sendemail_varifi($name, $email, $v_token);
            $Success = "Registration Successfull .Plese check your email inbox for verify email";
            return $Success;
        }else {
            $error = "Registration Failed";
            return $error;
        }
    }
    }
    }
 }

?>