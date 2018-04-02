<?php

/**
 * 别名函数
 */
/**
 * 从数组中获取值，如果未设定时，返回默认值
 *
 * @see array_get
 */
function A($array, $name, $default = null)
{
    return array_get($array, $name, $default);
}

/**
 * 加载配置文件数据
 *
 * @see config
 */
function C($name, $default = null, $is_to_Array = true)
{
    $config = config($name, $default);
    return $is_to_Array ? o2a($config) : $config;
}

/**
 * 实例化一个 model
 *
 * @see model
 */
function D($name)
{
    return model($name);
}

/**
 * 获取 $_REQUEST 中的数据
 *
 * @link   http://docs.phalconphp.com/zh/latest/reference/request.html
 * @link   http://docs.phalconphp.com/zh/latest/api/Phalcon_Http_Request.html
 *
 * @param  string       $name
 * @param  string|array $filters
 * @param  mixed        $default
 * @return mixed
 */
function R($name = null, $filters = null, $default = null)
{
    return service('request')->get($name, $filters, $default);
}

/**
 * 获取 $_POST 中的数据
 *
 * @link   http://docs.phalconphp.com/zh/latest/reference/request.html
 * @link   http://docs.phalconphp.com/zh/latest/api/Phalcon_Http_Request.html
 *
 * @param  string       $name
 * @param  string|array $filters
 * @param  mixed        $default
 * @return mixed
 */
function P($name = null, $filters = null, $default = null)
{
    return service('request')->getPost($name, $filters, $default);
}

/**
 * 获取 $_GET 中的数据
 *
 * @link   http://docs.phalconphp.com/zh/latest/reference/request.html
 * @link   http://docs.phalconphp.com/zh/latest/api/Phalcon_Http_Request.html
 *
 * @param  string       $name
 * @param  string|array $filters
 * @param  mixed        $default
 * @return mixed
 */
function G($name = null, $filters = null, $default = null)
{
    return service('request')->getQuery($name, $filters, $default);
}

/**
 * 简化 \Phalcon\Di::getDefault()->getShared($service)
 *
 * @see service
 */
function S($service)
{
    return service($service);
}
