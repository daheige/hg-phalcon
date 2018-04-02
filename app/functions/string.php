<?php
/**
 * 转换下划线字符串为驼峰式风格
 *     camel('lower_camel_case') === 'lowerCamelCase'
 *     camel('upper_camel_case', true) === 'UpperCamelCase'
 *
 * @param  string   $string
 * @param  string   $upper
 * @return string
 */
function camel($string, $upper = false, $separator = '_')
{
    $string = str_replace($separator, '_', $string);

    return $upper ? Phalcon\Text::camelize($string) : lcfirst(Phalcon\Text::camelize($string));
}
