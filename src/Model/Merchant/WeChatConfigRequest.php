<?php
namespace Saobei\sdk\Model\Merchant;

use Saobei\sdk\Exception\SaobeiException;

class WeChatConfigRequest extends MerchantRequest
{
    protected $requiredFields = array(
        'inst_no','trace_no','key_sign','merchant_no'
    );
    protected $optionalFields = array(
        'api_ver','sub_appid','subscribe_appid','jsapi_path'
    );

    /** @var string 扫呗商户号 */
    protected $merchant_no;
    /** @var string 版本号 */
    protected $api_ver;
    /** @var string 子商户支付APPID */
    protected $sub_appid;
    /** @var string 子商户推荐关注公众账号APPID */
    protected $subscribe_appid;
    /** @var string 子商户公众账号JSAPI支付授权目录 */
    protected $jsapi_path;

    /**
     * 微信参数配置
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $api_ver 选填
     * @fieldParam String $sub_appid 选填
     * @fieldParam String $subscribe_appid 选填
     * @fieldParam String $jsapi_path 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function set($fields)
    {
        $default = array(
            'api_ver' => '200'
        );
        return $this->main($fields, $default);
    }

    /**
     * 微信配置查询
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $api_ver 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function get($fields)
    {
        $default = array(
            'api_ver' => '200'
        );
        return $this->main($fields, $default);
    }

}