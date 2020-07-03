<?php
namespace Saobei\sdk\Config;

use Saobei\sdk\Exception\SaobeiException;

class Terminal
{
    static private $instance;

    /**
     * 商户号
     * */
    private $merchantNo;
    /**
     * 终端号
     * */
    private $terminalId;
    /**
     * 终端秘钥
     * */
    private $accessToken;

    /**
     *
     * @param string $merchantNo
     * @param string $terminalId
     * @param string $accessToken
     * @throws SaobeiException
     * */
    private function __construct($merchantNo, $terminalId, $accessToken)
    {
        if(empty($merchantNo))throw new SaobeiException('缺失商户号');
        if(empty($terminalId))throw new SaobeiException('缺失终端号');
        if(empty($accessToken))throw new SaobeiException('缺失秘钥');
        $this->merchantNo = $merchantNo;
        $this->terminalId = $terminalId;
        $this->accessToken = $accessToken;
    }

    private function __clone(){}

    /**
     *
     * @param string $merchantNo
     * @param string $terminalId
     * @param string $accessToken
     *
     * @return self
     * @throws SaobeiException
     * */
    static public function getInstance($merchantNo = '', $terminalId = '', $accessToken = '')
    {
        //判断$instance是否是Singleton的对象，不是则创建
        if (!self::$instance instanceof self) {
            self::$instance = new self($merchantNo, $terminalId, $accessToken);
        }
        return self::$instance;
    }

    public function getMerchantNo()
    {
        return $this->merchantNo;
    }

    public function getTerminalId()
    {
        return $this->terminalId;
    }

    public function getToken()
    {
        return $this->accessToken;
    }
}