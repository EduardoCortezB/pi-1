<?php 
session_start();

function viewImage($nameImg){
  echo '
    <img src="'.__DOM__ .'img/products/' . $nameImg .'" style="width: 150px; height: 150px;">
  ';
}

$statusSession = (isset($_SESSION['status-session'])) ? true : false;
$userName = (isset($_SESSION['name'])) ? $_SESSION['name'] : false;
$rol = (isset($_SESSION['rol'])) ? $_SESSION['rol'] : false;



include_once '../global.php';
include_once 'views/header.php';
include_once '../conexion/conexion.php';
include_once 'models/products.model.php';
include_once 'controllers/products.forms.controller.php';

if ($statusSession) {
  if ($rol == '4') {

    // Instances
    $products = new ctl_form_controller();

    switch ($_GET['page']) {
        case 'inicio':
          include_once 'views/listProducts.php';
          break;
        case 'uploadFile':
          include_once 'views/addProducts.php';
          break;
        case 'list':
          include_once 'views/listProducts.php';
          break;

        case 'list_normalOrders':
          include_once 'views/listNormalOrders.php';
          break;

          case 'view_order':
            include_once 'views/view_order.php';
            break;

            case 'users':
              include_once 'views/listUsers.php';
              break;
      default:
        # code...
        break;
    }

    include_once 'views/footer.php';
  }else{
    die("
    <script>
        location.href='".__DOM__."page/inicio';
    </script>");
  }
}else{
  // no session
  die("
  <script>
      location.href='".__DOM__."page/inicio';
  </script>");
}
?>
  