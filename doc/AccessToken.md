# AccessToken

## Description
AccessToken模块主要介绍access_token，js_api_ticket，card_api_ticket的获取方式。

三种token的介绍：

1.access_token：公众号的全局唯一接口调用凭据，公众号调用各接口时都需使用access_token。

2.js_api_ticket：公众号用于调用微信JS接口的临时票据

3.card_api_ticket：调用卡券相关接口的临时票据

三种token的相同点：

1.存在有效期，有效期通过返回的expire_in来传达

2.主动刷新将导致上一次获取的token失效

3.开发者需要妥善保存，建议统一获取和刷新token

鉴于三种token的特定和相同点，SDK已经处理好数据的保存和有效期的更新，通过相应类类调用方法就能保证是有效的token

## Usage
```php
<?php 

//获取access_token
$accessToken = $app->access_token;
$value = $accessToken->get();

//获取js_api_ticket
$jsApiTicket = $app->js_api_ticket;
$value = $jsApiTicket->get();

//card_api_ticket
$cardApiTicket = $app->card_api_ticket;
$value = $cardApiTicket->get();

```