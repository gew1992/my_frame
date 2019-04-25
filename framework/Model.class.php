<?php
/**
 * Created by PhpStorm.
 * User: enwei
 * Date: 2019/4/22
 * Time: 6:20 PM
 */

/**
 * Class Model model基类
 */
class Model extends Db
{
    protected $_table;

    function __construct()
    {
        // 连接数据库
        $this->connect(DB_HOST, DB_PORT, DB_USER, DB_PASSWORD, DB_NAME);

    }

}