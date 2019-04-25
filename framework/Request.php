<?php
/**
 * Created by PhpStorm.
 * User: enwei
 * Date: 2019/4/24
 * Time: 5:21 PM
 */

class Request
{
    /**
     * @var object 对象实例
     */
    protected static $instance;

    /**
     * @var array post请求参数
     */
    protected $post = [];
    /**
     * @var array get请求参数
     */
    protected $get = [];

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    public function get($key = '')
    {
        $this->get = $_GET;

        if ($key == '') {
            //返回全部get参数值
            return $this->get;
        }

        //返回指定的参数值
        return isset($this->get[$key]) ? $this->get[$key] : '';
    }

    public function post($key = '')
    {
        $this->post = $_POST;

        if ($key == '') {
            //返回全部post参数值
            return $this->post;
        }

        //返回指定的参数值
        return isset($this->post[$key]) ? $this->post[$key] : '';
    }

    public function param($key = '')
    {

    }
}