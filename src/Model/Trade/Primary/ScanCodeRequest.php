<?php
namespace Saobei\sdk\Model\Trade\Primary;

use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Model\Request;

class ScanCodeRequest extends Request
{
    protected $requiredFields = array(
        'merchant_no','terminal_id','out_shop_no','sub_appid','openid','login_token', 'order_entry','out_trade_no',
        'out_order_no','total_amount','discount_amount','user_amount','status','action_time','dish_list'
    );

    protected $optionalFields = array(
        'sub_appid','pay_time','transaction_id','out_table_no','people_count'
    );

    /** @var string 商户号 */
    protected $merchant_no;
    /** @var string 终端号 */
    protected $terminal_id;
    /** @var string 门店编号 */
    protected $out_shop_no;
    /** @var string 子商户号 */
    protected $sub_appid;
    /** @var string 子商户appid下的openid */
    protected $openid;
    /**
     * 登录票据
     *  微信接口返回的登录票据 公众号，填写access_token 小程序，填写session_key
     * @var string
     */
    protected $login_token;
    /** @var string 点餐入口 */
    protected $order_entry;
    /** @var int 总价 */
    protected $total_amount;
    /** @var int 优惠金额 */
    protected $discount_amount;
    /** @var int 实际支付 */
    protected $user_amount;
    /**
     * 订单状态
     *  取值如下：CREATE_DEAL—用户下单；PAY_SUCCESS—支付完成， 结账成功；
     * @var string
     */
    protected $status;
    /**
     * 状态发生变化的时间
     *  格式为 rfc3339格式，如 2018-06-08T10:34:56+08:0 0 代表北京时间2018年06月 08日10时34分56秒
     * @var string
     */
    protected $action_time;
    /**
     * 支付时间
     *  格式为 rfc3339格式，如 2018-06-08T10:34:56+08:0 0 （status 为 PAY_SUCCESS时必填）
     * @var string
     */
    protected $pay_time;
    /**
     * 微信支付订单号
     *  status 为 PAY_SUCCESS时必填
     * @var string
     */
    protected $transaction_id;
    /**
     * 利楚唯一订单号
     *  服务商系统内部支付订单号 （status为PAY_SUCCESS时 必填）
     * @var string
     */
    protected $out_trade_no;
    /** @var string 利楚唯一订单号 */
    protected $out_order_no;
    /** @var array 菜品列表 */
    protected $dish_list	;
    /** @var string 桌位号 */
    protected $out_table_no;
    /** @var string 消费人数 */
    protected $people_count;

    /**
     * 扫码点餐数据上传
     * @param array $fields
     *
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $out_shop_no
     * @fieldParam String $sub_appid
     * @fieldParam String $openid
     * @fieldParam String $login_token
     * @fieldParam String $order_entry
     * @fieldParam int $total_amount
     * @fieldParam int $discount_amount
     * @fieldParam int $user_amount
     * @fieldParam String $status
     * @fieldParam String $action_time
     * @fieldParam String $pay_time
     * @fieldParam String $transaction_id
     * @fieldParam String $out_trade_no
     * @fieldParam array $dish_list
     * @fieldParam String $out_table_no
     * @fieldParam String $people_count
     *
     * @return array
     * @throws SaobeiException
     * */
    public function orderSync($fields)
    {

        $this->init($fields);
        $this->checkParam();
        $param = $this->getter();
        return $param;
    }

}