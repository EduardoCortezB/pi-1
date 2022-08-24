<?php
session_start();
//https://www.weblantropia.com/2016/08/30/restful-api-api-php-mysql/

/* === [HEADERS CONFIGURATION]  === */
header("Access-Control-Allow-Origin: http://localhost");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

/* === [FILES CONFIGURATION]  === */
include_once '../global.php';
include_once '../conexion/conexion.php';
include_once 'models/products.model.php';
include_once 'controllers/products.controller.php';
include_once '../landing-page/models/auth.model.php';
include_once '../landing-page/controllers/auth.controller.php';
include_once '../landing-page/models/products.model.php';
include_once 'models/order.model.php';

/* === [GET CONFIGURATION]  === */
$methodRequest = $_SERVER['REQUEST_METHOD'];

$action = str_validation(isset($_GET['action']) ? $_GET['action'] : null);
$version = str_validation(isset($_GET['version']) ? $_GET['version'] : null);

/* === [POST CONFIGURATION] === */
$proccess = str_validation(isset($_POST['proccess']) ? $_POST['proccess'] : null);

/* === [JSON CONFIGURATION] === */
$json = json_decode(file_get_contents('php://input'),true);

/* === [PROCCESS CSRF] === */
//api-ad/$action/$version
//api-ad/proceso/version
//dashboard/api.php?action=&version=1

if ($methodRequest == 'GET') {
    if ($_GET['action'] == 'get-products') {
        $product = new productsModel();
        die(json_encode($product->getListProducts()));
    }
}

/* === [DELETE METHOD] === */
if ($methodRequest == 'DELETE') {
    if ($_GET['action'] == 'delProduct') {
        $connection = new conection();
        $pdo = $connection->connect_pdo();
        $id_ = isset($_GET['id']) ? $_GET['id'] : null;

        $sentenciaSQL = $pdo->prepare("SELECT image FROM products WHERE idProduct=:id");
        $sentenciaSQL->bindParam(':id', $id_);
        $sentenciaSQL->execute();
        $product=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
                  
        if(isset($product["image"]) && ($product["image"]!="image.jpg")){
            if(file_exists(__DIR_UP_IMG__.$product["image"])){
                unlink(__DIR_UP_IMG__.$product["image"]);
            }
        }
            
        try{
            $sentenciaSQL = $pdo->prepare("DELETE FROM products WHERE idProduct=:id");
            $sentenciaSQL->bindParam(':id', $id_);
            if($sentenciaSQL->execute()){
                die(json_encode(['success'=>'ok']));
            }
        }catch(PDOException $e){
            echo $e;
            echo json_encode(['success'=>'error']);
        }
    }
}

