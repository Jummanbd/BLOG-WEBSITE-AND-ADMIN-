<?php
 include_once '../classes/category.php';
 $ct = new Category();

 if(isset($_GET['editId'])){
    $id = base64_decode($_GET['editId']);
 }else{
    header('location:categorylists.php');
 }
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $catName = $_POST['catName'];
    $catadd = $ct->updatecategory($catName, $id);
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
                 <h4 class="mb-4">Update Category  Form</h4>
                <div class="col-xl-6">
                                    <span>
                    <?php
                    if(isset($catadd)){
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?=$catadd ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                </span>
                    <div class="card">
                      <div class="card-body">
                        <?php
                        $getData = $ct->getEditCat($id);
                        if($getData){
                        while ($row = mysqli_fetch_assoc($getData)){
                            ?>

                          <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Update Category</label>
                                <input type="text" class="form-control" name = "catName" value="<?=$row["catName"]?>">
                            </div>
                            <button type="submit" class = "btn btn-primary ">Update Category</button>
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