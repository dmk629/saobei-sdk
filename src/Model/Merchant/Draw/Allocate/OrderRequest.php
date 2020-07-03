<?php
namespace Saobei\sdk\Model\Merchant\Allocate;

use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Model\Merchant\Draw\DrawRequest;

class OrderRequest extends DrawRequest
{
    protected $requiredFields = array(
        'pay_ver','merchant_no','key_sign'
    );
    protected $optionalFields = array(
        'rule_no','rule_list_json','contract_no','terminal_id','terminal_trace','terminal_time','order_body','attach','out_trade_no','pay_trace','pay_time'
    );

    /** @var string 版本号 */
    protected $pay_ver;
    /** @var string 规则列表,Json数组 */
    protected $rule_list_json;
    /** @var string 分账规则编号 */
    protected $rule_no;
    /** @var string 协议编号 */
    protected $contract_no;
    /** @var string 终端号 */
    protected $terminal_id;
    /** @var string 终端流水号 */
    protected $terminal_trace;
    /** @var string 终端交易时间 */
    protected $terminal_time;
    /** @var string 订单描述 */
    protected $order_body;
    /** @var string 附加数据 */
    protected $attach;
    /** @var string 订单号 */
    protected $out_trade_no;
    /** @var string 当前支付终端流水号 */
    protected $pay_trace;
    /** @var string 当前支付终端交易时间 */
    protected $pay_time;

    /**
     * 分账查询
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $merchant_no
     * @fieldParam String $key_sign
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     * @fieldParam String $out_trade_no
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        return $this->main($fields);
    }

    /**
     * 订单分账
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $merchant_no
     * @fieldParam String $key_sign
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $out_trade_no
     * @fieldParam String $contract_no
     * @fieldParam String $rule_no
     * @fieldParam String $rule_list_json
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function doAllocate($fields)
    {
        return $this->main($fields);
    }

    /**
     * 撤销分账
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $merchant_no
     * @fieldParam String $key_sign
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $pay_trace
     * @fieldParam String $pay_time
     * @fieldParam String $out_trade_no
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function cancel($fields)
    {
        return $this->main($fields);
    }
}
