<?php
 $filepath = realpath(dirname(__FILE__));
 include_once  ($filepath.'/../lib/Database.php');
 include_once  ($filepath.'/../helpers/Format.php');
class siteOption{
    public $db;
    public $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }


    // all social

    public function allSocial(){
      $select_query = "SELECT * FROM tbl_social WHERE sid = '1'";
      $result = $this->db->select($select_query);
      return $result;
    }
    // update social
    public function updateLinks($data){
     $twitter = $this->fr->validation($data['twitter']);
     $facebook = $this->fr->validation($data['facebook']);
     $instagram = $this->fr->validation($data['instagram']);
     $youtube = $this->fr->validation($data['youtube']);

    $update_query = "UPDATE tbl_social SET twitter = '$twitter', facebook = '$facebook', instagram = '$instagram', youtube = '$youtube'";
    $update_result = $this->db->update($update_query) ;
    if($update_result){
        $msg = 'Link Update Successfully';
        return $msg;
    }else{
        $msg = "Link Not Update";
    }
    }


    // get logo

      public function getLogo(){
      $select_query = "SELECT * FROM tbl_logo WHERE logoid = '1'";
      $result = $this->db->select($select_query);
      return $result;
    }
    // update logo

    public function updateLogo($data){
     $logo = $this->fr->validation($data['logoname']);


    $update_query = "UPDATE tbl_logo SET logoname = '$logo'";
    $update_result = $this->db->update($update_query) ;
    if($update_result){
        $msg = 'Logo Update Successfully';
        return $msg;
    }else{
        $msg = "Logo Not Update";
    }
    }
}
?>