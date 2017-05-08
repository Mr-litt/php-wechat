<?php
/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-5-8
 * Time: 下午4:03
 */

namespace wechat\app\Message;


class Voice extends AbstractMessage
{
    protected $type = 'voice';

    protected $properties = ['media_id'];

}