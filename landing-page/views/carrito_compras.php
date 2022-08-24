<div style="background-color: rgb(59, 24, 24); height: 96px;"></div>
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container" id="sectionShoppingCar">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table" id="cartOrder">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Nombre</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="<?php echo __DOM__; ?>page/menu" class="btn btn-danger">CONTINUAR COMPRANDO</a>
                    </div>
                </div>
                <div class="col-lg-6">
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Total</h5>
                        <ul>
                            <li>Subtotal <span id="subT">--</span></li>
                            <li>Total <span id="Tot">--</span></li>
                        </ul>
                        <a href="#" id="nextContinue" class="btn btn-danger">Proceder a realizar la Orden</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
<template id="cart-section">
    <tr>
        <td class="shoping__cart__item">
            <img src="" style="width: 150px; height: 150px;" alt="">
            <h5></h5>
        </td>
        <td class="shoping__cart__price"></td>
        <td class="shoping__cart__quantity">
            <div class="quantity">
                <a id="addItem"><i class="fas fa-plus" style="font-size: 25px; color: red;"></i></a>
                    <div class="pro-qty">
                        <input type="number" value="1" id="inpProd" idProduct="20">
                    </div>
                <a id="substractItem"><i class="fas fa-window-minimize" style="font-size: 25px; color: red;"></i></a>
            </div>
        </td>
        <td class="shoping__cart__total">
            --
        </td>
        <td class="shoping__cart__item__close">
            <a id='removeProduct'><i class="far fa-times-circle" style="font-size: 25px; color: red;"></i></a>
        </td>
    </tr>
</template>
