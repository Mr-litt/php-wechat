<?php
/**
 * Created by IntelliJ IDEA.
 * User: lihaitao
 * Date: 17-4-28
 * Time: 下午3:27
 */

namespace wechat\helper;


class Fun
{

    /**
     * 获取输入参数 支持过滤和默认值
     * @param string $name 变量的名称
     * @param mixed $default 不存在的时候默认值
     * @param mixed $filter 参数过滤方法
     * @return mixed
     */
    function I($name, $default='', $filter=null) {

        if($name) { // 取值操作
            // is_array($name) && array_walk_recursive($name,'filter_exp');
            $filters    =   isset($filter)?$filter:'htmlspecialchars';
            if($filters) {
                $filters    =   explode(',',$filters);
                foreach($filters as $filter){
                    if(function_exists($filter)) {
                        $name   =   is_array($name)?Fun::array_map_recursive($filter,$name):$filter($name); // 参数过滤
                    }else{
                        $name   =   filter_var($name,is_int($filter)?$filter:filter_id($filter));
                        if(false === $name) {
                            return   isset($default)?$default:'';
                        }
                    }
                }
            }
        }else{ // 变量默认值
            $name       =    isset($default)?$default:'';
        }
        return $name;
    }

    function array_map_recursive($filter, $data) {
        $result = array();
        foreach ($data as $key => $val) {
            $result[$key] = is_array($val)
                ? Fun::array_map_recursive($filter, $val)
                : call_user_func($filter, $val);
        }
        return $result;
    }

}