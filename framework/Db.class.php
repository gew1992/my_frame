<?php
/**
 * Created by PhpStorm.
 * User: enwei
 * Date: 2019/4/22
 * Time: 6:19 PM
 */


/**
 * Class Db 数据库操作
 */
class Db
{
    protected $_dbHandle;
    protected $_result;
    protected $_table;

    /**
     * 连接数据库
     * @param $host
     * @param $port
     * @param $user
     * @param $pwd
     * @param $dbname
     */
    public function connect($host, $port, $user, $pwd, $dbname)
    {
        try {
            $dsn = sprintf("mysql:host=%s;port=%d;dbname=%s;charset=utf8", $host, $port, $dbname);
            $this->_dbHandle = new PDO($dsn, $user, $pwd, array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            exit('连接失败: ' . $e->getMessage());
        }
    }

    /**
     * 查询全部
     * @return mixed
     */
    public function selectAll()
    {
        $sql = sprintf("select * from `%s`", $this->_table);
        $obj = $this->_dbHandle->prepare($sql);
        $obj->execute();

        return $obj->fetchAll();
    }

    /**
     * 获取单条数据
     * @param $id
     * @return mixed
     */
    public function selectById($id)
    {
        $sql = sprintf("select * from `%s` where `id` = '%s'", $this->_table, $id);
        $obj = $this->_dbHandle->prepare($sql);
        $obj->execute();

        return $obj->fetch();
    }

    /**
     * 根据主键id删除
     * @param $id
     * @return mixed
     */
    public function deleteById($id)
    {
        $sql = sprintf("delete from `%s` where `id` = '%s'", $this->_table, $id);
        $obj = $this->_dbHandle->prepare($sql);
        $obj->execute();

        return $obj->rowCount();
    }

    /**
     * 自定义sql查询
     * @param $sql
     * @return mixed
     */
    public function query($sql)
    {
        $obj = $this->_dbHandle->prepare($sql);
        $obj->execute();

        return $obj->rowCount();
    }

    /**
     * 插入数据
     * @param $data
     * @return mixed
     */
    public function add($data)
    {
        $sql = sprintf("insert into `%s` %s", $this->_table, $this->formatInsert($data));

        return $this->query($sql);
    }

    /**
     * 根据主键id修改数据
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $sql = sprintf("update `%s` set %s where `id` = '%s'", $this->_table, $this->formatUpdate($data), $id);

        return $this->query($sql);
    }


    /**
     * 将数组转换成可插入的sql
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
     * 将数组转换成可更新的sql
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