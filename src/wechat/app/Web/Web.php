<?php

/**
 * Web.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-12
 */

namespace wechat\app\Web;
use wechat\app\Core\Api;
use wechat\components\Input;
use wechat\components\Url;

class Web extends Api
{
    const SNSAPI_BASE = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=snsapi_base&state=123#wechat_redirect";
    const WEB_ACCESS_TOKEN = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=APPID&secret=SECRET&code=CODE&grant_type=authorization_code";

    private $open_id;


    public function oAuth() {

        if(!isset($_SESSION)){
            session_start();
        }

        if (!isset($_SESSION['open_id']) || $_SESSION['open_id'] == '') {//获取open_id
            $code = Input::get('code','');
            if(empty($code)){
                /**
                 * snsapi_base（静默授权）：获取用户openid
                 * snsapi_userinfo（用户授权）：获取用户openid，还会返回获取用户信息的网页授权access_token
                 *
                 * 由于用户信息获取可以通过基础access_token获取，所以此处采用静默授权更方便
                 */
                $redirect = urlencode(Url::curPageURL());
                $url = $this->buildUrl(self::SNSAPI_BASE, ['APPID' => $this->app_id, 'REDIRECT_URI' => $redirect]);
                header("Location:".$url);
                exit;
            }

            $token_url = $this->buildUrl(self::WEB_ACCESS_TOKEN, ['CODE' => $code]);
            $result = $this->http($token_url,'get');
            if(isset($result['openid'])){
                $_SESSION['open_id'] = $result['openid'];
            }else{
                throw new \Exception("未获取用户信息");
            }
        }
        $this->open_id = $_SESSION['open_id'];
        return $this->open_id;
    }


    public function getOpen_id() {
        if (!$this->open_id) {
            return $this->oAuth();
        }
        return $this->open_id;
    }

}