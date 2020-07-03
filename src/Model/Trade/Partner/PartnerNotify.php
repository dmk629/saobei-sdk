<?php
namespace Saobei\sdk\Model\Trade\Partner;

use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Model\Trade\TradeNotify;

class PartnerNotify extends TradeNotify
{
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
