<?php
/**
 * 路由配置
 *
 * @link http://docs.phalconphp.com/zh/latest/reference/routing.html
 * @link http://docs.phalconphp.com/zh/latest/api/Phalcon_Mvc_Router.html
 */

$router = new \App\library\RouteHelper();

// 删除多余的斜线
$router->removeExtraSlashes(true);

//设置默认控制器和方法
$router->setDefaultController('index');
$router->setDefaultAction('index');

// 支持指定一个数字参数，例如：/post/detail/1 or /post/detail/1.html
// 设置占位符对应正则表达式
$router->add(
    '/:controller/:action/:params(\.html)?',
    [
        'controller' => 1,
        'action'     => 2,
        'params'     => 3,
    ]
);

// 默认路由，例如：/post/list or /post/list.html
$router->add(
    '/:controller/:action(\.html)?',
    [
        'controller' => 1,
        'action'     => 2,
    ]
);

// 支持不指定 action，例如：/post.html
$router->add(
    '/:controller(\.html)?',
    [
        'controller' => 1,
        'action'     => 'index',
    ]
);

/**
 * api 专用路由配置
 */

$router->add(
    '/api/:controller/:action/:params',
    [
        'namespace'  => 'Api',
        'controller' => 1,
        'action'     => 2,
        'params'     => 3,
    ]
);

$router->add(
    '/api/:controller/:action',
    [
        'namespace'  => 'Api',
        'controller' => 1,
        'action'     => 2,
    ]
);

$router->add(
    '/api/:controller',
    [
        'namespace'  => 'Api',
        'controller' => 1,
        'action'     => 'index',
    ]
);

// Taking URI from $_GET["_url"]
$router->handle();

return $router;
