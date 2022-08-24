<?php  
include_once "conf.php";

class conection extends PDOConfiguration{
    private $myServer;
    private $pdo;
    public function connect_pdo(){
        $this->myServer = 'mysql:host='.$this->SERVER.';dbname='.$this->DB;
        try{
            $this->pdo = new PDO($this->myServer, $this->USER, $this->PASSWORD,[
                PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"
            ]);
        }catch(PDOException $e){
            die($e);
        }
        return $this->pdo;
    }
}
?>