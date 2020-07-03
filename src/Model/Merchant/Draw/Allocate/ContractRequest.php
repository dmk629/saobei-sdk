<?php
namespace Saobei\sdk\Model\Merchant\Allocate;

use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Model\Merchant\Draw\DrawRequest;

class ContractRequest extends DrawRequest
{
    protected $requiredFields = array(
        'inst_no','trace_no','merchant_no','key_sign'
    );
    protected $optionalFields = array(
        'rule_list_json','phone_no','start_date','end_date','verify_no','verify_amt','contract_no'
    );

    /** @var string 机构编号 */
    protected $inst_no;
    /** @var string 请求流水号 */
    protected $trace_no;
    /** @var string 规则列表,Json数组 */
    protected $rule_list_json;
    /** @var string 商户结算卡银行预留手机号 */
    protected $phone_no;
    /** @var string 开始时间 */
    protected $start_date;
    /** @var string 结束时间 */
    protected $end_date;
    /** @var string 授权码 */
    protected $verify_no;
    /** @var string 富友打款金额 */
    protected $verify_amt;
    /** @var string 协议编号 */
    protected $contract_no;

    /**
     * 协议生成
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $merchant_no
     * @fieldParam String $key_sign
     * @fieldParam String $phone_no 选填
     * @fieldParam String $rule_list_json
     * @fieldParam String $start_date
     * @fieldParam String $end_date
     *
     * @return array
     * @throws SaobeiException
     * */
    public function create($fields)
    {
        return $this->main($fields);
    }

    /**
     * 协议签署
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $merchant_no
     * @fieldParam String $verify_no 选填
     * @fieldParam String $verify_amt 选填
     * @fieldParam String $contract_no
     * @fieldParam String $key_sign
     *
     * @return array
     * @throws SaobeiException
     * */
    public function sign($fields)
    {
        return $this->main($fields);
    }

    /**
     * 协议查询
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $merchant_no
     * @fieldParam String $contract_no
     * @fieldParam String $key_sign
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        return $this->main($fields);
    }
}
