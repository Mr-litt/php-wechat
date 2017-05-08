<?php
/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-5-8
 * Time: 下午4:04
 */

namespace wechat\app\Message;


class Video extends AbstractMessage
{
    protected $type = 'video';

    protected $properties = ['media_id', 'title' ,'description'];

}