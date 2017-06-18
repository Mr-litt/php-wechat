<?php

/**
 * Pay.php
 *
 * @author  Mr,litt<137057181@qq.com>
 * @date    2017/6/10
 */


namespace wechat\app\Pay;

use wechat\app\Core\Api;

class Pay extends Api
{
    /**
     * 统一下单
     * @param $openId
     * @param String $body 订单body
     * @param String $order_no 订单
     * @param int $price 价格单位分
     * @param String $notifyUrl 回调地址
     * @return \json数据
     * @throws \Exception
     */
    public function prepare($openId,$body,$order_no,$price,$notifyUrl) {

        if (empty($openId) || empty($body) || empty($order_no) || empty($price) || empty($notifyUrl)) {
            throw new \Exception("参数错误");
        }

        require_once WECHAT_ROOT."/app/Support/WxpayAPI_php_v3/lib/WxPay.Api.php";
        require_once WECHAT_ROOT."/app/Support/WxpayAPI_php_v3/example/WxPay.JsApiPay.php";
        require_once WECHAT_ROOT."/app/Support/WxpayAPI_php_v3/example/log.php";

        echo "ok";exit;
        //初始化日志
        $logHandler= new \CLogFileHandler("../logs/".date('Y-m-d').'.log');
        $log = \Log::Init($logHandler, 15);


        //①、获取用户openid
        $tools = new \JsApiPay();
        //$openId = $tools->GetOpenid();

        //②、统一下单
        $input = new \WxPayUnifiedOrder();
        $input->SetBody($body);
        //$input->SetAttach("test");
        $input->SetOut_trade_no($order_no);
        $input->SetTotal_fee($price);
        //$input->SetTime_start(date("YmdHis"));
        //$input->SetTime_expire(date("YmdHis", time() + 600));
        //$input->SetGoods_tag("test");
        $input->SetNotify_url($notifyUrl);
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = \WxPayApi::unifiedOrder($input);
        //echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
        //printf_info($order);
        $jsApiParameters = $tools->GetJsApiParameters($order);

        //获取共享收货地址js函数参数
        //$editAddress = $tools->GetEditAddressParameters();

        //③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
        /**
         * 注意：
         * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
         * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
         * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
         */
        return $jsApiParameters;

    }

}