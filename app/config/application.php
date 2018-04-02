<?php
//phalcon app基本配置
return [
    'loader' => [
        'dirs'       => [
            'controllersDir' => APP_PATH . '/controllers/',
            'modelsDir'      => APP_PATH . '/models/',
            'libraryDir'     => APP_PATH . '/library/',
            'pluginsDir'     => APP_PATH . '/plugins/',
        ],
        //自定义额外的命名空间，也可以在composer.json中采用psr-4方式加载
        'namespaces' => [
        ],
        'prefixes'   => [
        ],
    ],

    //视图目录设置
    'view'   => [
        'viewsDir' => APP_PATH . '/views/',
    ],

    /**
     * 静态资源url设置
     * @link http://docs.phalconphp.com/zh/latest/reference/url.html
     * @link http://docs.phalconphp.com/zh/latest/api/Phalcon_Mvc_Url.html
     */
    'url'    => [
        'baseUri'       => '/',
        'staticBaseUri' => '/',
    ],
];
