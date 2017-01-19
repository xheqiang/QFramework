<?php

/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 17/1/17
 * Time: 下午3:47
 */
class DB
{
    protected $_dbHandle;    //数据库连接句柄
    protected $_table = "";  //表名称
    private $_where = "";   //拼接where 条件
    private $_sql = "";     //拼接的sql语句
    private $_cloumn = "";  //查询的数据库列

    /**
     * 连接数据库
     * @param $db_type
     * @param $host
     * @param $port
     * @param $user
     * @param $pass
     * @param $dbname
     */
    public function connect($db_type, $host, $port, $user, $pass, $dbname)
    {
        try {
            $dsn = sprintf("%s:host=%s;port=%s;dbname=%s;charset=utf8", $db_type, $host, $port, $dbname);
            $option = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $this->_dbHandle = new PDO($dsn, $user, $pass, $option);
        } catch (PDOException $e) {
            exit('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * 新增数据
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        $this->_sql = sprintf("insert into `%s` %s ", $this->_table, $this->formatCreate($data));

        $sth = $this->execute();
        return $sth->rowCount();
    }

    /**
     * 修改数据
     * @param $data
     * @return mixed
     */
    public function save($data)
    {
        $whereStr = !empty($this->_where) ? $this->_where : " 1=1 ";
        $this->_sql = sprintf("update `%s` set %s where %s", $this->_table, $this->formatSaveData($data), $whereStr);

        $sth = $this->execute();
        return $sth->rowCount();
    }

    /**
     * 查询单条
     * @return mixed
     */
    public function findFirst()
    {
        $cloumnStr = !empty($this->_cloumn) ? $this->_cloumn : " * ";
        $whereStr = !empty($this->_where) ? $this->_where : " 1=1 ";
        $this->_sql = sprintf("select %s from `%s` where %s", $cloumnStr,  $this->_table, $whereStr);

        $sth = $this->execute();
        return $sth->fetch();

    }

    /**
     * 查询单条
     * @return mixed
     */
    public function find()
    {
        $cloumnStr = !empty($this->_cloumn) ? $this->_cloumn : " * ";
        $whereStr = !empty($this->_where) ? $this->_where : " 1=1 ";
        $this->_sql = sprintf("select %s from `%s` where %s", $cloumnStr,  $this->_table, $whereStr);

        $sth = $this->execute();
        return $sth->fetchAll();
    }
    
    /**
     * 根据条件删除
     * @return mixed
     */
    public function delete()
    {
        $whereStr = !empty($this->_where) ? $this->_where : " 1=1 ";
        $this->_sql = sprintf("delete from `%s` where %s", $this->_table, $whereStr);

        $sth = $this->execute();
        return $sth->rowCount();
    }


    public function cloumn($cloumn = null)
    {
        $this->_cloumn = !empty($cloumn) ? " " : " * ";
        if(is_array($cloumn)){
            $cloumnArr = array();
            foreach ($cloumn as $key => $value) {
                $cloumnArr[] = $value;
            }
            $this->_cloumn .= implode(',', $cloumnArr);
        }else{
            $this->_cloumn .= $cloumn;
        }
        return $this;
    }

    /**
     * 拼接where 条件
     * @param array $where
     * @return $this
     */
    public function where($where = null)
    {
        $this->_where = !empty($where) ? " " : " 1=1 ";
        if(is_array($where)){
            $whereArr = array();
            foreach ($where as $key => $value) {
                $whereArr = sprintf("`%s` = '%s'", $key, $value);
            }
            $this->_where .= implode(' and ', $whereArr);
        }else{
            $this->_where .= $where;
        }
        return $this;
    }

    /**
     * 排序条件
     * @return $this
     */
    public function order()
    {

    }

    /**
     * 显示显示条件
     * @return $this
     */
    public function limit()
    {

    }

    /**
     * Sql语句执行，返回影响的行数
     * @return mixed
     */
    public function execute()
    {
        $sth = $this->_dbHandle->prepare($this->_sql);
        $sth->execute();

        return $sth;
    }


    public function getLastSql(){
        return $this->_sql;
    }

    /**
     * 将数组转换成插入格式的sql语句
     * @param $data
     * @return string
     */
    private function formatCreate($data)
    {
        $fields = array();
        $values = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s`", $key);
            $values[] = sprintf("'%s'", $value);
        }

        $field = implode(',', $fields);
        $value = implode(',', $values);

        return sprintf("(%s) values (%s)", $field, $value);
    }

    /**
     * 将数组转换成更新格式的sql语句
     * @param $data
     * @return string
     */
    private function formatSaveData($data)
    {
        $fields = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s` = '%s'", $key, $value);
        }

        return implode(',', $fields);
    }

}