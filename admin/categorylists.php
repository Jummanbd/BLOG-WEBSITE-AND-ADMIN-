<?php
include_once '../classes/category.php';
$ct = new Category();
$allCat = $ct->allcategory();


 if(isset($_GET['delCat'])){
    $id = base64_decode($_GET['delCat']);
    $deleteCat = $ct->DeleteCategory($id);

 }

include_once 'inc/header.php';
include_once 'inc/sidebar.php';
?>

<?php
if(!isset($_GET['id'])){
    echo "<meta http-equiv='refresh' content='0;URL=?id=ahr'/>";
}
?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <span>
                    <?php
                    if(isset($deleteCat)){
                    ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?=$deleteCat ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    }
                    ?>
                    </span>
                    <div class="card">
                        <div class="card-body">

                            <h2 class="card-title">Category Lists</h2>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($allCat){
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($allCat)){
                                        $i++;
                                            ?>
                                            <tr>
                                                <td><?=$i?></td>
                                                <td><?=$row['catName'] ?></td>
                                                <td>
                                                    <a href="categoryedit.php?editId=<?=base64_encode($row['catid'])?>" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="?delCat=<?=base64_encode($row['catid'])?>" class="btn btn-danger btn-sm" onclick="confirm('Are Your Sure To Delete- <?=$row['catName']?>')">Delete</a>
                                                </td>

                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>
<?php
include_once 'inc/footer.php';
?>