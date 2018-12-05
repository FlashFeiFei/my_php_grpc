<?php

namespace App\MyRoutes;

use Laravel\Lumen\Routing\Router;

interface RouteInterface
{
    //安装路由
    public function map(Router $router);
}