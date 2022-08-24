<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Pishy Bake’s</title>
    <meta name="description" content="Reposteria Pishy Bake’s">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo __DOM__; ?>img/logo-01.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- Font Awesome Icons -->

    <!-- CSS here -->
    <link rel="stylesheet" href="<?php echo __DOM__; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo __DOM__; ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo __DOM__; ?>css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo __DOM__; ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo __DOM__; ?>css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo __DOM__; ?>css/nice-select.css">
    <link rel="stylesheet" href="<?php echo __DOM__; ?>css/flaticon.css">
    <link rel="stylesheet" href="<?php echo __DOM__; ?>css/animate.css">
    <link rel="stylesheet" href="<?php echo __DOM__; ?>css/slicknav.css">
    <link rel="stylesheet" href="<?php echo __DOM__; ?>css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://kit.fontawesome.com/3393d4e7a9.js" crossorigin="anonymous"></script>
    <!-- nice select  -->

    <?php
        // FUNC is a constant declared in index.php
        // this function only is executed when is in the register & login
        if (FUNCT == 'iniciar_sesion' or FUNCT == 'registro' ) {
            echo '<link rel="stylesheet" href="'. __DOM__ .'css/formStyle.css">';
        }

        if (FUNCT == 'car_shopping' || FUNCT == 'details_order') {
            echo '<link rel="stylesheet" href="'. __DOM__ .'css/cart.css">';
        }

    ?>


</head>

<body>
   <header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xl-10 col-lg-10">
                        <div class="main-menu d-none d-lg-block">
                            <nav>
                                <ul class="mein_menu_list" id="navigation">
                                    <div class="logo-img d-none d-lg-block">
                                        <a class="navbar-brand" href="<?php echo __DOM__; ?>page/inicio">
                                            <img src="<?php echo __DOM__; ?>img/logo.png" alt="" width="65px"  class="d-inline-block">
                                            <h2 class="d-inline-block align-text-center" style="font-family: 'Lobster', cursive; font-size: 1.8rem; color: red;
                                            ">Pishy Bake's</h2>
                                          </a>
                                    </div>
                                    <li><a href="<?php echo __DOM__; ?>page/inicio">Inicio</a></li>
                                    <li><a href="<?php echo __DOM__; ?>page/acerca_de">Acerca</a></li>
                                    <li><a href="<?php echo __DOM__; ?>page/menu">Menú</a></li>
                                    <!-- <li><a href="<?php //echo __DOM__; ?>page/galeria">Galeria</a></li> -->
                                    <li><a href="<?php echo __DOM__; ?>page/contacto">Contacto</a></li>
                                    <?php if($statusSession){ ?>
                                        <li><a href="#"><?php echo $userName; ?><i class="fas fa-user" style="padding: 9px; font-size: 1.2rem;"></i><i class="ti-angle-down"></i></a>
                                            <ul class="submenu">
                                                
                                                <hr>
                                                <?php if($rol == '4'){ ?>
                                                    <hr>
                                                    <li><a href="<?php echo __DOM__; ?>dashboard/index.php?page=inicio">Panel de control</a></li>
                                                <?php } ?>
                                                <hr>
                                                <li><a href="#" id="closeSesion">Cerrar sesión<i class="fas fa-times-circle" style="padding: 9px; font-size: 1.2rem;"></i></a></li>
                                            </ul>
                                        </li>
                                    <?php }else{ ?>
                                        <li><a href="<?php echo __DOM__; ?>page/iniciar_sesion"><i class="fa fa-user" style="font-size: 20px; padding-right: 10px"></i>Iniciar Sesion</a></li>
                                    <?php } ?>
                                    <li id="iconCart">
                                        <a id="buttonCarShip" href="#"> Carrito
                                            <i class="fas fa-shopping-cart text-center" style="font-size: 20px; margin-left: 0px;"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- custom order -->
                    <!-- <div class="col-xl-2 col-lg-2 d-none d-lg-block">
                        <div class="custom_order">
                            <a href="<?php //echo __DOM__; ?>page/ordenar" class="boxed_btn_white">Orden Personalizada</a>
                        </div>
                    </div>-->
                    <!-- cusom order end  -->
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                    <div class="logo-img-small d-sm-block d-md-block d-lg-none">
                        <a href="index.php">
                            <img src="<?php echo __DOM__; ?>img/logo.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </header>
