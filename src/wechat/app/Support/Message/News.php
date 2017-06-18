<?php

/**
 * News.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-8
 */

namespace wechat\app\Support\Message;

/**
 * Class News
 * @package wechat\app\Support\Message
 * @property string $picurl
 * @property string $url
 * @property string $title
 * @property string $description
 */
class News extends AbstractMessage
{
    protected $type = 'news';

    protected $properties = ['title', 'description', 'picurl', 'url'];

}