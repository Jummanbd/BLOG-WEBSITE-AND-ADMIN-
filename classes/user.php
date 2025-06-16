<?php
 $filepath = realpath(dirname(__FILE__));

 include_once  ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');
class Usered{
    public $db;
    public $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function userInfo($id){
        $user_query = "SELECT * FROM tbl_users WHERE userid = '$id'";
        $result = $this->db->select($user_query);
        return $result;
    }
    /// user bio

        public function userBio(){
        $user_query = "SELECT * FROM tbl_users";
        $result = $this->db->select($user_query);
        return $result;
    }
    public function userUpdate($data, $file, $id){
      $username = $this->fr->validation($data['username']);
      $userbio = $this->fr->validation($data['user_bio']);
    // user photo
    $permitedImg = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];
    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image =substr(md5(time()),0, 10).'.'. $file_ext;
    $upload_image = "upload/".$unique_image;


if(empty($username) || empty($userbio) ) {
    $msg = "Fild Must Not Be Empty";
    return $msg;
}else{
    if(!empty($file_name)){
        if($file_size > 1048567){
        $msg = "File Size Must Be less then 1 MB";
            return $msg;
        }elseif(in_array($file_ext, $permitedImg) == false){
        $msg = "Your can uplad only:-". implode('.', $permitedImg);
        return $msg;
        }else{
            move_uploaded_file($file_temp, $upload_image);
            $insert_query = "UPDATE `tbl_users` SET `username`='$username',`userimg`='$upload_image',  `user_bio`= '$userbio' WHERE userid =  '$id'";

            $result = $this->db->insert($insert_query);

            if($result){

            $Success = "Profile  Update Successfully";
            return $Success;
            }else {
                $error = "Something wrong Post is not Updated";
                return $error;
            }
        }
    }else{
            $insert_query = "UPDATE `tbl_users` SET `username`='$username',`user_bio`= '$userbio' WHERE userid =  '$id'";
            $result = $this->db->insert($insert_query);
            if($result){
            $Success = "Profile  Update Successfully";
            return $Success;
            }else {
                $error = "Something wrong Post is not Updated";
                return $error;
            }
    }
}
    }
}

?>