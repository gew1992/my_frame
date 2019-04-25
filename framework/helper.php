<?php
/**
 * Created by PhpStorm.
 * User: enwei
 * Date: 2019/4/24
 * Time: 6:38 PM
 */


if (!function_exists('request')) {
    /**
     * 获取当前Request对象实例
     * @return Request
     */
    function request()
    {
        return Request::instance();
    }
}


if (!function_exists('input')) {
    function input($key = '')
    {
        if (strpos($key, '.')) {
            //获取请求方式和请求参数
            list($method, $key) = explode('.', $key, 2);
            //规定的请求方式
            $requestMode = [
                'get',
                'post',
                'param'
            ];

            if (!in_array($method, $requestMode)) {
                echo '请求方式错误';
                exit;
            } else {
                return request()->$method($key);
            }
        } else {
            echo '获取参数错误';
            exit;
        }
    }

}