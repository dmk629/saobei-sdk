<?php
namespace Saobei\sdk\Model\Trade\Partner;
use Saobei\sdk\Model\Trade\TradeRequest;

class PartnerRequest extends TradeRequest
{
    protected $requiredFields = array(
        'pay_ver','pay_type','merchant_no','terminal_id','key_sign'
    );

    /** @var string 版本号 */
    protected $pay_ver;
    /** @var string 支付方式 */
    protected $pay_type;
    /** @var string 金额，单位分 */
    protected $total_fee;
    /**
     * 终端号
     *  yyyyMMddHHmmss，全局统一时间格式
     * @var string
     */
    protected $terminal_id;

}