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


/**
 * Class Api
 * @package wechat\app\Core
 * @property string $app_id
 * @property string $secret
 * @property string $access_token
 */
class Api extends Base
{
    const HTTP_TYPE_GET = 'get';
    const HTTP_TYPE_POST = 'post';

    private $replaces = [
        'APPID'=>'app_id',
        'APPSECRET'=>'secret',
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
            throw new \Exception("http request not result");
        }

        $result = json_decode($result,true);
        if($result['errcode'] != 0){
            throw new \Exception("http request error:".json_encode($result));
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
        $need = [];
        foreach ($this->replaces as $replace => $value) {
            if (strpos($url, $replace) !== false) {
                $value = $this->$value;
                $need[$replace] = $value;
            }
        }
        if ($need) {
            $url =  $this->buildUrl($url, $need);
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
}