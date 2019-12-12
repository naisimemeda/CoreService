<?php

namespace App\Http;

use App\Contracts\Http\Kernel as HttpKernel;
use App\Foundation\Application;

class Kernel
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    protected $bootstrappers = [
        \App\Foundation\Bootstrap\RegisterFacades::class,
    ];

    public function bootstrap()
    {
    }

    public function handle()
    {
        var_dump($this->app);die;
    }
}
