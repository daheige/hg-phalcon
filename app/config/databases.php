<?php
//数据库配置
return [
    'dbHgphalcon' => [
        'adapter'  => 'Mysql',
        'host'     => '127.0.0.1',
        'port'     => '3306',
        'username' => 'root',
        'password' => '1234',
        'dbname'   => 'test',
        'options'  => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ],
    ],
];
