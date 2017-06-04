<?php

/**
 * Image.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-8
 */

namespace wechat\app\Support\Message;


class Image extends AbstractMessage
{

    protected $type = 'image';

    protected $properties = ['media_id'];

}