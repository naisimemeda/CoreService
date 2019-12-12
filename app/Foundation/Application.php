<?php
namespace App\Foundation;

use App\Container\Container;
use App\Routing\RoutingServiceProvider;

class Application extends Container
{

    protected $hasBeenBootstrapped = false;

    /**
     * 记录已经加载过的 类名为键, 值 true
     *
     * @var array
     */
    protected $loadedProviders = [];

    /**
     * 存储加载好了的服务提供者
     * @var array
     */
    protected $serviceProviders = [];

    public function __construct($basePath = null)
    {
        $this->registerBaseBindings();
//        $this->registerBaseServiceProviders();
    }

    protected function registerBaseBindings()
    {

        $this->instance('app', $this);

        $this->instance(Container::class, $this);
    }

    /**
     * 注册基础服务
     */
    protected function registerBaseServiceProviders()
    {
        $this->register(new RoutingServiceProvider($this));
//        $this->registerCoreContainerAliases();
    }

    public function register($provider)
    {

        if (is_string($provider)) {
            $provider = $this->resolveProvider($provider);
        }

        $provider->register();

        //检查该服务是否拥有 bindings 属性 并绑定至容器
        if (property_exists($provider, 'bindings')) {
            foreach ($provider->bindings as $key => $value) {
                $this->bind($key, $value);
            }
        }
        //检查该服务是否拥有 singletons 属性 并绑定至容器 单列
        if (property_exists($provider, 'singletons')) {
            foreach ($provider->singletons as $key => $value) {
                $this->singleton($key, $value);
            }
        }

        $this->markAsRegistered($provider);

        return $provider;
    }

    /**
     * 标记为注册
     * @param  $provider
     * @return void
     */
    protected function markAsRegistered($provider)
    {
        $this->serviceProviders[] = $provider;

        $this->loadedProviders[get_class($provider)] = true;
    }



    public function resolveProvider($provider)
    {
        return new $provider($this);
    }

    /**
     *
     * @return void
     */
    public function registerCoreContainerAliases()
    {
        foreach (['app' => [self::class],] as $key => $aliases) {
            foreach ($aliases as $alias) {
                $this->alias($key, $alias);
            }
        }
    }

    public function hasBeenBootstrapped()
    {
        return $this->hasBeenBootstrapped;
    }

    public function bootstrapWith(array $bootstrappers)
    {
        $this->hasBeenBootstrapped = true;
        foreach ($bootstrappers as $bootstrapper) {
            $this->make($bootstrapper)->bootstrap($this);
        }
    }
}
