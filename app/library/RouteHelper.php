<?php

namespace App\library;

//继承phalcon顶层路由规则
class RouteHelper extends \Phalcon\Mvc\Router
{
    public function add($pattern, $paths = null, $regex = null, $httpMethods = null)
    {
        // 设置占位符对应正则表达式
        $route = parent::add($pattern, $paths, $regex, $httpMethods);

        // Api-login => ApiLoginController
        $route->convert('controller', function ($controller) {
            return str_replace('-', '_', $controller);
        });

        // page-list => pageListAction
        $route->convert('action', function ($action) {
            return camel(str_replace('-', '_', $action));
        });

        return $route;
    }
}
