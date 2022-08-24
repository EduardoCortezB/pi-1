<?php
class Orders_Model extends conection {
    private $idProduct;
    private $idUser;
    private $idOrder;
    private $totalUnit;
    private $qty;
    private $dateDelivery;
    function __construct() {

    }

    public function getOrderActive($idUser){
        // verificar si el usuario tiene alguna orden activa.
        try {
            $sql='SELECT idOrder FROM normalorders WHERE (statusOrder = 0) AND (idUser = ?)';
            $this->statement = $this->connect_pdo()->prepare($sql);
            $this->statement->bindValue(1,$idUser,PDO::PARAM_INT);
            $this->statement->execute();

            if($this->statement->rowCount() != 0){
                return $this->statement->fetch(PDO::FETCH_ASSOC);
            }else{
                $sql='INSERT INTO normalorders 
                (idOrder, idUser, idAddress, statusNotify, statusOrder, isOpenOrder, dateShipping,dateDelivery, total) 
                VALUES (NULL, ?, NULL, 0, 0,0, NOW(), NULL, NULL)';

                $this->statement = $this->connect_pdo()->prepare($sql);
                $this->statement->bindValue(1,$idUser,PDO::PARAM_INT);
                
                if($this->statement->execute()){
                    return $this->getOrderActive($idUser);
                }
            }
            
        }catch(PDOException $e){
            echo $e;
            return false;
        }  
    }

    public function getPriceProduct($idProduct){
        $this->idProduct = intval($idProduct);
        try {
            $sql='SELECT priceUnit FROM products WHERE idProduct = ?';
            $this->statement = $this->connect_pdo()->prepare($sql);
            $this->statement->bindValue(1,$this->idProduct,PDO::PARAM_INT);

            $this->statement->execute();

            if($this->statement->rowCount() !== 0){
                $priceUnit = $this->statement->fetch(PDO::FETCH_ASSOC);
                return $priceUnit['priceUnit']; 
            }else{
                return false;
            }
            
        }catch(PDOException $e){
            // return false;
            echo $e;
        }  
    }

    public function addProductOrderDB($idOrder,$idProduct,$totalUnit,$qty,){
        
        $this->idOrder=$idOrder;
        $this->idProduct=$idProduct;
        $this->totalUnit=$totalUnit;
        $this->qty=$qty;
        // verificar si el usuario tiene alguna orden activa.
        try {
            $sql='SELECT idProduct, quantity FROM shoppingcar WHERE idProduct = ? LIMIT 1';
            $this->statement = $this->connect_pdo()->prepare($sql);
            $this->statement->bindValue(1,$this->idProduct,PDO::PARAM_INT);

            $this->statement->execute();
            $qty_ = $this->statement->fetch(PDO::FETCH_ASSOC);
            if($this->statement->rowCount() == 0 || $qty_ != $this->qty){
                $sql='INSERT INTO shoppingcar 
                (idProdShip, idOrder, totalUnit, idProduct, quantity) 
                VALUES (NULL, ?,?,?,?)';
                $this->statement = $this->connect_pdo()->prepare($sql);
                $this->statement->bindParam(1,$this->idOrder,PDO::PARAM_INT);
                $this->statement->bindParam(2,$this->totalUnit,PDO::PARAM_INT);
                $this->statement->bindParam(3,$this->idProduct,PDO::PARAM_INT);
                $this->statement->bindParam(4,$this->qty,PDO::PARAM_INT);
    
                if($this->statement->execute()){
                    return true;
                }      
            }else{
                return true;
            }
                
        }catch(PDOException $e){
            return false;
            // echo $e;
        } 
    }
    public function purgueProductOrderDB($idOrder){
        $this->idOrder=$idOrder;
        try {

            $sql='DELETE FROM shoppingCar WHERE idOrder = ?';
            $this->statement = $this->connect_pdo()->prepare($sql);
            $this->statement->bindParam(1,$this->idOrder,PDO::PARAM_INT);

            if($this->statement->execute()){
                return true;
            }
                
        }catch(PDOException $e){
            return false;
            // echo $e;
        } 
    }

    public function doOrderActive($idOrder){
        $this->idOrder=$idOrder;
        try {

            $sql='UPDATE normalOrders SET isOpenOrder = 1 WHERE normalOrders.idOrder = ?';
            $this->statement = $this->connect_pdo()->prepare($sql);
            $this->statement->bindParam(1,$this->idOrder,PDO::PARAM_INT);

            if($this->statement->execute()){
                return true;
                
            }
                
        }catch(PDOException $e){
            return false;
            // echo $e;
        } 
    }
    public function deleteProductOrderDB($idOrder,$idProduct){

    }

    public function isOrder($idUser){
        $this->idUser=$idUser;
        
        try {

            $sql='SELECT idOrder FROM normalorders WHERE idUser = ? AND isOpenOrder = 1'; 
            $this->statement = $this->connect_pdo()->prepare($sql);
            $this->statement->bindParam(1,$this->idUser,PDO::PARAM_INT);
            $this->statement->execute();
            if($this->statement->rowCount() === 0){
                return ['status'=>'ok'];
            }else{
                $order=$this->statement->fetch(PDO::FETCH_ASSOC);
                return ['order'=>$order['idOrder']];
            }
        }catch(PDOException $e){
            // return false;
            echo $e;
        } 
    }
}
?>