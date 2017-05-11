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

class Api extends Base
{

    private $replaces = [
        'APPID'=>'getAppId',
        'APPSECRET'=>'getAppSecret',
        'ACCESS_TOKEN'=>'getAccessToken',
    ];

    public function http($url,$method="get",$field=[],$head=[]){
        $url = $this->handUrl($url);

        if($method == 'post'){
            $result =Curl::post($url,$field,$head);
        }else{
            $result = Curl::get($url,$field);
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

    private function handUrl($url){

        foreach ($this->replaces as $replace=>$value){
            $url  = str_replace($replace, $this->$value(),$url);
        }
        return $url;
    }


    public function getAppId(){
        return Config::get('app_id');
    }

    public function getAppSecret(){
        return Config::get('secret');
    }

    public function getAccessToken(){
        return Wechat::$app->access_token->get();
    }
}