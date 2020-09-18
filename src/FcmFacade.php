<?php

namespace Angga\Fcm;

use Illuminate\Support\Facades\Facade;

/**
 * Class FcmFacade
 * @package Angga\Fcm\Facades
 */
class FcmFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fcm';
    }
}
