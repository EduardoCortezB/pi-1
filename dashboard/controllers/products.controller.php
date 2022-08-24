<?php

class dash_controller_products extends dash_model_products {
    private $continue;
    private $idProduct;
    function __construct() {
        $this->continue=true;
    }

    public function addProduct($name,$description,$category,$price,$image,$imageName){

        /* === [UPLOAD IMAGE TO SERVER] === */
        // verify that there isn't an error already
        if ($image['error'] == 0) {
            
            
            // verify that the name is correct
            $image['name'] = str_validation($imageName);
            if (check_file_uploaded_name($image['name'])) {
                try {
                  $upStatus=move_uploaded_file($image["tmp_name"], __DIR_UP_IMG__.$imageName.'.'.explode('/',$image['type'])[1]);
                } catch (\Exception $e) {
                  $this->continue=false;
                }


                if (!$upStatus) {
                    $this->continue=false;
                }

            }else{
                // nombre de la imagen invalido
                $this->continue=false;
            }
        }else {
            // Error al subir la imagen al servidor
            $this->continue=false;
        }

        if ($this->continue !== false) {
            // all right.
            // subir la informacion a mysql
            $ext = explode('/',$image['type'])[1];
            $nnImg='';
            $nnImg = $imageName .'.'. $ext;
            
            if ($this->addProductToDb($name,$description,$category,$price,$image['name'],$nnImg)) {
                $return = [
                    'statusHttp'    => '200',
                    'statusProccess'=> 'ok',
                ];

                echo json_encode($return);
            }else{
                $return = [
                    'statusHttp'    => '203',
                    'statusProccess'=> false,
                    'message'       =>'error with the database has ocurred'
                ];
                echo json_encode($return);
            }
        }else{
            $return = [
                'statusHttp'    => '203',
                'statusProccess'=> false
            ];
            echo json_encode($return);
        }
    }
    public function updateProduct($name,$description,$category,$price,$image,$imageName,$idOldProduct,$isFile){
        // idOldImg
        $arrOldProduct = $this->getProductData($idOldProduct);

        // validamos si el producto esta en la database
        if ($idOldProduct != $arrOldProduct['idProduct']) {
            $this->continue=false;
            var_dump("id.not.db");

        }

        // upload update with image
        if ($isFile == '1') {

            // DELETE LAST IMAGE

            if(isset($arrOldProduct['image']) && ($arrOldProduct['image']!="image.jpg")){
                if(file_exists(__DIR_UP_IMG__.$arrOldProduct['image'])){
                  if(!unlink(__DIR_UP_IMG__.$arrOldProduct['image'])) {
                        $this->continue=false;
                        var_dump("img-del-last-img");
                    }
                }
            }

            /* === [UPLOAD NEW IMAGE TO SERVER] === */
            // verify that there isn't an error already

            if ($image['error'] == 0) {

                // verify that the name is correct
                $image['name'] = str_validation($imageName);
                if (check_file_uploaded_name($image['name'])) {
                    $upStatus=move_uploaded_file($image["tmp_name"], __DIR_UP_IMG__.$imageName.'.'.explode('/',$image['type'])[1]);

                    if (!$upStatus) {
                        $this->continue=false;
                        var_dump("img-folder-up");
                    }

                }else{
                    // nombre de la imagen invalido
                    $this->continue=false;
                    var_dump("img-name-no-valid");

                }
            }else {
                // Error al subir la imagen al servidor
                $this->continue=false;
                var_dump("img-err-to-server");

            }

            if ($this->continue !== false) {
                // all right.
                // subir la informacion a mysql
                $ext = explode('/',$image['type'])[1];
                $nnImg='';
                $nnImg = $imageName .'.'. $ext;

                // update information to database
                if ($this->updateProductDB($name,$description,$category,$price,$nnImg,$arrOldProduct['idProduct'])) {
                    $return = [
                        'statusHttp'    => '200',
                        'statusProccess'=> 'ok',
                    ];

                    echo json_encode($return);
                }
            }else{
                $return = [
                    'statusHttp'    => '203',
                    'statusProccess'=> false
                ];
                echo json_encode($return);
            }

        }else{
            if ($this->continue) {
                $imageName=str_validation($arrOldProduct['image']);
                // update information to database
                if ($this->updateProductDB($name,$description,$category,$price,$imageName,$arrOldProduct['idProduct'])) {
                    $return = [
                        'statusHttp'    => '200',
                        'statusProccess'=> 'ok',
                    ];

                    echo json_encode($return);
                }else{
                    $return = [
                        'statusHttp'    => '203',
                        'statusProccess'=> false,
                    ];

                    echo json_encode($return);
                }
            }else{
                $return = [
                    'statusHttp'    => '203-',
                    'statusProccess'=> false,
                ];

                echo json_encode($return);
            }

        }
    }
    public function getProduct($idProduct){
        $this->idProduct = $idProduct;

        return $this->getProductData($this->idProduct);
    }
    public function getCategoriesU(){
        return $this->getListCategory();
    }

    
}

?>
