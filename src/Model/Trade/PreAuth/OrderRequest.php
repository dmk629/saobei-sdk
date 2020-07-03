<?php
namespace Saobei\sdk\Model\Trade\PreAuth;
use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Util\UrlUtil;

class OrderRequest extends PreAuthRequest
{
    protected $requiredFields = array(
        'pay_ver','service_id','merchant_no','terminal_id','terminal_time','terminal_trace','key_sign','out_trade_no'
    );
    protected $optionalFields = array(
        'pay_type','order_body','pay_trace','pay_time','finish_amt','order_type'
    );

    /** @var string 版本号 */
    protected $pay_ver = '100';
    /** @var string 支付方式 */
    protected $pay_type;
    /** @var string 接口类型 */
    protected $service_id;
    /** @var string 订单描述 */
    protected $order_body;
    /** @var string 附加数据，原样返回 */
    protected $attach;
    /** @var string 订单号 */
    protected $out_trade_no;
    /** @var string 终端流水号 */
    protected $pay_trace;
    /** @var string 终端交易时间 */
    protected $pay_time;
    /** @var string 预授权金额 */
    protected $finish_amt;
    /**
     * 订单类型
     *  02预授权撤销订单查询 03预授权完成订单查询
     * @var string
     */
    protected $order_type;

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
     * @fieldParam String $out_trade_no
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        $default = array(
            'service_id' => '014'
        );
        return $this->main($fields, $default);
    }

    /**
     * 完成
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $key_sign
     * @fieldParam String $out_trade_no
     * @fieldParam String $finish_amt
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     * @fieldParam String $order_body 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function finish($fields)
    {
        $default = array(
            'service_id' => '015'
        );
        return $this->main($fields, $default);
    }

    /**
     * 撤销交易
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $key_sign
     * @fieldParam String $out_trade_no
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function cancel($fields)
    {
        $default = array(
            'service_id' => '016'
        );
        return $this->main($fields, $default);
    }

    /**
     * 状态查询
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $order_type
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $key_sign
     * @fieldParam String $out_trade_no 选填
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function queryStatus($fields)
    {
        $this->pay_ver = '110';
        $default = array(
            'service_id' => '017'
        );
        return $this->main($fields, $default);
    }
}