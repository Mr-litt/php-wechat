<?php
/**
 * JsApiTicket.php
 *
 * @author  Mr,litt<137057181@qq.com>
 * @date    2017/6/10
 */

namespace wechat\app\AccessToken;

class CardApiTicket extends AbstractAccessToken
{

    const CARD_ACCESS_TOKEN_GET = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=ACCESS_TOKEN&type=wx_card';

    public function get(){
        $cache = $this->getCache(CardApiTicket::class);
        if(empty($cache) || $cache['update_time']+$cache['expires_in'] <= time()){
            $cache = $this->set();
        }
        return $cache['card_api_ticket'];
    }

    private function set(){
        $cache = [];
        $result = $this->http(self::CARD_ACCESS_TOKEN_GET);
        $cache["update_time"] = time();
        $cache["card_api_ticket"] = $result->ticket;
        $cache["expires_in"] = $result->expires_in;
        $this->setCache(CardApiTicket::class,$cache);
        return $cache;
    }
}