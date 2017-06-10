<?php

/**
 * Card.php
 *
 * @author  Mr,litt<137057181@qq.com>
 * @date    2017/6/10
 */

namespace wechat\app\Card;
use wechat\app\Core\Api;
use wechat\app\Support\Card\AbstractCard;
use wechat\app\Support\CardFormat;

class Card extends Api
{

    const API_CREATE = 'https://api.weixin.qq.com/card/create?access_token=ACCESS_TOKEN';

    const API_CREATE_QR_CODE = 'https://api.weixin.qq.com/card/qrcode/create?access_token=TOKEN';
    const API_CREATE_LANDING_PAGE = 'https://api.weixin.qq.com/card/landingpage/create?access_token=TOKEN';

    const API_USER_CARD_LIST = 'https://api.weixin.qq.com/card/user/getcardlist?access_token=TOKEN';

    const API_DECRYPT_CODE = 'https://api.weixin.qq.com/card/code/decrypt?access_token=TOKEN';
    const API_GET_CODE = 'https://api.weixin.qq.com/card/code/get?access_token=TOKEN';
    const API_CONSUME_CODE = 'https://api.weixin.qq.com/card/code/consume?access_token=TOKEN';

    const API_DELETE = 'https://api.weixin.qq.com/card/delete?access_token=TOKEN';
    const API_CODE_UNAVAILABLE = 'https://api.weixin.qq.com/card/code/unavailable?access_token=TOKEN';


    /**
     * 获取颜色
     * @return array
     */
    public function getColor() {
        $info = [
            'Color010' => '#63b359',
            'Color020' => '#2c9f67',
            'Color030' => '#509fc9',
            'Color040' => '#5885cf',
            'Color050' => '#9062c0',
            'Color060' => '#d09a45',
            'Color070' => '#e4b138',
            'Color080' => '#ee903c',
            'Color081' => '#f08500',
            'Color082' => '#a9d92d',
            'Color090' => '#dd6549',
            'Color100' => '#cc463d',
            'Color101' => '#cf3e36',
            'Color102' => '#5E6671',
        ];
        return array_flip($info);
    }


    /**
     * 创建卡券
     * @param AbstractCard $card
     * @return \wechat\app\Core\Collection 返回card_id用于投放卡券
     * @throws \Exception
     */
    public function create($card) {
        if ($card instanceof AbstractCard) {
            $info = (new CardFormat())->transform($card);
        } else {
            throw new \Exception('请传入正确的类');
        }
        return $this->http(self::API_CREATE, Api::HTTP_TYPE_POST, $info);
    }


    /**
     * 创建二维码接口(使用card_id生成，用户扫描后会生成一个唯一的code)
     * @param $cardInfo
     * @return \wechat\app\Core\Collection
     */
    public function createQrCode($cardInfo) {
        return $this->http(self::API_CREATE_QR_CODE, Api::HTTP_TYPE_POST, $cardInfo);
    }


    /**
     * 创建货架
     * @param $info
     * @return \wechat\app\Core\Collection
     */
    public function createLandingPage($info){
        return $this->http(self::API_CREATE_LANDING_PAGE, Api::HTTP_TYPE_POST, $info);
    }


    /**
     * 获取用户card_id下对应的code（另一种方式获取，当用户获取后会有事件推送至服务器）
     * @param $openid
     * @param $card_id
     * @return \wechat\app\Core\Collection
     */
    public function getUserCardList($openid, $card_id) {
        $info = [
            'openid' => $openid,
            'card_id' =>$card_id,
        ];
        return $this->http(self::API_USER_CARD_LIST, Api::HTTP_TYPE_POST, $info);
    }


    /**
     * js卡券列表
     * @param $cardList
     * @return string
     */
    public function jsConfig($cardList){
        return json_encode($cardList);
    }

    /**
     * Code解码
     * @param $encrypt_code
     * @return \wechat\app\Core\Collection
     */
    public function decryptCode($encrypt_code){
        return $this->http(self::API_DECRYPT_CODE, Api::HTTP_TYPE_POST, [$encrypt_code]);
    }


    /**
     * 检查code是否是否合法
     * @param $code
     * @param string $card_id 自定义code必填
     * @return bool
     */
    public function getCode($code, $card_id = ''){

        $info = [
            'code' => $code,
            '$card_id'=>$card_id,
            'check_consume'=>true,
        ];

        try {
            $this->http(self::API_GET_CODE, Api::HTTP_TYPE_POST, $info);
        } catch (\Exception $e){
            return false;
        }
        return true;
    }

    /**
     * 核销卡卷
     * @param $code
     * @param string $card_id 自定义code必填
     * @return \wechat\app\Core\Collection
     * @throws \Exception
     */
    public function consumeCode($code, $card_id = '') {
        if($code){
            $info['code'] = $code;
            $card_id && $info['card_id'] = $card_id;
            return $this->http(self::API_CONSUME_CODE, Api::HTTP_TYPE_POST, $info);
        } else {
            throw new \Exception('参数错误');
        }
    }


    /**
     * 删除一类卡券
     * @param $card_id
     * @return \wechat\app\Core\Collection
     */
    public function delete($card_id) {
        return $this->http(self::API_DELETE, Api::HTTP_TYPE_POST, [$card_id]);
    }


    /**
     * 使一个code失效
     * @param $code
     * @param $card_id
     * @param $reason
     * @return \wechat\app\Core\Collection
     */
    public function unavailable($code, $card_id, $reason) {
        $info = [
            'code' => $code,
            'card_id' =>$card_id,
            'reasoon' => $reason
        ];
        return $this->http(self::API_CODE_UNAVAILABLE, Api::HTTP_TYPE_POST, $info);
    }

}