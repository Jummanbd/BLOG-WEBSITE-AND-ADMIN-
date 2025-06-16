<?php
 $filepath = realpath(dirname(__FILE__));
 include_once  ($filepath.'/../lib/Database.php');
 include_once  ($filepath.'/../helpers/Format.php');
class Comment{
    private $db;
    private  $fr;
 public function __construct(){
        $this->db = new Database();
        $this->fr = new Format();
}

// add comment
 public function addComment($data){
    $userId = $this->fr->validation($data['userid']);
    $postId = $this->fr->validation($data['postId']);
    $name = $this->fr->validation($data['name']);
    $email = $this->fr->validation($data['email']);
    $website = $this->fr->validation($data['website']);
    $message = $this->fr->validation($data['message']);

    if( $name == '' || $email == '' ||$message == '') {
        $msg = "Fild Must Not Be Empty";
        return $msg;
    }else{
        $comment_query = "INSERT INTO `tbl_comment`(`userId`,`postId`,`name`, `email`, `website`, `message`) VALUES ('$userId','$postId','$name', '$email', '$website', '$message')";
        $result = $this->db->insert($comment_query);
        if($result){
            $msg = "Commen Success";
            return $msg;
        }

    }



 }

 // all comment
 public function allcomment($id){
    $select_cmt = "SELECT tbl_comment.*, tbl_post.postId, tbl_users.username, tbl_users.userimg From tbl_comment INNER JOIN tbl_post ON tbl_comment.postId = tbl_post.postId INNER JOIN tbl_users ON tbl_comment.userId = tbl_users.userid WHERE tbl_comment.postId='$id' AND tbl_comment.status = '1'";
    $result = $this->db->select($select_cmt);
    return $result;
 }

 // admin comment
  public function adminComment($id){
    $select_cmt = "SELECT tbl_comment.*, tbl_users.userid From tbl_comment INNER JOIN tbl_users ON tbl_comment.postId = tbl_users.userid WHERE tbl_comment.postId='$id'";
    $result = $this->db->select($select_cmt);
    return $result;
 }

// comment Active
public function ActiveComment($acid){
    $update_status =  "UPDATE  tbl_comment SET status ='0'  WHERE cmId = '$acid'";
    $result = $this->db->update($update_status);

    if($result){
          $Success = "Comment Deactive Successfully";
        return $Success;
    }
}
// Comment Deactive
public function DeactiveComment($daid){
    $update_status =  "UPDATE  tbl_comment SET status ='1'  WHERE cmId = '$daid'";
    $result = $this->db->update($update_status);

    if($result){
        $Success = "Comment Active Successfully";
        return $Success;
    }
}

// comment reply

public function commentreply($data, $cmtId){
    $msg_reply = $this->fr->validation($data['msg_reply']);
    $update_time = date("D M Y");
    if(empty($msg_reply)) {
        $msg = "Reply Fild must be required";
        return $msg;
    }else{
        $reply_query = "UPDATE `tbl_comment` SET `admin_reply` = '$msg_reply', `update_time` = '$update_time'  WHERE `cmId` = '$cmtId'";
        $result = $this->db->update($reply_query);
        if($result){
            $msg = "Reply Success";
            return $msg;
        }else{
            $msg = "Reply Failed";
            return $msg;
        }

    }
}

/// select comment

public function commentSelect($id){
    $select_cmt = "SELECT * FROM tbl_comment WHERE cmId= '$id'";
    $result = $this->db->select($select_cmt);
    return $result;
}

// Delete Post
public function DeleteComment($id){

    $delete_query = "DELETE FROM tbl_comment WHERE cmId = '$id'";
      $result = $this->db->delete($delete_query);
      if($result){
        $msg = "Comment Delete Successfully";
        return $msg;
      }else{
        $error = "Comment is  Not  Delete";
        return $error;
      }

}
}
?>