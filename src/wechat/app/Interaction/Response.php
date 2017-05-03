<?php

namespace wechat\app\Interaction;
use wechat\app\Message\AbstractMessage;
use wechat\app\Message\Text;
use wechat\app\Support\MessageFormat;
use wechat\app\Support\Xml;


/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-4-28
 * Time: 下午3:24
 */
class Response extends AbstractInteraction
{

    protected $content;


    public function __construct($message = null)
    {
        if($message != null){
            $this->setMessageHandler($message);
        }
        parent::__construct();
    }


    public function setMessageHandler($message){
        if (is_string($message)) {
            $message = new Text(['content' => $message]);
        }

        if($message instanceof AbstractMessage){
            $this->content = $this->buildReply($this->getFrom(),$this->getTo(),$message);
        }
    }

    /**
     * @param $to
     * @param $from
     * @param AbstractMessage $message
     * @return string
     */
    protected function buildReply($to,$from,$message){
        $base = [
            'ToUserName' => $to,
            'FromUserName' => $from,
            'CreateTime' => time(),
            'MsgType' => $message->getType(),
        ];
        $detail = (new MessageFormat)->transform($message);
        return Xml::build(array_merge($base,$detail));
    }

    public function send(){
        $this->sendHeaders();
        $this->sendContent();
    }


    protected function sendHeaders(){
        if(!headers_sent()){
            header('HTTP/1.1 200 ok', true, 200);
        }
    }


    protected function sendContent(){
        echo $this->content != ""?$this->content:"";
    }
}