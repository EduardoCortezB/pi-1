<div style="background-color: rgb(59, 24, 24); height: 96px;"></div>
<?php
    $connection = new conection();
    $pdo = $connection->connect_pdo();
    
    $statusSession = (isset($_SESSION['status-session'])) ? true : false;
    $userName = (isset($_SESSION['name'])) ? $_SESSION['name'] : false;
    $lName = (isset($_SESSION['lName'])) ? $_SESSION['lName']:false;
    $idUser = (isset($_SESSION['id_user'])) ? $_SESSION['id_user'] :false;
    $email = (isset($_SESSION['email'])) ? $_SESSION['email']:false;
    $number = (isset($_SESSION['number'])) ? $_SESSION['number']:false;
    
    $rol = (isset($_SESSION['rol'])) ? $_SESSION['rol'] :false;
    $order = (isset($_GET['o'])) ? str_validation($_GET['o']):false;
    
    // validamos si esxiste la orden
    try{
        $sentenciaSQL = $pdo->prepare("SELECT * FROM normalorders WHERE idOrder=? LIMIT 1");
        $sentenciaSQL->bindParam(1, $order);
        $sentenciaSQL->execute();

        $ordenN_ = $sentenciaSQL->rowCount();

        if ($ordenN_ != 1) {
            die("
            <script>
                //location.href='".__DOM__."page/error_orden';
                console.log('Orden is Exist');
            </script>");
        }

        $dataOrder = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);

    }catch(PDOException $e){
        die('ERROR DE ORDEN');
    }

    try{
        $sentenciaSQL = $pdo->prepare("SELECT *
        FROM shoppingcar
        INNER JOIN products
        ON shoppingCar.idProduct=products.idProduct WHERE idOrder = ?");
        $sentenciaSQL->bindParam(1, $order);
        $sentenciaSQL->execute();

        $ordenN_ = $sentenciaSQL->rowCount();

        // No existen productos en la base de datos
        
        if ($ordenN_ === 0) {
            die("
            <script>
                //location.href='".__DOM__."page/error_orden';
                console.log('Error orden');
            </script>");
        }

        $dataProducts = $sentenciaSQL->fetchAll();
    }catch(PDOException $e){
        die('ERROR DE ORDEN');
    }

    $renderData = [];
    foreach ($dataProducts as $key) {
        $i=$key['quantity']*$key['priceUnit'];
        $renderData[] = [
            'name'=>$key['name'],
            'total'=>$i
        ];
        $i=0;
    }   
    $total =0;
    foreach ($renderData as $key){
        $total = $total + $key['total'];
    }


?>
    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Detalles de la orden</h4>
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Nombres<span>*</span></p>
                                        <input type="text" disabled value="<?php echo $userName; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Apellidos<span>*</span></p>
                                        <input type="text" disabled value="<?php echo $lName; ?>">
                                    </div>
                                </div>
                            </div>
                            <form method="post" id="sendOrder">
                                <input type="hidden" id="idUser" value="<?php echo $idUser; ?>"> 
                                <input type="hidden" id="order" value="<?php echo $order; ?>"> 
                                <input type="hidden" id="total" value="<?php echo $total; ?>"> 
                                <div class="checkout__input">
                                    <p>Address<span>*</span></p>
                                    <input name="calle" id="address" type="text" placeholder="Calle, colonia y número." class="checkout__input__add">
                                </div>
                                <div class="checkout__input">
                                    <p>Codigo Postal<span>*</span></p>
                                    <input name="cpp" id="cpp" type="text" required >
                                </div>
                                <div class="checkout__input">
                                    <p>Ciudad<span>*</span></p>
                                    <input name="ciudad" type="text" disabled value="Reynosa.">
                                </div>
                                <div class="checkout__input">
                                    <p>Estado<span>*</span></p>
                                    <input name="estado" type="text" disabled value="Tamaulipas">
                                </div>
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Telefono<span>*</span></p>
                                        <input type="text" disabled value="<?php echo $number; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Correo Electronico<span>*</span></p>
                                        <input type="text" disabled value="<?php echo $email; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="checkout__input">
                                <p>Notas de orden<span>*</span></p>
                                <input name="notas" type="text" placeholder="Agrega alguna nota a la órden.">
                                
                            </div>  -->
                            <div class="checkout__input">
                                <p>Fecha<span>*</span></p>
                                <input type="date" id="date">
                            </div> 
                        </form>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Tu orden</h4>
                                <div class="checkout__order__products">Products <span>  Total  </span></div>
                                <ul>
                                <?php
                                    foreach ($renderData as $key) {
                                        echo "<li>".$key['name']."<span>$".$key['total']."</span></li>";
                                    }                              
                                ?>
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>$<?php echo $total; ?></span></div>
                                <div class="checkout__order__total">Total <span>$<?php echo $total; ?></span></div>

                                <button type="submit" id="makeOrder" class="btn btn-primary">REALIZAR ORDER</button>
                                <!-- <button type="submit" id="deleteOrder"  class="btn btn-danger">CANCELAR ORDEN</button> -->
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

