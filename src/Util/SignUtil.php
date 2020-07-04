<?php
namespace Saobei\sdk\Util;

use Saobei\sdk\Config\Terminal;
use Saobei\sdk\Exception\SaobeiException;

class SignUtil
{

    /**
     * 生成签名（字典序）
     * @param array $info 参数
     * @param array $token 令牌数组
     * @return string
     *
     * @throws SaobeiException
     * */
    public static function createSign($info, $token)
    {
        ksort($info,SORT_STRING);
        $signString = "";
        foreach($info as $k=>$v){
            if($v!==null)$signString .= $k."=".$v."&";
        }
        $tokenKey = array_keys($token);
        $signString .= $tokenKey[0]."=".$token[$tokenKey[0]];
        return md5($signString);
    }

    /**
     * 验证签名（字典序）
     * @param array $info 参数
     * @param array $token 令牌数组
     * @param string $sign 签名
     * @return bool
     * @throws SaobeiException
     * */
    public static function checkSign($info, $token, $sign)
    {
        if(isset($info['key_sign']))unset($info['key_sign']);
        if(self::createSign($info, $token) != $sign)return false;
        return true;
    }

    /**
     * 生成签名（文档序）
     * @param array $info 参数
     * @param array $token 令牌数组
     * @return string
     *
     * @throws SaobeiException
     * */
    public static function createSignOld($info, $token)
    {
        $signString = "";
        foreach($info as $k=>$v){
            if($v!==null)$signString .= $k."=".$v."&";
        }
        $tokenKey = array_keys($token);
        $signString .= $tokenKey[0]."=".$token[$tokenKey[0]];
        return md5($signString);
    }

    /**
     * 验证签名（文档序）
     * @param array $info 参数
     * @param array $token 令牌数组
     * @param string $sign 签名
     * @return bool
     * @throws SaobeiException
     * */
    public static function checkSignOld($info, $token, $sign)
    {
        if(isset($info['key_sign']))unset($info['key_sign']);
        if(self::createSignOld($info, $token) != $sign)return false;
        return true;
    }

}
