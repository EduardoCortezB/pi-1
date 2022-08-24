
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Subir Producto</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Subir producto</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">

    <div class="modal fade" id="modalConf" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h2 class="modal-title" id="staticBackdropLabel">Confirmación de registro</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="addInfoOk">Subir</button>
          </div>
        </div>
      </div>
    </div>

      <div id="alerts"></div>
        <div class="form-group">
          <select id="category" class="form-select">
          <?php  
            $products->showOptionsCategories();
          ?>
          </select>
        </div>
        <div class="form-group">
          <label for="nameProduct">Nombre del producto</label>
          <input type="text" required class="form-control" id="nameProduct" placeholder="Ingresa el nombre del product">
        </div>
        <div class="form-group">
          <label for="description">Descripcion</label>
          <textarea required class="form-control" id="description" placeholder="Descripcion del producto"></textarea>
        </div>
        <div class="form-group">
          <label for="priceUnit">Precio</label>
          <input type="number" required class="form-control" id="priceUnit" placeholder="$" required>
        </div>
        <div class="form-group pl-1 pt-2">
          <button id='imgf' class="btn btn-primary">Subir Imagen<br><i class="fas fa-cloud-upload-alt text-center" style='font-size:50px'></i></button>
          <input type="file" required id="imageProduct" name="fileImage"  style="display: none;">
          <div id="preview">No hay ninguna imagen seleccionada.</div>
        </div>
 
      <div class="form-group">
        <button type="submit" id="confirmation" class="btn btn-primary" style="width: 100%;">Enviar</button> 
      </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->