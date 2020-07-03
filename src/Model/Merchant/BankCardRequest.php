<?php
namespace Saobei\sdk\Model\Merchant;

use Saobei\sdk\Exception\SaobeiException;

class BankCardRequest extends MerchantRequest
{
    protected $requiredFields = array(
        'inst_no','trace_no','key_sign','merchant_no'
    );
    protected $optionalFields = array(
        'modify_no'
    );

    /** @var string 版本号 */
    protected $version = '200';
    /** @var string 审核结果通知回调地址 */
    protected $notify_url;
    /** @var string 银行卡信息 */
    protected $bankinfo;
    /** @var string 变更单号 */
    protected $modify_no;

    /**
     * 微信参数配置
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $version
     * @fieldParam String $notify_url;
     * @fieldParam String $bankinfo;
     *
     * @return array
     * @throws SaobeiException
     * */
    public function update($fields)
    {
        $this->requiredFields = array(
            'inst_no','trace_no','key_sign','merchant_no','version','notify_url','bankinfo'
        );
        return $this->main($fields);
    }

    /**
     * 微信配置查询
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $version
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