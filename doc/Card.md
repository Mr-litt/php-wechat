# Account

## Description
Card模块即微信卡券。

快速完成创建卡券、投放卡券和核销卡券的流程：

1.获取access_token

2.上传卡券logo

3.创建卡券

4.创建二维码投放

5.显示二维码

6.设置测试白名单

7.核销卡劵

## Usage
```php
<?php 

//获取card实例
$card = $app->card;

//创建卡券
$general = new \wechat\app\Support\Card\GeneralCoupon();    //优惠券
$general->advanced_info = ["key"=>"advanced_info"];
$general->base_info = ["key"=>"base_info"]; //具体信息请对照微信开发者文档填写
$general->default_detail = ["key"=>"default_detail"];
$result = $card->create($general);
$card_id = $result->card_id;    //卡券ID。

//投放卡券
$cardInfo = [
   'action_name' => 'QR_CARD',
   'expire_seconds' => 1800,    //指定二维码的有效时间，范围是60 ~ 1800秒。不填默认为365天有效
   'action_info' => [
       'card_id' => $card_id,   //卡券ID。
       'code' => '',    //卡券Code码,use_custom_code字段为true的卡券必须填写，非自定义code和导入code模式的卡券不必填写。
       'openid' => '',  //指定领取者的openid，只有该用户能领取。bind_openid字段为true的卡券必须填写，非指定openid不必填写。
       'is_unique_code' => false,   //指定下发二维码，生成的二维码随机分配一个code，领取后不可再次扫描。填写true或false。默认false，注意填写该字段时，卡券须通过审核且库存不为0。
       'outer_str' => ''    //事件推送中会带上此自定义场景值
]
];
$result = $card->createQrCode($cardInfo);
$result->ticket;    //获取的二维码ticket，凭借此ticket调用通过ticket换取二维码接口可以在有效时间内换取二维码。
$result->url;   //二维码图片解析后的地址，开发者可根据该地址自行生成需要的二维码图片
$result->show_qrcode_url;   //二维码显示地址，点击后跳转二维码页面

//核销卡券
$code = 'abc';
if ($card->getCode($code)) {    //检查卡券是否合法
    $card->consumeCode($code);  //核销
}


//管理卡券
//管理卡券->获取用户的卡券
$openid = '123';
$card->getUserCardList($openid, $card_id);
//管理卡券->删除一类卡券
$card->delete($card_id);
//管理卡券->使一个卡券失效
$reason = '使一个卡券失效';
$card->unavailable($card_id, $code, $reason);

```