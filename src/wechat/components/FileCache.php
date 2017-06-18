<?php
/**
 * FileCache.php
 *
 * @author  Mr,litt<137057181@qq.com>
 * @date    2017/6/18
 */

namespace wechat\components;


class FileCache
{
    private $options;

    public function __construct($options=[]) {

        $this->options['temp'] = isset($options['temp']) ? $options['temp'] : WECHAT_ROOT."/temp/";
        $this->options['prefix'] = isset($options['prefix']) ? $options['prefix'] : '';
        $this->options['expire'] = isset($options['expire']) ? $options['expire'] : 7200;

        if (substr($this->options['temp'], -1) != '/')
            $this->options['temp'] .= '/';
        $this->init();
    }

    /**
     * 初始化检查
     * @access private
     * @return boolean
     */
    private function init() {
        // 创建应用缓存目录
        if (!is_dir($this->options['temp'])) {
            mkdir($this->options['temp']);
        }
    }


    /**
     * 取得变量的存储文件名
     * @access private
     * @param string $name 缓存变量名
     * @return string
     */
    private function filename($name) {
        $name	=	md5($name);
        return $this->options['temp'].$name;
    }


    /**
     * 写入缓存
     * @access public
     * @param string $name 缓存变量名
     * @param mixed $value  存储数据
     * @param int $expire  有效时间 0为永久
     * @return boolean
     */
    public function set($name,$value,$expire=null) {
        if (is_null($expire)) {
            $expire = time() + $this->options['expire'];
        } else {
            if ($expire) {
                $expire =  time() + $expire;
            } else if ($expire == 0) {
                $expire = 0;
            }
        }
        $filename = $this->filename($name);
        $data['content'] = $value;
        $data['expire'] = $expire;
        $result = file_put_contents($this->options['prefix'].$filename,json_encode($data));
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 读取缓存
     * @access public
     * @param string $name 缓存变量名
     * @return mixed
     */
    public function get($name) {
        $filename   =   $this->filename($name);
        if (!is_file($filename)) {
            return false;
        }
        $data = file_get_contents($this->options['prefix'].$filename);
        if ($data) {
            $data = json_decode($data, true);
            if ($data['expire'] == 0 || $data['expire'] > time()){
                return $data['content'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 删除缓存
     * @access public
     * @param string $name 缓存变量名
     * @return boolean
     */
    public function rm($name) {
        return unlink($this->filename($name));
    }

}