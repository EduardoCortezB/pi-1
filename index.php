<?php 
session_start();

$statusSession = (isset($_SESSION['status-session'])) ? true : false;
$userName = (isset($_SESSION['name'])) ? $_SESSION['name'] : false;
$lName = (isset($_SESSION['lName'])) ? $_SESSION['lName']:false;
$rol = (isset($_SESSION['rol'])) ? $_SESSION['rol'] :false;
$idUser = (isset($_SESSION['id_user'])) ? $_SESSION['id_user'] :false;
$email = (isset($_SESSION['email'])) ? $_SESSION['email']:false;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


/* === [NECESSARY FILES]  === */
include_once 'global.php';
include_once 'conexion/conexion.php';
include_once 'landing-page/models/products.model.php';
include_once 'landing-page/controllers/products.controller.php';
include_once 'landing-page/controllers/index.home.controller.php'; // mains pages controller
// include_once 'controller/home.navbar.controller.php'; // controller of navbar

/* === [GLOBAL CONFIGURATION]  === */
$methodRequest = $_SERVER['REQUEST_METHOD'];

//CONTEXT
$redTo = 'inicio';
$ctx = (isset($_GET['page'])) ? str_validation($_GET['page']) : null; 


if($ctx !== null){
    define('FUNCT',$ctx);
}else{
    die("
    <script>
        location.href='".__DOM__."page/".$redTo."';
    </script>");
}

/* === [MANAGER OF METHOD] === */

// GET REQUEST
if ($methodRequest === 'GET') {
    // HEADER HTML
    include_once 'landing-page/views/header.php';
    
    switch (FUNCT) {
        case 'inicio':
            $home = new IndexHomeController();
            $home->load('start');
            break;
        case 'acerca_de':
            $home = new IndexHomeController();
            $home->load('about');
            break;
        case 'menu':
            $home = new IndexHomeController();
            $home->load('menu');
            break;    
        case 'galeria':
            $home = new IndexHomeController();
            $home->load('gallery');
            break; 
        case 'contacto':
            $home = new IndexHomeController();
            $home->load('contact');
            break;
        case 'ordenar':
            if ($statusSession) {
                $home = new IndexHomeController();
                $home->load('orderp');
            }else{
                die("
                <script>
                    location.href='".__DOM__."page/iniciar_sesion';
                </script>");
            }
            break;  
        case 'iniciar_sesion':
            if (!$statusSession) {
                $home = new IndexHomeController();
                $home->load('login');
            }else{
                die("
                <script>
                    location.href='".__DOM__."page/".$redTo."';
                </script>");
            }
            break; 

        case 'registro':
            if (!$statusSession) {
                $home = new IndexHomeController();
                $home->load('register');
            }else{
                die("
                <script>
                    location.href='".__DOM__."page/".$redTo."';
                </script>");
            }
            break; 

        case 'necesitasInicarSesion':
            if (!$statusSession) {
                $home = new IndexHomeController();
                $home->load('noSesionShop');
            }else{
                die("
                <script>
                    location.href='".__DOM__."page/".$redTo."';
                </script>");
            }
            break; 
            
            case 'car_shopping':
                if ($statusSession) {
                    $home = new IndexHomeController();
                    $home->load('carrito_compras');
                }else{
                    die("
                    <script>
                        location.href='".__DOM__."page/".$redTo."';
                    </script>");
                }
                break;     
                
            case 'details_order':
                if ($statusSession) {
                    $home = new IndexHomeController();
                    $home->load('details');
                }else{
                    die("
                    <script>
                        location.href='".__DOM__."page/".$redTo."';
                    </script>");
                }
                break; 

            case 'error_orden':
                    if ($statusSession) {
                        $home = new IndexHomeController();
                        $home->load('noOrder');
                    }else{
                        die("
                        <script>
                            location.href='".__DOM__."page/".$redTo."';
                        </script>");
                    }
                    break; 


            case 'order_ok':
                    if ($statusSession) {
                        $home = new IndexHomeController();
                        $home->load('orderok');
                    }else{
                        die("
                        <script>
                            location.href='".__DOM__."page/".$redTo."';
                        </script>");
                    }
                    break; 
                      case 'historial': 
                    if ($statusSession) {
                        $home = new IndexHomeController();
                        $home->load('historyOrders');
                    }else{
                        die("
                        <script>
                            location.href='".__DOM__."page/".$redTo."';
                        </script>");
                    }
                    break; 
            default:
            // PAGE DON'T FOUND
            echo "<div style='height: 100px; background-color: rgb(59, 24, 24);'></div><div class='container p-5'><h2>Página no localizada</h2></div>";
            break;
        }
        // // FOOTER HTML
        // if (FUNCT !== 'registro' && FUNCT !== 'iniciar_sesion') {
        //     include_once 'landing-page/views/footer.php';
        // }
        include_once 'landing-page/views/footer.php';
}

// POST REQUEST
if ($methodRequest === 'POST') {
    #...
}

?>
