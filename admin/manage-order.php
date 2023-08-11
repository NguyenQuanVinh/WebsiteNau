<?php require "../admin/include/header.php"; ?>
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if($_POST['mahd-status']){
            foreach($_POST['mahd-status'] as $string){
                $split = explode("-", $string);
                $order = new Order();
                $order->mahd = $split[0];
                $order->tinhtrang = $split[1];
                $order->update($pdo);
            }
        }
    }
    $orders = Order::getAll($pdo); 
?>
<div class="container mt-5">
    <div class="order">
        <div class="col">
            <form method="post">
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th>Ngày lập đơn hàng</th>
                        <th>Mã hóa đơn</th>
                        <th>Receipt</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Note</th>
                        <th>Order status</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if($orders){
                        foreach($orders as $order){?> 
                    <tr>
                        <td><?= $order->ngaythanhtoan ?></td>
                        <td><?= $order->mahd ?></td>
                        <td><?= $order->nguoinhan ?></td>
                        <td><?= $order->sdt ?></td>
                        <td><?= $order->diachi ?></td>
                        <td><?= $order->ghichu ?></td>
                        <?php if($order->tinhtrang == 'Finished'){?>
                            <td>
                                <select class="w-75" disabled>
                                    <option>Finished</option>
                                </select>
                            </td><?php }else{?>
                            <td>
                                <select name="mahd-status[]" class="w-75">
                                    <option value="<?= $order->mahd ?>-Prepare your order" <?php if($order->tinhtrang == 'Prepare your order'){echo "selected";} ?>>Prepare your order</option>
                                    <option value="<?= $order->mahd ?>-Shipping" <?php if($order->tinhtrang == 'Shipping'){echo "selected";} ?>>Shipping</option>
                                    <option value="<?= $order->mahd ?>-Finished">Finished</option>
                                </select>
                            </td><?php } ?>
                    </tr><?php }}?>
                </tbody>
            </table>
            <button class="btn btn-primary" type="submit">UPDATE</button>
            </form>
        </div>
    </div>
</div>
<?php require "../admin/include/footer.php"?>