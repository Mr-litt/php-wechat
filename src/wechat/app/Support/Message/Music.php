<?php

/**
 * Music.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-8
 */

namespace wechat\app\Support\Message;


class Music extends AbstractMessage
{
    protected $type = 'music';

    protected $properties = ['title', 'description', 'music_url', 'hq_music_url', 'media_id'];

}