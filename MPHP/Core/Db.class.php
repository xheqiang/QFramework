<?php

/**
 * Created by PhpStorm.
 * User: qiang
 * Date: 17/1/17
 * Time: 下午3:47
 */
class DB
{
    protected $_dbHandle;
    protected $_result;
    private $filter = '';

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
     * 拼接where 条件
     * @param array $where
     * @return $this
     */
    public function where($where = array())
    {
        if (isset($where)) {
            $this->filter .= ' WHERE ';
            $this->filter .= implode(' ', $where);
        }

        return $this;
    }

    /**
     * 排序条件
     * @param array $order
     * @return $this
     */
    public function order($order = array())
    {
        if (isset($order)) {
            $this->filter .= ' ORDER BY ';
            $this->filter .= implode(',', $order);
        }

        return $this;
    }

    /**
     * 查询所有
     * @return mixed
     */
    public function selectAll()
    {
        $sql = sprintf("select * from `%s` %s", $this->_table, $this->filter);
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetchAll();
    }

    /**
     * 根据条件 (id) 查询
     * @param $id
     * @return mixed
     */
    public function select($id)
    {
        $sql = sprintf("select * from `%s` where `id` = '%s'", $this->_table, $id);
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->fetch();
    }

    /**
     * 根据条件 (id) 删除
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $sql = sprintf("delete from `%s` where `id` = '%s'", $this->_table, $id);
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->rowCount();
    }

    /**
     * 自定义SQL查询，返回影响的行数
     * @param $sql
     * @return mixed
     */
    public function query($sql)
    {
        $sth = $this->_dbHandle->prepare($sql);
        $sth->execute();

        return $sth->rowCount();
    }

    /**
     * 新增数据
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        $sql = sprintf("insert into `%s` %s", $this->_table, $this->formatInsert($data));

        return $this->query($sql);
    }

    /**
     * 修改数据
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        $sql = sprintf("update `%s` set %s where `id` = '%s'", $this->_table, $this->formatUpdate($data), $id);

        return $this->query($sql);
    }

    /**
     * 将数组转换成插入格式的sql语句
     * @param $data
     * @return string
     */
    private function formatInsert($data)
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
    private function formatUpdate($data)
    {
        $fields = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s` = '%s'", $key, $value);
        }

        return implode(',', $fields);
    }
}