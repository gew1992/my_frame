<?php
/**
 * Created by PhpStorm.
 * User: enwei
 * Date: 2019/4/22
 * Time: 5:53 PM
 */

define('FD_DS', DIRECTORY_SEPARATOR);
// 应用目录为当前目录
define('APP_PATH', __DIR__ . FD_DS);
// 开启调试模式
define('APP_DEBUG', true);
// 网站根URL
define('APP_URL', 'http://gew.myframe.com');
// 加载框架
require './framework/framework.php';