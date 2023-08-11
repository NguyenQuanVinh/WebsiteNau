<?php
class Cart{
    public $mahd;
    public $makh;
    public $thanhtoan;

    public function newCart($pdo){
        $sql = "INSERT INTO cart(makh,thanhtoan) VALUES(:username, :state)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $this->makh, PDO::PARAM_STR);
        $stmt->bindParam(':state', $this->thanhtoan, PDO::PARAM_BOOL);

        if($stmt->execute()){
            $this->mahd = $pdo->lastInsertId();
            return true;
        }else{
            return false;
        }
    }

    public static function getCart($pdo, $makh, $state){
        $sql = "SELECT mahd FROM cart WHERE makh=:username AND thanhtoan=:state";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $makh, PDO::PARAM_STR);
        $stmt->bindParam(':state', $state, PDO::PARAM_BOOL);

        if($stmt->execute()){
            return $stmt->fetchColumn();
        }
    }

    public function updateCart($pdo){
        $sql = "UPDATE cart SET thanhtoan=:state WHERE mahd=:mahd AND makh=:username";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':state', $this->thanhtoan, PDO::PARAM_BOOL);
        $stmt->bindParam(':mahd', $this->mahd, PDO::PARAM_INT);
        $stmt->bindParam(':username', $this->makh, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    

}