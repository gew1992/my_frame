<?php
/**
 * Created by PhpStorm.
 * User: enwei
 * Date: 2019/4/22
 * Time: 6:06 PM
 */

/**
 * my_frame核心框架
 */
class Core
{
    private $_route;
    private $_controllerName = 'IndexController';
    private $_actionName  = 'index';

    function __construct($route)
    {
        $this->_route = $route;
    }

    // 运行程序
    function run()
    {
        spl_autoload_register(array($this, 'loadClass'));

        $this->Route();
    }


    // 路由处理
    function Route()
    {
        $path = $_SERVER['REQUEST_URI'];
        $path = ltrim($path,'/');
        if (empty($path)) {
            call_user_func([$this->_controllerName, $this->_actionName]);
            return;
        }

        $path_arr = explode('/', $path);

        $key = $path_arr[0];
        array_shift($path_arr);

        $route = $this->_route;
        if (isset($route[$key])) {
            $params = explode('@', $route[$key]);
            $queryString = empty($path_arr) ? [] : $path_arr;
            call_user_func_array([$params[0], $params[1]], $queryString);
        } else {
            echo '路由不存在!';
        }
    }

    // 自动加载控制器和模型类
    static function loadClass($class)
    {
        $frameworks = FRAME_PATH . $class . '.class.php';
        $controllers = APP_PATH . 'application/controller/' . $class . '.php';
        $models = APP_PATH . 'application/model/' . $class . '.php';
        if (file_exists($frameworks)) {
            // 加载框架核心类
            include $frameworks;
        } elseif (file_exists($controllers)) {
            // 加载控制器类
            include $controllers;
        } elseif (file_exists($models)) {
            // 加载模型类
            include $models;
        } else {
            // 其它
        }
    }
}