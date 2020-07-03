<?php
namespace Saobei\sdk\Model\Trade\Primary;
use Saobei\sdk\Config\Terminal;
use Saobei\sdk\Exception\SaobeiException;

class WeChatRequest extends PrimaryRequest
{
    protected $requiredFields = array(
        'pay_ver','pay_type','service_id','merchant_no','terminal_id','terminal_time','terminal_trace','key_sign','auth_no'
    );
    protected $optionalFields = array(
        'sub_appid','attach','terminal_no'
    );

    /** @var string 授权码 */
    protected $auth_no;
    /**
     * 微信分配的子商户公众账号ID
     *  如果子商户号绑定多个appid，入参sub_appid必传
     * @var string
     */
    protected $sub_appid;
    /** @var string 附加数据，原样返回 */
    protected $attach;
    /** @var string 终端号 */
    protected $terminal_no;

    /**
     * 授权码查询 OPENID
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_id
     * @fieldParam String $terminal_trace
     * @fieldParam String $terminal_time
     * @fieldParam String $auth_no
     * @fieldParam String $key_sign
     * @fieldParam String $sub_appid 选填
     * @fieldParam String $attach 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function authCodeToOpenId($fields)
    {
        $default = array(
            'pay_ver' => '110',
            'service_id' => '080'
        );
        return $this->main($fields, $default);
    }

    /**
     * 微信获取access_token
     * @param array $fields
     *
     * @fieldParam String $redirect_uri
     * @fieldParam String $terminal_no
     * @fieldParam String $merchant_no
     *
     * @return string
     *
     * @throws SaobeiException
     * */
    public function authAccessToken($fields)
    {
        return $this->_init($fields);
    }

    /**
     * 微信获取access_token
     * @param array $fields
     *
     * @fieldParam String $redirect_uri
     * @fieldParam String $terminal_no
     * @fieldParam String $merchant_no
     *
     * @return string
     *
     * @throws SaobeiException
     * */
    public function authOpenId($fields)
    {
        return $this->_init($fields);
    }

    /**
     * 重写
     * @param array $fields
     * @return string
     *
     * @throws SaobeiException
     * */
    public function _init($fields = array())
    {
        $requiredFields = array('merchant_no','terminal_no','redirect_uri');
        $fields['merchant_no'] = Terminal::getInstance()->getMerchantNo();
        $fields['terminal_no'] = Terminal::getInstance()->getTerminalId();
        foreach($requiredFields as $value){
            if(empty($fields[$value]))throw new SaobeiException('缺失必填参数：'.$value);
        }
        return '?merchant_no='.$fields['merchant_no'].'&terminal_no='.$fields['terminal_no'].'&redirect_uri='.urlencode($fields['redirect_uri']).'&key_sign='.$this->createJsApiSign($fields);
    }

    /**
     * 生成签名
     * @param array $fields
     *
     * @return string
     * @throws SaobeiException
     * */
    private function createJsApiSign($fields)
    {
        $token = Terminal::getInstance()->getToken();
        return md5('merchant_no='.$fields['merchant_no'].'&redirect_uri='.$fields['redirect_uri'].'&terminal_no='.$fields['terminal_no'].'&access_token='.$token);
    }
}