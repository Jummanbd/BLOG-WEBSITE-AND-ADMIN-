<?php
include_once '../classes/Register.php';
$re = new Register();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $addUser =$re->AddUser($_POST);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>
    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                <span>
                    <?php
                    if(isset($addUser)){
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?=$addUser ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                </span>
                <div class="card">
                    <h5 class="card-header">Registration Form</h5>
                    <div class="card-body">
                        <form action="" method="POST">

                        <div class="mb-3">
                            <label  class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label  class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label  class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" >
                        </div>
                        <button type="submit" class="btn btn-success">Sign Up</button>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>