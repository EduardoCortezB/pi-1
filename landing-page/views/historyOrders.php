<?php
$connection = new conection();
$pdo = $connection->connect_pdo();
$sentenciaSQL2=0;
$listaProductos=[];

// VARIABLES DE ACCION
$idUser = (isset($_SESSION['id_user'])) ? $_SESSION['id_user'] : null;



try{

     $sql="SELECT * FROM normalOrders INNER JOIN users ON normalOrders.idUser = users.idUser WHERE normalOrders.idUser = ?";
     $sentenciaSQL = $pdo->prepare($sql);
     $sentenciaSQL->bindParam(1,$idUser);
     $sentenciaSQL->execute();
     $isElements='';
     $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    


    $sentenciaSQL=null;
}catch(PDOException $e){
     echo $e; 
}

function estatusOrder($estatus){
  if($estatus == '1'){
    return '
      <p class="text-danger">Pendiente</p>
    ';
  }elseif($estatus=='0'){
    return '
      <p class="text-success">Echo</p>
    ';
}

}
?>

<div style="background-color: rgb(59,24,24); height: 96px"></div>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Listado de ordenes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Listado de ordenes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">        
        <div class="row">
        <div class="col-md-12">
            <br/>
            <table class="table" id="tableProducts">
                <thead class="table-head">
                    <tr>
                    <th>ESTATUS</th>
                    <th>ID ORDER</th>
                    <th>CLIENTE </th>
                    <th>Email </th>
                    <th>FECHA PEDIDO</th>
                    <th>FECHA DE ENTREGA </th>
                    <th>PRECIO TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                    foreach ($listaProductos as $producto) {
                      if (!($producto['isOpenOrder'] !== 0)) {
                        
                      }else{
                    ?>
                    <tr class="table-row">
                    <th><?php echo estatusOrder($producto['statusNotify']);?></th>
                    <th><?php echo $producto['idOrder'];?></th>
                    <td><?php echo $producto['name'];?></td>
                    <td><?php echo $producto['email'];?></td>
                    <td><?php echo $producto['dateShipping'];?></td>
                    <td><?php echo $producto['dateDelivery']; ?></td>
                    <td>$<?php echo $producto['total'];?></td>
                    </tr>
                <?php } }?>
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
