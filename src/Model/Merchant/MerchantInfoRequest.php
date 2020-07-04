<?php
namespace Saobei\sdk\Model\Merchant;

use Saobei\sdk\Config\Merchant;
use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Util\SignUtil;

class MerchantInfoRequest extends MerchantRequest
{
    protected $requiredFields = array(
        'inst_no','trace_no','key_sign','merchant_name','merchant_alias','merchant_company','merchant_province','merchant_province_code',
        'merchant_city','merchant_city_code','merchant_county','merchant_county_code','merchant_address','merchant_person','merchant_phone',
        'merchant_email','business_name','business_code','merchant_business_type','account_type','settlement_type','license_type','account_name',
        'account_no','bank_name','bank_no','settle_type'
    );
    protected $optionalFields = array(
        'daily_timely_status','daily_timely_code','license_no','license_expire','artif_nm','legalIdnum','legalIdnumExpire','merchant_id_no',
        'merchant_id_expire','account_phone','company_account_name','company_account_no','company_bank_name','company_bank_no','rate_code',
        'img_license','img_merchant_person_idcard','img_idcard_a','img_idcard_b','img_bankcard_a','img_bankcard_b','img_logo','img_indoor',
        'img_contract','img_other','img_idcard_holding','img_org_code','img_tax_reg','img_unincorporated','img_private_idcard_a',
        'img_private_idcard_b','img_standard_protocol','img_val_add_protocol','img_sub_account_promiss','img_cashier','img_3rd_part',
        'img_alicashier','img_salesman_logo','img_union_materiel','notify_url','merchant_service_phone','img_open_permits','api_ver'
    );

    /**
     * 微商户名称
     *  扫呗系统全局唯一不可重复
     * @var string
     */
    protected $merchant_name;
    /** @var string 商户简称 */
    protected $merchant_alias;
    /**
     * 商户注册名称/公司全称
     *  须与营业执照名称保持一致，最多30个汉字且不能包含特殊符号
     * @var string
     */
    protected $merchant_company;
    /** @var string 所在省 */
    protected $merchant_province;
    /** @var string 省编码 */
    protected $merchant_province_code;
    /** @var string 所在市 */
    protected $merchant_city;
    /** @var string 市编码 */
    protected $merchant_city_code;
    /** @var string 所在区县 */
    protected $merchant_county;
    /** @var string 所在区县编码 */
    protected $merchant_county_code;
    /** @var string 商户详细地址 */
    protected $merchant_address;
    /** @var string 商户联系人姓名 */
    protected $merchant_person;
    /** @var string 商户联系人电话（唯一） */
    protected $merchant_phone;
    /** @var string 商户联系人邮箱（唯一） */
    protected $merchant_email;
    /** @var string 客服电话 */
    protected $merchant_service_phone;
    /** @var int D1状态,0不开通，1开通 */
    protected $daily_timely_status;
    /** @var string D1手续费代码 */
    protected $daily_timely_code;
    /** @var string 行业类目名称 */
    protected $business_name;
    /** @var string 行业类目编码 */
    protected $business_code;
    /**
     * 商户类型
     *  1企业，2个体工商户，3小微商户
     * @var int
     */
    protected $merchant_business_type;
    /** @var string 账户类型，1对公，2对私 */
    protected $account_type;
    /** @var string 结算类型:1.法人结算 2.非法人结算 */
    protected $settlement_type;
    /**
     * 营业证件类型
     *  0营业执照，1三证合一，2手持身份证
     * @var int
     */
    protected $license_type;
    /** @var string 营业证件号码 */
    protected $license_no;
    /** @var string 营业证件到期日 */
    protected $license_expire;
    /** @var string 法人名称 */
    protected $artif_nm;
    /** @var string 法人身份证号 */
    protected $legalIdnum;
    /** @var string 法人身份证有效期 */
    protected $legalIdnumExpire;
    /** @var string 结算人身份证号码 */
    protected $merchant_id_no;
    /**
     * 结算人身份证有效期
     *  格式YYYYMMDD，长期填写29991231
     * @var string
     */
    protected $merchant_id_expire;
    /** @var string 入账银行卡开户名 */
    protected $account_name;
    /** @var string 入账银行卡卡号 */
    protected $account_no;
    /** @var string 入账银行卡开户支行 */
    protected $bank_name;
    /** @var string 开户支行联行号 */
    protected $bank_no;
    /** @var string 对公户结算账户开户名 */
    protected $company_account_name;
    /** @var string 对公户结算账户开户号 */
    protected $company_account_no;
    /** @var string 对公户结算账户开户支行 */
    protected $company_bank_name;
    /** @var string 对公户结算账户开户支行联行号 */
    protected $company_bank_no;
    /** @var string 清算类型：1自动结算；2手动结算 */
    protected $settle_type;
    /** @var string 支付费率代码 */
    protected $rate_code;
    /** @var string 营业执照照片 */
    protected $img_license;
    /** @var string 商户联系人身份证照片(正面) */
    protected $img_merchant_person_idcard;
    /** @var string 法人身份证正面照片 */
    protected $img_idcard_a;
    /** @var string 法人身份证反面照片 */
    protected $img_idcard_b;
    /** @var string 入账银行卡正面照片 */
    protected $img_bankcard_a;
    /** @var string 入账银行卡反面照片 */
    protected $img_bankcard_b;
    /** @var string 商户门头照片 */
    protected $img_logo;
    /** @var string 内部前台照片 */
    protected $img_indoor;
    /** @var string 店内环境照片 */
    protected $img_contract;
    /** @var string 其他证明材料 */
    protected $img_other;
    /** @var string 本人手持身份证照片 */
    protected $img_idcard_holding;
    /** @var string 开户许可证照片 */
    protected $img_open_permits;
    /** @var string 组织机构代码证照片 */
    protected $img_org_code;
    /** @var string 税务登记证照片 */
    protected $img_tax_reg;
    /** @var string 入账非法人证明照片 */
    protected $img_unincorporated;
    /** @var string 对私账户身份证正面照片 */
    protected $img_private_idcard_a;
    /** @var string 对私账户身份证反面照片 */
    protected $img_private_idcard_b;
    /** @var string 商户总分店关系证明 */
    protected $img_standard_protocol;
    /** @var string 商户增值协议照片 */
    protected $img_val_add_protocol;
    /** @var string 分账承诺函 */
    protected $img_sub_account_promiss;
    /** @var string 微信支付物料照片 */
    protected $img_cashier;
    /** @var string 第三方平台截图 */
    protected $img_3rd_part;
    /** @var string 支付宝支付物料照片 */
    protected $img_alicashier;
    /** @var string 业务员门头合照 */
    protected $img_salesman_logo;
    /** @var string 云闪付营销物料布放照片 */
    protected $img_union_materiel;
    /** @var string 审核状态通知地址 */
    protected $notify_url;
    /** @var string 版本号 */
    protected $api_ver;

