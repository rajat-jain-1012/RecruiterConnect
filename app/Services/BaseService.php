<?php

namespace App\Services;

class BaseService {

    public static function make() {
        return new static;
    }
}
