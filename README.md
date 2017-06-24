# php-wechat
## Description
这是一个简单开发微信公众号的SDK。

帮你解决应用和微信服务器交互的复杂和繁琐，让你像开发普通PHP应用一样去开发微信公众号。
 
## Feature
 - 隐藏应用和微信交互的细节，免去拼接xml和json等麻烦；
 - 结构清晰，模块化管理，易于扩展；
 - 丰富的功能类，让功能开发变得非常简单；
 - 详细的错误报告，一切交互都一目了然；
 
## Requirement
1. PHP >= 5.4.9
2. [composer](http://www.phpcomposer.com/)
3. php-xml 扩展
4. php-curl 扩展
> SDK 对所使用的框架并无特别要求

## Installation
使用[composer](http://www.phpcomposer.com/)安装
```shell
composer require mr-litt/wechat
```

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
$response = $app->response; //获取respomse对象
$response->setMessageHandler("欢迎光临！");  //设置返回信息
$response->send();

```

##Documentation
具体使用详见列表文档：
0. [Begin]()
1. [AccessToken]()
2. [Account]()
3. [Card]()
4. [Customer]()
5. [Interaction]()
6. [Material]()
7. [Menu]()
8. [Pay]()
9. [User]()
10. [Web]()

## License

MIT
