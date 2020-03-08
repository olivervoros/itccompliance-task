<?php

namespace App;

interface ApiDataValidatorInterface {

    public function validateApiResult(string $apiReturn);
}