    /**
     * 创建商户
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_name
     * @fieldParam String $merchant_alias
     * @fieldParam String $merchant_company
     * @fieldParam String $merchant_province
     * @fieldParam String $merchant_province_code
     * @fieldParam String $merchant_city
     * @fieldParam String $merchant_city_code
     * @fieldParam String $merchant_county
     * @fieldParam String $merchant_county_code
     * @fieldParam String $merchant_address
     * @fieldParam String $merchant_person
     * @fieldParam String $merchant_phone
     * @fieldParam String $merchant_email
     * @fieldParam String $business_name
     * @fieldParam String $business_code
     * @fieldParam String $merchant_business_type
     * @fieldParam String $account_type
     * @fieldParam String $settlement_type
     * @fieldParam String $license_type
     * @fieldParam String $account_name
     * @fieldParam String $account_no
     * @fieldParam String $bank_name
     * @fieldParam String $bank_no
     * @fieldParam String $rate_code
     * @fieldParam String $settle_type
     * @fieldParam String $key_sign
     * @fieldParam String $daily_timely_status 选填
     * @fieldParam String $daily_timely_code 选填
     * @fieldParam String $license_no 选填
     * @fieldParam String $license_expire 选填
     * @fieldParam String $artif_nm 选填
     * @fieldParam String $legalIdnum 选填
     * @fieldParam String $legalIdnumExpire 选填
     * @fieldParam String $merchant_id_no 选填
     * @fieldParam String $merchant_id_expire 选填
     * @fieldParam String $account_phone 选填
     * @fieldParam String $company_account_name 选填
     * @fieldParam String $company_account_no 选填
     * @fieldParam String $company_bank_name 选填
     * @fieldParam String $company_bank_no 选填
     * @fieldParam String $img_license 选填
     * @fieldParam String $img_merchant_person_idcard 选填
     * @fieldParam String $img_idcard_a 选填
     * @fieldParam String $img_idcard_b 选填
     * @fieldParam String $img_bankcard_a 选填
     * @fieldParam String $img_bankcard_b 选填
     * @fieldParam String $img_logo 选填
     * @fieldParam String $img_indoor 选填
     * @fieldParam String $img_contract 选填
     * @fieldParam String $img_other 选填
     * @fieldParam String $img_idcard_holding 选填
     * @fieldParam String $img_org_code 选填
     * @fieldParam String $img_tax_reg 选填
     * @fieldParam String $img_unincorporated 选填
     * @fieldParam String $img_private_idcard_a 选填
     * @fieldParam String $img_private_idcard_b 选填
     * @fieldParam String $img_standard_protocol 选填
     * @fieldParam String $img_val_add_protocol 选填
     * @fieldParam String $img_sub_account_promiss 选填
     * @fieldParam String $img_cashier 选填
     * @fieldParam String $img_3rd_part 选填
     * @fieldParam String $img_alicashier 选填
     * @fieldParam String $img_salesman_logo 选填
     * @fieldParam String $img_union_materiel 选填
     * @fieldParam String $notify_url 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function add($fields)
    {
        return $this->main($fields);
    }

    /**
     * 商户名称验重
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_name
     * @fieldParam String $api_ver
     *
     * @return array
     * @throws SaobeiException
     * */
    public function checkName($fields)
    {
        $this->requiredFields = array(
            'inst_no','trace_no','key_sign','merchant_name'
        );
        $param = $this->main($fields);
        $param['api_ver'] = '200';
        return $param;
    }

