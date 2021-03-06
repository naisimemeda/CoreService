<?php

namespace App\Http;

use App\Container\Http\Kernel as HttpKernel;
use App\Foundation\Application;

class Kernel implements HttpKernel
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    protected $bootstrappers = [
        \App\Foundation\Bootstrap\RegisterFacades::class,
    ];

    public function handle()
    {
        $this->bootstrap();
    }

    public function bootstrap()
    {
        if (! $this->app->hasBeenBootstrapped()) {
            $this->app->bootstrapWith($this->bootstrappers());
        }
    }

    protected function bootstrappers()
    {
        return $this->bootstrappers;
    }

    public function getApplication()
    {
        return $this->app;
    }
}
