<?php

namespace App\Foundation\Bootstrap;

use App\Foundation\AliasLoader;
use App\Foundation\Application;
use App\Support\Facades\AuthFacade;
use App\Support\Facades\Facade;

class RegisterFacades
{
    public function bootstrap(Application $app)
    {
       Facade::setFacadeApplication($app);
       AliasLoader::getInstance([
            'Auth' => AuthFacade::class,
        ])->register();
    }
}
