<?php

namespace wechat\app\Interaction;
use wechat\app\Support\Xml;
use wechat\components\Config;
use wechat\components\Input;
use wechat\components\Log;

/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-4-28
 * Time: 下午3:23
 */

/**
 * Class Request
 * @property mixed|null ToUserName
 * @property mixed|null FromUserName
 * @package wechat\app\Interaction
 */
class Request extends AbstractInteraction
{

    /**
     * Request constructor.
     */
    public function __construct()
    {
        try{
            if (Input::isGet()){
                $this->bind();
            }else{
                $xml = file_get_contents("php://input");
                $inputData = Xml::parse($xml);
                parent::__construct($inputData);
                if(!isset($this->ToUserName) || !isset($this->FromUserName))
                {
                    throw new \Exception("不合法的数据");
                }
                $this->setTo($this->ToUserName);
                $this->setFrom($this->FromUserName);
            }
        }  catch (\Exception $e){
            Log::error(file_get_contents("php://input"));
        }

    }

    private function bind(){

        $signature = Input::get("signature");
        $timestamp = Input::get("timestamp");
        $nonce = Input::get("nonce");
        $token = Config::get("token");

        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );
        if( $tmpStr == $signature ){
            echo Input::get("echostr");
            exit;
        }else{
            echo '';
            exit;
        }
    }

}