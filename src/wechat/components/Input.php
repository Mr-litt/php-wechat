<?php

/**
 * Curl.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-4-28
 */

namespace wechat\components;

class Input
{

    public static function get($name = null, $defaultValue = null){
        if($name == null){
            return $_GET;
        }else{
            return isset($_GET[$name])?$_GET[$name]:$defaultValue;
        }
    }

    public static function post($name = null, $defaultValue = null){
        if($name == null){
            return $_POST;
        }else{
            return isset($_POST[$name])?$_POST[$name]:$defaultValue;
        }
    }

    public static function isGet(){
        return self::getMethod() === 'GET';
    }

    public static function isPost(){
        return self::getMethod() === 'POST';
    }

    private static function getMethod()
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            return strtoupper($_SERVER['REQUEST_METHOD']);
        }
        return 'GET';
    }

}