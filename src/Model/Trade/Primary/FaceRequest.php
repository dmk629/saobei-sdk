<?php
namespace Saobei\sdk\Model\Trade\Primary;

use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Model\Trade\TradeRequest;

class FaceRequest extends TradeRequest
{
    protected $requiredFields = array(
        'pay_ver','pay_type','merchant_no','terminal_time','key_sign','terminal_no','rawdata','trace_no'
    );

    /** @var string 版本号 */
    protected $pay_ver = '110';
    /** @var string 支付方式 */
    protected $pay_type;
    /** @var string 终端号 */
    protected $terminal_no;
    /**
     * 微信、支付宝人脸识别SDK初始化数据
     * @var string
     */
    protected $rawdata;
    /** @var string 请求流水号 */
    protected $trace_no;

    /**
     * 获取刷脸凭证
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $merchant_no
     * @fieldParam String $terminal_no
     * @fieldParam String $trace_no
     * @fieldParam String $terminal_time
     * @fieldParam String $rawdata
     * @fieldParam String $key_sign
     *
     * @return array
     * @throws SaobeiException
     * */
    public function faceInfo($fields)
    {
        return $this->main($fields);
    }

}