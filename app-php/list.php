<?php  
include '../conexion/conexion.php';
$connection = new conection();
$pdo = $connection->connect_pdo();

$filter = (isset($_GET['filter'])) ? $_GET['filter'] : null; 


try{

    if($filter == '1'){
      // ordenes pendientes
      $sql="SELECT * FROM normalorders INNER JOIN users ON normalorders.idUser = users.idUser WHERE normalorders.statusNotify = 1";
      $sentenciaSQL = $pdo->prepare($sql);
      $sentenciaSQL->execute();
      $isElements='';
      $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
      die(json_encode($listaProductos));
    }elseif($filter == '2'){
      //ordenes hechas
      $sql="SELECT * FROM normalorders INNER JOIN users ON normalorders.idUser = users.idUser WHERE normalorders.statusNotify = 2 ";
      $sentenciaSQL = $pdo->prepare($sql);
      $sentenciaSQL->execute();
      $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

      die(json_encode($listaProductos));
    // }elseif($filter == '0'){
    //   // todas las ordenes
    //   $sql="SELECT * FROM normalorders INNER JOIN users ON normalorders.idUser = users.idUser";
    //   $sentenciaSQL = $pdo->prepare($sql);
    //   $sentenciaSQL->execute();
    //   $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    // }else{
    //   // todas
    //   $sql="SELECT * FROM normalorders INNER JOIN users ON normalorders.idUser = users.idUser";
    //   $sentenciaSQL = $pdo->prepare($sql);
    //   $sentenciaSQL->execute();
    //   $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    }

    
    $sentenciaSQL=null;
}catch(PDOException $e){
    echo $e; 
}

?>