<?php

class productsController extends productsModel {
    function __construct(){ }

    function showProductsPopular(){
        $list = ($this->getListProducts_() !== false) ? $this->getListProducts_() : null;
        if ($list === null) {
          echo 'error';
        }else{
          foreach ($list as $row) {
              echo '
                 <div class="col-xl-4 col-md-6">
                      <div class="single_order card">
                         <div class="order_thumb card-header">
                             <img src="'.__DOM__ .'img/products/' . $row['image'] .'" style="width: 300px; height: 250px;">
                             <div class="order_prise">
                                 <span>'.$row['priceUnit'].'</span>
                             </div>
                         </div>
                          <div class="order_info card-body">
                             <h3><a href="#">'. $row['name'] .'</a></h3>
                             <p>' . $row['description'] .'</p>
                              <a href="'.__DOM__ .'page/menu' .'" class="boxed_btn">Ir al menu</a>
                          </div>
                      </div>
                  </div>
              ';
          }
        }

    }
}
?>
