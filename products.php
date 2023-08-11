<?php require "include/header.php"?>
<?php

# -------------------------- phan trang
    $product_per_page = 8;
    $page = $_GET['page'] ?? 1;
    $limit = $product_per_page;
    $offset = ($page - 1) * $product_per_page;
#-------------------------------------------------------

    $categories = Category::getAll($pdo);

    if(isset($_GET['category']) && isset($_GET['arrange'])){
        $data = Product::getProductByPriceAndCate($pdo,$limit,$offset,$_GET['arrange'],$_GET['category']);
        $total_pages = ceil(Product::totalPageOfCate($pdo,$limit,$_GET['category']));
    }elseif(isset($_GET['category'])){
        $data = Product::getProductByCate($pdo, $_GET['category']);
        $total_pages = ceil(Product::totalPageOfCate($pdo,$limit,$_GET['category']));
    }elseif(isset($_GET['arrange'])){
        $data = Product::getProductByPrice($pdo,$limit,$offset,$_GET['arrange']);
        $total_pages = ceil(Product::totalPage($pdo, $limit));
    }elseif(isset($_GET['search']) && !empty($_GET['search'])){
        $data = Product::getProductBySearch($pdo,$limit,$offset,$_GET['search']);
        $total_pages = ceil(Product::totalPageOfSearch($pdo,$limit,$_GET['search']));
    }else
    {
        $data = Product::getPage($pdo,$limit,$offset);
        $total_pages = ceil(Product::totalPage($pdo, $limit));
    }

    

?>
<div class="container-fluid mb-5 mt-5" style="background-image: url(image/banner3.png); background-size: cover; background-repeat: no-repeat; background-position: center;height: 500px;">
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-2">
            <div class="border-bottom pb-3">
                <h3>Category:</h3>
                <select name="categories" id="" class="p-2 w-100 rounded" onchange="window.location.href = this.value;">
                    <option value="products.php">All</option>
                    <?php foreach($categories as $category): ?>
                        <?php if($_GET['category'] == $category->maloai) :?>
                            <option selected value="products.php?category=<?= $category->maloai ?>"><?= $category->tenloai ?></option>
                        <?php else: ?>
                            <option value="products.php?category=<?= $category->maloai ?>"><?= $category->tenloai ?></option>
                    <?php endif; endforeach; ?>
                </select>
            </div>
            <div class="border-bottom pb-3">
                <h3>Price:</h3>
                <input type="radio" id="ascending" name="arrange"
                <?php if(isset($_GET['arrange'])){
                    if($_GET['arrange'] == 1){
                        echo "checked";
                    }
                }if(isset($_GET['category'])){
                    $value = "products.php?category=".$_GET['category']."&arrange=1";
                }else{
                    $value="products.php?arrange=1";
                }
                ?>
                value="<?=$value?>" onchange="window.location.href = this.value;">
                <label for="ascending">Ascending</label><br>

                <input type="radio" id="descreasing" name="arrange"
                <?php if(isset($_GET['arrange'])){
                    if($_GET['arrange'] == 2){
                        echo "checked";
                    }
                }if(isset($_GET['category'])){
                    $value = "products.php?category=".$_GET['category']."&arrange=2";
                }else{
                    $value="products.php?arrange=2";
                }
                ?>
                value="<?=$value?>" onchange="window.location.href = this.value;">
                <label for="descreasing">Descreasing</label>
            </div>
            <div class="border-bottom pb-3">
                <h6 class="mt-2">What are you looking for?</h6>
                <form method="get" class="d-flex">
                    <input type="search" name="search" placeholder="SEARCH..." class="rounded w-75 p-1">
                    <button type="submit" class="btn btn-secondary ms-1"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="col-lg-12">
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
            <div class="row">
                    <div class="col text-center">
                        <ul class="list-inline">
                            <?php
                             if($page >=2):?>
                                <li class="list-inline-item border p-1 me-2"><a href="
                                <?php if(isset($_GET['category']) && isset($_GET['arrange'])){
                                    echo "products.php?category=".$_GET['category']."&arrange=".$_GET['arrange']."&page=". ($page - 1);
                                }elseif(isset($_GET['category'])){
                                    echo "products.php?category=".$_GET['category']."&page=". ($page - 1);
                                }elseif(isset($_GET['arrange'])){
                                    echo "products.php?arrange=".$_GET['arrange']."&page=". ($page - 1);
                                }else{
                                    echo "products.php?page=". ($page - 1);
                                } ?>
                                " class="nav-link">Prev</a></li>
                            <?php endif; ?>
                            <?php
                                for($i = 1; $i <= $total_pages; $i++):?>
                                    <li class="list-inline-item border p-1 me-2 <?php if($_GET['page']==$i){echo "border-primary";}?>"><a href="
                                <?php if(isset($_GET['category']) && isset($_GET['arrange'])){
                                    echo "products.php?category=".$_GET['category']."&arrange=".$_GET['arrange']."&page=". $i;
                                }elseif(isset($_GET['category'])){
                                    echo "products.php?category=".$_GET['category']."&page=". $i;
                                }elseif(isset($_GET['arrange'])){
                                    echo "products.php?arrange=".$_GET['arrange']."&page=". $i;
                                }else{
                                    echo "products.php?page=". $i;
                                } ?>
                                    " class="nav-link"><?= $i ?></a></li>
                            <?php endfor; ?>
                            <?php if($page < $total_pages):?>
                                <li class="list-inline-item border p-1 me-2"><a href="
                                <?php if(isset($_GET['category']) && isset($_GET['arrange'])){
                                    echo "products.php?category=".$_GET['category']."&arrange=".$_GET['arrange']."&page=". ($page + 1);
                                }elseif(isset($_GET['category'])){
                                    echo "products.php?category=".$_GET['category']."&page=". ($page + 1);
                                }elseif(isset($_GET['arrange'])){
                                    echo "products.php?arrange=".$_GET['arrange']."&page=".($page + 1);
                                }else{
                                    echo "products.php?page=". ($page + 1);
                                } ?>
                                " class="nav-link">Next</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
            </div>
        </div>
            
    </div>
</div>
<?php require "include/footer.php"?>