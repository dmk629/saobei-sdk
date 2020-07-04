<?php
namespace Saobei\sdk\Model\Merchant;

use Saobei\sdk\Exception\SaobeiException;

class TerminalRequest extends MerchantRequest
{
    protected $requiredFields = array(
        'inst_no','trace_no','key_sign'
    );
    protected $optionalFields = array(
        'merchant_no','api_ver','store_code','terminal_id','terminal_name'
    );

    /** @var string 扫呗商户号 */
    protected $merchant_no;
    /** @var string 版本号 */
    protected $api_ver;
    /** @var string 门店编号 */
    protected $store_code;
    /** @var string 终端号 */
    protected $terminal_id;
    /** @var string 终端简称 */
    protected $terminal_name;

    /**
     * 创建终端
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $api_ver 选填
     * @fieldParam String $store_code 选填
     * @fieldParam String $terminal_name 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function add($fields)
    {
        $param = $this->main(array(
            'inst_no' => $fields['inst_no'],
            'trace_no' => $fields['trace_no'],
            'merchant_no' => $fields['merchant_no']
        ));
        $param['api_ver'] = '200';
        if(isset($fields))$param['store_code'] = $fields['store_code'];
        if(isset($fields))$param['terminal_name'] = $fields['terminal_name'];
        return $param;
    }

    /**
     * 查询终端
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $terminal_id
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
            'terminal_id' => $fields['terminal_id']
        ));
        $param['api_ver'] = '200';
        if(isset($fields))$param['merchant_no'] = $fields['merchant_no'];
        return $param;
    }

}