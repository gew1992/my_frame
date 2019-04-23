<?php
/**
 * Created by PhpStorm.
 * User: enwei
 * Date: 2019/4/22
 * Time: 6:17 PM
 */

/**
 * Class Controller 控制器基类
 */
class Controller
{
    protected $_controller;
    protected $_action;

    // 构造函数，初始化
    function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
    }
}