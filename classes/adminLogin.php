<?php
include_once '../lib/Session.php';
Session::logincheck();
include_once '../lib/Database.php';
include_once '../helpers/Format.php';
class adminLogin{
    private $db;
    private $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();

    }

    public  function LoginUser($email, $password){
    $email = $this->fr->validation($email);
    $password = $this->fr->validation($password);

    if( empty($email) || empty($password)){
    $error = "Fild Must Not Be Empty";
    return $error;
    } else{
        $select_query = "SELECT * FROM tbl_users WHERE email = '$email' AND password= '$password'";
        $result = $this->db->select($select_query);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            if($row['v_status'] == 1){
                Session::set('login', true);
                Session::set('userid', $row['userid']);
                Session::set('username', $row['username']);
                Session::set('userimg', $row['userimg']);
                header('location:index.php');


            }else{
                $error = "Please First virifi your email";
                return $error;
            }

        }else{
            $error = "Invalid Email or Password";
            return $error;
        }
    }
}
}
?>