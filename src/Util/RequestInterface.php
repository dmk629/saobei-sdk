<?php
namespace Saobei\sdk\Util;

interface RequestInterface
{
    /**
     * 初始化
     * @param array $fields
     * */
    public function init($fields = array());

    /**
     * 检查参数
     * @param array $defaultOptions
     * */
    public function checkParam($defaultOptions = array());

    /**
     * 单属性赋值
     * @param string $fieldName
     * @param mixed $value
     * */
    public function setter($fieldName, $value);

    /**
     * 属性取值
     * @param string $fieldName
     * */
    public function getter($fieldName = '');

}