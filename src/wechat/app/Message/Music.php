<?php
/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-5-8
 * Time: 下午4:06
 */

namespace wechat\app\Message;


class Music extends AbstractMessage
{
    protected $type = 'music';

    protected $properties = ['title', 'description', 'music_url', 'hq_music_url', 'media_id'];

}