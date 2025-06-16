<?php
 include_once '../classes/PasswordChange.php';
 $cng = new PasswordChange();

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $ChangePass = $cng->changePass($_POST);
 }
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chenge Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  </head>
  <body>
    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                    <?php
                    if(isset($ChangePass)){
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= $ChangePass ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php
                    }
                    ?>
                </span>
                <div class="card">
                    <h5 class="card-header">Change Passw Form</h5>
                    <div class="card-body">
                        <form action="" method="POST">
                        <input type="hidden" name="token" class="form-control" value = "
                            <?php
                            if(isset($_GET['token'])){
                                echo $_GET['token'];
                            }
                            ?>
                            " >
                        <div class="mb-3">
                            <label  class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control"   value ="
                            <?php
                            if(isset($_GET['email'])){
                                echo $_GET['email'];
                            }
                            ?>" >
                        </div>

                        <div class="mb-3">
                            <label  class="form-label">New Password</label>
                            <input type="password" name="newpassword" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label  class="form-label">Confirm Password</label>
                            <input type="password" name="c_password" class="form-control" >
                        </div>
                        <button type="submit" class="btn btn-success">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  </body>
</html>