<?php
/**
 * CardFormat.php
 *
 * @author  Mr,litt<137057181@qq.com>
 * @date    2017/6/10
 */

namespace wechat\app\Support;


use wechat\app\Support\Card\AbstractCard;

class CardFormat
{

    public function transform($card){
        $class = get_class($card);
        $prefix = 'format';
        $handle = $prefix.ucfirst(substr($class, strlen('wechat\app\Support\Card\\')));
        return method_exists($this,$handle)?$this->$handle($card):[];
    }


    /**
     * @param AbstractCard $card
     * @return array
     */
    public function formatGeneralCoupon($card){
        return [
            'card' => [
                'card_type' => $card->getType(),
                'general_coupon' => [
                    'base_info' => $card->get('base_info'),
                    'advanced_info' => $card->get('advanced_info'),
                    'default_detail' => $card->get('default_detail'),
                ]
            ]
        ];
    }

}