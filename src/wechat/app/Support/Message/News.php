<?php

/**
 * News.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-8
 */

namespace wechat\app\Support\Message;


class News extends AbstractMessage
{
    protected $type = 'news';

    protected $properties = ['title', 'description', 'picurl', 'url'];

}