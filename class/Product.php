<?php
class Product{
    public $id;
    public $tensp;
    public $mota;
    public $dongia;
    public $tacgia;
    public $hinh;

    public static function getAll($pdo){

        $sql = "SELECT * FROM product";
        $stmt = $pdo->prepare($sql);
        if($stmt->execute()){
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
            return $stmt->fetchAll();
        }else{
        	$error = $stmt->errorInfo();
        	var_dump($error);
        }
    }

    public static function getOneById($pdo,$id){

        $sql = "SELECT * FROM product WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
            return $stmt->fetch();
        } else {
            return null;
        }
    }

    public static function getProductByCate($pdo,$cate_id){
        $sql = "SELECT product.id, product.tensp, product.mota, product.dongia, product.tacgia, product.hinh FROM product LEFT JOIN pro_cate ON product.id = pro_cate.pro_id WHERE cate_id =:cate_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":cate_id", $cate_id, PDO::PARAM_INT);

        if($stmt->execute()){
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
            return $stmt->fetchAll();
        }else{
        	$error = $stmt->errorInfo();
        	var_dump($error);
        }
    }

    public static function getProductByPrice($pdo,$limit,$offset,$i){
        if($i == 1){
            $sql = "SELECT * FROM product ORDER BY dongia ASC LIMIT :limit OFFSET :offset";
        }else{
            $sql = "SELECT * FROM product ORDER BY dongia DESC LIMIT :limit OFFSET :offset";
        }
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);

        if($stmt->execute()){
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
            return $stmt->fetchAll();
        }else{
        	$error = $stmt->errorInfo();
        	var_dump($error);
        }
    }

    public static function getProductByPriceAndCate($pdo,$limit,$offset,$i,$cate_id){
        if($i == 1){
            $sql = "SELECT product.id, product.tensp, product.mota, product.dongia, product.tacgia, product.hinh FROM product LEFT JOIN pro_cate ON product.id = pro_cate.pro_id WHERE cate_id =:cate_id ORDER BY dongia ASC LIMIT :limit OFFSET :offset";
        }else{
            $sql = "SELECT product.id, product.tensp, product.mota, product.dongia, product.tacgia, product.hinh FROM product LEFT JOIN pro_cate ON product.id = pro_cate.pro_id WHERE cate_id =:cate_id ORDER BY dongia DESC LIMIT :limit OFFSET :offset";
        }
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":cate_id", $cate_id, PDO::PARAM_INT);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);

        if($stmt->execute()){
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
            return $stmt->fetchAll();
        }else{
        	$error = $stmt->errorInfo();
        	var_dump($error);
        }
    }

    #phan trang
    public static function getPage($pdo, $limit, $offset){
        $sql = "SELECT * FROM product ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
            return $stmt->fetchAll();
        }
    }

    public static function totalPage($pdo, $limit){
        $sql = "SELECT COUNT(*) FROM product";
        $stmt = $pdo->prepare($sql);
        
        if($stmt->execute()){
            return $stmt->fetchColumn()/$limit;
        }
    }

    public static function totalPageOfCate($pdo,$limit, $cate_id){
        $sql = "SELECT COUNT(*) FROM product LEFT JOIN pro_cate ON product.id = pro_cate.pro_id WHERE cate_id =:cate_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":cate_id", $cate_id, PDO::PARAM_INT);
        if($stmt->execute()){
            return $stmt->fetchColumn()/$limit;
        }
    }

    public static function getProductBySearch($pdo, $limit, $offset, $key){
        $key = "%". $key . "%";
        $sql = "SELECT * FROM product WHERE tensp LIKE :key OR tacgia LIKE :key OR mota LIKE :key OR id LIKE :key ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":key", $key, PDO::PARAM_STR);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);

        if($stmt->execute()){
            $stmt->setFetchMode(PDO::FETCH_CLASS, "Product");
            return $stmt->fetchAll();
        }else{
        	$error = $stmt->errorInfo();
        	var_dump($error);
        }
    }

    public static function totalPageOfSearch($pdo,$limit, $key){
        $key = "%". $key . "%";
        $sql = "SELECT COUNT(*) FROM product WHERE tensp LIKE :key OR tacgia LIKE :key OR mota LIKE :key OR id LIKE :key";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":key", $key, PDO::PARAM_STR);
        if($stmt->execute()){
            return $stmt->fetchColumn()/$limit;
        }
    }



    public function insert($pdo){

        $sql = "INSERT INTO product(tensp,mota,dongia,tacgia,hinh) VALUES (:tensp, :mota, :dongia, :tacgia, :hinh)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':tensp', $this->tensp, PDO::PARAM_STR);
        $stmt->bindParam(':mota', $this->mota, PDO::PARAM_STR);
        $stmt->bindParam(':dongia', $this->dongia, PDO::PARAM_INT);
        $stmt->bindParam(':tacgia', $this->tacgia, PDO::PARAM_STR);
        $stmt->bindParam(':hinh', $this->hinh, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
            return true;
        } else {
            $error = $stmt->errorInfo();
            var_dump($error);
            return false;
        }
    }

    public function delete($pdo)
    {

        $sql = "DELETE FROM product WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

    public function update($pdo)
    {   
        $sql = "UPDATE product SET tensp=:tensp, mota=:mota, dongia=:dongia, tacgia=:tacgia, hinh=:hinh WHERE id=:id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':tensp', $this->tensp, PDO::PARAM_STR);
        $stmt->bindParam(':mota', $this->mota, PDO::PARAM_STR);
        $stmt->bindParam(':dongia', $this->dongia, PDO::PARAM_INT);
        $stmt->bindParam(':tacgia', $this->tacgia, PDO::PARAM_STR);
        $stmt->bindParam(':hinh', $this->hinh, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            var_dump($stmt->errorInfo());
            return false;
        }
    }

}