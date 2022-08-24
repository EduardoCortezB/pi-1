    <!-- footer-start -->
    <footer class="footer_area footer-bg">
        <div class="footer-top">
            <div class="container">
                <div class="row">
                <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget">
                            <h3 class="heading">
                                <img src="<?php echo __DOM__; ?>img/logo.png" alt="logo" width="100px">
                            </h3>
                            <div class="copyright">
                                <p class="footer-text">PISHY BAKE.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget">
                            <h3 class="heading">
                                Mapa del sitio
                            </h3>
                            <ul>
                                <li><a href="#">Nosotros</a></li>
                                <li><a href="#">Galeria</a></li>
                                <li><a href="#">Orden Personalizada</a></li>
                                <li><a href="#">Menú</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-7 col-md-12 col-lg-8">
                        <div class="copyright">
                                <p class="footer-text">Pishy Bake’s, S, A, Todos los derechos reservados | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by StoreSystem.</p>
                        </div>
                    </div>
                    <div class="col-xl-5 col-md-12 col-lg-4">
                        <div class="social_links">
                            <ul>
                                <li><a href="#"> <i class="fa fa-facebook"></i> </a></li>
                                <li><a href="#"> <i class="fa fa-instagram"></i> </a></li>
                                <li><a href="#"> <i class="fa fa-whatsapp"></i> </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-end -->
    <!-- JS here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" integrity="sha512-n/4gHW3atM3QqRcbCn6ewmpxcLAHGaDjpEBu4xZd47N0W2oQ+6q7oc3PXstrJYXcbNU1OHdQ1T7pAP+gi5Yu8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="<?php echo __DOM__; ?>js/vendor/modernizr-3.5.0.min.js"></script>
    <!--<script src="<?php echo __DOM__; ?>js/owl.carousel.min.js"></script>
    <script src="<?php echo __DOM__; ?>js/isotope.pkgd.min.js"></script> -->
    <!-- <script src="<?php echo __DOM__; ?>js/waypoints.min.js"></script> -->
    <script src="<?php echo __DOM__; ?>js/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo __DOM__; ?>js/scrollIt.js"></script>
    <script src="<?php echo __DOM__; ?>js/wow.min.js"></script>
    <script src="<?php echo __DOM__; ?>js/nice-select.min.js"></script>
    <script src="<?php echo __DOM__; ?>js/cart.js"></script>
    <script src="<?php echo __DOM__; ?>js/app.js"></script>

    <?php 
        if (FUNCT == 'details_order') {
            echo '<script src="'.__DOM__.'js/details.js"></script>';
        }   
    ?>


    <!-- <script src="<?php echo __DOM__; ?>js/jquery.slicknav.min.js"></script>
    <script src="<?php echo __DOM__; ?>js/jquery.magnific-popup.min.js"></script> -->
    <script src="<?php echo __DOM__; ?>js/aplogreg.js"></script>
    <script src="<?php echo __DOM__; ?>js/plugins.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="<?php echo __DOM__; ?>js/main.js"></script>

</body>

</html>
