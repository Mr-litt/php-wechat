# Pay

## Description
Pay模块即微信公众号支付。

## Usage
```php
<?php 

//支付管理
$pay = $app->pay;

$openId = '123';
$body = '测试';
$order_no = '123456789';
$price = '10000';   //单位分
$notifyUrl = 'http://MyNotifyUrl';

$jsApiParameters = $pay->prepare($openId,$body,$order_no,$price,$notifyUrl);


```