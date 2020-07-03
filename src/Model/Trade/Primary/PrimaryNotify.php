<?php
namespace Saobei\sdk\Model\Trade\Primary;

use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Model\Trade\TradeNotify;

/**
 * 回调类
 *      回调参数格式化为数组传入闭包callback，闭包返回规范如下：
 * @example
 *  []
 *  ["status" => true]
 *  ["status" => true, "errmsg" => "成功"]
 *  ["status" => false, "errmsg" => "签名失败"]
 * */
class PrimaryNotify extends TradeNotify
{
    /**
     * 交易实时同步
     * @param array $data
     * @param \Closure $callback
     *
     * @return array
     * @throws SaobeiException
     * */
    public function orderSync($data, $callback)
    {
        return $this->onRequest($data, $callback);
    }

    /**
     * 交易通知
     * @param array $data
     * @param \Closure $callback
     *
     * @return array
     * @throws SaobeiException
     * */
    public function notify($data, $callback)
    {
        return $this->onRequest($data, $callback);
    }
}
