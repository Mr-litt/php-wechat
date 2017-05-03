<?php
namespace wechat\app\Message;
use wechat\app\Core\Collection;

/**
 * Created by IntelliJ IDEA.
 * User: tao
 * Date: 2017/5/2
 * Time: 22:29
 */
abstract class AbstractMessage extends Collection
{
    protected $type;

    protected $properties = [];

    public function getType(){
        return $this->type;
    }

    public function __get($property){
        if (in_array($property,$this->properties)) {
            return parent::__get($property);
        }
        return null;
    }

    public function __set($property, $value)
    {
        if (in_array($property,$this->properties)) {
            parent::__set($property, $value);
        }
    }
}