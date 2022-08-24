<?php

class IndexHomeController {
    private $section;
    public function load($section){
        $this->section = $section;
        include_once 'landing-page/views/' . $this->section . '.php';
    }

} 


?>