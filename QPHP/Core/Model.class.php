<?php

/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 17/1/17
 * Time: 下午3:46
 */
class Model extends DB
{
    protected $_model;
    protected $_table;

    public function __construct()
    {
        // 连接数据库
        $this->connect(DB_TYPE, DB_HOST, DB_PORT, DB_USER, DB_PASSWORD, DB_NAME);

        // 获取模型类名
        $this->_model = get_class($this);

        // 数据库表名与类名一致
        $this->_table = !empty($this->_table) ? $this->_table : strtolower($this->_model);
    }

}