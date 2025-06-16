<?php
 $filepath = realpath(dirname(__FILE__));
 include_once  ($filepath.'/../lib/Database.php');
 include_once  ($filepath.'/../helpers/Format.php');
class Category{
    public $db;
    public $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function categoryadd($data){
     $catname = $this->fr->validation($data['categoryname']);

     if(empty($catname)){
        $error = "Fild Must Not Be Empty";
        return $error;
     }else{
            $catname_query = "SELECT * FROM  tbl_category WHERE catname = '$catname'";
            $catname_result = $this->db->select($catname_query) ;
            if($catname_result > 0){
                $msg = "This Category alredy exsist";
                return $msg;
            }else{
                $insert_query = "INSERT INTO tbl_category(catName) VALUES ('$catname')";
                $insert_result = $this->db->insert($insert_query);

                if($insert_result){

                $success = "Category Inserted Successfully";
                return $success;

                }else{
                $error = "Something Wrong Category";
                return $error;
              }

            }

     }

    }

    //select all category

    public function allcategory(){
        $select_cat = "SELECT * FROM tbl_category";
        $select_result = $this->db->select($select_cat);
        if($select_result != false){
            return $select_result;
        }else{

            return false;
        }
    }

    //Edit cat data

    public function getEditCat($id){
        $eidt_data = "SELECT * FROM tbl_category WHERE catid= '$id'";
        $eid_result = $this->db->select($eidt_data);
        return $eid_result;
    }
    //update category

    public function updatecategory($catName, $id){
    $catNames = $this->fr->validation($catName);
    if(empty($catNames)){
      $msg = "$catName, $id";
      return $msg;
    }else{
      $checkName = "SELECT * FROM  tbl_category WHERE catName='$catName'";
      $cat_result = $this->db->select($checkName);

      if($cat_result > 0){
        $msg = "This Category already exsist";
        return $msg;
      }else{
                $update_query = "UPDATE  tbl_category SET catName='$catName' WHERE catid='$id'";
                $update_result = $this->db->insert($update_query);
                if($update_result){
                header('location:categorylists.php');
                $success = "Category Inserted Successfully";
                return $success;

                }else{
                $error = "Something Wrong Category Is Not Update";
                return $error;
              }

            }
    }
    }




    /// delect category

    public function DeleteCategory($id){
      $delete_query = "DELETE FROM tbl_category WHERE catid = '$id'";
      $result = $this->db->delete($delete_query);
      if($result){
        $msg = "Category Delete Successfully";
        return $msg;
      }
    }
}

?>