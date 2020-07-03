<?php
namespace Saobei\sdk\Config;

class Path
{
    /**
     * 商户地址
     * */
    const MchPath = 'http://test.lcsw.cn:8045/lcsw_mch';

    /**
     * 支付地址
     * */
    const PayPath = 'http://test.lcsw.cn:8045/lcsw';

    /**
     *
     * @param mixed $type
     * @return string
     * */
    public static function getPath($type = 'pay')
    {
        switch ($type) {
            case 'pay':
                return self::PayPath;
            default:
                return self::MchPath;
        }
    }
}
