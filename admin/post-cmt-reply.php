<?php
 include_once '../classes/comment.php';
 $cmt = new Comment();

 if(isset($_GET['replycmt'])){
    $cmtId = base64_decode($_GET['replycmt']);

 }

 if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $cmtReply = $cmt->commentreply($_POST, $cmtId);
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
                 <h4 class="mb-4">Comment Reply</h4>
                <div class="col-xl-6">
                <span>
                    <?php
                    if(isset($cmtReply)){
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?=$cmtReply ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                </span>
                    <div class="card">
                      <div class="card-body">
                        <?php
                        $select_cmt = $cmt->commentSelect($cmtId);
                        if($select_cmt){
                        while($row = mysqli_fetch_assoc($select_cmt)){
                            ?>
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Reply Message</label>
                                <textarea name="msg_reply" id="message" cols="30" rows="10" class="form-control" ><?=$row['admin_reply']?></textarea>
                            </div>
                            <button type="submit" class = "btn btn-success ">Send Reply</button>
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