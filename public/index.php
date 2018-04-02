<?php
//入口文件
//加载系统常量
defined('ROOT_PATH') or define('ROOT_PATH', dirname(__DIR__));
defined('APP_PATH') or define('APP_PATH', ROOT_PATH . '/app');
define('VENDOR_PATH', ROOT_PATH . '/vendor');

require_once VENDOR_PATH . '/autoload.php';
// //启动应用
App\AppBoot::runApp();
