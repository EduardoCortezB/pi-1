<?php
// const __DOM__ = 'http://localhost/PI/pi1-1/';
const __DOM__ = 'http://localhost/public_html/';
// var_dump($_SERVER['DOCUMENT_ROOT']);
const __DIR_UP_IMG__ = 'C:/xampp/htdocs/public_html/img/products/';
//const __DIR_UP_IMG__ = 'C:/xampp/htdocs/PI/pi1-1/img/products/';
const __DIR_MAIN__ = '/home/u620138192/domains/pishybakes.online/public_html/';

function str_validation($vp_string){
    $vp_string = trim($vp_string);
    $vp_string = html_entity_decode($vp_string);
    $vp_string = strip_tags($vp_string);
    return $vp_string;
}

function check_file_uploaded_name ($filename){
    return (bool) ((preg_match("`^[-0-9A-Z_\.]+$`i",$filename)) ? true : false);
}


/*if (isset(_SERVER['HTTP_CF_CONNECTING_IP'])){
    _SERVER[‘REMOTE_ADDR’] = $_SERVER[‘HTTP_CF_CONNECTING_IP’];
} */
/*var_dump($_SERVER['HTTP_CF_CONNECTING_IP']);
var_dump($_SERVER['REMOTE_ADDR']);
var_dump($_SERVER['HTTP_CF_CONNECTING_IP']);*/
?>