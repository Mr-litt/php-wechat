<?php
/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-5-8
 * Time: 下午4:01
 */

namespace wechat\app\Message;


class Image extends AbstractMessage
{

    protected $type = 'image';

    protected $properties = ['media_id'];

}