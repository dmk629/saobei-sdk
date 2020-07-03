<?php
namespace Saobei\sdk\Model\Trade\Primary;
use Saobei\sdk\Config\Terminal;
use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Util\SignUtil;
use Saobei\sdk\Util\UrlUtil;

class PayRequest extends PrimaryRequest
{
    protected $optionalFields = array(
        'order_body','attach','goods_detail','goods_tag','auth_no','notify_url','open_id','out_trade_no','front_url','auto_pay','repeated_trace'
    );

    /** @var string 订单描述 */
    protected $pay_ver = '110';
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
     * 利楚订单号
     *  来自自助收银SDK调用凭证获取接口，仅微信刷脸支付必传
     * @var string
     */
    protected $out_trade_no;
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
     * 是否允许订单重复
     *  1:不允许重复,0或不传:允许重复
     * @var string
     */
    protected $repeated_trace;

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
     * @fieldParam String $sub_appid 选填
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
     * @fieldParam String $key_sign
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
     * @fieldParam String $sub_appid 选填
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
     * 小程序支付
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

    /**
     * 刷脸支付
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
     * @fieldParam String $auth_no
     * @fieldParam String $key_sign
     * @fieldParam String $open_id 选填
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     * @fieldParam String $out_trade_no 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function facePay($fields)
    {
        $default = array(
            'service_id' => '016'
        );
        return $this->main($fields, $default);
    }

    /**
     * WAP SDK
     * @param array $fields
     *
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $total_fee
     * @fieldParam String $key_sign
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     * @fieldParam String $notify_url 选填
     * @fieldParam String $front_url 选填
     * @fieldParam String $auto_pay 选填
     * @fieldParam String $repeated_trace 选填
     *
     * @return string
     * @throws SaobeiException
     * */
    public function wapPay($fields)
    {
        $this->requiredFields = array_diff($this->requiredFields, array('pay_ver','pay_type','service_id'));
        $this->init($fields);
        $this->checkParam(array());
        $param = $this->getter();
        if(!empty($param['notify_url']))$param['notify_url'] = urlencode($param['notify_url']);
        if(!empty($param['front_url']))$param['front_url'] = urlencode($param['front_url']);
        unset($param['key_sign']);
        $param['key_sign'] = SignUtil::createSign($param, array('access_token'=>Terminal::getInstance()->getToken()));
        return '?'.UrlUtil::paramToUrl($param);
    }

    /**
     * 聚合码支付
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
     * @fieldParam String $notify_url 选填
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     * @fieldParam String $repeated_trace 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function qrPay($fields)
    {
        $default = array(
            'pay_type' => '000',
            'service_id' => '016'
        );
        return $this->main($fields, $default);
    }
}