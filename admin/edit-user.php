<?php require "../admin/include/header.php"; ?>
<?php
$errors = "";
$account = new User();
$account->username = $_GET['username'];
if(!$account->checkUser($pdo)){
    die('Khong tim thay tai khoan');
}
if($_SERVER['REQUEST_METHOD']=='POST'){
  
  $account->password = $_POST['pass'];
  if($account->update($pdo)){

  }else{
    $errors = "Something went wrong!";
  }
}  
?>
<div class="container-fluid mt-5 p-5" style="background-color: #F4F0EB;">
<div class="box p-5 bg-white rounded-4 m-auto">
        <h3 class="text-center">Change password</h3>
        <br>
        <br>
        <form method="post">
          
            <div class="mb-4 inputbox">
              <input type="password"  name="pass"  class="form-control" required />
              <label for="">New password</label>
            </div>
          
            <button type="submit" class="btn btn-primary btn-block mb-4 form-control rounded-pill">Change</button>
        </form>
        <p class="text-center text-danger"><?= $errors?></p>
    </div>
</div>
</div>
<?php require "../admin/include/footer.php"?>