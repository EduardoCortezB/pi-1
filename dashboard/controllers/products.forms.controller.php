
<?php 
class ctl_form_controller extends dash_model_products {
    public function showOptionsCategories(){
        
        foreach($this->getListCategory() as $key){
            echo '<option value="'.$key[0].'">'.$key[1].'</option>';
        }
    }
}
?>