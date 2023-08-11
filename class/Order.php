<?php
class Order{
    public $ngaythanhtoan;
    public $mahd;
    public $nguoinhan;
    public $sdt;
    public $diachi;
    public $ghichu;
    public $tinhtrang;

    public function insert($pdo){
        $sql = "INSERT INTO `order` VALUES(NOW(), :mahd, :nguoinhan, :sdt, :diachi, :ghichu, :tinhtrang)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':mahd', $this->mahd, PDO::PARAM_INT);
        $stmt->bindParam(':nguoinhan', $this->nguoinhan, PDO::PARAM_STR);
        $stmt->bindParam(':sdt', $this->sdt, PDO::PARAM_STR);
        $stmt->bindParam(':diachi', $this->diachi, PDO::PARAM_STR);
        $stmt->bindParam(':ghichu', $this->ghichu, PDO::PARAM_STR);
        $stmt->bindParam(':tinhtrang', $this->tinhtrang, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public function update($pdo){
        $sql = "UPDATE `order` SET tinhtrang =:tinhtrang WHERE mahd =:mahd";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':tinhtrang', $this->tinhtrang, PDO::PARAM_STR);
        $stmt->bindParam(':mahd', $this->mahd, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public static function getAll($pdo){
        $sql = "SELECT * FROM `order`";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Order");
            return $stmt->fetchAll();
        }
    }

    public static function getOrderByUsername($pdo, $makh){
        $sql = "SELECT * FROM `order`, cart WHERE `order`.`mahd`=cart.mahd AND makh=:makh ORDER BY `order`.`ngaythanhtoan` DESC";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':makh', $makh, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Order");
            return $stmt->fetchAll();
        }
    }

}