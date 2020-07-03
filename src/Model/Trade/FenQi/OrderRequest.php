<?php
namespace Saobei\sdk\Model\Trade\FenQi;

use Saobei\sdk\Exception\SaobeiException;

class OrderRequest extends FenQiRequest
{
    protected $requiredFields = array(
        'pay_ver','pay_type','service_id','merchant_no','terminal_id','terminal_trace','terminal_time','key_sign'
    );

    protected $optionalFields = array(
        'out_trade_no','out_refund_no','pay_trace','pay_time','refund_fee'
    );

    /** @var string 版本号 */
    protected $pay_ver = '110';
    /** @var string 支付方式 */
    protected $pay_type;
    /** @var string 接口类型 */
    protected $service_id;
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
    /**
     * 利楚订单号
     *  来自自助收银SDK调用凭证获取接口，仅微信刷脸支付必传
     * @var string
     */
    protected $out_trade_no;
    /**
     * 利楚唯一退款订单号
     * @var string
     */
    protected $out_refund_no;
    /**
     * 退款终端流水号
     *  与pay_time同时传递
     * @var string
     */
    protected $pay_trace;
    /**
     * 当前支付终端交易时间
     *  yyyyMMddHHmmss，全局统一时间格式，与pay_trace同时传递
     * @var string
     */
    protected $pay_time;
    /** @var string 退款金额 */
    protected $refund_fee;

    /**
     * 支付查询
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $key_sign
     * @fieldParam String $out_trade_no 选填
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        $default = array(
            'service_id' => '020'
        );
        return $this->main($fields, $default);
    }

    /**
     * 退款申请
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $refund_fee
     * @fieldParam String $key_sign
     * @fieldParam String $out_trade_no
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     * @fieldParam String $auth_code 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function refund($fields)
    {
        $default = array(
            'service_id' => '030',
            'pay_type' => '000'
        );
        return $this->main($fields, $default);
    }

    /**
     * 撤销交易
     *  注：只针对刷卡支付
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $key_sign
     * @fieldParam String $out_trade_no 选填
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function cancel($fields)
    {
        $default = array(
            'service_id' => '040',
            'pay_type' => '000'
        );
        return $this->main($fields, $default);
    }

    /**
     * 关闭订单
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $key_sign
     * @fieldParam String $out_trade_no 选填
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function close($fields)
    {
        $default = array(
            'service_id' => '041',
            'pay_type' => '000'
        );
        return $this->main($fields, $default);
    }

    /**
     * 退款订单查询
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $key_sign
     * @fieldParam String $out_trade_no
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function queryRefund($fields)
    {
        $default = array(
            'service_id' => '031',
            'pay_type' => '000'
        );
        return $this->main($fields, $default);
    }

}