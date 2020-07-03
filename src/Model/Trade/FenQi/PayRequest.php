<?php
namespace Saobei\sdk\Model\Trade\FenQi;
use Saobei\sdk\Exception\SaobeiException;

class PayRequest extends FenQiRequest
{
    protected $requiredFields = array(
        'pay_ver','pay_type','service_id','merchant_no','terminal_id','terminal_trace','terminal_time','key_sign','fenqi_num','total_fee'
    );

    protected $optionalFields = array(
        'order_body','attach','goods_detail','goods_tag','auth_no','notify_url','open_id'
    );

    protected $pay_ver = '110';
    /** @var string 花呗分期数,支持 3,6,12 期 */
    protected $fenqi_num;
    /** @var string 附加数据，原样返回 */
    protected $total_fee;
    /** @var string 订单描述 */
    protected $order_body;
    /** @var string 附加数据，原样返回 */
    protected $attach;
    /**
     * 商品列表
     *  Json格式,pay_type为010，020，090时，可选填此字段
     * @var string
     */
    protected $goods_detail;
    /**
     * 订单优惠标记
     *  代金券或立减优惠功能的参数
     * @var string
     */
    protected $goods_tag;
    /** @var string 授权码 */
    protected $auth_no;
    /** @var string 通知地址 */
    protected $notify_url;
    /**
     * 用户标识
     *  （微信openid，支付宝userid），pay_type为010及020时需要传入
     * @var string
     */
    protected $open_id;

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
     * @fieldParam String $fenqi_num
     * @fieldParam String $key_sign
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     * @fieldParam String $goods_detail 选填
     * @fieldParam String $goods_tag 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function barcodePay($fields)
    {
        $default = array(
            'service_id' => '010'
        );
        return $this->main($fields, $default);
    }

    /**
     * 扫码支付
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
     * @fieldParam String $fenqi_num
     * @fieldParam String $key_sign
     * @fieldParam String $notify_url 选填
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     * @fieldParam String $goods_detail 选填
     * @fieldParam String $goods_tag 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function prepay($fields)
    {
        $default = array(
            'service_id' => '011'
        );
        return $this->main($fields, $default);
    }

    /**
     * 公众号预支付
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
     * @fieldParam String $notify_url 选填
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     * @fieldParam String $goods_detail 选填
     * @fieldParam String $goods_tag 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function jsPay($fields)
    {
        $default = array(
            'service_id' => '012'
        );
        return $this->main($fields, $default);
    }

    /**
     * 小程序预支付
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
     * @fieldParam String $notify_url 选填
     * @fieldParam String $sub_appid 选填
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     * @fieldParam String $goods_detail 选填
     * @fieldParam String $goods_tag 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function miniPay($fields)
    {
        $default = array(
            'service_id' => '015'
        );
        return $this->main($fields, $default);
    }

}