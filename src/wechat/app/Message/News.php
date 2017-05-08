<?php
/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-5-8
 * Time: 下午4:41
 */

namespace wechat\app\Message;


class News extends AbstractMessage
{
    protected $type = 'news';

    protected $properties = ['title', 'description', 'picurl', 'url'];

}