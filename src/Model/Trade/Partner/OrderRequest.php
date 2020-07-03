<?php
namespace Saobei\sdk\Model\Trade\Partner;
use Saobei\sdk\Exception\SaobeiException;

class OrderRequest extends PartnerRequest
{
    protected $requiredFields = array(
        'pay_ver','pay_type','merchant_no','terminal_id','key_sign','terminal_trace','terminal_time'
    );
    protected $optionalFields = array(
        'sub_appid','trade_scene','plate_number','scene_info','total_fee','order_body','goods_tag','goods_detail','attach','notify_url'
    );

    /** @var string 版本号 */
    protected $pay_ver = '110';
    /**
     * 终端流水号
     *  填写商户系统的订单号
     * @var string
     */
    protected $terminal_trace;
    /** @var string 微信子商户appid */
    protected $sub_appid;
    /**
     * 交易场景
     *  1. PARKING：车场停车场景 2. PARKING SPACE；车位停车场景 3GAS 加油场景 4. HIGHWAY 高速场景 5. BRIDGE 路桥场景
     * @var string
     */
    protected $trade_scene;
    /**
     * 场景信息
     *  格式为json，不同业务场景设置不同的值，具体如后面所列。
     * @var string
     */
    protected $scene_info;
    /** @var string 车牌号 */
    protected $plate_number;
    /** @var string 金额 */
    protected $total_fee;
    /** @var string 通知地址 */
    protected $notify_url;
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
    /**
     * 利楚订单号
     *  来自自助收银SDK调用凭证获取接口，仅微信刷脸支付必传
     * @var string
     */
    protected $out_trade_no;
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
    /** @var string 附加数据，原样返回 */
    protected $refund_fee;

    /**
     * 申请扣款
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $total_fee
     * @fieldParam String $key_sign
     * @fieldParam String $sub_appid
     * @fieldParam String $trade_scene
     * @fieldParam String $scene_info
     * @fieldParam String $plate_number
     * @fieldParam String $notify_url
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach 选填
     * @fieldParam String $goods_detail 选填
     * @fieldParam String $goods_tag 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function payApply($fields)
    {
        return $this->main($fields);
    }

    /**
     * 查询订单
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $key_sign
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     * @fieldParam String $out_trade_no 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        return $this->main($fields);
    }

    /**
     * 申请退款
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $key_sign
     * @fieldParam String $refund_fee
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     * @fieldParam String $out_trade_no 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function refund($fields)
    {
        return $this->main($fields);
    }
}
