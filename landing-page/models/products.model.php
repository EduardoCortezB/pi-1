<?php
class productsModel extends conection{
    private $idProduct;
    private $idCategory;
    private $name;
    private $image;
    private $description;
    private $priceUnit;

    private $sql='';
    private $statement='';
    private $array=[];
    function __construct(){  }

    // limitar el numero a cierta cantidad de productos.
    // implementar paginado
    function getListProducts(){
        try{
            $this->sql = 'SELECT * FROM products ORDER BY idProduct DESC';
            $this->statement = $this->connect_pdo()->prepare($this->sql);
            $this->statement->execute();
            $this->array = $this->statement->fetchAll();
        }catch(PDOException $e){
            return false;
        }

        return $this->array;
    }

        // implementar paginado
    function getListProducts_(){
        try{
            $this->sql = 'SELECT * FROM products ORDER BY idProduct DESC LIMIT 9';
            $this->statement = $this->connect_pdo()->prepare($this->sql);
            $this->statement->execute();
            $this->array = $this->statement->fetchAll();
        }catch(PDOException $e){
            return false;
        }

        return $this->array;
    }

    function getListByProducts($idCat){
        try{
            $this->sql = 'SELECT * FROM products WHERE idCategory = ? ORDER BY idProduct DESC';
            $this->statement = $this->connect_pdo()->prepare($this->sql);
            $this->statement->bindParam(1,$idCat);
            $this->statement->execute();
            $this->array = $this->statement->fetchAll();
        }catch(PDOException $e){
            return false;
        }

        return $this->array;
    }

    function getListProductsForCart($idProduct){
        try{
            $this->sql = 'SELECT idProduct, name, image, priceUnit FROM products WHERE idProduct = ?';
            $this->statement = $this->connect_pdo()->prepare($this->sql);
            $this->statement->bindParam(1, $idProduct);
            $this->statement->execute();
            $this->array = $this->statement->fetch(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            return false;
        }

        return $this->array;
    }

    function getProduct($idP_){

    }
}
?>