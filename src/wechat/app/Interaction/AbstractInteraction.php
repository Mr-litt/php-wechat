<?php
/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-5-3
 * Time: 下午2:27
 */

namespace wechat\app\Interaction;


use wechat\app\Core\Collection;

abstract class AbstractInteraction extends Collection
{
    protected static $to = "";
    protected static $from = "";


    protected function getTo(){
        self::$to == "" && (new Request());
        return self::$to;
    }

    protected function getFrom(){
        self::$from == "" && (new Request());
        return self::$from;
    }

    protected function setTo($to){
        self::$to = $to;
    }

    protected function setFrom($from){
        self::$from = $from;
    }
}