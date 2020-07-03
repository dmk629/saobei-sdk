<?php
namespace Saobei\sdk\Model\Merchant;

use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Model\Merchant\Draw\DrawRequest;

class TransferRequest extends DrawRequest
{
    protected $requiredFields = array(
        'inst_no','trace_no','version','merchant_no','key_sign'
    );
    protected $optionalFields = array(
        'account_no','terminal_id','terminal_trace', 'terminal_time','account_out','total_fee','order_body','attach',
        'trans_type','pay_trace','pay_time','out_transfer_no',
    );

    /** @var string 机构编号 */
    protected $inst_no;
    /** @var string 请求流水号 */
    protected $trace_no;
    /** @var string 记账户账号 */
    protected $account_no;
    /** @var string 版本号 */
    protected $version = '110';
    /** @var string 终端号 */
    protected $terminal_id;
    /** @var string 终端流水号 */
    protected $terminal_trace;
    /** @var string 终端交易时间 */
    protected $terminal_time;
    /** @var string 出账记账户账号,扣款的账户 */
    protected $account_out;
    /** @var string 转账金额 */
    protected $total_fee;
    /** @var string 订单描述 */
    protected $order_body;
    /** @var string 附加数据,原样返回 */
    protected $attach;
    /** @var string 转账类型 1：营销，2：核销 3：其他 */
    protected $trans_type;
    /** @var string 当前支付终端流水号 */
    protected $pay_trace;
    /** @var string 当前支付终端交易时间 */
    protected $pay_time;
    /** @var string 利楚唯一转账流水号 */
    protected $out_transfer_no;

    /**
     * 开通
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $merchant_no
     * @fieldParam String $key_sign
     * @fieldParam String $account_no 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function open($fields)
    {
        return $this->main($fields);
    }

    /**
     * 转账
     * @param array $fields
     *
     * @fieldParam String $merchant_no
     * @fieldParam String $key_sign
     * @fieldParam String $pay_ver
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $account_out
     * @fieldParam String $total_fee 选填
     * @fieldParam String $order_body 选填
     * @fieldParam String $attach
     * @fieldParam String $trans_type
     *
     * @return array
     * @throws SaobeiException
     * */
    public function doTransfer($fields)
    {
        return $this->main($fields);
    }

    /**
     * 查询
     * @param array $fields
     *
     * @fieldParam String $merchant_no
     * @fieldParam String $key_sign
     * @fieldParam String $pay_ver
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $account_out
     * @fieldParam String $pay_trace 选填
     * @fieldParam String $pay_time 选填
     * @fieldParam String $out_transfer_no 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        return $this->main($fields);
    }
}
