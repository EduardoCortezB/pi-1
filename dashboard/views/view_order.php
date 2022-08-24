<?php

$connection = new conection();
$pdo = $connection->connect_pdo();
$sentenciaSQL2=0;
$listaProductos=[];

// VARIABLES DE ACCION


$idOrder = (isset($_GET['order'])) ? str_validation($_GET['order']) : null; 
// SELECT * FROM normalOrders INNER JOIN shoppingCar ON normalOrders.idOrder = shoppingCar.idOrder; 
// SELECT * FROM normalOrders INNER JOIN shoppingCar ON normalOrders.idOrder = shoppingCar.idOrder; 
function estatusOrder($estatus){
  if($estatus == '1'){
    return '
      <h1 class="text-danger">Pendiente</h1>
    ';
  }elseif($estatus=='0'){
    return '
      <h1 class="text-success">Echo</h1>
    ';
}
}

try{

  $sql="SELECT * FROM shoppingCar INNER JOIN products ON shoppingCar.idProduct = products.idProduct WHERE shoppingCar.idOrder = ?";
  $sentenciaSQL = $pdo->prepare($sql);
  $sentenciaSQL->bindParam(1,$idOrder);
  $sentenciaSQL->execute();
  if($sentenciaSQL->rowCount()!==0){
    $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
  }else{
    //die('No existe la orden');
  }

  $renderData = [];
  foreach ($listaProductos as $key) {
      $i=$key['quantity']*$key['priceUnit'];
      $renderData[] = [
          'name'=>$key['name'],
          'image'=>$key['image'],
          'description'=>$key['description'],
          'priceUnit'=>$key['priceUnit'],
          'quantity'=>$key['quantity'],
          'total'=>$i,
      ];
      $i=0;
  }   
  $total =0;
  foreach ($renderData as $key){
      $total = $total + $key['total'];
  }

  $sql="SELECT * FROM normalOrders INNER JOIN users ON normalOrders.idUser = users.idUser INNER JOIN address ON normalOrders.idAddress = address.idAddress WHERE normalOrders.idOrder = ?";
  $sentenciaSQL = $pdo->prepare($sql);
  $sentenciaSQL->bindParam(1,$idOrder);

  $sentenciaSQL->execute();
  $user=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOException $e){
    echo $e; 
}
$user=$user[0];
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Orden <?php echo estatusOrder($user['statusNotify']); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Orden</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->

    <div class="container-fluid">        
        <div class="row">
          <div class="col-12">
          <table class="table">
          <thead>
            <tr>
              <th scope="col">ID CLIENTE</th>
              <th scope="col">NOMBRE</th>
              <th scope="col">APELLIDOS</th>
              <th scope="col">NUMERO</th>
              <th scope="col">EMAIL</th>
              <th scope="col">CÓDIGO POSTAL</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <?php 
                
                echo '
                <th scope="row">'. $user['idUser'] .'</th>
                <th scope="row">'. $user['name'] .'</th>
                <th scope="row">'. $user['lastName'] .'</th>
                <th scope="row">'. $user['number'] .'</th>
                <th scope="row">'. $user['email'] .'</th>
                <th scope="row">'. $user['cpp'] .'</th>
                ';
            
            ?>
            </tr>
          </tbody>
        </table>
        </div>
        <div class="row justify-content-between">
    <div class="col-4">
      <h3>Lista de la orden</h3>
    </div>
    <div class="col-4 pr-0 mr-0">
      <h4>Total de la orden $<? echo $total; ?></h4>
    </div>
  </div>

        <div class="col-md-12">
            <br/>
            <table class="table" id="tableProducts">
                <thead class="table-head">
                    <tr>
                    <th>PRODUCTO</th>
                    <th>IMAGEN</th>
                    <th>DESCRIPCION</th>
                    <th>PRECIO POR UNIDAD </th>
                    <th>CANTIDAD</th>
                    <th>TOTAL CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    foreach ($renderData as $producto) {
                    ?>
                    <tr class="table-row">
                    <td><?php echo $producto['name'];?></td>
                    <td><?php echo viewImage($producto['image']);?></td>
                    <td><?php echo $producto['description'];?></td>
                    <td>$<?php echo $producto['priceUnit'];?></td>
                    <td><?php echo $producto['quantity']; ?> Unidades</td>
                    <td>$<?php echo $producto['total'];?></td>
                    </tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
        
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
  document.addEventListener('DOMContentLoaded',() => {
    $('#tableProducts').DataTable();
  })
</script>
