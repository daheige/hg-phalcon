<?php
//phalcon loader 自动加载文件

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader
    ->registerDirs($config->loader->dirs->toArray())
    ->registerPrefixes($config->loader->prefixes->toArray())
    ->register();
