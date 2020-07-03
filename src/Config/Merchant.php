<?php
namespace Saobei\sdk\Config;

use Saobei\sdk\Exception\SaobeiException;

class Merchant
{
    static private $instance;

    /**
     * 机构号
     * */
    private $instNo;
    /**
     * 令牌
     * */
    private $key;

    /**
     *
     * @param string $instNo
     * @param string $key
     * @throws SaobeiException
     * */
    private function __construct($instNo, $key)
    {
        if(empty($instNo))throw new SaobeiException('缺失机构号');
        if(empty($key))throw new SaobeiException('缺失令牌');
        $this->instNo = $instNo;
        $this->key = $key;
    }

    private function __clone(){}

    /**
     *
     * @param string $instNo
     * @param string $key
     *
     * @return self
     * @throws SaobeiException
     * */
    static public function getInstance($instNo = '', $key = '')
    {
        //判断$instance是否是Singleton的对象，不是则创建
        if (!self::$instance instanceof self) {
            self::$instance = new self($instNo, $key);
        }
        return self::$instance;
    }

    public function getInstNo()
    {
        return $this->instNo;
    }

    public function getKey()
    {
        return $this->key;
    }
}
