<?php
class dash_model_products extends conection {
    private $name;
    private $description;
    private $category;
    private $price;
    private $imageC;
    private $imageName;
    private $statement;
    private $idProduct;

    function __construct() {

    }

    public function addProductToDb($name,$description,$category,$price,$image_,$imageN){
        $this->name=$name;
        $this->description=$description;
        $this->category= $category;
        $this->price=$price;
        $this->imageC=$image_;
        $this->imageName=$imageN;
        try {
            $this->statement = $this->connect_pdo()->prepare('INSERT INTO products (idProduct, idCategory, name, image, description, priceUnit) VALUES (NULL,?,?,?,?,?) ');
            
            $this->statement->bindParam(1,$this->category,PDO::PARAM_STR);
            $this->statement->bindParam(2,$this->name,PDO::PARAM_STR);
            $this->statement->bindParam(3,$this->imageName,PDO::PARAM_STR);
            $this->statement->bindParam(4,$this->description,PDO::PARAM_STR);
            $this->statement->bindParam(5,$this->price,PDO::PARAM_INT);
            
            $this->statement->execute();
            $this->statement = null;
            return true;
        }catch(PDOException $e){
            
            return false;
        }
    }

    public function getListCategory(){
        try {
            $this->statement = $this->connect_pdo()->prepare('SELECT * FROM category');
            $this->statement->execute();
            
            return $this->statement->fetchAll();
        }catch(PDOException $e){
            return false;
        }       
    }


    public function getProductData($idProduct){
        try {
            $this->statement = $this->connect_pdo()->prepare('SELECT * FROM products INNER JOIN category ON products.idCategory = category.id_Category WHERE idProduct = ?');
            $this->statement->bindParam(1,$idProduct,PDO::PARAM_STR);

            $this->statement->execute();
            
            return $this->statement->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            die($e);
            // return false;
        }       
    }
    public function updateProductDB($name,$description,$category,$price,$imageN, $idProduct){
        $this->name=$name;
        $this->description=$description;
        $this->category= $category;
        $this->price=$price;
        $this->imageName=$imageN;
        $this->idProduct=$idProduct;
        try {
            
            $this->statement = $this->connect_pdo()->prepare('UPDATE products SET idCategory = ?, name = ?, image = ?, description = ?, priceUnit = ? WHERE idProduct = ?');
            
            $this->statement->bindParam(1,$this->category,PDO::PARAM_STR);
            $this->statement->bindParam(2,$this->name,PDO::PARAM_STR);
            $this->statement->bindParam(3,$this->imageName,PDO::PARAM_STR);
            $this->statement->bindParam(4,$this->description,PDO::PARAM_STR);
            $this->statement->bindParam(5,$this->price,PDO::PARAM_INT);
            $this->statement->bindParam(6,$this->idProduct,PDO::PARAM_INT);
            
            $this->statement->execute();
            $this->statement = null;
            return true;
        }catch(PDOException $e){
            die($e);
            return false;
        }
    }
}

?>