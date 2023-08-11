<?php require "include/header.php"; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cd = new Cart_detail();
    $cd->mahd = Cart::getCart($pdo, $_SESSION['log_detail'], false);
    $cd->masp = $_POST['proid'];
    $cd->soluong = $_POST['qty'];
    $cd->update($pdo);
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'empty') {
        Cart_detail::empty($pdo, Cart::getCart($pdo, $_SESSION['log_detail'], false));
    }

    if ($action == 'remove') {
        if (isset($_GET['proid'])) {
            $cd = new Cart_detail();
            $cd->mahd = Cart::getCart($pdo, $_SESSION['log_detail'], false);
            $cd->masp = $_GET['proid'];
            $cd->delete($pdo);
        }
    }
}
?>
<div class="container mt-5">
    <div class="row mb-3">
        <div class="col">
            <ul class="nav nav-justified">
                <li class="nav-item"><a class="nav-link" href="cart.php?action=empty">Empty cart</a></li>
                <li class="nav-item"><a class="nav-link" href="history.php">Purchasing history</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php if ($mahd = Cart::getCart($pdo, $_SESSION['log_detail'], false)) {
                if ($listPro = Cart_detail::getAll($pdo, $mahd)) {
                    $i = 1;
                    $total = 0; ?>
                    <table class="table align-middle">
                        <thead class="text-center table-success">
                            <tr>
                                <th>Number</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">

                            <?php foreach ($listPro as $cart) : ?>
                                <tr>
                                    <form method="post">
                                        <td><?= $i ?></td>
                                        <td class="w-25"><img src="image/<?= $cart->hinh ?>" class="w-25"> </td>
                                        <td><?= $cart->tensp ?></td>
                                        <td>$<?= number_format($cart->dongia, 0, ',', '.') ?></td>
                                        <td>
                                            <input type="number" min="1" value="<?= $cart->soluong ?>" name="qty" style="width: 50px">
                                            <input type="hidden" name="proid" value="<?= $cart->id ?>">
                                        </td>
                                        <td>
                                            <input type="submit" name="update" value="Update" class="btn btn-primary" />
                                            <a href="cart.php?action=remove&proid=<?= $cart->id ?>" class="btn btn-warning">Remove</a>
                                        </td>
                                    </form>
                                </tr>
                            <?php
                                $i++;
                                $total += $cart->dongia * $cart->soluong;
                            endforeach;
                            ?>
                            <tr>
                                <td colspan="6" class="text-center">
                                    <h4>Total: <span class="text-danger">$<?= number_format($total, 0, ',', '.') ?></span></h4>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="payment.php" class="btn btn-success float-end">PROCEED TO PAYMENT</a>
                <?php } else { ?>
                    <h4 class="text-center">Let's try to buy something!</h4>
            <?php }
            }else{
                echo "<h4 class="."text-center".">Let's try to buy something!</h4>";
            } ?>


        </div>
    </div>
</div>
<?php require "include/footer.php" ?>