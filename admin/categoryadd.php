<?php
 include_once '../classes/category.php';
 $category = new Category();

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $catadd = $category->categoryadd($_POST);
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
                 <h4 class="mb-4">Category Add Form</h4>
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

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" class="form-control" name = "categoryname" placeholder = "Category Type">
                            </div>
                            <button type="submit" class = "btn btn-primary ">Add Category</button>
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