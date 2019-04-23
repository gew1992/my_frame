<?php
/**
 * Created by PhpStorm.
 * User: enwei
 * Date: 2019/4/22
 * Time: 5:58 PM
 */

// 定义常量
defined('FRAME_PATH') or define('FRAME_PATH', __DIR__.'/');
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');
defined('APP_DEBUG') or define('APP_DEBUG', false);
defined('CONFIG_PATH') or define('CONFIG_PATH', APP_PATH.'conf/');
defined('ROUTE_PATH') or define('ROUTE_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/routes/');

// 包含所需文件
require APP_PATH . 'conf/config.php';
require FRAME_PATH . 'Core.php';
require ROUTE_PATH . 'route.php';

// 实例化核心类
$fast = new Core($route);
$fast->run();