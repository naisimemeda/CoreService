<?php

namespace App\Support\Facades;
/**
 * @method static void Login();
 */
class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Auth';
    }
}
