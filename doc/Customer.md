# Customer

## Description
Customer模块即微信客服，主要介绍账号管理和发送消息。

客服消息：客服发送消息使用辅助消息类（Text, Image, Music, News, Video, Voice, Card），特别注意此处可以发送卡券。

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


//账号管理
$customerAccount = $app->customer_account;
$info = [
    'kf_account' => 'test1@test',
    'nickname' => '客服1',
    'password' => 'pswmd5',
];
$customerAccount->add($info);   //添加客服

$customerAccount->update($info);    //修改客服

$customerAccount->del($info);   //删除客服

$account = 'test1@test';
$imgFile = '/image/headImg.jpg';    //头像图片文件必须是jpg格式，推荐使用640*640大小的图片以达到最佳效果。
$customerAccount->uploadHeadImg($account, $imgFile);    //设置客服头像

$customerAccount->get();    //获取客服列表



//发送消息
$customerMessage = $app->customer_message;
$openid = '123';
//$message = '客服发送一个消息'; //等同于下面
$message = new \wechat\app\Support\Message\Text();
$message->content = '客服发送一个消息';
$customerMessage->send($openid, $message);  //发送文字
$message = new \wechat\app\Support\Message\Card();
$message->card_id = 'abc';
$customerMessage->send($openid, $message);  //发送卡券

```