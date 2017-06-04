<?php

/**
 * Material.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-12
 */

namespace wechat\app\Material;
use wechat\app\Core\Api;

class Material extends Api
{

    const TYPE_IMAGE = 'image';
    const TYPE_VOICE = 'voice';
    const TYPE_VIDEO = 'video';
    const TYPE_THUMB = 'thumb';

    const API_UPLOAD_TMP = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=ACCESS_TOKEN&type=TYPE';
    const API_GET_TMP = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token=ACCESS_TOKEN&media_id=MEDIA_ID';

    const API_ADD_NEWS = 'https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=ACCESS_TOKEN';
    const API_ADD = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=ACCESS_TOKEN&type=TYPE';
    const API_GET = 'https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=ACCESS_TOKEN';
    const API_DEL = 'https://api.weixin.qq.com/cgi-bin/material/del_material?access_token=ACCESS_TOKEN';

    const API_GET_COUNT = 'https://api.weixin.qq.com/cgi-bin/material/get_materialcount?access_token=ACCESS_TOKEN';
    const API_GET_LIST = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=ACCESS_TOKEN';

    public function uploadTmp($type, $path) {
        if (!$this->checkType($type)) {
            throw new \Exception('类型错误');
        }
        return $this->http($this->buildUrl(self::API_UPLOAD_TMP, ['TYPE' => $type]), Api::HTTP_TYPE_POST, [], $path);
    }

    public function getTmp($media_id) {
        return $this->http($this->buildUrl(self::API_GET_TMP, ['MEDIA_ID', $media_id]));
    }

    public function add($type, $path) {
        if (!$this->checkType($type)) {
            throw new \Exception('类型错误');
        }
        return $this->http($this->buildUrl(self::API_ADD, ['TYPE' => $type]), Api::HTTP_TYPE_POST, [], $path);
    }

    public function get($media_id) {
        return $this->http(self::API_GET, Api::HTTP_TYPE_POST, ['media_id' => $media_id]);
    }

    public function del($media_id) {
        return $this->http(self::API_DEL, Api::HTTP_TYPE_POST, ['media_id' => $media_id]);
    }

    public function addNews() {
        ///todo...
        return false;
    }

    private function checkType($type) {
        return in_array($type, [self::TYPE_IMAGE, self::TYPE_THUMB, self::TYPE_VIDEO, self::TYPE_VOICE]);
    }

}