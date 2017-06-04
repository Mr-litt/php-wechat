<?php

/**
 * Log.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-4-28
 */

namespace wechat\components;

class Log
{
    const LEVEL_ERROR  = "error";
    const LEVEL_WARNING  = "warning";
    const LEVEL_INfO  = "info";


    public static function error($message)
    {
        self::write($message, self::LEVEL_ERROR);
    }


    public static function warning($message)
    {
        self::write($message, self::LEVEL_WARNING);
    }


    public static function info($message)
    {
        self::write($message, self::LEVEL_INfO);
    }
    

    private static function write($message,$level){
        $info = "[$level]:" . $message;
        if($file = Config::get("log")["path"]){
            file_put_contents($info,$file,FILE_APPEND);
        }
    }

}