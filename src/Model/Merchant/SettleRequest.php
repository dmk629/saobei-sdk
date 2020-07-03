<?php
namespace Saobei\sdk\Model\Merchant;

use Saobei\sdk\Exception\SaobeiException;

class SettleRequest extends MerchantRequest
{
    protected $requiredFields = array(
        'inst_no','trace_no','key_sign','merchant_no','version'
    );
    protected $optionalFields = array(
        'modify_no','notify_url','settle_type','daily_timely_status','daily_timely_code'
    );

    /** @var string 商户号 */
    protected $merchant_no;
    /** @var string 版本号 */
    protected $version = '200';
    /** @var string 审核回调地址 */
    protected $notify_url;
    /** @var string 清算类型：1自动结算；2手动结算 */
    protected $settle_type;
    /** @var string 变更单号 */
    protected $modify_no;
    /** @var string D1开通状态 */
    protected $daily_timely_status;
    /** @var string 即时到账或者非工作日结算费率 */
    protected $daily_timely_code;

    /**
     * 周期变更
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $version
     * @fieldParam String $settle_type
     * @fieldParam String $notify_url 选填
     * @fieldParam String $daily_timely_status 选填
     * @fieldParam String $daily_timely_code 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function update($fields)
    {
        $this->requiredFields = array(
            'inst_no','trace_no','key_sign','merchant_no','version','settle_type'
        );
        return $this->main($fields);
    }

    /**
     * 周期查询
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $version
     * @fieldParam String $settle_type
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        return $this->main($fields);
    }

}