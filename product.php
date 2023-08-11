<?php require "include/header.php"?>
<?php
    $id = $_GET["id"];
    $pd = Product::getOneById($pdo,$id);
    $categories = Category::getCateByIdPro($pdo,$id);
    if(!$pd)
    {die("NOT FOUND PRODUCT!");}

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(!isset($_SESSION['log_detail'])){
            header('location: login.php');
            exit();
        }

        if($mahd=Cart::getCart($pdo,$_SESSION['log_detail'], false)){
            $cd = new Cart_detail();
            $cd->mahd = $mahd;
            $cd->masp = $id;
            
            if(!$sl = Cart_detail::getQuantity($pdo, $mahd, $id)){
                $cd->soluong = $_POST['sl'];
                $cd->insert($pdo);
            }else{

                $cd->soluong = $sl+$_POST['sl'];
                $cd->update($pdo);
            }
        }else{
            $cart = new Cart();
            $cart->makh = $_SESSION['log_detail'];
            $cart->thanhtoan = false;
            $cart->newCart($pdo);
            $cd = new Cart_detail();
            $cd->mahd = $cart->mahd;
            $cd->masp = $id;
            $cd->soluong = $_POST['sl'];
            $cd->insert($pdo);
        }
    }
?>

<div class="container mt-5">
    <div class="row">
        
        <div class="col-2">
        </div>
        <div class="col-5">
            
            <div class="border border-secondary text-center">
                <img src="image/<?= $pd->hinh ?>" class="p-4 w-75"> 
            </div>
        </div>
        <div class="col-5">
            <div class="title border-bottom">
                <h4><?= $pd->tensp ?></h4>
                <h4>$<?= $pd->dongia ?></h4>
            </div>
            <div class="description border-bottom">
                <b>DESCRIPTION:</b>
                <p><?= $pd->mota ?></p>
            </div>
            <div class="addcart border-bottom mt-3 pb-3">
                <form method="post">
                    <input type="number" name="sl" class="text-center" min="1" value="1" style="width: 100px; height: 37px">
                    <button type="submit"  class="btn btn-primary rounded-0 ms-3">ADD TO CART</button>
                </form>
            </div>
            <div class="category">
                <b>CATEGORY:</b>
                <br/>
                <?php foreach($categories as $cate):?>
                    <u><?= $cate->tenloai ?></u> &nbsp;&nbsp;
                <?php endforeach; ?>
                <br/>
                <b>SHARE:</b>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="nav-item"><a class="nav-link"><i class="fab fa-youtube"></i></a></li>
                    <li class="nav-item"><a class="nav-link"><i class="fab fa-instagram"></i></a></li>
                    <li class="nav-item"><a class="nav-link"><i class="fab fa-twitter"></i></a></li>
                    <li class="nav-item"><a class="nav-link"><i class="fab fa-vimeo-v"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php require "include/footer.php"?>