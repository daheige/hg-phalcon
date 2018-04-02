<?php
namespace App;

//app启动类
class AppBoot
{
    public static $_instance = null; //实例句柄
    public static function initEnvConf()
    {
        // 默认时区定义
        date_default_timezone_set('PRC');
        // 设置错误报告模式
        error_reporting(E_ALL);
        // 设置默认区域
        setlocale(LC_ALL, 'zh_CN.utf-8');
        // 设置内部字符默认编码为 UTF-8
        mb_internal_encoding('UTF-8');
        // 打开/关闭错误显示
        ini_set('display_errors', !IS_PRO);
        // 避免 cli 或 curl 模式下 xdebug 输出 html 调试信息
        ini_set('html_errors', !(IS_CLI || IS_CURL));
        // 使得在 api|ajax 模式下，输出 json 格式的错误信息
        if (API_MODE || IS_AJAX) {
            $_SERVER['HTTP_ACCEPT'] = 'application/json';
        }
    }

    public static function loadConstants()
    {
        //加载系统常量
        defined('ROOT_PATH') or define('ROOT_PATH', dirname(__DIR__));
        defined('APP_PATH') or define('APP_PATH', ROOT_PATH . '/app');
        require_once APP_PATH . '/bootstrap/constants.php';
    }

    //处理错误
    public static function handlError()
    {
        error_reporting(E_ALL & ~E_NOTICE);
        //获取 常见错误和fatal error
        register_shutdown_function("App\library\Slog::fatalHandler");
        set_error_handler("App\library\Slog::errorHandler", E_ALL | E_STRICT);
    }

    //运行app
    public static function runApp()
    {
        //初始化
        self::init();
        self::run();
    }

    //启动phalcon应用
    public static function run()
    {

        try {
            /**
             * Read the configuration
             */
            if (!$config = config('application')) {
                exit('Application configuration failed to load');
            }

            // Register an autoloader
            $loader = new \Phalcon\Loader();
            include_once APP_PATH . '/bootstrap/loader.php';

            /**Create a DI
             * 加载服务器容器，惰性加载服务组件
             */
            $di = new \Phalcon\Di\FactoryDefault();
            include_once APP_PATH . '/bootstrap/services.php';

            // Handle the request
            $application = new \Phalcon\Mvc\Application($di);
            echo $application->handle()->getContent();
            exit;
        } catch (\Exception $e) {
            echo "Exception: ", $e->getMessage();
            $message = sprintf(
                'errorno: [%d]: %s (in %s on line %d)\n',
                $e->getCode(),
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );

            //生产环境直接退出
            if (IS_PRO) {
                echo json_encode(['code' => 500, 'message' => 'system error!']);
                exit;
            }

            write_log($message, 'app_error', 'info');
            echo "Exception: ", $e->getMessage();
        }
    }

    //初始化项目
    public static function init()
    {
        if (self::$_instance == null) {
            self::initSystem();
            self::$_instance = 1;
        }

        return;
    }

    public static function loadFunctions()
    {
        include_once FUNC_PATH . '/common.php';                //加载公共函数库
        load_functions(['array', 'alias', 'logic', 'string']); //加载函数，可以加载多个文件
    }

    //初始化项目设置
    public static function initSystem()
    {
        //加载常量
        self::loadConstants();

        //注册错误抓取事件
        self::handlError();

        //加载初始化配置
        self::initEnvConf();

        //加载公共函数库
        self::loadFunctions();
    }

}
