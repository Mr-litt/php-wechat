<?php

/**
 * Application.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-4-28
 */

namespace wechat;
use wechat\app\AccessToken\AccessToken;
use wechat\app\AccessToken\CardApiTicket;
use wechat\app\AccessToken\JsApiTicket;
use wechat\app\Account\QrCode;
use wechat\app\Card\Card;
use wechat\app\Core\Container;
use wechat\app\Customer\CustomerAccount;
use wechat\app\Customer\CustomerMessage;
use wechat\app\Interaction\Request;
use wechat\app\Interaction\Response;
use wechat\app\Material\Material;
use wechat\app\Menu\Menu;
use wechat\app\Pay\Pay;
use wechat\app\User\User;
use wechat\app\Web\Js;
use wechat\app\Web\Web;
use wechat\app\Wechat;
use wechat\components\Config;

/**
 * Class Application
 * @package wechat
 *
 * @property Request $request
 * @property Response $response
 * @property Menu $menu
 * @property QrCode $qr_code
 * @property Card $card
 * @property CustomerAccount $customer_account
 * @property CustomerMessage $customer_message
 * @property Material $material
 * @property User $user
 * @property Web $web
 * @property Js $js
 * @property Pay $pay
 * @property AccessToken $access_token
 * @property JsApiTicket $js_api_ticket
 * @property CardApiTicket $card_api_ticket
 */
class Application
{
    private $container = null;

    protected $providers = [
        "request"=>app\Interaction\Request::class,
        "response"=>app\Interaction\Response::class,
        "menu"=>app\Menu\Menu::class,
        "qr_code"=>app\Account\QrCode::class,
        "card"=>app\Card\Card::class,
        "customer_account"=>app\Customer\CustomerAccount::class,
        "customer_message"=>app\Customer\CustomerMessage::class,
        "material"=>app\Material\Material::class,
        "user"=>app\User\User::class,
        "web"=>app\Web\Web::class,
        "js"=>app\Web\Js::class,
        "pay"=>app\Pay\Pay::class,
        "access_token"=>app\AccessToken\AccessToken::class,
        "js_api_ticket"=>app\AccessToken\JsApiTicket::class,
        "card_api_ticket"=>app\AccessToken\CardApiTicket::class,
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
        define("WECHAT_ROOT",__DIR__);
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