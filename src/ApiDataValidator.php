<?php

namespace App;

class ApiDataValidator implements ApiDataValidatorInterface
{

    public function validateApiResult(string $input) {

        if(! $this->isResultValidJSON($input)) {
            return false;
        }

        $resultArray = json_decode($input, TRUE);

        if($this->isResultEmpty($resultArray)) {

            return false;
        }

        if($this->isResultHasError($resultArray)) {
            return false;
        }

        return $resultArray;


    }

    public function isResultValidJSON(string $input):bool {
        if (!empty($input)) {

            @json_decode($input);

            return (json_last_error() === JSON_ERROR_NONE);

        }

        return false;
    }

    public function isResultEmpty($resultArray):bool {
        return (empty($resultArray) AND empty($resultArray['products']));
    }

    public function isResultHasError($resultArray):bool {
        return (!empty($resultArray) AND !empty($resultArray['error']));
    }

}