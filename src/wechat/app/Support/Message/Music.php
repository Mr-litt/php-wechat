<?php

/**
 * Music.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-8
 */

namespace wechat\app\Support\Message;

/**
 * Class Music
 * @package wechat\app\Support\Message
 * @property string $music_url
 * @property string $hq_music_url
 * @property string $media_id
 * @property string $title
 * @property string $description
 */
class Music extends AbstractMessage
{
    protected $type = 'music';

    protected $properties = ['title', 'description', 'music_url', 'hq_music_url', 'media_id'];

}