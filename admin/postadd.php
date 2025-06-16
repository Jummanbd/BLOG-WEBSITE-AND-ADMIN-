<?php
include_once '../classes/category.php';
$ct = new Category();
 include_once '../classes/post.php';
 $post = new Post();
//  all category


 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $addPost = $post->AddPost($_POST, $_FILES);
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
                 <h4 class="mb-4">Post  Add Form</h4>
                <div class="col-xl-10">
                <span>
                    <?php
                    if(isset($addPost)){
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?=$addPost ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                </span>
                    <div class="card">
                      <div class="card-body">

                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" name = "userid" value="<?=Session::get('userid')?>">

                            <div class="mb-3">
                                <label class="form-label">Post Add</label>
                                <input type="text" class="form-control" name = "title" placeholder = "Title Type">
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

                                                    <option value="<?=$row['catid']?>"><?=$row['catName']?></option>
                                                <?php
                                            }
                                           }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image One</label>
                                <input type="file" class="form-control" name = "imageOne" placeholder = "Title Type">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description One</label>
                                 <textarea name="des_one" id="classic-editor"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Image Two</label>
                                <input type="file" class="form-control" name = "imageTwo" placeholder = "Title Type">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description Two</label>
                                 <textarea name="des_two" id="classic-editor_two"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Post Type</label>
                                <div class="col">
                                    <select class="form-select" name = "postType">
                                        <option>Select</option>
                                        <option value="1">Post</option>
                                        <option value="2">Slider</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tag</label>
                                <input type="text" class="form-control" name = "tags" placeholder = "Post Tags">
                            </div>
                            <button type="submit" class = "btn btn-primary ">Add Post</button>
                        </form>
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