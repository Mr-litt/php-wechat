<?php

/**
 * AbstractAccessToken.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-11
 */

namespace wechat\app\AccessToken;

use wechat\app\Core\Api;
use wechat\components\FileCache;

abstract class AbstractAccessToken extends Api
{

    public function getCache($key) {
        $cache = new FileCache();
        return $cache->get($key);
    }

    public function setCache($key,$value) {
        $cache = new FileCache();
        return $cache->set($key,$value,0);
    }

}