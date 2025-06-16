<?php
include_once 'inc/header.php';
include_once 'inc/sidebar.php';
 include_once '../classes/siteOption.php';
 $siteOption = new siteOption();

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $social = $siteOption->updateLogo($_POST);
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
                       $logo = $siteOption->getlogo();

                       if($logo){
                        while($row = mysqli_fetch_assoc($logo)){
                            ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Twitter</label>
                                <input type="text" class="form-control" name = "logoname" value="<?=$row['logoname']?>">
                            </div>
                            <button type="submit" class = "btn btn-primary ">Update Logo</button>
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