<?php require "../admin/include/header.php"; ?>

<?php
    $user = new User();
    $user->username = $_GET['username'];
    if($user->username=='admin'){
        header('location: users.php');
    }
    if(!$user->checkUser($pdo)){
        die('Khong tim thay tai khoan');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($user->delete($pdo)){
            header('location: users.php');
        }
        
    }
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-4"></div>
        <div class="col-4 text-center">
            <form method="post" class="border p-3">
                <h5 class="text-center text-danger">Are you sure delete this User?</h5>
                <input class="btn btn-info" type="submit" value="OK"/>
                <a href="users.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
        <div class="col-4"></div>
    </div>
</div>


<?php require "../admin/include/footer.php"?>