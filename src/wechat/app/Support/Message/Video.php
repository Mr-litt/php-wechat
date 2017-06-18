<?php

/**
 * Video.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-8
 */

namespace wechat\app\Support\Message;


/**
 * Class Video
 * @package wechat\app\Support\Message
 * @property string $media_id
 * @property string $title
 * @property string $description
 */
class Video extends AbstractMessage
{
    protected $type = 'video';

    protected $properties = ['media_id', 'title' ,'description'];

}