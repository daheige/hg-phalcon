<?php
/**服务容器
 * 一个请求可以使用多个服务，单独注册每个服务可以说是一个繁重的任务
 * 框架提供了 Phalcon\Di 的一个变种，称作 Phalcon\Di\FactoryDefault
 * 其任务是注册所有MVC所需要的服务来提供一个全栈框架
 */

/**
 * Setting up the view component
 * 采用惰性加载view为服务
 * @link http://docs.phalconphp.com/zh/latest/reference/views.html
 * @link http://www.myleftstudio.com/reference/tutorial.html#dependency-management
 */

// Setup the view component
$di->set('view', function () use (&$config) {
    $view = new Phalcon\Mvc\View();
    $view->setViewsDir($config->view->viewsDir);
    $view->registerEngines([
        '.tpl' => 'Phalcon\Mvc\View\Engine\Php',
    ]);

    return $view;
});

// Setup a base URI so that all generated URIs include the "tutorial" folder
$di->set('url', function () use (&$config) {
    $url = new Phalcon\Mvc\Url();
    $url->setBaseUri($config->url->baseUri);
    $url->setStaticBaseUri($config->url->staticBaseUri);

    return $url;
});

//set router
$di->set('router', function () {
    return include_once APP_PATH . '/routes/web.php';
});

$di->set('session', function () {
    $session = new Phalcon\Session\Adapter\Files();
    $session->start();

    return $session;
});

// Setup the database service
$di->set('db', function () {
    return new Phalcon\Db\Adapter\Pdo\Mysql([
        "host"     => "localhost",
        "username" => "root",
        "password" => "1234",
        "dbname"   => "test",
    ]);
});
