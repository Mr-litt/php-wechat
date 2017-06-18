<?php

/**
 * Text.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-2
 */


namespace wechat\app\Support\Message;

/**
 * Class Text
 * @package wechat\app\Support\Message
 * @property mixed|null $content
 */
class Text extends AbstractMessage
{
    protected $type = 'text';

    protected $properties = ['content'];

}