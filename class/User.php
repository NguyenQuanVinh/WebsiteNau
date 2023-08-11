<?php
class User{
    public $username;
    public $password;

    public static function getAll($pdo){
        $sql = "SELECT * FROM user";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute()){
            $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
            return $stmt->fetchAll();
        }else{
        	$error = $stmt->errorInfo();
        	var_dump($error);
        }
    }

    public function insert($pdo){

        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO user VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $this->username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $this->password, PDO::PARAM_STR);
        if($stmt->execute()){
            if($_SESSION['log_detail']=='admin'){
                header('location: users.php');
                exit();
            }else{
                $_SESSION['log_detail'] = $this->username;
                header('location: index.php');
                exit();
            }
            
        }else{
            return 'Account already exists!';
        }
    }

    public function update($pdo){
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password=:password WHERE username=:username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $this->username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            header('location: users.php');
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public function delete($pdo){

        $sql = "DELETE FROM user WHERE username = :username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":username", $this->username, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public function checkUser($pdo){
        $sql = "SELECT * FROM user WHERE username =:username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":username", $this->username, PDO::PARAM_STR);
        if($stmt->execute()){
            if(!$stmt->fetchAll(PDO::FETCH_ASSOC)){
                return false;
            }
            return true;
        }else{
            return false;
        }
    }


}