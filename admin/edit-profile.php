<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
include_once '../classes/user.php';
 $user = new Usered();
if(isset($_GET['uid'])){
    $id = $_GET['uid'];

}
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $update = $user->userUpdate($_POST, $_FILES, $id);
 }

?>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                 <h4 class="mb-4">User Profile Update Form</h4>
                <div class="col-xl-6">
                <span>
                    <?php
                    if(isset($update)){
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?=$update ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                </span>
                    <div class="card">
                      <div class="card-body">
                        <?php
                          $getDate = $user->userInfo($id);

                          if($getDate){
                            while ($row = mysqli_fetch_assoc($getDate)){
                                ?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label class="form-label">User Name</label>
                                        <input type="text" class="form-control" name = "username" value="<?=$row['username']?>">
                                    </div>

                                    <div class="mb-3">
                                    <label class="form-label">User Photo</label>
                                    <input type="file" class="form-control" name = "image" placeholder = "User Name Type">
                                    <img src="<?=$row['userimg']?>" alt="img" class="img-thumbnail">
                                    </div>

                                    <div class="mb-3">
                                    <label class="form-label">User Bio</label>
                                    <textarea name="user_bio" class="form-control" placeholder = "User Bio"><?=$row['user_bio']?></textarea>
                                    </div>
                                    <button type="submit" class = "btn btn-primary ">Update Profile</button>
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