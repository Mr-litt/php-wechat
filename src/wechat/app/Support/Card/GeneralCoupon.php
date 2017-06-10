<?php
/**
 * GeneralCoupon.php
 *
 * @author  Mr,litt<137057181@qq.com>
 * @date    2017/6/10
 */

namespace wechat\app\Support\Card;


class GeneralCoupon extends AbstractCard
{

    protected $type = 'GENERAL_COUPON';

    protected $properties = ['base_info', 'advanced_info', 'default_detail'];

}