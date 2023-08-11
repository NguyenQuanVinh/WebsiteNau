<?php
    session_start();
    if(isset($_SESSION['log_detail']) && $_SESSION['log_detail'] =='admin')
    {
        header('location: admin/index.php');
    }
    require "class/Database.php";
    require "class/Product.php";
    require "class/Category.php";
    require "class/Auth.php";
    require "class/User.php";
    require "class/Cart.php";
    require "class/Cart_detail.php";
    require "class/Order.php";
    
    $db = new Database();
    $pdo = $db->getConnect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylecss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Trang chủ</title>
</head>
<body>
<div class="container-fluid p-3 border-bottom">
    <div class="container bg-white">
        <div class="row" >
            <div class="col-lg-2">
                
            </div>
            <div class="col-lg-3">
                <ul class="nav nav-justified mt-4">
                    <li class="nav-item"><a class="nav-link text-dark" href="index.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="products.php">PRODUCTS</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">BLOGS</a></li>
                </ul>
            </div>
            <div class="col-lg-2 text-center">
                <a href="index.php"><img src="image/logo.png"></a>
            </div>
            <div class="col-lg-3">
                <ul class="nav nav-justified mt-4">
                    <li class="nav-item"><a class="nav-link text-dark" href="#">ABOUT US</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="#">CONTACT US</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <ul class="nav nav-justified mt-4">
                    <?php if(isset($_SESSION['log_detail'])):?>
                        <li class="nav-item"><a class="nav-link text-dark" href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>  
                        <li class="nav-item"><a class="nav-link text-dark" href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link text-dark" href="login.php"><i class="fa-solid fa-user"></i></a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>