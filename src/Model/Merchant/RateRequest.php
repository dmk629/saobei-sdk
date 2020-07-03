<?php
namespace Saobei\sdk\Model\Merchant;

use Saobei\sdk\Exception\SaobeiException;

class RateRequest extends MerchantRequest
{
    protected $requiredFields = array(
        'inst_no','trace_no','key_sign','merchant_no'
    );
    protected $optionalFields = array(
        'wx_rate_code','ali_rate_code','qq_rate_code','jd_rate_code'
    );

    /** @var string 扫呗商户号 */
    protected $merchant_no;
    /** @var string 商户当前通道微信费率 */
    protected $wx_rate_code;
    /** @var string 商户当前通道支付宝费率 */
    protected $ali_rate_code;
    /** @var string 商户当前通道QQ费率 */
    protected $qq_rate_code;
    /** @var string 商户当前通道京东费率 */
    protected $jd_rate_code;

    /**
     * 费率配置
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $wx_rate_code 选填
     * @fieldParam String $ali_rate_code 选填
     * @fieldParam String $qq_rate_code 选填
     * @fieldParam String $jd_rate_code 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function update($fields)
    {
        return $this->main($fields);
    }

    /**
     * 费率查询
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        return $this->main($fields);
    }

}