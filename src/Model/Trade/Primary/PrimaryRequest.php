<?php
namespace Saobei\sdk\Model\Trade\Primary;
use Saobei\sdk\Model\Trade\TradeRequest;

class PrimaryRequest extends TradeRequest
{
    protected $requiredFields = array(
        'pay_ver','pay_type','service_id','merchant_no','terminal_id','terminal_trace','terminal_time','key_sign','total_fee'
    );

    /** @var string 版本号 */
    protected $pay_ver;
    /** @var string 支付方式 */
    protected $pay_type;
    /** @var string 接口类型 */
    protected $service_id;
    /** @var string 金额，单位分 */
    protected $total_fee;
    /**
     * 终端号
     *  yyyyMMddHHmmss，全局统一时间格式
     * @var string
     */
    protected $terminal_id;
    /**
     * 终端流水号
     *  填写商户系统的订单号
     * @var string
     */
    protected $terminal_trace;

}