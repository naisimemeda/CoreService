<?php
$app = new App\Foundation\Application(
    dirname(__DIR__)
);

$app->singleton(App\Contracts\Http\Kernel::class, App\Http\Kernel::class);

return $app;
