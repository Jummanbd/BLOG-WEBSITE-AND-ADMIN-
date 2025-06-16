<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
 include_once '../classes/category.php';
 $category = new Category();

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $catadd = $category->categoryadd($_POST);
 }

?>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
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
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>User Profile</h5>
                                </div>
                                <div class="col-sm-6 d-flex justify-content-end">
                                    <a href="edit-profile.php?uid=<?=Session::get('userid')?>" class="btn btn-sm btn-info">Edit Profile</a>
                                </div>
                            </div>
                        </div>
                      <div class="card-body">
                         <table class="table table-bordered table-responsive">
                            <tr>
                                <td><label for="">User Name</label></td>
                                <td><?=Session::get('username')?></td>
                            </tr>
                            <tr>
                                <td><label for="">User Photo</label></td>
                                <td><img src="<?=Session::get('userimg')?>" alt="user photo"></td>
                            </tr>
                         </table>
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