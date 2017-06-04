<?php

/**
 * Application.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-4-28
 */

namespace wechat;
use wechat\app\Core\Container;
use wechat\app\Interaction\Request;
use wechat\app\Interaction\Response;
use wechat\app\Wechat;
use wechat\components\Config;

/**
 * Class Application
 * @package wechat
 *
 * @property Request request
 * @property Response response
 *
 */
class Application
{
    private $container = null;

    protected $providers = [
        "request"=>app\Interaction\Request::class,
        "response"=>app\Interaction\Response::class,
    ];

    protected $configs = [
        "default"=>"config/default.php"
    ];

    public function __construct($options)
    {
        $this->container = new Container();
        $this->init($options);
        Wechat::$app = $this;
    }

    private function init($options){
        $configs = [];
        foreach ($this->configs as $value){
            $config = include $value;
            $configs = array_merge($configs,$config);
        }
        Config::set(array_merge($configs,$options));
    }

    private function getProvider($name)
    {
        if(!array_key_exists($name,$this->providers)){
            return null;
        }
        return $this->container->get($this->providers[$name]);
    }


    public function __get($name)
    {
        return $this->getProvider($name);
    }

}