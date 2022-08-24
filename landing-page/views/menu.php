
<!-- Preloader -->
<div id="preloader">
    <div class="text-center">
        <i class="circle-preloader"></i>
        <img src="<?php echo __DOM__; ?>img/logo.png" alt="">
        <p>Cargando - Pishie Bakers</p>
    </div>
</div>
<!-- breadcam_area_start -->
<div class="opacity_img" style="background-image: url('<?php echo __DOM__; ?>img/banner/2.jpg'); width: 100%; height: 100vh; background-repeat: no-repeat;background-size: cover;">
    <div class="container">
        <div class="row" style="padding-top: 300px;">
            <div class="col-xl-12 text-center">
                <div class="section_title mb-60">
                    <div class="breadcam_text">
                    <h3 style="font-family: 'Lobster', cursive; color: white;">Menú</h3>
                </div>
                <p style="font-weight: bold; color: aquamarine;">Puedes elegir cualquiera de nuestros productos y lo llevamos a tu domicilio o puedes venir a nuestro <a href="contact.html" style="color: red;"> establecimiento.</a></p>
            </div>
            <div class="text-center">
                <a href="#ourProducts" class="mt-3 load_more_btn" style="padding: 1.2rem;">Ver Productos</a>
            </div>
        </div>
        </div>
    </div>
</div>

    <!-- order_area_start -->
    <div class="order_area" id="ourProducts">
        <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-12 align-self-center">
                        <div class="section_title mb-70">
                            <h3 style="font-family: 'Lobster', cursive;">Categorias</h3>
                            <div class="mt-4 justify-content-center" id="categorias"></div>
                        </div>
                    </div>
                </div>
            <div class="row" id="list-products"></div>
        </div>
    </div>
    <!-- order_area_end -->
<template id="tp-product">
    <div class="col-xl-4 col-md-6">
        <div class="single_order">
            <div class="order_thumb">
                <img src="" style="height: 300px" alt="">
                <div class="order_prise">
                    <span></span>
                </div>
            </div>
            <div class="order_info">
                <h3><a href="#">...</a></h3>
                <p> ... </p>
                <button type="submit"></button>
            </div>
        </div>
        <input type="hidden">
    </div>
</template>
