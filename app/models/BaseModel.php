<?php

namespace App\models;

use Phalcon\Mvc\Model;

/**
 * @mixin Phalcon\Mvc\Model
 */
class BaseModel extends Model
{
    protected static $instances = [];
    protected $dbname           = ''; //db连接实例
    protected $table            = ''; //表名称
    protected $_table_prefix    = ''; //分表前缀
    public $timestamps          = false;

    public $db = null;

    /**
     * 初始化方法
     */
    public function initialize()
    {
        parent::initialize();

        // $this->db = S('dbHgphalcon');
        // $this->setConnectionService('dbHgphalcon');
    }

    /**
     * 获取数据库名
     *
     * @return string
     */
    public function getSchema()
    {
        return $this->dbname;
    }

    /**
     * [getSource 返回数据库操作的表名]
     * @return [string] [name]
     */
    public function getSource()
    {
        return $this->table;
    }

    /**
     * 获取单例实例
     *
     * @return App\Models\BaseModel
     */
    public static function getInstance()
    {
        $class = get_called_class();
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new $class;
        }

        return self::$instances[$class];
    }

    //设置表方法，映射到相关的表上
    public function setTable($num = 0)
    {
        $this->table = !empty($this->_table_prefix) ? $this->_table_prefix . $num : $this->table;
        return $this;
    }
}
