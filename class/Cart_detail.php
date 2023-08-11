<?php
class Cart_detail{
    public $mahd;
    public $masp;
    public $soluong;

    public static function getAll($pdo, $mahd){
        $sql = "SELECT * FROM product, cart_detail WHERE product.id = cart_detail.masp AND mahd = :mahd";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':mahd', $mahd, PDO::PARAM_INT);
        if($stmt->execute()){
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Cart_detail");
            return $stmt->fetchAll();
        }else{
        	$error = $stmt->errorInfo();
        	var_dump($error);
        }
    }

    public function insert($pdo){
        $sql = "INSERT INTO cart_detail VALUES (:mahd, :masp, :sl)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':mahd', $this->mahd, PDO::PARAM_INT);
        $stmt->bindParam(':masp', $this->masp, PDO::PARAM_INT);
        $stmt->bindParam(':sl', $this->soluong, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public function update($pdo){
        $sql = "UPDATE cart_detail SET soluong=:sl WHERE mahd=:mahd AND masp=:masp";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':mahd', $this->mahd, PDO::PARAM_INT);
        $stmt->bindParam(':masp', $this->masp, PDO::PARAM_INT);
        $stmt->bindParam(':sl', $this->soluong, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }

    }

    public function delete($pdo){
        $sql = "DELETE FROM cart_detail WHERE mahd=:mahd AND masp=:masp";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':mahd', $this->mahd, PDO::PARAM_INT);
        $stmt->bindParam(':masp', $this->masp, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public static function empty($pdo, $mahd)
    {
        $sql = "DELETE FROM cart_detail WHERE mahd=:mahd";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':mahd', $mahd, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public static function getQuantity($pdo, $mahd, $masp){
        $sql = "SELECT soluong FROM cart_detail WHERE mahd=:mahd AND masp=:masp";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':mahd', $mahd, PDO::PARAM_INT);
        $stmt->bindParam(':masp', $masp, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
    }

}