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

    // 路由
//    function routes()
//    {
//        $controllerName = 'Index';
//        $action = 'index';
//        if (!empty($_GET['url'])) {
//            $url = $_GET['url'];
//            $urlArray = explode('/', $url);
//            // 获取控制器名
//            $controllerName = ucfirst($urlArray[0]);
//            // 获取方法名
//            array_shift($urlArray);
//            $action = empty($urlArray[0]) ? 'index' : $urlArray[0];
//            //获取URL参数
//            array_shift($urlArray);
//            $queryString = empty($urlArray) ? array() : $urlArray;
//        }
//        // 数据为空的处理
//        $queryString  = empty($queryString) ? array() : $queryString;
//        // 实例化控制器
//        $controller = $controllerName . 'Controller';
//        $dispatch = new $controller($controllerName, $action);
//        // 如果控制器和方法存在，调用并传入URL参数
//        if ((int)method_exists($controller, $action)) {
//            call_user_func_array(array($dispatch, $action), $queryString);
//        } else {
//            exit($controller . "控制器不存在");
//        }
//    }


    // 路由处理
    function Route()
    {
        $path = $_SERVER['REQUEST_URI'];
        $path = ltrim($path,'/');
        if (empty($path)) {
            $controller = new $this->_controllerName($this->_controllerName, $this->_actionName);
            $action = $this->_actionName;
            $controller->$action();
            return;
        }

        $path_arr = explode('/', $path);

        $key = $path_arr[0];
        array_shift($path_arr);

        $route = $this->_route;
        if (isset($route[$key])) {
            $arr = explode('@', $route[$key]);

            $controller = new $arr[0]($arr[0], $arr[1]);

            if (!empty($path_arr)) {
                $controller->{$arr[1]}($path_arr);
            } else {
                $controller->{$arr[1]}();
            }
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