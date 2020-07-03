<?php
namespace Saobei\sdk\Config;

class TradeRoute
{
    //普通支付
    public static $barcodePay = "/pay/110/barcodepay";//条码支付
    public static $prePay = "/pay/110/prepay";//预支付
    public static $jsPay = "/pay/110/jspay";//公众号支付
    public static $appPay = "/pay/110/apppay";//app支付
    public static $miniPay = "/pay/110/minipay";//小程序支付
    public static $facePay = "/pay/110/facepay";//自助收银支付
    public static $faceInfo = "/pay/110/faceinfo";//自助收银SDK调用凭证获取
    public static $authCodeToOpenId = "/pay/110/authcodetoopenid";// 授权码查询 OPENID
    public static $query = "/pay/110/query"; //支付查询
    public static $cancel = "/pay/110/cancel"; //撤销交易
    public static $close = "/pay/110/close";//关单
    public static $refund = "/pay/110/refund";//退款
    public static $refundQuery = "/pay/110/queryrefund";//退款查询
    public static $qrPay = "/pay/110/qrpay";//聚合码支付
    public static $wapSdk = "/open/wap/110/pay";//WAP SDK
    public static $authOpenid = "/wx/jsapi/authopenid";//微信公众号JSAPI支付授权
    public static $authAccessToken = "/wx/jsapi/authAccessToken";//微信获取access_token(扫码点餐的登录票据)
    public static $scanOrderSync = "/scancode/110/orderfood";//扫码点餐数据上传

    //分期支付
    public static $fenqiBarcodePay = "/pay/fenqi/barcodepay";//条码支付
    public static $fenqiPrePay = "/pay/fenqi/prepay";//预支付
    public static $fenqiSsPay = "/pay/fenqi/jspay";//公众号支付
    public static $fenqiMiniPay = "/pay/fenqi/minipay";//小程序支付
    public static $fenqiQuery = "/pay/fenqi/query"; //支付查询
    public static $fenqiCancel = "/pay/fenqi/cancel"; //撤销交易
    public static $fenqiClose = "/pay/fenqi/close";//关单
    public static $fenqiRefund = "/pay/fenqi/refund";//退款
    public static $fenqiRefundQuery = "/pay/fenqi/queryrefund";//退款查询
    public static $fenqiRateQuery = "/pay/fenqi/queryrate";//费率查询

    //预授权支付
    public static $preAuthBar = "/pos/200/preauth/preAuthBar";//条码预授权
    public static $preAuthQr = "/pos/200/preauth/preAuthQr";//获取预授权聚合码
    public static $preAuthQrH5Pay = "/pos/200/preauth/preAuthQrH5pay";//预授权聚合码
    public static $preAuthJsPay = "/pos/200/preauth/preAuthH5pay";//预授权公众号支付
    public static $preAuthMiniPay = "/pos/200/preauth/preAuthMinipay";//预授权小程序支付
    public static $preAuthFinish = "/pos/200/preauth/preAuthFinish";//预授权完成
    public static $preAuthCancel = "/pos/200/preauth/preAuthCancel";//预授权撤销
    public static $preAuthQuery = "/pos/200/preauth/preAuthQuery";//预授权完成，预授权撤销查询
    public static $preAuthCommonQuery = "/pos/200/preauth/commonQuery";//预授权订单查询
    public static $preAuthFacePay = "/pos/200/preauth/preAuthFacepay";//刷脸预授权

    //微信交通代扣
    public static $partnerPayApply = "/partnerpay/110/payapply";//申请扣款
    public static $partnerQuery = "/partnerpay/110/queryorder";//查询订单
    public static $partnerRefund = "/partnerpay/110/refund";//申请退款
    public static $partnerQueryUser = "/partnerpay/110/querystate";//用户状态查询
}