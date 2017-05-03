<?php
namespace wechat\components;
/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-4-28
 * Time: 下午3:25
 */
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