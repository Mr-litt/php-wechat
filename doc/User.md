# User

## Description
User模块即用户管理，主要介绍获取用户信息。

## Usage
```php
<?php 

//用户管理
$user = $app->user;
$openid = '123';
$user->info($openid);

```