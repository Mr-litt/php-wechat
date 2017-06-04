<?php

/**
 * AccessToken.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-11
 */

namespace wechat\app\AccessToken;

class AccessToken extends AbstractAccessToken
{
    const ACCESS_TOKEN_GET = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET';

    public function get(){
        $cache = $this->getCache(AccessToken::class);
        if(empty($cache) || $cache['update_time']+$cache['expire_in'] <= time()){
            $cache = $this->set();
        }
        return $cache['access_token'];
    }

    private function set(){
        $cache = [];
        $result = $this->http(self::ACCESS_TOKEN_GET);
        $cache["update_time"] = time();
        $cache["access_token"] = $result->access_token;
        $cache["expires_in"] = $result->expires_in;
        $this->setCache(AccessToken::class,$cache);
        return $cache;
    }
}