<?php
namespace wechat\app\Menu;
use wechat\app\Core\Api;


/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-5-2
 * Time: 下午6:07
 */
class Menu extends Api
{

    const API_CREATE = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=ACCESS_TOKEN';
    const API_GET = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=ACCESS_TOKEN';
    const API_DELETE = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=ACCESS_TOKEN';

    public function create($menu){
        $menu = json_encode($menu);
        $this->http(self::API_CREATE,"post",$menu);
    }

    public function get(){
        return $this->http(self::API_GET);
    }


    public function delete(){
        $this->http(self::API_DELETE);
    }

}