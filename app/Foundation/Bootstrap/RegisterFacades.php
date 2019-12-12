<?php

namespace App\Foundation\Bootstrap;

use App\Foundation\AliasLoader;
use App\Foundation\Application;
use App\Support\Facades\Auth;

class RegisterFacades
{
    public function bootstrap(Application $app)
    {
        var_dump([
            'Auth' => Auth::class,
        ]);die;
        AliasLoader::getInstance([
            'Auth' => Auth::class,
        ])->register();
    }
}