    /**
     * 更新商户资料
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_name
     * @fieldParam String $api_ver
     * @fieldParam String $merchant_province
     * @fieldParam String $merchant_province_code
     * @fieldParam String $merchant_city
     * @fieldParam String $merchant_city_code
     * @fieldParam String $merchant_county
     * @fieldParam String $merchant_county_code
     * @fieldParam String $merchant_address
     * @fieldParam String $merchant_person
     * @fieldParam String $merchant_phone
     * @fieldParam String $merchant_email
     * @fieldParam String $business_name
     * @fieldParam String $business_code
     * @fieldParam String $merchant_business_type
     * @fieldParam String $account_type
     * @fieldParam String $settlement_type
     * @fieldParam String $license_type
     * @fieldParam String $account_name
     * @fieldParam String $account_no
     * @fieldParam String $bank_name
     * @fieldParam String $bank_no
     * @fieldParam String $key_sign
     * @fieldParam String $license_no 选填
     * @fieldParam String $license_expire 选填
     * @fieldParam String $artif_nm 选填
     * @fieldParam String $legalIdnum 选填
     * @fieldParam String $legalIdnumExpire 选填
     * @fieldParam String $merchant_id_no 选填
     * @fieldParam String $merchant_id_expire 选填
     * @fieldParam String $account_phone 选填
     * @fieldParam String $company_account_name 选填
     * @fieldParam String $company_account_no 选填
     * @fieldParam String $company_bank_name 选填
     * @fieldParam String $company_bank_no 选填
     * @fieldParam String $img_license 选填
     * @fieldParam String $img_merchant_person_idcard 选填
     * @fieldParam String $img_idcard_a 选填
     * @fieldParam String $img_idcard_b 选填
     * @fieldParam String $img_bankcard_a 选填
     * @fieldParam String $img_bankcard_b 选填
     * @fieldParam String $img_logo 选填
     * @fieldParam String $img_indoor 选填
     * @fieldParam String $img_contract 选填
     * @fieldParam String $img_other 选填
     * @fieldParam String $img_idcard_holding 选填
     * @fieldParam String $img_org_code 选填
     * @fieldParam String $img_tax_reg 选填
     * @fieldParam String $img_unincorporated 选填
     * @fieldParam String $img_private_idcard_a 选填
     * @fieldParam String $img_private_idcard_b 选填
     * @fieldParam String $img_standard_protocol 选填
     * @fieldParam String $img_val_add_protocol 选填
     * @fieldParam String $img_sub_account_promiss 选填
     * @fieldParam String $img_cashier 选填
     * @fieldParam String $img_3rd_part 选填
     * @fieldParam String $img_alicashier 选填
     * @fieldParam String $img_salesman_logo 选填
     * @fieldParam String $img_union_materiel 选填
     * @fieldParam String $notify_url 选填
     *
     * @return array
     * @throws SaobeiException
     * */
    public function update($fields)
    {
        $default = array(
            'api_ver' => '200'
        );
        return $this->main($fields, $default);
    }

    /**
     * 商户微信认证状态查询
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $api_ver
     *
     * @return array
     * @throws SaobeiException
     * */
    public function queryWeChatStatus($fields)
    {
        $this->requiredFields = array(
            'inst_no','trace_no','key_sign','merchant_no'
        );
        $param = $this->main($fields);
        $param['api_ver'] = '200';
        return $param;
    }

    /**
     * 商户查询
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $key_sign
     * @fieldParam String $merchant_no
     * @fieldParam String $api_ver
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        $this->requiredFields = array(
            'inst_no','trace_no','key_sign','merchant_no'
        );
        $param = $this->main($fields);
        $param['api_ver'] = '201';
        return $param;
    }

}