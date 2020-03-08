<?php

namespace App;

interface ApiHelperInterface {

    public function callAPI($method, $url, $data);
}