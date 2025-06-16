<?php
 include_once 'inc/header.php';
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath.'/./classes/post.php');
 $post = new Post();
 include_once './helpers/Format.php';
 $fr= new Format();

 if(!isset($_GET['search']) || $_GET['search'] == NULL){
     echo "<h1 class ='text-danger pl-5'> Search Result Not Found </h1>";
 }else{
    $search = $_GET['search'];
 }
 ?>

  <section class="site-section py-sm pt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h2 class="mb-4">Latest Posts</h2>
        </div>
      </div>
      <div class="row blog-entries">
        <div class="col-md-12 col-lg-8 main-content">
          <div class="row">
            <?php
             $getPost = $post->searchPost($search);
             if($getPost){
              while($row= mysqli_fetch_assoc($getPost)){
                ?>

                  <div class="col-md-6">
                    <a href="blog-single.php?single=<?=base64_encode($row['postId'])?>"  class="blog-entry element-animate" data-animate-effect="fadeIn">
                      <img src="admin/<?=$row['imageOne']?>" alt="Image placeholder">
                      <div class="blog-content-body">
                        <div class="post-meta">
                          <span class="author mr-2"><img src="admin/<?=$row['userimg']?>" alt="Colorlib"><?=$row['username']?></span>&bullet;
                          <span class="mr-2"><?=$fr->formatedate($row['create_time'])?></span> &bullet;
                          <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                        </div>
                        <h2><?=$row['title']?></h2>
                      </div>
                    </a>
                  </div>
                <?php
              }
             }else{
                echo "<h1 class = 'text-danger '> Search Result Not Found </h1>";

             }
            ?>


          </div>

          <div class="row mt-5">
            <div class="col-md-12 text-center">
              <nav aria-label="Page navigation" class="text-center">
                <ul class="pagination">
                  <li class="page-item  active"><a class="page-link" href="#">&lt;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">4</a></li>
                  <li class="page-item"><a class="page-link" href="#">5</a></li>
                  <li class="page-item"><a class="page-link" href="#">&gt;</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>

        <!-- END main-content -->
      <?php include_once 'inc/sidebar.php';?>
      </div>
    </div>
  </section>
<?php include_once 'inc/footer.php';?>
