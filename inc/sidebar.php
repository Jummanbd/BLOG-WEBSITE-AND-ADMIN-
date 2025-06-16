<?php
 $filepath = realpath(dirname(__FILE__));
 include_once ($filepath."/../helpers/Format.php");
 $ft = new Format();
 $category = new Category();
 include_once ($filepath."/../classes/user.php");
 $user = new Usered();
  include_once ($filepath."/../classes/siteOption.php");
 $site = new siteOption();
 include_once ($filepath."/../classes/post.php");
 $post = new post();
  include_once ($filepath."/../classes/category.php");
 $category = new Category();

?>
<div class="col-md-12 col-lg-4 sidebar">
  <div class="sidebar-box search-form-wrap">
    <form action="#" class="search-form">
      <div class="form-group">
        <span class="icon fa fa-search"></span>
        <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
      </div>
    </form>
  </div>
  <!-- END sidebar-box -->
  <div class="sidebar-box">
  <?php
   $userBoi = $user->userBio();
   if($userBoi){
    while($row = mysqli_fetch_assoc($userBoi)){
      ?>
    <div class="bio text-center">
      <img src="admin/<?=$row['userimg']?>" alt="Image Placeholder" class="img-fluid">
      <div class="bio-body">
        <h2><?=$row['username']?></h2>
        <p><?=$row['user_bio']?></p>
        <p><a href="#" class="btn btn-primary btn-sm rounded">Read my bio</a></p>
              <?php
              $social_link = $site->allSocial();
              if($social_link){
                while($row = mysqli_fetch_assoc($social_link)){
                  ?>
                    <div class="social">
                      <a href="<?=$row["twitter"]?>" class="p-2"><span class="fa fa-twitter"></span></a>
                      <a href="<?=$row["facebook"]?>" class="p-2"><span class="fa fa-facebook"></span></a>
                      <a href="<?=$row["instagram"]?>" class="p-2"><span class="fa fa-instagram"></span></a>
                      <a href="<?=$row["youtube"]?>" class="p-2"><span class="fa fa-youtube-play"></span></a>
                    </div>
               <?php

                }
              }
              ?>
      </div>
    </div>
      <?php
    }
   }
  ?>

  </div>
  <!-- END sidebar-box -->
  <div class="sidebar-box">
    <h3 class="heading">Popular Posts</h3>
    <div class="post-entry-sidebar">
      <ul>
        <?php
         $populer_post = $post->popularPost();
         if($populer_post){
          while($row = mysqli_fetch_assoc($populer_post)){
            ?>

              <li>
                <a href="blog-single.php?single=<?=base64_encode($row['postId'])?>">
                  <img src="admin/<?=$row['imageOne']?>" alt="Image placeholder" class="mr-4">
                  <div class="text">
                    <h4><?=$row['title']?></h4>
                    <div class="post-meta">
                      <span class="mr-2"><?=$fr->formatedate($row['create_time'])?> </span>
                    </div>
                  </div>
                </a>
              </li>
            <?php
          }
         }
        ?>

      </ul>
    </div>
  </div>
  <!-- END sidebar-box -->

  <div class="sidebar-box">
    <h3 class="heading">Categories</h3>
    <ul class="categories">
      <?php
      $categoryItem = $category->allcategory();
      if($categoryItem){
        while($catRow= mysqli_fetch_assoc($categoryItem)){
          ?>
         <li><a href="#"><?=$catRow['catName']?>
         <span>
            (<?php
            $catNum = $post->catNum($catRow['catid']);
            if($catNum){
              echo $num = mysqli_num_rows($catNum);
            }else{
              echo "0";
            }
            ?>)
         </span>
        </a>
      </li>

          <?php
        }
      }
      ?>

    </ul>
  </div>
  <!-- END sidebar-box -->

  <div class="sidebar-box">
    <h3 class="heading">Tags</h3>
    <ul class="tags">

        <?php
        $allTags = $post->popularPost();
        if($allTags){
          while ($tag = mysqli_fetch_assoc($allTags)){
            ?>
          <li><a href="#"><?=$tag['tags']?></a></li>

            <?php
          }
        }
        ?>
    </ul>
  </div>
</div>
<!-- END sidebar -->