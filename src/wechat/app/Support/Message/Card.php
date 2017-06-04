<?php

/**
 * Card.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    2017/5/30
 */

namespace wechat\app\Support\Message;

class Card extends AbstractMessage
{
    protected $type = 'wxcard';

    protected $properties = ['card_id'];

}