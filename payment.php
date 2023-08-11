<?php require "include/header.php"; ?>
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $order = new Order();

        $order->mahd = Cart::getCart($pdo, $_SESSION['log_detail'], false);
        $order->nguoinhan = $_POST['recipient'];
        $order->sdt = $_POST['tel'];
        $order->diachi = $_POST['address'];
        $order->ghichu = $_POST['note'];
        $order->tinhtrang = "Prepare your order";
        if($order->insert($pdo)){
            $cart = new Cart();
            $cart->mahd = Cart::getCart($pdo, $_SESSION['log_detail'], false);
            $cart->makh = $_SESSION['log_detail'];
            $cart->thanhtoan = true;
            $cart->updateCart($pdo);
            header('location: history.php');
        }
    }
?>
<div class="container mt-5">
    <div class="row">
        <div class="col">
        <h3 class="text-center">Info on shipping</h3>
            <form method="post" class="m-auto w-50">
                <div class="form-group mb-4">
                    <label>Recipient <span class="text-danger">(*)</span></label>
                    <input type="text" name="recipient" class="form-control" required>
                </div>
                <div class="form-group mb-4">
                    <label>Phone number <span class="text-danger">(*)</span></label>
                    <input type="tel" name="tel" maxlength="10" pattern="[0-9]{10}" class="form-control" placeholder="0123456789" required>
                </div>
                <div class="form-group mb-4">
                    <label>Address <span class="text-danger">(*)</span></label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="form-group mb-4">
                    <label>Note</label>
                    <textarea class="form-control" name="note" id="" placeholder="Leave a note for shipper" cols="30" rows="5"></textarea>
                </div>
                <button class="btn btn-primary form-control">Confirm payment</button>
            </form>
        </div>
    </div>
</div>
<?php require "include/footer.php"?>