<?php

namespace App\Foundation;

class AliasLoader
{
    protected static $instance;

    protected $aliases;

    protected $registered = false;

    private function __construct($aliases)
    {
        $this->aliases = $aliases;
    }

    public static function getInstance(array $aliases = [])
    {
        if (is_null(static::$instance)) {
            return static::$instance = new static($aliases);
        }

        $aliases = array_merge(static::$instance->getAliases(), $aliases);

        static::$instance->setAliases($aliases);

        return static::$instance;
    }

    public function register()
    {
        if (!$this->registered) {
            $this->prependToLoaderStack();

            $this->registered = true;
        }
    }

    public function getAliases()
    {
        return $this->aliases;
    }

    public function setAliases(array $aliases)
    {
        $this->aliases = $aliases;
    }

    protected function prependToLoaderStack()
    {
        spl_autoload_register([$this, 'load'], true, true);
    }

    public function load($alias)
    {
        if (isset($this->aliases[$alias])) {
            return class_alias($this->aliases[$alias], $alias);
        }
    }
}
