<?php

 include_once '../classes/Resendemail.php';

 $re = new Resendemail();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $email = $_POST['email'];
     $resend = $re->resendEmail($email);
}


?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resend Email Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>
    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <span>
                    <?php
                    if(isset($resend)){
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= $resend ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                </span>
                <div class="card">
                    <h5 class="card-header">Resend Email Form</h5>
                    <div class="card-body">
                        <form action="" method="POST">
                        <div class="mb-3">
                            <label  class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" >
                        </div>
                        <button type="submit" class="btn btn-success">Resend Email</button>
                        <a href="login.php" class="btn btn-info ">Login</a>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>