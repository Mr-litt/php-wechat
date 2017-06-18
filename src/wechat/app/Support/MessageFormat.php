<?php

/**
 * MessageFormat.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-3
 */

namespace wechat\app\Support;

use wechat\app\Support\Message\AbstractMessage;
use wechat\app\Support\Message\News;

class MessageFormat
{

    public $is_customer = false;

    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function transform($message){
        $class = is_array($message) ? News::class : get_class($message);
        $prefix = 'format';
        $this->is_customer && $prefix = $prefix.'Customer';
        $handle = $prefix.ucfirst(substr($class, strlen('wechat\app\Support\Message\\')));
        return method_exists($this,$handle)?$this->$handle($message):[];
    }


    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function formatText($message){
        return [
            'Content' => $message->get('content'),
        ];
    }

    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function formatCustomerText($message) {
        return [
            'text' => ["content" => $message->get('content')],
        ];
    }

    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function formatImage($message)
    {
        return [
            'Image' => ["MediaId"=>$message->get('media_id')],
        ];
    }


    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function formatCustomerImage($message)
    {
        return [
            'image' => ["media_id"=>$message->get('media_id')],
        ];
    }


    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function formatVoice($message)
    {
        return [
            'Voice' => ["MediaId"=>$message->get('media_id')],
        ];
    }


    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function formatCustomerVoice($message)
    {
        return [
            'voice' => ["media_id"=>$message->get('media_id')],
        ];
    }

    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function formatVideo($message)
    {
        return [
            'Video' => [
                "MediaId"=>$message->get('media_id'),
                "Title"=>$message->get('title'),
                "Description"=>$message->get('description'),
            ],
        ];
    }

    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function formatCustomerVideo($message)
    {
        return [
            'Video' => [
                "media_id" => $message->get('media_id'),
                "thumb_media_id" => $message->get('media_id'),
                "title" => $message->get('title'),
                "description" => $message->get('description'),
            ],
        ];
    }


    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function formatMusic($message)
    {
        return [
            'Music' => [
                "Title"=>$message->get('title'),
                "Description"=>$message->get('description'),
                "MusicUrl"=>$message->get('music_url'),
                "HQMusicUrl"=>$message->get('hq_music_url'),
                "ThumbMediaId"=>$message->get('media_id'),
            ],
        ];
    }


    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function formatCustomerMusic($message)
    {
        return [
            'music' => [
                "title"=>$message->get('title'),
                "description"=>$message->get('description'),
                "musicurl"=>$message->get('music_url'),
                "hqmusicurl"=>$message->get('hq_music_url'),
                "thumb_media_id"=>$message->get('media_id'),
            ],
        ];
    }


    /**
     * @param \ArrayObject $message
     * @return array
     */
    public function formatNews($message)
    {
        $articles = [];
        /** @var News $new */
        foreach ($message as $new){
            $articles[] = [
                'item'=>[
                    "Title"=>$new->get('title'),
                    "Description"=>$new->get('description'),
                    "PicUrl"=>$new->get('picurl'),
                    "Url"=>$new->get('url'),
                ],
            ];
        }

        return [
            "ArticleCount"=>count($articles),
            "Articles"=>$articles,
        ];
    }



    /**
     * @param \ArrayObject $message
     * @return array
     */
    public function formatCustomerNews($message)
    {
        $articles = [];
        /** @var News $new */
        foreach ($message as $new){
            $articles[] = [
                "title"=>$new->get('title'),
                "description"=>$new->get('description'),
                "picurl"=>$new->get('picurl'),
                "url"=>$new->get('url'),
            ];
        }

        return [
            "news" => ["articles" => $articles],
        ];
    }


    /**
     * @param AbstractMessage $message
     * @return array
     */
    public function formatCustomerCard($message)
    {
        return [
            "wxcard" => ["card_id" => $message->get('card_id')],
        ];
    }

}