<?php require "../admin/include/header.php"; ?>

<?php
    $id = $_GET["id"];
    $pd = Product::getOneById($pdo,$id);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pro_cate = new Pro_cate();
        $pro_cate->pro_id = $id;
        $pro_cate->delete($pdo);
        if($pd->delete($pdo)){
            $s = "../image/".$pd->hinh;
            unlink($s);
            header("Location:products.php");
        }
        
        
    }
?>
<div class="row mt-3">
    <div class="col-4"></div>
    <div class="col-4 text-center">
        
        <form method="post" class="border p-3">
            <h5 class="text-center text-danger">Are you sure delete this Product?</h5>
            <input class="btn btn-info" type="submit" value="OK"/>
            <a href="product.php?id=<?= $id ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <div class="col-4"></div>
</div>

<?php require "../admin/include/footer.php"?>