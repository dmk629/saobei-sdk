<?php
namespace Saobei\sdk\Model\Trade\PreAuth;
use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Util\UrlUtil;

class PayRequest extends PreAuthRequest
{
    protected $optionalFields = array(
        'pay_ver','pay_type','service_id','order_body','attach','goods_detail','goods_tag','auth_no','notify_url','open_id','out_trade_no','front_url','auto_pay','repeated_trace'
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
    /** @var string 授权码 */
    protected $auth_no;
    /** @var string 通知地址 */
    protected $notify_url;
    /**
     * 前端回调地址
     *  必须urlencode（get请求拼接需要urlencode，签名拼接不需要urlencode），不填则支付成功后不跳转
     * @var string
     */
    protected $front_url;
    /**
     * 自动点击支付按钮
     *  1自动，0或不传手动
     * @var string
     */
    protected $auto_pay;

    /**
     * 付款码支付
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $auth_no
     * @fieldParam String $total_fee
     * @fieldParam String $key_sign
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function barcode($fields)
    {
        $this->requiredFields = array_merge($this->requiredFields, array('pay_ver','pay_type','service_id'));
        $default = array(
            'pay_type' => '000',
            'service_id' => '010'
        );
        return $this->main($fields, $default);
    }

    /**
     * 获取聚合码
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $total_fee
     * @fieldParam String $key_sign
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function qr($fields)
    {
        $this->requiredFields = array_merge($this->requiredFields, array('pay_ver','pay_type','service_id'));
        $default = array(
            'service_id' => '011'
        );
        return $this->main($fields, $default);
    }

    /**
     * 预授权聚合码
     * @param array $fields
     *
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $total_fee
     * @fieldParam String $key_sign
     * @fieldParam String $auto_pay
     * @fieldParam String $front_url
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     *
     * @return string
     * @throws SaobeiException
     * */
    public function qrH5Pay($fields)
    {
        $param = $this->main($fields);
        return '?'.UrlUtil::paramToUrl($param);
    }

    /**
     * 公众号预授权
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $total_fee
     * @fieldParam String $key_sign
     * @fieldParam String $open_id 选填
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function jsPay($fields)
    {
        $this->requiredFields = array_merge($this->requiredFields, array('pay_ver','pay_type','service_id'));
        $default = array(
            'service_id' => '013'
        );
        return $this->main($fields, $default);
    }

    /**
     * 小程序预授权
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $total_fee
     * @fieldParam String $key_sign
     * @fieldParam String $open_id 选填
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function miniPay($fields)
    {
        $this->requiredFields = array_merge($this->requiredFields, array('pay_ver','pay_type','service_id'));
        $default = array(
            'service_id' => '014'
        );
        return $this->main($fields, $default);
    }

    /**
     * 刷脸预授权
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $total_fee
     * @fieldParam String $key_sign
     * @fieldParam String $auth_no
     * @fieldParam String $open_id 选填
     * @fieldParam String $out_trade_no 选填
     * @fieldParam String $operator_id 选填
     * @fieldParam String $goods_detail 选填
     * @fieldParam String $goods_tag 选填
     * @fieldParam String $device_type 选填
     * @fieldParam String $terminal_params 选填
     * @fieldParam String $sub_appid 选填
     * @fieldParam String $order_body 选填
     * @fieldParam String $notify_url 选填
     * @fieldParam String $coupon_no 选填
     * @fieldParam String $attach 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function facePay($fields)
    {
        $this->requiredFields = array_merge($this->requiredFields, array('pay_ver','pay_type','service_id'));
        $default = array(
            'service_id' => '015'
        );
        return $this->main($fields, $default);
    }
}
