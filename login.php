<?php require "include/header.php" ?>
<?php
  $errors = "";
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $errors = Auth::login($user,$pass);
  } 
?>
<div class="container-fluid mt-5 p-5" style="background-color: #F4F0EB;">
<div class="box p-5 bg-white rounded-4 m-auto">
        <h3 class="text-center">Sign In</h3>
        <br>
        <br>
        <form method="post">
            <div class="mb-4 inputbox">
                <input type="text" name="user"  class="form-control" required />
                <label for="">Username</label>
              </div>
          
            <div class="mb-4 inputbox">
              <input type="password" name="pass"  class="form-control" required />
              <label for="">Password</label>
            </div>
          
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value=""  checked />
                  <label class="form-check-label" > Stay signed in </label>
                </div>
              </div>
          
              <div class="col">
                <a href="#!">Forget Password?</a>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block mb-4 form-control rounded-pill">Sign in</button>
          
            <div class="text-center">
              <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
        <p class="text-center text-danger"><?= $errors?></p>
    </div>
</div>
<?php require "include/footer.php" ?>