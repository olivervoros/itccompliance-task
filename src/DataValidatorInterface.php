<?php

namespace App;

interface DataValidatorInterface {

    public function validateApiResult(string $apiReturn);
}