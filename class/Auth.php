<?php
class Auth{
    public static function login($username, $password){
        $db = new Database();
        $pdo = $db->getConnect();

        $sql = "SELECT * from user where username=:username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":username", $username, PDO::PARAM_STR);

        if($stmt->execute()){
            if(!$data = $stmt->fetchAll(PDO::FETCH_ASSOC)){
                return 'Login Failed!';
            }
            $pwd_hash = $data[0]['password'];
            if(password_verify($password,$pwd_hash)){
                $_SESSION['log_detail'] = $username;
                if($_SESSION['log_detail']=='admin'){
                    header('location: admin/index.php');
                    exit();
                }else{
                    header('location: index.php');
                    exit();
                }
                
            }else {
                return 'Login Failed!';
            }
        }else{
            return 'Login Failed!';
        }
        
    }

    public static function logout(){
        if($_SESSION['log_detail']=='admin'){
            unset($_SESSION['log_detail']);
            header('location: ../login.php');
            exit();
        }else{
            unset($_SESSION['log_detail']);
            header('location: login.php');
            exit();
        }
        
    }

    
}