<?php

/**
 * Curl.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-11
 */

namespace wechat\components;


class Curl
{
    /**
     * @param $url
     * @param array $postFields
     * @param array $header
     * @param string $file_path
     * @return mixed
     */
    public static function post($url, $postFields = [], $file_path = '', $header =[]){
        if(is_array($postFields)) $postFields = http_build_query($postFields);

        $ch = curl_init();
        if($file_path){
            if(class_exists("CURLFile")){
                $postFields= array("media"=>new \CURLFile($file_path));
            }else{
                $postFields= array("media"=>"@".$file_path);
                curl_setopt ( $ch, CURLOPT_SAFE_UPLOAD, false);
            }
        }

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
    /**
     * get
     * @param $url
     * @param array $getFields
     * @return mixed
     */
    public static function get($url, $getFields = []){
        if ($getFields) {
            $getFields = http_build_query($getFields);
            $url .='?'.$getFields;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}