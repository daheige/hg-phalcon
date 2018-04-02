<?php
namespace App\models;

//测试模型
class TestModel extends BaseModel
{
    protected $connection    = 'hglumen';
    protected $_table_prefix = 'user_';
    protected $table         = 'user';

}
