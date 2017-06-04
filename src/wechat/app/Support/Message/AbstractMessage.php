<?php

/**
 * AbstractMessage.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-2
 */

namespace wechat\app\Support\Message;
use wechat\app\Core\Collection;

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