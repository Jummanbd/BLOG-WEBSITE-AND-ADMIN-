<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
 include_once '../classes/siteOption.php';
 $siteOption = new siteOption();

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $social = $siteOption->updateLinks($_POST);
 }

?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                 <h4 class="mb-4">Social Links</h4>
                <div class="col-xl-6">
                <span>
                    <?php
                    if(isset($social)){
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?=$social ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                </span>
                    <div class="card">
                      <div class="card-body">

                      <?php
                       $allsocial = $siteOption->allSocial();

                       if($allsocial){
                        while($row = mysqli_fetch_assoc($allsocial)){
                            ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Twitter</label>
                                <input type="text" class="form-control" name = "twitter" value="<?=$row['twitter']?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Facebook</label>
                                <input type="text" class="form-control" name = "facebook" value="<?=$row['facebook']?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Instagram</label>
                                <input type="text" class="form-control" name = "instagram" value="<?=$row['instagram']?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">YouTube</label>
                                <input type="text" class="form-control" name = "youtube" value="<?=$row['youtube']?>">
                            </div>
                            <button type="submit" class = "btn btn-primary ">Social Links</button>
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