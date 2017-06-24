<?php

/**
 * QrCode
 *
 * @author  Mr,litt<137057181@qq.com>
 * @date    2017/6/4
 */

namespace wechat\app\Account;
use wechat\app\Core\Api;

class QrCode extends Api
{

    const API_CREATE_TMP = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=TOKEN';
    const API_CREATE = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=TOKEN';
    const API_SHOW = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=TICKET';

    public function createTmp($scene_id ,$expire_seconds = 0) {
        $expire_seconds && $data['expire_seconds'] = $expire_seconds;
        $data['action_name'] = 'QR_SCENE';
        $data['action_info']['scene']['scene_id'] = $scene_id;
        return $this->http(self::API_CREATE, Api::HTTP_TYPE_POST, $data);
    }

    public function create($scene_id=0, $scene_str='') {
        if($scene_id) {
            $data['action_name'] = 'QR_LIMIT_SCENE';
            $data['action_info']['scene']['scene_id'] = $scene_id;
        } elseif ($scene_str) {
            $data['action_name'] = 'QR_LIMIT_STR_SCENE';
            $data['action_info']['scene']['scene_str'] = $scene_str;
        } else {
            throw new \Exception('参数错误');
        }
        return $this->http(self::API_CREATE, Api::HTTP_TYPE_POST, $data);
    }

    public function showUrl($ticket) {
        return $this->buildUrl(self::API_SHOW, ['TICKET' => urlencode($ticket)]);
    }

}