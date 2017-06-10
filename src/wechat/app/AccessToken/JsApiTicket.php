<?php
/**
 * JsApiTicket.php
 *
 * @author  Mr,litt<137057181@qq.com>
 * @date    2017/6/10
 */

namespace wechat\app\AccessToken;


class JsApiTicket extends AbstractAccessToken
{

    const JA_ACCESS_TOKEN_GET = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=ACCESS_TOKEN&type=jsapi';

    public function get(){
        $cache = $this->getCache(JsApiTicket::class);
        if(empty($cache) || $cache['update_time']+$cache['expire_in'] <= time()){
            $cache = $this->set();
        }
        return $cache['jsapi_ticket'];
    }

    private function set(){
        $cache = [];
        $result = $this->http(self::JA_ACCESS_TOKEN_GET);
        $cache["update_time"] = time();
        $cache["jsapi_ticket"] = $result->ticket;
        $cache["expires_in"] = $result->expires_in;
        $this->setCache(JsApiTicket::class,$cache);
        return $cache;
    }
}