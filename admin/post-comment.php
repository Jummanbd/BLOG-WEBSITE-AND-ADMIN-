<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
// FORMAT
include_once '../helpers/Format.php';
$fr = new Format();
include_once '../classes/post.php';
$pt = new Post();
$userId = Session::get('userid');
$allPost = $pt->GetAllPost($userId);

include_once '../classes/comment.php';
$cmt = new Comment();
// post active
 if(isset($_GET['active'])){
    $acid= $_GET['active'];
    $active_comment = $cmt->ActiveComment($acid);

 }
// post deactive
 if(isset($_GET['deactive'])){
    $daid = $_GET['deactive'];
    $deactive_comment  = $cmt->DeactiveComment($daid);

 }

 // post delete
  if(isset($_GET['delComment'])){
    $id = base64_decode($_GET['delComment']);
    $deletePost = $cmt->DeleteComment($id);

 }
?>
<?php
// if(!isset($_GET['id'])){
//     echo "<meta http-equiv='refresh' content='0;URL=?id=ahr'/>";
// }
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <span>
                    <?php
                    if(isset($active_comment)){
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?=$active_comment ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    }
                    ?>
                    </span>



                    <span>
                    <?php
                    if(isset($deactive_comment)){
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?=$deactive_comment ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    }
                    ?>
                    </span>



                    <span>
                    <?php
                    if(isset($deletePost)){
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?=$deletePost ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    }
                    ?>
                    </span>
                    <div class="card">
                        <div class="card-body">

                            <h2 class="card-title">Post Lists</h2>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th>Comment</th>
                                    <th>Admin Reply</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $admintCmt = $cmt->adminComment($userId);
                                    if($admintCmt){
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($admintCmt)){
                                        $i++;
                                            ?>
                                            <tr>
                                                <td><?=$i++?></td>
                                                <td><?=$row['name']?></td>
                                                <td><?=$row['email']?></td>
                                                <td><?=$row['website']?></td>
                                                <td><?=$fr->textShorten($row['message'],20)?></td>
                                                <td><?=$row['admin_reply']?></td>
                                                <td>
                                                    <a  href="post-cmt-reply.php?replycmt=<?=base64_encode($row['cmId'])?>"   class="btn btn-danger btn-sm"><i class="fa-solid fa-reply"></i></a>

                                                    <a  href="?delComment=<?=base64_encode($row['cmId'])?>"   class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>



                                                    <a href="#" class="btn btn-success btn-sm"  data-bs-toggle="modal" data-bs-target="#myModal-<?=$row["cmId"]?>"><i class="fa-solid fa-eye"></i></a>


                                                    <?php
                                                    if($row['status'] == 0){
                                                        ?>
                                                        <a href="?deactive=<?=$row['cmId']?>" class="btn btn-warning btn-sm" ><i class="fa-solid fa-arrow-down"></i></a>
                                                      <?php

                                                    }else{
                                                        ?>
                                                        <a href="?active=<?=$row['cmId']?>" class="btn btn-info btn-sm"><i class="fa-solid fa-arrow-up"></i></a>
                                                      <?php
                                                    }
                                                    ?>


                                                </td>

                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>


<?php
$modelGet= $pt->modelData();
if($modelGet){
while($row = mysqli_fetch_assoc($modelGet)){
    ?>

    <div id="myModal-<?=$row["postId"]?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Modal Heading</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <td><label for="">Title</label></td>
                    <td><?=$row['title']?></td>
                </tr>
                <tr>
                    <td><label for="">Category</label></td>
                    <td><?=$row['catName']?></td>
                </tr>
                <tr>
                    <td><label for="">Image One</label></td>
                    <td><img style="width:100px;  height:80px" src="<?=$row['imageOne']?>" alt="post img"></td>
                </tr>
                <tr>
                    <td><label for="">Description One</label></td>
                    <td><?=$row['desOne']?></td>
                </tr>

                <tr>
                    <td><label for="">Image Two</label></td>
                    <td><img style="width:100px;  height:80px" src="<?=$row['imageTwo']?>" alt="post img"></td>
                </tr>
                <tr>
                    <td><label for="">Description Two</label></td>
                    <td><?=$row['desTwo']?></td>
                </tr>

                <tr>
                    <td><label for="">Post Type</label></td>
                    <td><?php
                    if($row['postType'] == 1){
                        echo "Post";
                    }else{
                    echo "Slider";

                    }
                    ?></td>
                </tr>
                <tr>
                    <td><label for="">Tags</label></td>
                    <td><?=$row['tags']?></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal">Close</button>
        </div>
    </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php
}
}
?>


<?php
include_once 'inc/footer.php';
?>