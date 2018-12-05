<?php
/**
 * Created by PhpStorm.
 * User: liangyu
 * Date: 2018/12/5
 * Time: 11:52
 */

namespace App\MyRoutes\Collection;

use App\MyRoutes\RouteInterface;
use Laravel\Lumen\Routing\Router;

class Collection implements RouteInterface
{

    public function map(Router $router)
    {
        $router->group(['namespace' => 'Collection'], function () use ($router) {
            $router->get('/collection', 'CollectionController@collection');
        });
    }
}