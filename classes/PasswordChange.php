<?php
 include_once  '../lib/Database.php';
 include_once  '../helpers/Format.php';
class PasswordChange{
    public $db;
    public $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function changePass($data){
    $email = $this->fr->validation($data['email']);
    $newPassword = $this->fr->validation(md5($data['newpassword']));
    $c_Password = $this->fr->validation(md5($data['c_password']));
    $token = $this->fr->validation($data['token']);

    if(!empty($token)){


        if(!empty($email) || !empty($newPassword) || !empty($c_Password)){

            $token_query = "SELECT v_token FROM  tbl_users WHERE v_token = '$token'";
            $token_result = $this->db->select($token_query);

            if(!empty($token_result) && $token_result !== true){
            if(mysqli_num_rows($token_result) > 0){
                if($newPassword === $c_Password){
                    $update_password =  "UPDATE  tbl_users SET password ='$newPassword'  WHERE v_token = '$token'";
                    $update_pass_result = $this->db->update($update_password);

                     if($update_pass_result){
                        $new_token = md5(rand());
                        $up_token =  "UPDATE  tbl_users SET v_token ='$new_token'  WHERE v_token = '$token'";
                        $update_pass_result = $this->db->update($up_token);

                        $success = "Password  Changed Successfully";
                        return $success;

                     } else{
                      $error = "Password Not Changed";
                      return $error;
                     }

                }else{
                    $error = "Password Not Match";
                    return $error;
                }
            }else{
                 $error = "Invalid Token";
                return $error;
            }
            }else{

               $error = "Invalid Token";
                return $error;

            }


        }else{
         $error = "Filds Must Not Be Empty";
         return $error;

        }



    }else{
    $error = "Token is not avaliable";
         return $error;
    }


    }
}
?>