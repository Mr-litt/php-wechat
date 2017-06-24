# Begin

读取文档之前，首先你要对[微信官方文档](https://mp.weixin.qq.com/wiki)有一定的了解，结合微信官方文档读取本项目文档会更容易理解。

## 文档相关代码说明

1.所有返回信息经过了Collection类处理，Collection是一个继承了ArrayAccess的类，例如结果返回有access_token字段，你可以使用```$result['access_token']```或```$result->access_token```获取access_token，推荐使用```$result->access_token```。

2.被动回复消息和客服发送消息，请使用辅助消息类来传递参数，参数为字符串则默认Text类，创建卡券信息传递参数请使用辅助卡券类

3.应用实例化如下，文档中均默认为你已经实例化

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


```