/* === [MANAGER OF METHOD] === */
switch ($action) {
    case 'upload':

        // that is going up
        switch ($proccess) {
            // case 'delProduct':
            //     $connection = new conection();
            //     $pdo = $connection->connect_pdo();
            //     $id_ = isset($_POST['id']) ? $_POST['id'] : null;

            //         $sentenciaSQL = $pdo->prepare("SELECT image FROM products WHERE idProduct=:id");
            //         $sentenciaSQL->bindParam(':id', $id_);
            //         $sentenciaSQL->execute();
            //         $product=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
                  
            //         if(isset($product["image"]) && ($product["image"]!="image.jpg")){
            //             if(file_exists(__DIR_UP_IMG__.$product["image"])){
            //               unlink(__DIR_UP_IMG__.$product["image"]);
            //             }
            //         }
                  
            //         try{
            //             $sentenciaSQL = $pdo->prepare("DELETE FROM products WHERE idProduct=:id");
            //             $sentenciaSQL->bindParam(':id', $id_);
            //             if($sentenciaSQL->execute()){
            //                 echo json_encode(['success'=>'ok']);
            //             }
            //         }catch(PDOException $e){
            //             echo $e;
            //             echo json_encode(['success'=>'error']);
            //         }

            //     break;
            case 'add-product':

                // add new product
                $name = str_validation(isset($_POST['nameProduct']) ? $_POST['nameProduct'] : null);
                $description = str_validation(isset($_POST['descProduct']) ? $_POST['descProduct'] : null);
                $price = str_validation(isset($_POST['priceProduct']) ? $_POST['priceProduct'] : null);
                $category = str_validation(isset($_POST['categoryProduct']) ? $_POST['categoryProduct'] : null);
                $image = isset($_FILES['imgProduct']) ? $_FILES['imgProduct'] : null;
                $nameImage = isset($_POST['nameImg']) ? $_POST['nameImg'] : null;

                // initilize the controller for products
                $products = new dash_controller_products();
                $products->addProduct($name, $description,$category, $price, $image, $nameImage);

            break;

            case 'update-product':
                // update product
                $name = str_validation(isset($_POST['nameProduct']) ? $_POST['nameProduct'] : null);
                $description = str_validation(isset($_POST['descProduct']) ? $_POST['descProduct'] : null);
                $price = str_validation(isset($_POST['priceProduct']) ? $_POST['priceProduct'] : null);
                $category = str_validation(isset($_POST['categoryProduct']) ? $_POST['categoryProduct'] : null);

                $isFile = str_validation(isset($_POST['isFile']) ? $_POST['isFile'] : null);
                $image = isset($_FILES['imgProduct']) ? $_FILES['imgProduct'] : null;
                $nameImage = isset($_POST['nameImg']) ? $_POST['nameImg'] : null;
                $idOldProduct = isset($_POST['idOldImg']) ? $_POST['idOldImg'] : null;

                // initilize the controller for products
                $products = new dash_controller_products();
                $products->updateProduct($name, $description,$category, $price, $image, $nameImage,$idOldProduct,$isFile);
            break;

            case 'get-categories':
                $products = new dash_controller_products();

                echo json_encode($products->getCategoriesU());

            break;

            case 'get-product':
                $idPoroduct = str_validation(isset($_POST['idPoroduct']) ? $_POST['idPoroduct'] : null);
                if ($idPoroduct !== null || $idPoroduct !== '') {
                    // initilize the controller for add products
                    $products = new dash_controller_products();
                    $list =$products->getProduct($idPoroduct);
                    
                    die(json_encode($list));
                }else{
                    die('error-PB-vald-01');
                }
                
                break;
            case 'get-products':    
                $idPoroduct = isset($_POST['idProduct']) ? str_validation($_POST['idProduct']) : null;
                $product = new productsModel();
                if ($idPoroduct === null) {
                    echo json_encode($product->getListProducts());  
                }else{
                    echo json_encode($product->getListByProducts($idPoroduct));
                }
                
            break;

            case 'get-products-cart':    
                $listProd = isset($_POST['list']) ? str_validation($_POST['list']) : null;
                $product = new productsModel();
                $i = 0;
                $response=[];
                foreach(json_decode($listProd) as $idProduct){
                    $response[$i] = $product->getListProductsForCart($idProduct);
                    $i++;
                }

                echo json_encode($response);
                $i=null;
            break;
            default:
                die('error-PB-02');
                break;
        }

    break;


    case 'request':

        switch ($json['proccess']) {
            case '1':
                // login
                $email = isset($json['mail']) ? filter_var(strtolower($json['mail']), FILTER_SANITIZE_EMAIL) : null;
                $password = isset($json['pwd']) ? str_validation($json['pwd']) : null;

                $auth = new Auth_controller();
                $auth->login($email, $password);

            break;

            case '2':
                // sign up
                $fName = isset($json['fName']) ? str_validation($json['fName']) : null;
                $lName = isset($json['lName']) ? str_validation($json['lName']) : null;
                $number = isset($json['number']) ? str_validation($json['number']) : null;
                $email = isset($json['email']) ? filter_var(strtolower($json['email']), FILTER_SANITIZE_EMAIL) : null;
                $password = isset($json['pwd1']) ? str_validation($json['pwd1']) : null;

                $auth = new Auth_controller();
                $auth->register($fName, $lName, $email, $number, $password);

            break;

            case '3':
                // log out

                $idUser = isset($json['idUser']) ? str_validation($json['idUser']) : null;
                $auth = new Auth_controller();

                $auth->logOut($idUser);

            break;

            case '4':
                
                // verificamos si hay una sesion activa
                $statusSession = (isset($_SESSION['status-session'])) ? true : false;

                if ($statusSession == true) {
                    echo json_encode([
                        'estatus' => 'ok'
                    ]);
                }
                if ($statusSession == false) {
                    echo json_encode([
                        'estatus' => 'nel'
                    ]);
                }

            break;
            default:
                # code...
                break;
        }

    break;

    case 'order': 
        $order = new Orders_Model();
        $proccess = isset($json['proccess']) ? str_validation($json['proccess']) : null;
        
        switch ($proccess) {
            case '0':
                $idUser = isset($json['user']) ? str_validation($json['user']) : null;
                // validamos si existe una orden activa
                echo json_encode($order->getOrderActive($idUser));
                break;




                case '1': // REALIZAR ORDEN
                
                
                $idUser = isset($json['user']) ? str_validation($json['user']) : null;
                $idOrder = isset($json['payload'][0]) ? str_validation($json['payload'][0]) : null;
                $nxt=false;
                // var_dump(str_validation($key)); // position of element
                // var_dump(str_validation($value[0][1])); // id product
                // var_dump(str_validation($value[1][1])); // price product
                // var_dump(str_validation($value[2][1])); // qty product

                foreach ($json['payload'][1] as $key => $value) {
                    $price_product = $order->getPriceProduct(str_validation($value[0][1]));
                    if($price_product !== false) {
                        if($order->addProductOrderDB($idOrder,str_validation($value[0][1]),$price_product,str_validation($value[2][1]))){
                            $nxt = true;
                        }
                    }else{
                        // eliminamos los productos agregados de la base de datos
                        $order->purgueProductOrderDB($idOrder);

                        echo json_encode(['status'=> 'nel']);
                        return;
                    }
                }
                if($order->doOrderActive($idOrder)){
                    $nxt = true;
                }else{
                    $nxt = false;
                }
                if ($nxt) {
                    echo json_encode(['status'=> 'ok', 'order'=> $idOrder]);
                }else{
                    $order->purgueProductOrderDB($idOrder);
                    // eliminamos los productos agregados de la base de datos
                    echo json_encode(['status'=> 'nel','w']);
                }
            break;     
            case '2': // AGREGAR PRODUCTO A ORDEN
                $idProduct = isset($json['idProduct']) ? str_validation($json['idProduct']) : null;
                $idOrder = isset($json['idOrder']) ? str_validation($json['idOrder']) : null;

                echo json_encode($order->addProductOrderDB($idOrder,$idProduct,));
                
            break;  
            case '3': // ELIMINAR PRODUCTO DE ORDEN
                $idProduct = isset($json['idProduct']) ? str_validation($json['idProduct']) : null;
                $idOrder = isset($json['idOrder']) ? str_validation($json['idOrder']) : null;
                
                echo json_encode($order->deleteProductOrderDB($idOrder,$idProduct));
                
            break; 
            
            case '4': // VALIDAMOS SI HAY UNA ORDEN ACTIVA
                $idUser = isset($json['idUser']) ? str_validation($json['idUser']) : null;

                echo json_encode($order->isOrder($idUser));           
            break; 

            case '5': // activamos orden
                $connection = new conection();
                $pdo = $connection->connect_pdo();

                $idUser = isset($json['idUser']) ? str_validation($json['idUser']) : null;
                $idOrder = isset($json['order']) ? str_validation($json['order']) : null;
                $address = isset($json['address']) ? str_validation($json['address']) : null;
                $cpp = isset($json['cpp']) ? str_validation($json['cpp']) : null;
                $total = isset($json['total']) ? str_validation($json['total']) : null;
                $date = isset($json['date']) ? str_validation($json['date']) : null;

                
                try{
                    $sentenciaSQL = $pdo->prepare("INSERT INTO address 
                    (idAddress, idUser, address, cpp) VALUES (NULL, ?, ?, ?);");
                    
                    $sentenciaSQL->bindParam(1, $idUser);
                    $sentenciaSQL->bindParam(2, $address);
                    $sentenciaSQL->bindParam(3, $cpp);
                    $sentenciaSQL->execute();

                    $sentenciaSQL = $pdo->prepare("SELECT * FROM address WHERE idUser=?");
                    
                    $sentenciaSQL->bindParam(1, $idUser);
                
                    $sentenciaSQL->execute();
                    $ADRR = $sentenciaSQL->fetch(PDO::FETCH_ASSOC);


                    $idAddress=$ADRR['idAddress'];


                    $sentenciaSQL = $pdo->prepare("UPDATE normalorders
                    SET idAddress = ?, statusNotify = '1', `isOpenOrder` = '0', `statusOrder` = '1', dateDelivery =?, total = ?
                    WHERE normalorders.idOrder = ? ");

                    $sentenciaSQL->bindParam(1, $idAddress);
                    $sentenciaSQL->bindParam(2, $date);
                    $sentenciaSQL->bindParam(3, $total);
                    $sentenciaSQL->bindParam(4, $idOrder);


                    if($sentenciaSQL->execute()){
                        die(json_encode(['response'=>'ok']));
                    }


                }catch(PDOException $e){
                    die($e);
                }
                    

            break;             
            default:
                die('error-PB-ORD-01');
                break;
        }
    break;

    default:
        die('error-PB-02');
        break;
}
?>
