<?php

namespace App;

class ProductsManager
{
    public function getListOfProducts(ApiHelperInterface $apiHelper, DataValidatorInterface $validate):array {
        $result =  $apiHelper->callAPI('GET', $_ENV['API_URL_GET_ALL'], false);
        $validatedApiResultArray = $validate->validateApiResult($result);
        if($validatedApiResultArray === false) {
            return $this->getListOfProducts($apiHelper, $validate);
        }
        return $validatedApiResultArray['products'];
    }

    public function getProductDetail(ApiHelperInterface $apiHelper, DataValidatorInterface $validate, string $productId):array {
        $result = $apiHelper->callAPI('GET', $_ENV['API_URL_GET_DETAIL'], ["id" => $productId]);
        $validatedApiResultArray = $validate->validateApiResult($result);
        if($validatedApiResultArray === false) {
            return $this->getProductDetail($apiHelper, $validate,  $productId);
        }
        return $validatedApiResultArray;
    }
}