<?php
namespace wechat\app\Message;

/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-5-2
 * Time: 下午6:12
 */
class Text extends AbstractMessage
{
    protected $type = 'text';

    protected $properties = ['content'];

}