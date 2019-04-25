<?php
/**
 * Created by PhpStorm.
 * User: enwei
 * Date: 2019/4/22
 * Time: 8:08 PM
 */

/**
 * 路由配置
 */
$route = [
    'index' => 'IndexController@index',
    'getInfo/:id' => 'IndexController@getInfo',
];