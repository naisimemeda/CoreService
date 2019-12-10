<?php

namespace Nice\Support;

abstract class ServiceProvider
{
    protected $app;


    public function __construct($app)
    {
        $this->app = $app;
    }

    public function register()
    {
        //
    }
}