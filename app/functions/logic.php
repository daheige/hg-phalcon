<?php
if (!function_exists('parse_name')) {
/**
 * 字符串命名风格转换
 * type 0 将Java风格转换为C的风格 1 将C风格转换为Java的风格
 * @param  string   $name 字符串
 * @param  integer  $type 转换类型
 * @return string
 */
    function parse_name($name, $type = 0)
    {
        if ($type) {
            return ucfirst(preg_replace_callback('/_([a-zA-Z])/', function ($match) {return strtoupper($match[1]);}, $name));
        } else {
            return strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
        }
    }
}

if (!function_exists('loadLogic')) {
/**
 * 创建logic
 * @author heige
 *
 * @param  string    $name logic名称
 * @return B\Logic
 */
    function loadLogic($name, $group = 'Common')
    {
        $name  = parse_name($name, 1);
        $class = '\\App\logics\\' . parse_name($group, 1) . '\\' . $name . 'Logic';
        if (class_exists($class)) {
            $logic = $class::getInstance();
        } else {
            $class = '\\App\logics\\' . $name . 'Logic';
            $logic = class_exists($class) ? $class::getInstance() : \App\logics\BaseLogic::getInstance();
        }

        return $logic;
    }
}

if (!function_exists('loadModel')) {
/**
 * 创建model
 * @author heige
 *
 * @param  string  $name model名称
 * @return Model
 */
    function loadModel($name, $group = 'Common')
    {
        $name  = parse_name($name, 1);
        $class = '\\App\models\\' . parse_name($group, 1) . '\\' . $name . 'Model';
        if (class_exists($class)) {
            $model = $class::getInstance();
        } else {
            $class = '\\App\models\\' . $name . 'Model';
            $model = class_exists($class) ? $class::getInstance() : \App\models\BaseModel::getInstance();
        }
        return $model;
    }
}

if (!function_exists('loadService')) {
/**
 * 创建model
 * 单例模式返回模型实例
 * @author heige
 *
 * @param  string    $name service名称
 * @return service
 */
    function loadService($name, $group = 'Common')
    {
        $name  = parse_name($name, 1);
        $class = '\\App\services\\' . parse_name($group, 1) . '\\' . $name . 'Service';

        if (class_exists($class)) {
            $service = $class::getInstance();
        } else {
            $class   = '\\App\services\\' . $name . 'Service';
            $service = class_exists($class) ? $class::getInstance() : \App\services\BaseService::getInstance();
        }

        return $service;
    }
}
