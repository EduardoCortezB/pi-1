
<div style="background-color: rgb(59, 24, 24); height: 100px;"></div>
<div class="container">
    <div class="p-4">
        <h3 style="font-family: 'Lobster', cursive;">Orden Personalizada</h3>
        <p>Personaliza tu orden a tu gusto, porfavor proporcionala información  necesaria para que podamos preparar tu orden con las caracteristicas que requieres.<br><b style="color: #ff1212;">
        Es muy importante que rellenes todos los compos con la información más detallada posible<b></b></p>
    </div>
    <div class="row justify-content-center">
        <form>
            <div class="col-12">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="nombreInfo" class="col-sm-2 col-form-label">Nombres</label>
                        <input type="text" class="form-control" placeholder="Nombre" id="nombreInfo" aria-describedby="Nombre">
                    </div>
                    <div class="col-sm-6">
                        <label for="apellidosInfo" class="col-sm-2 col-form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidosInfo" aria-describedby="Apellidos">
                    </div>
                </div>
            </div> 
            <!-- end personal info -->
            <br>
            <div class="col-12 text-center">
                <p>Entrega</p>
            </div>
            <!-- begin information address -->
            <div class="col-12">
                <!-- begin receibed address or house -->
                <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck">
                      <label class="form-check-label" for="gridCheck">
                        Lo recojeré en sucursal.
                      </label>
                    </div>
                </div>
                <!-- end receibed address or house -->
                <!-- begin list address registred -->
                <div class="form-group">
                    <label for="inputState">Direcciones registradas</label>
                    <select id="inputState" class="form-control">
                      <option>Address 1</option>
                      <option>Address 2</option>
                      <option>Address 3</option>
                      <option>Address 4</option>
                    </select>
                  </div>
                <!-- end list address registred -->
                <div class="form-group">
                    <label for="inputAddress">Dirección</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputCity">Ciudad</label>
                      <input type="text" class="form-control" id="inputCity" value="Reynosa" disabled>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputState">Estado</label>
                      <select id="inputState" class="form-control" disabled>
                        <option selected>Tamaulipa</option>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">CPP</label>
                        <input type="text" class="form-control" id="inputZip">
                    </div>
                </div>
                <div id="messageCppZone text-dark">
                    Por el momento solamente tenemos entregas en Reynosa, Tamaulipas. <br> Selecciona el Código postal para poder validar si tenemos envios a tu zona.
                </div>
            </div>
            <!-- end information address -->
            <br>
            <div class="col-12 text-center">
                <p>Información del producto.</p>
            </div>

            <div class="col-12">
                <div class="form-group">
                    <label for="imageReference">Sube una imágen de referencia.</label>
                    <input type="file" class="form-control-file" id="imageReference">
                  </div>
                  <div class="form-group">
                      <label for="dateDelivery">Fecha de entrega</label>
                      <input class="form-control-file" type="date" id="start" name="deliveryDate" value="2018-07-22" min="2018-01-01" max="2018-12-31">
                  </div>

            </div>

        </form>
    </div>
</div>
