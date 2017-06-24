# Customer

## Description
Interaction模块即通信模块，主要介绍接受普通消息和事件推送，被动回复消息。

普通消息：

1.文本消息
2.图片消息
3.语音消息
4.视频消息
5.小视频消息
6.地理位置消息
7.链接消息

事件推送：

1.关注/取消关注事件
2.扫描带参数二维码事件
3.上报地理位置事件
4.自定义菜单事件
5.点击菜单拉取消息时的事件推送
6.点击菜单跳转链接时的事件推送

被动回复消息：

1.回复文本消息
2.回复图片消息
3.回复语音消息
4.回复视频消息
5.回复音乐消息
6.回复图文消息

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

$request    = $app->request;
$response = $app->response;

//接受消息
switch (strtolower($request->MsgType)) {
    case 'text':
        //todo...
        break;
    case 'image':
        //todo...
        break;
    case 'voice':
        //todo...
        break;
    case 'video':
        //todo...
        break;
    default:
        echo "no case";
}

//$message = '发送一个消息'; //等同于下面
$message = new \wechat\app\Support\Message\Text();
$message->content = '发送一个消息';
$response->setMessageHandler($message);  //发送文字
$response->send();

```