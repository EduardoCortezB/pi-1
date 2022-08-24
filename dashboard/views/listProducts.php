<?php
$connection = new conection();
$pdo = $connection->connect_pdo();
$sentenciaSQL2=0;

// VARIABLES DE ACCION
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : null;
$txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : null;


//--



function getNameCategory($idCategory,$pdo){
  try{
    $sentenciaSQL = $pdo->prepare("SELECT nameCategory FROM category where id_Category= ? ");
    $sentenciaSQL->bindParam(1,$idCategory);
    $sentenciaSQL->execute();
    $listaProductos=$sentenciaSQL->fetchAll();
    echo $listaProductos[0]['nameCategory'];


    $sentenciaSQL=null;
  }catch(PDOException $e){
    // echo $e; 
  }
}
// --
try{
    $sentenciaSQL = $pdo->prepare("SELECT * FROM products");
    $sentenciaSQL->execute();
    $isElements='';
    if($sentenciaSQL->rowCount()==0){
      $isElements = "
      <th class='text-center'>No hay registros</th>
      ";
    }

    $listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    $sentenciaSQL=null;
}catch(PDOException $e){
    // echo $e; 
}
?>

<div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h2 class="modal-title" id="staticBackdropLabel">Confirmación de modificacion</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="addEdith">Modificar</button>
          </div>
        </div>
      </div>
    </div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Listado de productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Listado de productos</li>
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
                    <th>ID</th>
                    <th>Nombre</th>
                    <!-- <th>Categoria</th> -->
                    <th>Descripcion</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id='listProd_'>

                </tbody>
            </table>
        </div>
    </div>
        
    </div>
    <!-- /.content -->
</div>

<div class="modal" tabindex="-1" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>¿Estas seguro de que deseas elimininar este item?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="okDel">Si</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
