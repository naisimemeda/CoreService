<?php

namespace App\Contracts\Http;

interface Kernel
{
    public function bootstrap();

    public function handle();
}
