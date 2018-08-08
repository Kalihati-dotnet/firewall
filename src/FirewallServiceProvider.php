<?php
namespace NV\Firewall;

//use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use NV\Firewall\FirewallFacade;


class FirewallServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
        $loader = AliasLoader::getInstance();
        $loader->alias('Firewall', FirewallFacade::class);
        $this->registerFirewall();

    }

    protected function registerFirewall()
    {
        $this->app->singleton('firewall', function ($app) {
            return new Firewall($app);
        });
    }
}
