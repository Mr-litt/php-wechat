<?php
/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-5-3
 * Time: 下午5:18
 */

namespace wechat\app\Support;


use wechat\app\Message\AbstractMessage;
use wechat\app\Message\News;

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
                ]
            ];
        }

        return [
            "ArticleCount"=>count($articles),
            "Articles"=>$articles,
        ];
    }

}