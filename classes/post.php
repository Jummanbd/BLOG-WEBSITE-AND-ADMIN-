<?php
 $filepath = realpath(dirname(__FILE__));
 include_once  ($filepath.'/../lib/Database.php');
 include_once  ($filepath.'/../helpers/Format.php');
class Post{
    private $db;
    private  $fr;
 public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

 public function AddPost($data, $file){
  $userId = $this->fr->validation($data['userid']);
  $title = $this->fr->validation($data['title']);
  $catId = $this->fr->validation($data['catId']);
  $desOne = $this->fr->validation($data['des_one']);
  $desTwo = $this->fr->validation($data['des_two']);
  $postType = $this->fr->validation($data['postType']);
  $tags = $this->fr->validation($data['tags']);

  // for image one
  $permitedImg = array('jpg', 'jpeg', 'png', 'gif');
  $file_name = $file['imageOne']['name'];
  $file_size = $file['imageOne']['size'];
  $file_temp = $file['imageOne']['tmp_name'];
  $div = explode('.', $file_name);
  $file_ext = strtolower(end($div));
  $unique_image =substr(md5(time()),0, 10).'.'. $file_ext;
  $upload_image = "upload/".$unique_image;


  // for image two
  $permitedTow = array('jpg', 'jpeg', 'png', 'gif');
  $file_name_two = $file['imageTwo']['name'];
  $file_size_two = $file['imageTwo']['size'];
  $file_temp_two = $file['imageTwo']['tmp_name'];
  $div_two = explode('.', $file_name_two);
  $file_ext_two = strtolower(end($div_two));
  $unique_image_two =substr(md5(rand().time()),0, 10).'.'. $file_ext_two;
  $upload_image_two = "upload/".$unique_image_two;



    if(empty($title) || empty($catId) || empty($desOne) || empty($desTwo) || empty($postType) || empty($tags)) {
        $msg = "Fild Must Not Be Empty";
        return $msg;
    }elseif($file_size > 1048567){
       $msg = "File Size Must Be less then 1 MB";
        return $msg;
    }elseif($file_size_two > 1048567){
       $msg = "File Size Must Be less then 1 MB";
        return $msg;
    }elseif(in_array($file_ext, $permitedImg) == false){
       $msg = "Your can uplad only:-". implode('.', $permitedImg);
        return $msg;
    }elseif(in_array($file_ext_two, $permitedTow) == false){
       $msg = "Your can uplad only:-". implode('.', $permitedTow);
        return $msg;
    }else{
        move_uploaded_file($file_temp, $upload_image);
        move_uploaded_file($file_temp_two, $upload_image_two);
        $insert_query = "INSERT INTO `tbl_post`( `userid`,`title`, `catId`, `imageOne`, `desOne`, `imageTwo`, `desTwo`, `postType`, `tags`) VALUES('$userId','$title', '$catId', '$upload_image', '$desOne', '$upload_image_two', '$desTwo', '$postType', '$tags')";

        $result = $this->db->insert($insert_query);

        if($result){

            $Success = "Post Inserted Successfully";
            return $Success;
           header("location:postall.php");


        }else {
            $error = "Something wrong Post is not added";
            return $error;
        }
    }

 }

//  get all post
public function GetAllPost($userId){
    $get_post = "SELECT  tbl_post.*, tbl_category.catName,tbl_users.userid FROM tbl_post INNER JOIN tbl_category ON tbl_post.catId = tbl_category.catid INNER JOIN tbl_users ON tbl_post.userid = tbl_users.userid WHERE tbl_users.userid = '$userId'";
    $get_query = $this->db->select($get_post);
    return $get_query;
}

//  modela all data
public function modelData(){
    $get_post = "SELECT  tbl_post.*, tbl_category.catName FROM tbl_post INNER JOIN tbl_category ON tbl_post.catId = tbl_category.catid";
    $get_query = $this->db->select($get_post);
    return $get_query;
}

// post update

public function EditPost($data, $file, $id){

  $title = $this->fr->validation($data['title']);
  $catId = $this->fr->validation($data['catId']);
  $desOne = $this->fr->validation($data['des_one']);
  $desTwo = $this->fr->validation($data['des_two']);
  $postType = $this->fr->validation($data['postType']);
  $tags = $this->fr->validation($data['tags']);
  // for image one
  $permitedImg = array('jpg', 'jpeg', 'png', 'gif');
  $file_name = $file['imageOne']['name'];
  $file_size = $file['imageOne']['size'];
  $file_temp = $file['imageOne']['tmp_name'];
  $div = explode('.', $file_name);
  $file_ext = strtolower(end($div));
  $unique_image =substr(md5(time()),0, 10).'.'. $file_ext;
  $upload_image = "upload/".$unique_image;


  // for image two
  $permitedTow = array('jpg', 'jpeg', 'png', 'gif');
  $file_name_two = $file['imageTwo']['name'];
  $file_size_two = $file['imageTwo']['size'];
  $file_temp_two = $file['imageTwo']['tmp_name'];
  $div_two = explode('.', $file_name_two);
  $file_ext_two = strtolower(end($div_two));
  $unique_image_two =substr(md5(rand().time()),0, 10).'.'. $file_ext_two;
  $upload_image_two = "upload/".$unique_image_two;



if(empty($title) || empty($catId) || empty($desOne) || empty($desTwo) || empty($postType) || empty($tags)) {
    $msg = "Fild Must Not Be Empty";
    return $msg;
}else{
    if(!empty($file_name) || !empty($file_name_two)){

        if($file_size > 1048567){
        $msg = "File Size Must Be less then 1 MB";
            return $msg;
        }elseif($file_size_two > 1048567){
        $msg = "File Size Must Be less then 1 MB";
            return $msg;
        }elseif(in_array($file_ext, $permitedImg) == false){
        $msg = "Your can uplad only:-". implode('.', $permitedImg);
        return $msg;
        }elseif(in_array($file_ext_two, $permitedTow) == false){
        $msg = "Your can uplad only:-". implode('.', $permitedTow);
            return $msg;
        }else{
            move_uploaded_file($file_temp, $upload_image);
            move_uploaded_file($file_temp_two, $upload_image_two);
            $insert_query = "UPDATE `tbl_post` SET `title`='$title',`catId`='$catId',`imageOne`='$upload_image',`desOne`='$desOne',`imageTwo`='$upload_image_two',`desTwo`='$desTwo',`postType`='$postType',`tags`='$tags' WHERE postId =  '$id'";

            $result = $this->db->insert($insert_query);

            if($result){

            $Success = "Post Update Successfully";
            return $Success;
                header("location:postall.php");


            }else {
                $error = "Something wrong Post is not Updated";
                return $error;
            }
        }
    }else{
            $insert_query = "UPDATE `tbl_post` SET `title`='$title',`catId`='$catId',`desOne`='$desOne',`desTwo`='$desTwo',`postType`='$postType',`tags`='$tags' WHERE postId =  '$id'";

            $result = $this->db->insert($insert_query);

            if($result){

            $Success = "Post Update Successfully";
            return $Success;
                header("location:postall.php");


            }else {
                $error = "Something wrong Post is not Updated";
                return $error;
            }
    }
}

}
// getpostforedit
public function getPostForEdit($id){
    $get_post = "SELECT * FROM tbl_post  WHERE postId = '$id'";
    $get_query = $this->db->select($get_post);
    return $get_query;
}
// post active
public function ActivePost($acid){
    $update_status =  "UPDATE  tbl_post SET status ='0'  WHERE postId = '$acid'";
    $result = $this->db->update($update_status);

    if($result){
          $Success = "Post Deactive Successfully";
        return $Success;
    }
}
// Deactive Post
public function DeactivePost($daid){
    $update_status =  "UPDATE  tbl_post SET status ='1'  WHERE postId = '$daid'";
    $result = $this->db->update($update_status);

    if($result){
        $Success = "Post Active Successfully";
        return $Success;
    }
}

// Delete Post
public function DeletePost($id){
    $img_query = "SELECT * FROM tbl_post WHERE postId = '$id'";
    $img_result = $this->db->select($img_query);
    if($img_result){
        while ($img = mysqli_fetch_assoc($img_result)){
            $imgOne = $img['imageOne'];
            unlink($imgOne);
            $imgTwo = $img['imageTwo'];
            unlink($imgTwo);
        }
    }

    $delete_query = "DELETE FROM tbl_post WHERE postId = '$id'";
      $result = $this->db->delete($delete_query);
      if($result){
        $msg = "Post Delete Successfully";
        return $msg;
      }else{
        $error = "Post Not  Delete";
        return $error;
      }

}

// latest post


public function latestPost(){
    $post_query = "SELECT tbl_post.*, tbl_users.username, tbl_users.userimg FROM tbl_post INNER JOIN tbl_users ON tbl_post.userid = tbl_users.userid WHERE tbl_post.status = '1' ORDER BY tbl_post.postId  DESC";
    $result = $this->db->select($post_query);
    return $result;

}

// get single post

public function singlePost($id){
 $single_query = "SELECT tbl_post.*, tbl_users.username, tbl_users.userimg, tbl_category.catName FROM tbl_post INNER JOIN tbl_users ON tbl_post.userid = tbl_users.userid INNER JOIN tbl_category ON tbl_post.catId = tbl_category.catid  WHERE tbl_post.postId = '$id'";

  $result = $this->db->select($single_query);
    return $result;

}

// popular post

public function popularPost(){
    $popular_query = "SELECT * FROM tbl_post ORDER BY postid DESC LIMIT 3";
    $result = $this->db->select($popular_query);
    return $result;
}

//catgory post  count
public function catNum($id){
    $ct_query = "SELECT * FROM tbl_post  WHERE tbl_post.catId = '$id'";
    $ct_result = $this->db->select($ct_query);
    return $ct_result;
}

// Slider Post
 public function sliderPost(){
  $slider_query = "SELECT tbl_post.*, tbl_category.catName, tbl_users.userimg, tbl_users.username FROM tbl_post INNER JOIN tbl_category ON tbl_post.catid = tbl_category.catid INNER JOIN tbl_users ON tbl_post.userid = tbl_users.userid WHERE postType = 2 AND status = 1";
  $result = $this->db->select($slider_query);
  return $result;
 }

 public function searchPost($id){
    $post_query = "SELECT tbl_post.*, tbl_users.userimg, tbl_users.username FROM tbl_post INNER JOIN tbl_users ON tbl_post.userid = tbl_users.userid WHERE tbl_post.title LIKE '%$id%'";
    $result = $this->db->select($post_query);
    return $result;
 }

 //relatedPost

 public function relatedPost($id){
    $rel_query = "SELECT tbl_post.*, tbl_category.catName FROM tbl_post INNER JOIN tbl_category ON tbl_post.catId = tbl_category.catid WHERE tbl_category.catid = '$id' ORDER BY tbl_post.postId DESC LIMIT 3";
    $result = $this->db->select($rel_query);
    return $result;

 }
}
?>