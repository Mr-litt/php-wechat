<?php

/**
 * Menu.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-12
 */

namespace wechat\app\Menu;
use wechat\app\Core\Api;

class Menu extends Api
{

    const API_CREATE = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=ACCESS_TOKEN';
    const API_GET = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=ACCESS_TOKEN';
    const API_DELETE = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=ACCESS_TOKEN';

    public function create($menu){
        $this->http(self::API_CREATE, Api::HTTP_TYPE_POST, $menu);
    }

    public function get(){
        return $this->http(self::API_GET);
    }

    public function delete(){
        $this->http(self::API_DELETE);
    }

}