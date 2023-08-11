<?php
class Pro_cate{
    public $pro_id;
    public $cate_id;
    public function insert($pdo)
    {
        $sql = "INSERT INTO pro_cate VALUES (:pro_id, :cate_id)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':pro_id', $this->pro_id, PDO::PARAM_INT);
        $stmt->bindParam(':cate_id', $this->cate_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public function delete($pdo)
    {
        $sql = "DELETE FROM pro_cate WHERE pro_id = :pro_id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":pro_id", $this->pro_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }
}