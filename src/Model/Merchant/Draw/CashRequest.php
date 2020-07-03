<?php
namespace Saobei\sdk\Model\Merchant;

use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Model\Merchant\Draw\DrawRequest;

class CashRequest extends DrawRequest
{
    protected $requiredFields = array(
        'inst_no','trace_no','version','merchant_no','key_sign'
    );
    protected $optionalFields = array(
        'amt','zero_arr_type','fee_amt','cash_type','txn_type','begin_date','end_date'
    );

    /** @var string 机构编号 */
    protected $inst_no;
    /** @var string 版本号 */
    protected $version = '200';
    /** @var string 请求流水号 */
    protected $trace_no;
    /** @var string 提现金额，单位分 */
    protected $amt;
    /** @var string D0类型：1普通纯D0 2：钱包D0 */
    protected $zero_arr_type;
    /** @var string 手续费 */
    protected $fee_amt;
    /** @var string 资金类型 1:未结金额提现，2:已结金额提现 */
    protected $cash_type;
    /** @var string 到账周期：3：次日到账 、4：实时到账 */
    protected $txn_type;
    /** @var string 查询清算开始时间 */
    protected $begin_date;
    /** @var string 查询清算结束时间 */
    protected $end_date;

    /**
     * 查询余额
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $version
     * @fieldParam String $trace_no
     * @fieldParam String $merchant_no
     * @fieldParam String $key_sign
     *
     * @return array
     * @throws SaobeiException
     * */
    public function queryCash($fields)
    {
        return $this->main($fields);
    }

    /**
     * 查询提现手续费
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $version
     * @fieldParam String $trace_no
     * @fieldParam String $merchant_no
     * @fieldParam String $amt
     * @fieldParam String $zero_arr_type
     * @fieldParam String $key_sign
     *
     * @return array
     * @throws SaobeiException
     * */
    public function queryFee($fields)
    {
        return $this->main($fields);
    }

    /**
     * 发起提现
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $version
     * @fieldParam String $trace_no
     * @fieldParam String $merchant_no
     * @fieldParam String $amt
     * @fieldParam String $fee_amt
     * @fieldParam String $zero_arr_type
     * @fieldParam String $cash_type 选填
     * @fieldParam String $txn_type 选填
     * @fieldParam String $key_sign
     *
     * @return array
     * @throws SaobeiException
     * */
    public function applyCash($fields)
    {
        return $this->main($fields);
    }

    /**
     * 查询清算
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $version
     * @fieldParam String $trace_no
     * @fieldParam String $merchant_no
     * @fieldParam String $begin_date
     * @fieldParam String $end_date
     * @fieldParam String $key_sign
     *
     * @return array
     * @throws SaobeiException
     * */
    public function settlementRecords($fields)
    {
        return $this->main($fields);
    }
}