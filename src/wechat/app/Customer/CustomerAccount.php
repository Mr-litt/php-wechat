<?php

/**
 * CustomerAccount.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-12
 */


namespace wechat\app\Customer;
use wechat\app\Core\Api;


class CustomerAccount extends Api
{
    const API_ADD = 'https://api.weixin.qq.com/customservice/kfaccount/add?access_token=ACCESS_TOKEN';
    const API_UPDATE = 'https://api.weixin.qq.com/customservice/kfaccount/update?access_token=ACCESS_TOKEN';
    const API_DEL = 'https://api.weixin.qq.com/customservice/kfaccount/del?access_token=ACCESS_TOKEN';
    const API_UPLOAD_HEAD_IMG = 'http://api.weixin.qq.com/customservice/kfaccount/uploadheadimg?access_token=ACCESS_TOKEN&kf_account=KFACCOUNT';
    const API_GET = 'https://api.weixin.qq.com/cgi-bin/customservice/getkflist?access_token=ACCESS_TOKEN';


    public function add($info){
        return $this->http(self::API_ADD, Api::HTTP_TYPE_POST, $info);
    }

    public function update($info){
        return $this->http(self::API_UPDATE, Api::HTTP_TYPE_POST, $info);
    }

    public function del($info){
        return $this->http(self::API_DEL, Api::HTTP_TYPE_POST, $info);
    }

    public function uploadHeadImg($account,$path){
        return $this->http($this->buildUrl(self::API_UPLOAD_HEAD_IMG, ['KFACCOUNT' => $account]), Api::HTTP_TYPE_POST, [], $path);
    }

    public function get(){
        return $this->http(self::API_GET);
    }
}