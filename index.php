<?php require "include/header.php"; ?>

<?php
     
     $data = Product::getProductByCate($pdo,5);
?>

<div class="container-fluid mt-5 mb-5" 
    style="background-image: url(image/baner1.png);
	background-repeat: no-repeat;
	background-size: cover;
	background-position: center;
	height: 500px;">
</div>


<div class="container">
    <div class="row mb-3">
        <div class="col text-center"><h2>Trending</h2></div>
    </div>
    <div class="row">
        <?php foreach($data as $product):?>
            <div class="col-lg-3 mb-4">
                <div class="border text-center pt-3 pb-3 mb-2">
                    <a href="product.php?id=<?= $product->id ?>"><img src="image/<?= $product->hinh ?>" style="width: 144.607px;height: 202.45px;"></a>
                </div>
                <div class="ps-2 pe-2">
                    <a href="product.php?id=<?= $product->id ?>" style="text-decoration: none;" class="h5 d-inline"><?= $product->tensp ?></a>
                    <p class="h5 d-inline float-end">$<?= $product->dongia ?></p>
                    <small class="d-block">by <?= $product->tacgia ?></small>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<?php require "include/footer.php"?>