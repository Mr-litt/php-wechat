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


    public static function error($message, $line = '')
    {
        self::write($message, $line, self::LEVEL_ERROR);
    }


    public static function warning($message, $line = '')
    {
        self::write($message, $line, self::LEVEL_WARNING);
    }


    public static function info($message, $line = '')
    {
        self::write($message, $line, self::LEVEL_INfO);
    }
    

    private static function write($message, $line, $level){
        $date = date("Y-m-d H:i:s");
        $info = "[$level]" . "[$date] " . $message . " in " . $line ."\r\n";
        if($file = Config::get("log")["path"]){
            $dir = dirname($file);
            if (is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            file_put_contents($info,$file,FILE_APPEND);
        }
    }

}