<?php

/**
 * Config.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-4-28
 */

namespace wechat\components;


class Config
{
    private static $_config = [];


    public static function get($name){
        return isset(self::$_config[$name])?self::$_config[$name]:"";
    }

    public static function set($options){
        if(is_array($options)){
            self::$_config = array_merge(self::$_config,$options);
        }
    }
}