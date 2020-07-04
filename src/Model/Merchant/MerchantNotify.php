<?php
namespace Saobei\sdk\Model\Merchant;

use Saobei\sdk\Config\Merchant;
use Saobei\sdk\Model\Notify;
use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Util\SignUtil;

class MerchantNotify extends Notify
{
    /**
     * 商户变更回调通知
     * @param array $data
     * @param \Closure $callback
     *
     * @return array
     * @throws SaobeiException
     * */
    public function changeNotify($data, $callback)
    {
        return $this->onRequest($data, $callback);
    }

    /**
     * 交易通知
     * @param array $data
     * @param \Closure
     *
     * @return array
     * @throws SaobeiException
     * */
    public function notify($data, $callback)
    {
        if(SignUtil::checkSign(
            array(
                'return_code' => $data['return_code'],
                'return_msg' => $data['return_msg'],
                'trace_no' => $data['trace_no'],
                'result_code' => $data['result_code'],
                'inst_no' => $data['inst_no'],
                'merchant_no' => $data['merchant_no'],
                'key_sign' => $data['key_sign']
            ),
            array('key' => Merchant::getInstance()->getKey()),
            $data['key_sign']
        )
        ){
            return $this->onSucceed($callback);
        }
        return $this->onFailed();
    }

    /**
     * 验证请求(重写)
     * @param array $data
     *
     * @return bool
     * @throws SaobeiException
     * */
    protected function verifySign($data)
    {
        return SignUtil::checkSign($data, array('key' => Merchant::getInstance()->getKey()), $data['key_sign']);
    }

    /**
     * 请求失败事件
     * @throws SaobeiException
     * */
    protected function onFailed()
    {
        return $this->reply(false);
    }

}