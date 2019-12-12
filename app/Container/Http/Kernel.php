<?php

namespace App\Container\Http;

interface Kernel
{
    public function bootstrap();

    public function handle();

    public function getApplication();

}
