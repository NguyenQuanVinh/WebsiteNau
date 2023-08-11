<?php require "include/header.php"; ?>
<?php
$orders = Order::getOrderByUsername($pdo, $_SESSION['log_detail']);

?>
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <?php if ($orders) {
                foreach ($orders as $order) {
                    $cds = Cart_detail::getAll($pdo, $order->mahd); 
                    $total = 0;?>
                    
                    <table class="table mb-5 align-middle border-top border-end border-start">
                        <tr>
                            <td colspan="2">Date of payment: <?= $order->ngaythanhtoan ?></td>
                            <td class="text-end">Order status:</td>
                            <td  style="color:#26aa99;"> <?= $order->tinhtrang ?></td>
                        </tr>
                    <?php foreach($cds as $cd){ ?>
                        
                        <tr>
                            <td class="w-25 text-center"><img src="image/<?= $cd->hinh ?>" style="width: 100px; height: 120px"></td>
                            <td class="w-25"><?= $cd->tensp ?></td>
                            <td class="w-25">x<?= $cd->soluong ?></td>
                            <td class="w-25"><span class="text-danger">$<?= $cd->dongia?></span></td>
                        </tr>
                    <?php $total+=$cd->soluong*$cd->dongia;} ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>TOTAL: <span class="text-danger">$<?= $total ?></span></td>
                        </tr>
                    </table>
            <?php }
            }else{?>
                <h4 class="text-center">You didn't buy anything!</h4>
            <?php } ?>
        </div>
    </div>
</div>

<?php require "include/footer.php" ?>