<?php

/**
 * AbstractAccessToken.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-11
 */

namespace wechat\app\AccessToken;

use wechat\app\Core\Api;

abstract class AbstractAccessToken extends Api
{

    public function getCache($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return [];
        }
    }

    public function setCache($key,$value){
        return $_SESSION[$key] = $value;
    }

}