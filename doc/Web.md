# Web

## Description
Web模块即微信网页开发，主要介绍网页授权和JS-SDK签名。

网页授权：用户在微信客户端中访问第三方网页，公众号可以通过微信网页授权机制，来获取用户基本信息，进而实现业务逻辑。

JS-SDK签名：使用JS-SDK的页面必须先注入配置信息，配置信息当中signature签名需要服务器配置。


## Usage
```php
<?php 

//授权管理
$web = $app->web;
$openid = $web->oAuth();    //因为所有需要授权的地方都需要用到，你可以定义一个webBase基类，在构造器里面使用本代码

//js签名
$js = $app->js;
$signature = $js->getJsSdkSign();    //json字符串，直接给前端页面

```