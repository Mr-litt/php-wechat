<?php

/**
 * User.php
 *
 * @author  Mr,litt<137057181@qq.com>
 * @date    2017/6/4
 */

namespace wechat\app\User;
use wechat\app\Core\Api;

class User extends Api
{
    const API_INFO = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=ACCESS_TOKEN&openid=OPENID&lang=zh_CN';


    public function info($open_id) {
        return $this->http($this->buildUrl(self::API_INFO, ['OPENID' => $open_id]));
    }

}