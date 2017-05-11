<?php

/**
 * Container.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-11
 */

namespace wechat\app\Core;


class Container extends Base
{

    private $_singletons = [];

    public function get($class,$params=[]){
        if (!isset($this->_singletons[$class])) {
            $this->register($class, $params);
        }
        return $this->_singletons[$class];
    }

    private function register($class, $params){
        $reflection = new \ReflectionClass($class);
        $this->_singletons[$class] = $reflection->newInstanceArgs($params);
    }

}