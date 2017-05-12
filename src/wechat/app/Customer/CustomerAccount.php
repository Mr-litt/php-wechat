<?php

namespace wechat\app\Customer;
use wechat\app\Core\Api;

/**
 * CustomerAccount.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-12
 */
class CustomerAccount extends Api
{
    const API_ADD = 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token=ACCESS_TOKEN';
    const API_UPDATE = 'https://api.weixin.qq.com/customservice/kfaccount/update?access_token=ACCESS_TOKEN';
    const API_DEL = 'https://api.weixin.qq.com/customservice/kfaccount/del?access_token=ACCESS_TOKEN';
    const API_UPLOAD_HEAD_IMG = 'http://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token=ACCESS_TOKEN&kf_account=KFACCOUNT';
    const API_GET = 'https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=ACCESS_TOKEN';


    public function add($info){
        return $this->http(self::API_ADD,$info);
    }

    public function update($info){
        return $this->http(self::API_UPDATE,$info);
    }

    public function del($info){
        return $this->http(self::API_DEL,$info);
    }

    public function uploadHeadImg($account,$path){
        return $this->http(self::API_UPLOAD_HEAD_IMG,$account,$path);
    }

    public function get(){
        return $this->http(self::API_GET);
    }
}