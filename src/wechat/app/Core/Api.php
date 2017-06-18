<?php

/**
 * Api.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-11
 */

namespace wechat\app\Core;

use wechat\app\Wechat;
use wechat\components\Config;
use wechat\components\Curl;
use wechat\components\Log;


/**
 * Class Api
 * @package wechat\app\Core
 * @property string $app_id
 * @property string $secret
 * @property string $access_token
 * @property string $js_api_ticket
 * @property string $card_api_ticket
 */
class Api extends Base
{
    const HTTP_TYPE_GET = 'get';
    const HTTP_TYPE_POST = 'post';

    private $replaces = [
        'APPID'=>'app_id',
        'APPSECRET'=>'secret',
        'SECRET'=>'secret',
        'ACCESS_TOKEN'=>'access_token',
        'TOKEN'=>'access_token',
    ];

    public function http($url, $method = "get", $field = [], $file_path = '', $head = []){
        $url = $this->buildUrlRequired($url);
        if(strtolower($method) == self::HTTP_TYPE_POST){
            if ($file_path && !is_file($file_path)) {
                throw new \Exception("file is not exist");
            }
            $field && is_array($field) && $field = json_encode($field);
            $result =Curl::post($url, $field, $file_path, $head);
        }else{
            $result = Curl::get($url, $field);
        }

        if(empty($result)){
            Log::error("http请求为空:");
            throw new \Exception("http请求为空");
        }

        $result = json_decode($result,true);
        if($result['errcode'] != 0){
            Log::error("http请求错误:".json_encode($result));
            throw new \Exception("http请求错误:".json_encode($result));
        }

        return new Collection($result);
    }

    protected function buildUrl($url, $replaces = []){
        foreach ($replaces as $replace => $value) {
            if (strpos($url, $replace) !== false) {
                $url  = str_replace($replace, $value,$url);
            }
        }
        return $url;
    }

    private function buildUrlRequired($url){
        foreach ($this->replaces as $replace => $value) {
            if (strpos($url, $replace) !== false) {
                $value = $this->$value;
                $url =  $this->buildUrl($url, [$replace=>$value]);
            }
        }
        return $url;
    }


    public function getApp_id(){
        return Config::get('app_id');
    }

    public function getSecret(){
        return Config::get('secret');
    }

    public function getAccess_token(){
        return Wechat::$app->access_token->get();
    }

    public function getJs_api_ticket(){
        return Wechat::$app->js_api_ticket->get();
    }

    public function getCard_api_ticket(){
        return Wechat::$app->card_api_ticket->get();
    }
}