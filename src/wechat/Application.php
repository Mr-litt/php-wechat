<?php
namespace wechat;
use wechat\app\Interaction\Request;
use wechat\app\Interaction\Response;
use wechat\components\Config;

/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-4-28
 * Time: 下午3:11
 */

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
        $this->init($options);
    }

    private function init($options){
        $configs = [];
        foreach ($this->configs as $value){
            $config = include $value;
            $configs = array_merge($configs,$config);
        }
        Config::set(array_merge($configs,$options));
    }

    private function registerProvider($name)
    {
        $provider = $this->providers[$name];
        $this->container[$name] = new $provider();
        return $this->container[$name];
    }

    private function getProvider($name)
    {
        if(!array_key_exists($name,$this->providers)){
            return null;
        }
        if(!isset($this->container[$name])){
            $this->registerProvider($name);
        }
        return $this->container[$name];
    }


    public function __get($name)
    {
        return $this->getProvider($name);
    }

}