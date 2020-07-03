<?php
namespace Saobei\sdk\Config;

class MerchantRoute
{
    public static $addMerchant = "/merchant/200/add";//创建商户
    public static $updateMerchant = "/merchant/200/update";//更新商户资料
    public static $checkNameMerchant = "/merchant/200/checkname";//商户名称验重
    public static $queryWxStatus = "/merchant/200/querywxstatus";//商户微信认证状态查询接口
    public static $queryMerchant = "/merchant/200/query";//查询商户

    public static $addStore = "/store/110/add";//创建商户
    public static $updateStore = "/store/110/update";//更新商户资料
    public static $queryStore = "/store/110/query";//查询商户

    public static $addTerminal = "/terminal/110/add";//创建终端
    public static $queryTerminal = "/terminal/110/query";//查询终端

    public static $setWechatConfig = "/merchant/200/wechatConfigSet";//微信参数配置
    public static $getWechatConfig = "/merchant/200/wechatConfigGet";//微信参数配置查询

    public static $updatePayRate = "/merchant/open/updatepayrate";//商户费率修改接口
    public static $queryPayRate = "/merchant/open/querypayrate";//商户费率查询接口

    public static $updateBankCardInfo = "/merchant/open/updatebankcardinfo";//结算卡变更接口
    public static $queryBankCardInfo = "/merchant/open/querybankcardinfo";//结算卡信息查询接口

    public static $updateSettleType = "/merchant/open/updatesettletype";//商户结算周期变更接口
    public static $querySettleType = "/merchant/open/querysettletype";//商户结算周期变更查询接口

    public static $openD0 = "/merchant/open/timelystatus_open";//即时到账(D0)业务申请接口
    public static $queryD0 = "/merchant/open/timelystatus_query";//即时到账(D0)业务状态查询

    public static $queryChannelMerchant = "/merchant/200/queryChnlMchntGet";//商户子商户信息查询接口

    public static $queryMerchantCash = "/merchant/withdraw/querycash";//商户查询余额
    public static $queryMerchantFee = "/merchant/withdraw/queryfee";//商户查询手续费
    public static $applyMerchantCash = "/merchant/withdraw/applycash";//商户发起提现
    public static $querySettlementRecords = "/merchant/withdraw/settlementrecords";//商户查询清算

    public static $openTransfer = "/account/transfer/open";//转账开通
    public static $doTransfer = "/account/transfer/dotransfer";//发起转账
    public static $queryTransfer = "/account/transfer/query";//流水查询

    public static $generateContract = "/order/allocate/generatecontract";//电子协议生成
    public static $signContract = "/order/allocate/signcontract";//电子协议签署
    public static $queryContract = "/order/allocate/querycontract";//电子协议查询

    public static $doAllocate = "/order/allocate/doallocate";//发起订单分账
    public static $queryAllocate = "/order/allocate/query";//查询分账
    public static $cancelAllocate = "/order/allocate/querycontract";//撤销分账

    public static $queryAllocateRecord = "/order/allocate/queryallocate";//查询入账户分账流水
}