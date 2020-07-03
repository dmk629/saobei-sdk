<?php
namespace Saobei\sdk\Util;

class UrlUtil
{
    /**
     * 数组拼接路由地址
     * @param array $data
     *
     * @return string
     * */
    public static function paramToUrl($data)
    {
        $url = '';
        foreach($data as $key => $value){
            $url .= $key.'='.$value.'&';
        }
        return rtrim($url,'&');
    }
}
