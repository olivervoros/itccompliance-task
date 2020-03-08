<?php

namespace App;

class ProductsManager
{
    public function getListOfProducts(ApiHelperInterface $apiHelper, ApiDataValidatorInterface $validate, Logger $logger):array {
        $result =  $apiHelper->callAPI('GET', $_ENV['API_URL_GET_ALL'], false);
        $logger->log("INFO", $result);
        $validatedApiResultArray = $validate->validateApiResult($result);
        if($validatedApiResultArray === false) {
            return $this->getListOfProducts($apiHelper, $validate, $logger);
        }
        return $validatedApiResultArray['products'];
    }

    public function getProductDetail(ApiHelperInterface $apiHelper, ApiDataValidatorInterface $validate, string $productId):array {
        $result = $apiHelper->callAPI('GET', $_ENV['API_URL_GET_DETAIL'], ["id" => $productId]);
        $validatedApiResultArray = $validate->validateApiResult($result);
        if($validatedApiResultArray === false) {
            return $this->getProductDetail($apiHelper, $validate,  $productId);
        }
        return $validatedApiResultArray;
    }
}