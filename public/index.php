<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(App\Container\Http\Kernel::class);
$response = $kernel->handle();

Auth::Login();
