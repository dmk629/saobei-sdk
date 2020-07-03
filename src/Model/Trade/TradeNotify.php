<?php
namespace Saobei\sdk\Model\Trade;

use Saobei\sdk\Config\Terminal;
use Saobei\sdk\Model\Notify;
use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Util\SignUtil;

class TradeNotify extends Notify
{
    /**
     * 验证请求
     * @param array $data
     *
     * @return bool
     * @throws SaobeiException
     * */
    protected function verifySign($data)
    {
        return SignUtil::checkSign($data, array('access_token' => Terminal::getInstance()->getToken()), $data['key_sign']);
    }
}