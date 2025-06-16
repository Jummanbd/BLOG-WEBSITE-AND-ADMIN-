<?php
 include_once '../classes/category.php';
 $ct = new Category();


 include_once '../classes/post.php';
 $post = new Post();
//  all category
if(isset($_GET['editpost'])){
    $id = base64_decode($_GET['editpost']);

 }else{
    header('location:postall.php');
 }
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $postEidt = $post->EditPost($_POST, $_FILES, $id);
 }
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                 <h4 class="mb-4">Edit Form</h4>
                <div class="col-xl-10">
                <span>
                    <?php
                    if(isset($postEidt)){
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?=$postEidt ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                </span>
                    <div class="card">
                      <div class="card-body">

                       <?php
                      $getPost = $post->getPostForEdit($id);
                       if($getPost){
                        while($prow=mysqli_fetch_assoc($getPost)){
                            ?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">Post Add</label>
                                        <input type="text" class="form-control" name = "title" value="<?=$prow["title"]?>">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Select Category </label>
                                        <div class="col">
                                            <select class="form-select" name = "catId">
                                                <option>Select</option>
                                                <?php
                                                $allCat= $ct->allcategory();
                                                if($allCat){
                                                    while($row = mysqli_fetch_assoc($allCat)){
                                                        ?>
                                                            <option  <?=$prow['catId'] == $row['catid'] ? 'selected' : ''?> value="<?=$row['catid']?>"><?=$row['catName']?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image One</label>
                                        <input type="file" class="form-control" name = "imageOne">
                                        <img src="<?=$prow['imageOne']?>" class="img-thumbnail" style = "width:220px" alt="post_img">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description One</label>
                                        <textarea name="des_one" id="classic-editor" ><?=$prow["desOne"]?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Image Two</label>
                                        <input type="file" class="form-control" name = "imageTwo" >
                                        <img src="<?=$prow['imageTwo']?>" class="img-thumbnail" style = "width:220px" alt="post_img">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description Two</label>
                                        <textarea name="des_two" id="classic-editor_two" ><?=$prow["desTwo"]?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Post Type</label>
                                        <div class="col">
                                            <select class="form-select" name = "postType">
                                                <option>Select</option>
                                                <?php
                                                if($prow['postType'] == 1){
                                                    ?>
                                                    <option selected value="1">Post</option>
                                                    <option value="2">Slider</option>
                                                    <?php

                                                }else{

                                                   ?>
                                                   <option  value="1">Post</option>
                                                    <option selected value="2">Slider</option>
                                                   <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tag</label>
                                        <input type="text" class="form-control" name = "tags" value="<?=$prow["tags"]?>">
                                    </div>
                                    <button type="submit" class = "btn btn-primary ">Edit Post</button>
                                </form>

                            <?php
                        }
                       }
                       ?>

                      </div>
                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->



</div>
<!-- end main content-->
<?php
include_once 'inc/footer.php';
?>