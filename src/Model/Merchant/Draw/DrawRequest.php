<?php
namespace Saobei\sdk\Model\Merchant\Draw;

use Saobei\sdk\Config\Merchant;
use Saobei\sdk\Model\Request;
use Saobei\sdk\Util\SignUtil;
use Saobei\sdk\Exception\SaobeiException;

class DrawRequest extends Request
{
    protected $requiredFields = array(
        'merchant_no','key_sign'
    );

    /** @var string 商户号 */
    protected $merchant_no;
    /** @var string 签名 */
    protected $key_sign;

    /**
     * 重写
     * @throws SaobeiException
     * */
    public function afterCheckParam()
    {
        $sign = SignUtil::createSign($this->getter(), array('key'=>Merchant::getInstance()->getKey()));
        $this->setter('key_sign', $sign);
    }

    /**
     * 自动生成重写
     * @param string $fieldName 需要生成的属性名
     * @param array $defaultOptions 默认值数组
     *
     * @return bool
     * @throws SaobeiException
     * */
    protected function autoCreateAttribute($fieldName, $defaultOptions)
    {
        switch($fieldName){
            case 'inst_no':
                $this->$fieldName = Merchant::getInstance()->getInstNo();
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
