# Pay

## Description
Pay模块即微信公众号支付。

## Usage
```php
<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use wechat\Application;

$options = [
    'app_id' => '123456',
    'secret' => '123456789',
    'token'  => 'wechat',
    'debug'     => true, //调试模式，默认false
    'log' => [
        'level' => 'info',  //调试模式记录级别，默认info
        'path'  => __DIR__.'/wechat.log',   //日志保存文件，默认/tmp/app.log
    ],
];

$app = new Application($options);

//支付管理
$pay = $app->pay;

$openId = '123';
$body = '测试';
$order_no = '123456789';
$price = '10000';   //单位分
$notifyUrl = 'http://MyNotifyUrl';

$jsApiParameters = $pay->prepare($openId,$body,$order_no,$price,$notifyUrl);


```