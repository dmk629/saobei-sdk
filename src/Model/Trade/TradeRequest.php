<?php
namespace Saobei\sdk\Model\Trade;

use Saobei\sdk\Config\Terminal;
use Saobei\sdk\Model\Request;
use Saobei\sdk\Util\SignUtil;
use Saobei\sdk\Exception\SaobeiException;

class TradeRequest extends Request
{
    protected $requiredFields = array(
        'merchant_no','terminal_time','key_sign'
    );

    /** @var string 商户号 */
    protected $merchant_no;
    /**
     * @var string 终端交易时间
     *  yyyyMMddHHmmss，全局统一时间格式
     */
    protected $terminal_time;
    /** @var string 签名 */
    protected $key_sign;

    /**
     * 重写
     * @throws SaobeiException
     * */
    public function afterCheckParam()
    {
        $sign = SignUtil::createSign($this->getter(), array('access_token'=>Terminal::getInstance()->getToken()));
        $this->setter('key_sign', $sign);
    }

    /**
     * 自动生成
     * @param string $fieldName 需要生成的属性名
     * @param array $defaultOptions 默认值数组
     *
     * @return bool
     * @throws SaobeiException
     * */
    protected function autoCreateAttribute($fieldName, $defaultOptions)
    {
        switch($fieldName){
            case 'merchant_no':
                $this->$fieldName = Terminal::getInstance()->getMerchantNo();
                break;
            case 'terminal_id':
                $this->$fieldName = Terminal::getInstance()->getTerminalId();
                break;
            case 'terminal_time':
                $this->$fieldName = date('YmdHis');
                break;
            default:
                if(empty($defaultOptions[$fieldName]))return false;
                $this->$fieldName = $defaultOptions[$fieldName];
        }
        return true;
    }

    /**
     * 公用流程
     * @param array $fields
     * @param array $defaultOptions
     * @return array
     * @throws SaobeiException
     * */
    protected function main($fields, $defaultOptions = array())
    {
        $this->init($fields);
        $this->checkParam($defaultOptions);
        $param = $this->getter();
        return $param;
    }
}
