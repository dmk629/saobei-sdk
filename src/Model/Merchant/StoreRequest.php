<?php
namespace Saobei\sdk\Model\Merchant;

use Saobei\sdk\Exception\SaobeiException;

class StoreRequest extends MerchantRequest
{
    protected $requiredFields = array(
        'inst_no','trace_no','key_sign'
    );
    protected $optionalFields = array(
        'api_ver','store_name','store_addre','store_person','store_phone','store_email','store_code','merchant_no'
    );

    /** @var string 扫呗商户号 */
    protected $merchant_no;
    /** @var string 版本号 */
    protected $api_ver;
    /** @var string 门店名称 */
    protected $store_name;
    /** @var string 门店地址 */
    protected $store_addre;
    /** @var string 门店联系人 */
    protected $store_person;
    /** @var string 门店联系手机号码 */
    protected $store_phone;
    /** @var string 门店联系邮箱 */
    protected $store_email;
    /** @var string 门店编号 */
    protected $store_code;

    /**
     * 创建门店
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $store_name
     * @fieldParam String $store_phone
     * @fieldParam String $store_email
     * @fieldParam String $api_ver 选填
     * @fieldParam String $store_addre 选填
     * @fieldParam String $store_person 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function add($fields)
    {
        $param = $this->main(array(
            'inst_no' => $fields['inst_no'],
            'trace_no' => $fields['trace_no'],
            'merchant_no' => $fields['merchant_no'],
            'store_name' => $fields['store_name'],
            'store_phone' => $fields['store_phone'],
            'store_email' => $fields['store_email']
        ));
        $param['api_ver'] = '200';
        if(isset($fields))$param['store_addre'] = $fields['store_addre'];
        if(isset($fields))$param['store_person'] = $fields['store_person'];
        return $param;
    }

    /**
     * 修改门店
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $store_code
     * @fieldParam String $store_name 选填
     * @fieldParam String $store_phone 选填
     * @fieldParam String $store_email 选填
     * @fieldParam String $api_ver 选填
     * @fieldParam String $store_addre 选填
     * @fieldParam String $store_person 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function update($fields)
    {
        $param = $this->main(array(
            'inst_no' => $fields['inst_no'],
            'trace_no' => $fields['trace_no'],
            'merchant_no' => $fields['merchant_no'],
            '$store_code' => $fields['$store_code']
        ));
        $param['api_ver'] = '200';
        if(isset($fields))$param['store_name'] = $fields['store_name'];
        if(isset($fields))$param['store_phone'] = $fields['store_phone'];
        if(isset($fields))$param['store_email '] = $fields['store_email '];
        if(isset($fields))$param['store_addre'] = $fields['store_addre'];
        if(isset($fields))$param['store_person'] = $fields['store_person'];
        return $param;
    }

    /**
     * 门店查询
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $store_code
     * @fieldParam String $merchant_no 选填
     * @fieldParam String $api_ver 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        $param = $this->main(array(
            'inst_no' => $fields['inst_no'],
            'trace_no' => $fields['trace_no'],
            'store_code' => $fields['store_code']
        ));
        $param['api_ver'] = '200';
        if(isset($fields))$param['merchant_no'] = $fields['merchant_no'];
        return $param;
    }

}