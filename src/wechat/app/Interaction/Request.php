<?php

/**
 * Request.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-4-28
 */

namespace wechat\app\Interaction;
use wechat\app\Support\Xml;
use wechat\components\Config;
use wechat\components\Input;
use wechat\components\Log;


/**
 * Class Request
 * @package wechat\app\Interaction
 *
 * @property String $ToUserName
 * @property String $FromUserName
 * @property String $CreateTime
 * @property String $MsgType
 * @property String $MsgId
 * //text
 * @property String $Content
 * //image
 * @property String $PicUrl
 * @property String $MediaId
 * //voice
 * @property String $Format
 * //video
 * @property String $ThumbMediaId
 * //location
 * @property String $Location_X
 * @property String $Location_Y
 * @property String $Scale
 * @property String $Label
 * //link
 * @property String $Title
 * @property String $Description
 * @property String $Url
 * //Event
 * @property String $Event
 * @property String $EventKey
 * @property String $Ticket
 *
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
            }
        }  catch (\Exception $e){
            Log::error(file_get_contents("php://input"));
            throw new \Exception("不合法的数据");
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