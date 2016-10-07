<?php

namespace App\Util;
use Illuminate\Support\Facades\Facade;

class CategoryTreeOutputFacade extends Facade{
    protected static function getFacadeAccessor() { return 'categorytree'; }
}
