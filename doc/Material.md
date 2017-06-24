# Material

## Description
Material模块即素材管理。

注意点：

1、临时素材media_id是可复用的。
2、媒体文件在微信后台保存时间为3天，即3天后media_id失效。
3、上传临时素材的格式、大小限制与公众平台官网一致。
    图片（image）: 2M，支持PNG\JPEG\JPG\GIF格式
    语音（voice）：2M，播放长度不超过60s，支持AMR\MP3格式
    视频（video）：10MB，支持MP4格式
    缩略图（thumb）：64KB，支持JPG格式
4、需使用https调用本接口。

## Usage
```php
<?php 

//素材管理
$material = $app->material;

$type = 'image';    //image, voice, video, thumb
$file = '/image/uploadTmp.jpg';
$material->uploadTmp($type, $file); //新增临时

$media_id = 'abc';
$material->getTmp($media_id);   //获取临时素材

$material->add($type, $file);   //新添永久
$material->get($media_id);  //获取永久素材
$material->del($media_id);  //删除永久素材

```