<?php
class Category{
    public $maloai;
    public $tenloai;

    public static function getAll($pdo){

        $sql = "SELECT * FROM category";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute()){
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Category");
            return $stmt->fetchAll();
        }else{
        	$error = $stmt->errorInfo();
        	var_dump($error);
        }
    }

    public static function getCateByIdPro($pdo, $pro_id){
        $sql = "SELECT * FROM category, pro_cate WHERE maloai = cate_id AND pro_id =:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $pro_id, PDO::PARAM_INT);
        if($stmt->execute()){
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Category");
            return $stmt->fetchAll();
        }else{
        	$error = $stmt->errorInfo();
        	var_dump($error);
        }
    }
}