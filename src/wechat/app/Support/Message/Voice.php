<?php

/**
 * Voice.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-8
 */

namespace wechat\app\Support\Message;


class Voice extends AbstractMessage
{
    protected $type = 'voice';

    protected $properties = ['media_id'];

}