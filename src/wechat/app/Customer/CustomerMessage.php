<?php

namespace wechat\app\Customer;
use wechat\app\Core\Api;
use wechat\app\Support\MessageFormat;

/**
 * CustomerMessage.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-12
 */
class CustomerMessage extends Api
{

    const API_SEND  = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=ACCESS_TOKEN';

    public function send($open_id,$message){

        $base = [
            'touser' => $open_id,
            'msgtype' => $message->getType(),
        ];
    }

}