<?php
namespace Saobei\sdk\Model\Trade\Partner;
use Saobei\sdk\Exception\SaobeiException;

class UserRequest extends PartnerRequest
{
    protected $requiredFields = array(
        'pay_ver','pay_type','merchant_no','terminal_id','key_sign','sub_appid','sub_openid','trade_scene','jump_scene','plate_number'
    );

    /** @var string 版本号 */
    protected $pay_ver = '110';
    /** @var string 微信子商户appid */
    protected $sub_appid;
    /** @var string 微信子商户appid下的唯一标识 */
    protected $sub_openid;
    /**
     * 交易场景
     *  1. PARKING：车场停车场景 2. PARKING SPACE；车位停车场景 3GAS 加油场景 4. HIGHWAY 高速场景 5. BRIDGE 路桥场景
     * @var string
     */
    protected $trade_scene;
    /**
     * 跳转场景
     *  APP:通过APP跳转 H5:通过公众号H5跳转
     * @var string
     */
    protected $jump_scene;
    /** @var string 车牌号 */
    protected $plate_number;

    /**
     * 状态查询
     * @param array $fields
     *
     * @fieldParam String $pay_ver
     * @fieldParam String $pay_type
     * @fieldParam String $service_id
     * @fieldParam String $terminal_id
     * @fieldParam String $sub_appid
     * @fieldParam String $sub_openid
     * @fieldParam String $key_sign
     * @fieldParam String $trade_scene
     * @fieldParam String $jump_scene
     * @fieldParam String $plate_number
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        return $this->main($fields);
    }
}
