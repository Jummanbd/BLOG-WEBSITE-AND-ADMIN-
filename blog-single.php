
<?php
 include_once 'inc/header.php';
 include_once 'inc/slider.php';

 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/./classes/post.php');
 $post = new Post();

 include_once './helpers/Format.php';
 $fr= new Format();
 include_once './classes/comment.php';
 $comt = new Comment();

  if(isset($_GET['single'])){
    $id = base64_decode($_GET['single']);
 }

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $comment = $comt->addComment($_POST);
 }
 ?>
  <section class="site-section py-lg">
    <div class="container">

      <div class="row blog-entries element-animate">

        <?php
           $getSinglePost = $post->singlePost($id);
          if($getSinglePost){
            while($sinrow= mysqli_fetch_assoc($getSinglePost)){
             ?>

              <div class="col-md-12 col-lg-8 main-content">
                <img src="admin/<?=$sinrow['imageOne']?>" alt="Image" class="img-fluid mb-5">
                <div class="post-meta">
                  <span class="author mr-2"><img src="admin/<?=$sinrow['userimg']?>" alt="Colorlib" class="mr-2"><?=$sinrow['username']?></span>&bullet;
                  <span class="mr-2"><?=$fr->formatedate($sinrow['create_time'])?></span> &bullet;
                  <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                </div>
                <h1 class="mb-4"><?=$sinrow['title']?></h1>
                <a class="category mb-5" href="#"><?=$sinrow['catName']?></a>

                <div class="post-content-body">
                  <p><?=$sinrow['desOne']?></p>
                <div class="row mb-5">
                  <div class="col-md-12 mb-4">
                    <img src="admin/<?=$sinrow['imageTwo']?>" alt="Image placeholder" class="img-fluid">
                  </div>
                </div>
                <p><?=$sinrow['desTwo']?></p>
                </div>


                <div class="pt-5">
                  <p>Categories:  <a href="#"><?=$sinrow['catName']?></a>,   Tags: <a href="#"><?=$sinrow['tags']?></a></p>
                </div>


                <div class="pt-5">
                  <h3 class="mb-5"> Comment</h3>
                  <?php
                  $pId = $sinrow['postId'];
                  $userid = $sinrow['userid'];
                  $all_cmt = $comt->allcomment($pId);
                  if($all_cmt){
                  while($comrow= mysqli_fetch_assoc($all_cmt)){

                    ?>


                      <ul class="comment-list">


                        <li class="comment">
                          <div class="vcard">
                            <img src="admin/<?=$comrow['userimg']?>" alt="Image placeholder">
                          </div>
                          <div class="comment-body">
                            <h3><?=$comrow['name']?></h3>
                            <div class="meta"><?=$fr->formatedate($comrow['create_time'])?></div>
                            <p><?=$comrow['message']?></p>
                          </div>
                          <?php
                          if($comrow['admin_reply']){
                            ?>
                              <ul class="children">
                                <li class="comment">
                                  <div class="vcard">
                                    <img src="admin/<?=$comrow['userimg']?>" alt="Image placeholder">
                                  </div>
                                  <div class="comment-body">
                                    <h3><?=$comrow['name']?></h3>
                                  <div class="meta"><?=$fr->formatedate($comrow['create_time'])?></div>
                                    <p class="meta text-dark"><?=$comrow['admin_reply']?></p>

                                  </div>
                                </li>
                              </ul>
                            <?php
                          }
                          ?>

                        </li>


                      </ul>
                    <?php
                  }
                  }
                  ?>

                  <!-- END comment-list -->

                  <div class="comment-form-wrap pt-5">
                    <h3 class="mb-5">Leave a comment</h3>

                    <?php
                  if(isset($comment)){
                  ?>
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <?=$comment ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  <?php
                  }
                  ?>
                    <form action="#" method="POST" class="p-5 bg-light">

                      <input type="hidden" class="form-control" name = "userid" value="<?=$userid?>">
                      <input type="hidden" class="form-control" name = "postId" value="<?=$pId?>">
                      <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" name="name" class="form-control" id="name">
                      </div>
                      <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" name="email" class="form-control" id="email">
                      </div>
                      <div class="form-group">
                        <label for="website">Website</label>
                        <input type="url" name="website" class="form-control" id="website">
                      </div>

                      <div class="form-group">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                      </div>
                      <div class="form-group">
                        <input type="submit" value="Post Comment" class="btn btn-primary">
                      </div>

                    </form>
                  </div>
                </div>

              </div>



                <!-- END main-content -->

                <?php include_once 'inc/sidebar.php';?>
                <!-- END sidebar -->

                  </div>
                  </div>
                </section>

                <section class="py-5">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">

                        <h2 class="mb-3 ">Related Post</h2>
                      </div>
                    </div>
                    <div class="row">
                      <?php
                      $rel_post = $post->relatedPost($sinrow['catId']);
                      if($rel_post){
                        while($relateRow = mysqli_fetch_assoc($rel_post)){
                          ?>
                      <div class="col-md-6 col-lg-4">
                        <a href="blog-single.php?single=<?=base64_encode($relateRow['postId'])?>" class="a-block sm d-flex align-items-center height-md" style="background-image: url('admin/<?=$relateRow['imageOne']?>'); ">
                          <div class="text">
                            <div class="post-meta">
                              <span class="category"><?=$relateRow['catName']?></span>
                              <span class="mr-2">March 15, 2018 </span> &bullet;
                              <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                            </div>
                            <h3><?=$relateRow['title']?></h3>
                          </div>
                        </a>
                      </div>
                          <?php
                        }
                      }
                      ?>

                    </div>
                  </div>


                </section>

             <?php
           }
         }
  ?>
    <!-- END section -->

<?php include_once 'inc/footer.php';?>

