<?php
/**
 * Created by PhpStorm.
 * User: liangyu
 * Date: 2018/12/5
 * Time: 11:48
 */

namespace App\Providers;

use App\MyRoutes\Collection\Collection;
use Illuminate\Support\ServiceProvider;
use \Laravel\Lumen\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{

    protected $namespace = 'App\Http\Controllers';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * @var $router Router
         */
        $router = $this->app->router;
        $router->group(['namespace' => $this->namespace,], function () use($router){
            (new Collection())->map($router);
        });
    }
}