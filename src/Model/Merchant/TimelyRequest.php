<?php
namespace Saobei\sdk\Model\Merchant;

use Saobei\sdk\Exception\SaobeiException;

class TimelyRequest extends MerchantRequest
{
    protected $requiredFields = array(
        'inst_no','trace_no','key_sign','merchant_no','version','zero_arr_type'
    );
    protected $optionalFields = array(
        'modify_no','notify_url','apply_type','timely_code','account_phone'
    );

    /** @var string 版本号 */
    protected $version = '200';
    /** @var string D0类型：1普通纯D0 2：钱包D0 */
    protected $zero_arr_type;
    /** @var string 变更单号 */
    protected $modify_no;
    /** @var string 审核回调地址 */
    protected $notify_url;
    /** @var string 状态：1申请开通 2关闭 */
    protected $apply_type;
    /** @var string D0手续费代码 */
    protected $timely_code;
    /** @var string 银行卡预留手机号 */
    protected $account_phone;

    /**
     * 即时到账申请
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $version
     * @fieldParam String $apply_type
     * @fieldParam String $zero_arr_type
     * @fieldParam String $notify_url 选填
     * @fieldParam String $timely_code 选填
     * @fieldParam String $account_phone 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function update($fields)
    {
        $this->requiredFields = array(
            'inst_no','trace_no','key_sign','merchant_no','version','apply_type','zero_arr_type'
        );
        return $this->main($fields);
    }

    /**
     * 即时到账查询
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $version
     * @fieldParam String $zero_arr_type
     * @fieldParam String $modify_no 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        return $this->main($fields);
    }

}