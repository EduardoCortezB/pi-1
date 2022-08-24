<!-- Preloader -->
<div id="preloader">
    <div class="text-center">
        <i class="circle-preloader"></i>
        <img src="<?php echo __DOM__; ?>img/logo.png" alt="">
        <p>Cargando - Pishie Bakers</p>
    </div>
</div>
    <!-- header-end -->
    <!-- slider_area-start -->
 <!-- breadcam_area_start -->
 <div style="background-image: url('<?php echo __DOM__; ?>img/banner/fondo.jpg'); width: 100%; height: 100vh; background-position: center center; background-repeat: no-repeat; background-repeat: no-repeat;background-size: cover; background-attachment: fixed; background-size: cover; background-color: #66999;">
    <div class="container">
        <div class="row" style="padding-top: 300px;">
         <div class="col-xl-12 text-center">
            <div class="section_title mb-60">
                <h3 style="font-family: 'Lobster', cursive;" class="text-light">Reposteria <b style="color: red">Pishy Bake's</b></h3>
                <p class="text-light">Nuestra prioridad es tu opinión<br>preparamos y enviamos tu orden.</p>
                <div class="text-center">
                    <a href="#order_now" class="mt-3 load_more_btn" style="padding: 1.2rem;">Realizar Orden</a>
                </div>
            </div>
         </div>
        </div>
    </div>
 </div>
 <!-- breadcam_area_end -->

    <!-- service_area-start -->
    <div class="service_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-60">
                        <h3 style="font-family: 'Lobster', cursive;">Acerca de nosotros</h3>
                        <p class="blockquote">Pishy Bake’s es una empresa dedicada a la reposteria,
                            siempre tomando en cuenta la palabra del cliente para que nuestro producto sea de la más alta calidad.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="single_service alt-card-panel"  style="background-color: #ff0000">
                        <div class="service_icon">

                        </div>
                        <h4 style="color: #ffffff">Envio Gratis</h4>
                        <p style="color: #ffffff">Nuestros envios son gratis, estan limitados a distintas zonas de Reynosa.</p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="single_service"  style="background-color: #ff0000">
                        <div class="service_icon">

                        </div>
                        <h4 style="color: #ffffff">La mejor Calidad</h4>
                        <p style="color: #ffffff">Nuestro producto es 100% fresco y customizado.</p>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="single_service"  style="background-color: #ff0000"      >
                        <div class="service_icon">

                        </div>
                        <h4 style="color: #ffffff">El mejor Precio</h4>
                        <p style="color: #ffffff">Siempre preocupados por tu economia, asi que nos preocupamos porque nuestros productos sean accesibles y economicos para todos.</p>
                    </div>
                </div>
                <div class="text-center col-12 justify-content-center pb-5">
                    <a class="load_more_btn" href="<?php echo __DOM__; ?>page/acerca_de">Ver más acerca de nosotros</a>
                </div>
            </div>
        </div>
    </div>
    <!-- service_area-end -->
    <!-- ff1212 -->
    <!-- video_area_start -->
    <div class="video_area video_bg zigzag_bg_1 zigzag_bg_2 ">
        <div class="video_area_inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="video_text">
                            <div class="info">
                                <div class="info_inner">
                                        <h4>Ver Video</h4>
                                        <p>Presentación de nuestros productos</p>
                                </div>
                                <div class="icon_video">
                                        <a class="popup-video" href="https://www.youtube.com/watch?v=9TJvktrr1DY"><i class="ti-control-play"></i></a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- video_area_end -->

    <!-- order_area_start -->
    <div id="order_now" class="order_area">
        <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section_title mb-70">
                            <h3 style="font-family: 'Lobster', cursive;">Subidos recientemente</h3>
                            <p>Tenemos una gran variedad de productos de alta calidad los cuales puedes personalizar o elegir.</p>
                        </div>
                    </div>
                </div>
            <div class="row">
                <?php
                    $products = new productsController();
                    $products->showProductsPopular();
                ?>
                <div class="col-12 justify-content-center text-center">
                    <a href="<?php echo __DOM__; ?>page/menu" class="load_more_btn m-4">Ver Menú</a>
                     <!--<a href="<?php echo __DOM__; ?>page/ordenar" class="load_more_btn m-4">Personalizar Orden</a>-->
                </div>
            </div>
        </div>
    </div>
    <!-- order_area_end -->
