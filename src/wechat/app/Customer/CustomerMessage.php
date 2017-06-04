<?php

/**
 * CustomerMessage.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-12
 */

namespace wechat\app\Customer;
use wechat\app\Core\Api;
use wechat\app\Support\Message\AbstractMessage;
use wechat\app\Support\Message\News;
use wechat\app\Support\Message\Text;
use wechat\app\Support\MessageFormat;


class CustomerMessage extends Api
{

    const API_SEND  = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=ACCESS_TOKEN';

    public function send($open_id, $message){
        if(is_array($message)){
            foreach ($message as $key=>$value){
                if(!($value instanceof News)){
                    unset($message[$key]);
                }
            }
            $class = News::class;
        }else{
            if (is_string($message)) {
                $message = new Text(['content' => $message]);
            }
            $class = get_class($message);
        }
        $contents = '';
        if(is_subclass_of($class,AbstractMessage::class)){
            $contents = $this->buildReply($open_id, $message);
        }
        $this->http(self::API_SEND,"post",$contents);
    }

    /**
     * @param String $open_id
     * @param AbstractMessage $message
     * @return string
     */
    protected function buildReply($open_id, $message) {
        $base = [
            'touser' => $open_id,
            'msgtype' => $message->getType(),
        ];
        $MessageFormat = new MessageFormat();
        $MessageFormat->is_customer = true;
        $detail = $MessageFormat->transform($message);
        return json_encode(array_merge($base,$detail));
    }

}