<?php 
include '../conexion/conexion.php';
$connection = new conection();
$pdo = $connection->connect_pdo();

$id = (isset($_GET['id'])) ? $_GET['id'] : null; 

$sql="UPDATE normalOrders SET statusNotify = 2 WHERE normalOrders.idOrder = ?";
$sentenciaSQL = $pdo->prepare($sql);
$sentenciaSQL->bindParam(1,$id);
if($sentenciaSQL->execute()){
  die(json_encode(['success'=>'ok','message'=>'Se ha completado la orden.']));
}


?>