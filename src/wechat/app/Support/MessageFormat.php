<?php
/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-5-3
 * Time: 下午5:18
 */

namespace wechat\app\Support;


use wechat\app\Message\AbstractMessage;

class MessageFormat
{

    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function transform($message){
        $class = get_class($message);
        $handle = 'format'.ucfirst(substr($class, strlen('wechat\app\Message\\')));
        return method_exists($this,$handle)?$this->$handle($message):[];
    }


    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function formatText($message)
    {
        return [
            'Content' => $message->get('content'),
        ];
    }

}