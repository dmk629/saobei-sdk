<?php
namespace Saobei\sdk\Model;

use Saobei\sdk\Config\Terminal;
use Saobei\sdk\Util\RequestInterface;
use Saobei\sdk\Exception\SaobeiException;

class Request implements RequestInterface
{
    /**
     * 必传参数
     * @var array
     */
    protected $requiredFields = array();

    /**
     * 可传参数
     * @var array
     */
    protected $optionalFields = array();

    /**
     * 初始化
     * @param array $fields
     * @throws SaobeiException
     * */
    public function init($fields = array())
    {
        if(!empty($fields))$this->onInitParamByArray($fields);
    }

    /**
     * 参数检查
     * @param array $defaultOptions
     *
     * @throws SaobeiException
     * */
    public function checkParam($defaultOptions = array())
    {
        $fullFields = array_merge($this->optionalFields, $this->requiredFields);
        foreach($this as $fieldName => $fieldValue){
            if(
                in_array($fieldName, $this->requiredFields) &&
                $this->$fieldName === null &&
                $this->autoCreateAttribute($fieldName, $defaultOptions) === false &&
                $fieldName != 'key_sign'
            ){
                throw new SaobeiException('必填参数缺失:'.$fieldName);
            }
            if(!in_array($fieldName, $fullFields))throw new SaobeiException('非法字段:'.$fieldName);
        }
        $this->afterCheckParam();
    }

    /**
     * 单属性赋值
     * @param string $fieldName
     * @param mixed $value
     * */
    public function setter($fieldName, $value)
    {
        if(property_exists($this, $fieldName))$this->$fieldName = $value;
    }

    /**
     * 属性取值
     * @param string $fieldName
     *
     * @return mixed
     * */
    public function getter($fieldName = '')
    {
        if(empty($fieldName)){
            $fields = array();
            $fullFields = array_merge($this->optionalFields, $this->requiredFields);
            foreach($this as $key => $value){
                if(in_array($key, $fullFields) && $value !== null && !is_array($value)){
                    $fields[$key] = $value;
                }
            }
            return $fields;
        }else{
            return $this->$fieldName;
        }
    }

    /**
     * 初始化参数
     * @param array $fields
     *
     * @throws SaobeiException
     * */
    public function onInitParamByArray($fields)
    {
        $fullFields = array_merge($this->optionalFields, $this->requiredFields);
        foreach($fields as $fieldName => $fieldValue){
            if(in_array($fieldName, $fullFields)){
                $this->$fieldName = $fieldValue;
            }
        }
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
        if(empty($defaultOptions[$fieldName]))return false;
        return true;
    }

    /**
     * 检查参数前事件
     *  重写用
     * */
    protected function afterCheckParam(){}
}
