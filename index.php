<?php

namespace App;
require 'vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;
$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

if($_ENV['DEV_MODE']==='true') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}


// CLIENT CODE, in a larger MVC application this code would be in the Controller...
$apiHelper = new ApiHelper();
$validate = new ApiDataValidator();

$productsManager = new ProductsManager();

$products = $productsManager->getListOfProducts($apiHelper, $validate);
$productsWithDetail = array();
foreach($products as $productId => $product) {
    $productsDetail = $productsManager->getProductDetail($apiHelper, $validate, $productId);
    if(key($productsDetail)===$productId) {
        $productsWithDetail[$productId]['detail'] = $productsDetail[$productId];
    }

}
require 'viewHelper.php';
require 'view.php';


