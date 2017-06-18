<?php
/**
 * Js.php
 *
 * @author  Mr,litt<137057181@qq.com>
 * @date    2017/6/10
 */

namespace wechat\app\Web;


use wechat\app\Core\Api;
use wechat\components\Url;

class Js extends Api
{

    /**
     * 获取js签名
     * @return string
     */
    public function getJsSdkSign(){
        $appId = $this->app_id;
        $timestamp = time();
        $nonceStr = uniqid();
        $signArray = [
            "noncestr"=>$nonceStr,
            "jsapi_ticket"=>$this->js_api_ticket,
            "timestamp"=>$timestamp,
            "url"=>Url::curPageURL()
        ];
        $signature = $this->buildSign($signArray);

        $sign["appId"] = $appId;
        $sign["noncestr"] = $nonceStr;
        $sign["timestamp"] = $timestamp;
        $sign["signature"] = $signature;
        return json_encode($sign);
    }


    public function buildSign($signArray) {
        $signKeys=array_keys($signArray);
        sort($signKeys);
        $tmpStr = "";
        foreach($signKeys as $key){
            $param = $signArray[$key];
            if($key=="sign" || $param===""){
                continue;
            }
            if($tmpStr != ""){
                $tmpStr.="&".$key."=".$param;
            }else{
                $tmpStr=$key."=".$param;
            }
        }
        return sha1($tmpStr);
    }

}