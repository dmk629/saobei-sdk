<?php
namespace Saobei\sdk;

use Saobei\sdk\Config\Merchant;
use Saobei\sdk\Config\MerchantRoute;
use Saobei\sdk\Config\Terminal;
use Saobei\sdk\Config\TradeRoute;
use Saobei\sdk\Config\Path;
use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Model\Trade\Primary\FaceRequest;
use Saobei\sdk\Model\Trade\Primary\PrimaryNotify;
use Saobei\sdk\Model\Trade\Primary\OrderRequest;
use Saobei\sdk\Model\Trade\Primary\PayRequest;
use Saobei\sdk\Model\Trade\Primary\ScanCodeRequest;
use Saobei\sdk\Model\Trade\Primary\WeChatRequest;
use Saobei\sdk\Model\Trade\FenQi\RateRequest as FenQiRate;
use Saobei\sdk\Model\Trade\FenQi\PayRequest as FenQiPay;
use Saobei\sdk\Model\Trade\FenQi\OrderRequest as FenQiOrder;
use Saobei\sdk\Model\Trade\FenQi\FenQiNotify;
use Saobei\sdk\Model\Trade\PreAuth\PayRequest as PreAuthPay;
use Saobei\sdk\Model\Trade\PreAuth\OrderRequest as PreAuthOrder;
use Saobei\sdk\Model\Trade\Partner\OrderRequest as PartnerOrder;
use Saobei\sdk\Model\Trade\Partner\UserRequest as PartnerUser;
use Saobei\sdk\Model\Trade\Partner\PartnerNotify;
use Saobei\sdk\Model\Merchant\MerchantInfoRequest as MerchantInfo;
use Saobei\sdk\Model\Merchant\StoreRequest as MerchantStore;
use Saobei\sdk\Model\Merchant\TerminalRequest as MerchantTerminal;
use Saobei\sdk\Model\Merchant\BillRequest as Bill;
use Saobei\sdk\Model\Merchant\WeChatConfigRequest as WeChatConfig;
use Saobei\sdk\Model\Merchant\RateRequest as Rate;
use Saobei\sdk\Model\Merchant\ChannelMerchantRequest as ChannelMerchant;
use Saobei\sdk\Model\Merchant\BankCardRequest as BankCard;
use Saobei\sdk\Model\Merchant\SettleRequest as Settle;
use Saobei\sdk\Model\Merchant\TimelyRequest as Timely;
use Saobei\sdk\Model\Merchant\MerchantNotify as MerchantNotify;
use Saobei\sdk\Model\Merchant\CashRequest as MerchantCash;
use Saobei\sdk\Model\Merchant\TransferRequest as MerchantTransfer;
use Saobei\sdk\Model\Merchant\Allocate\ContractRequest as MerchantContract;
use Saobei\sdk\Model\Merchant\Allocate\OrderRequest as AllocateOrder;
use Saobei\sdk\Model\Merchant\Allocate\AccountRequest as MerchantAccount;
use Saobei\sdk\Util\HttpClient;

class Dispatcher
{
    /**
     *
     * @param string $merchantNo
     * @param string $terminalId
     * @param string $token
     * @throws SaobeiException
     * */
    public function initTerminal($merchantNo, $terminalId, $token)
    {
        Terminal::getInstance($merchantNo, $terminalId, $token);
    }

    /**
     *
     * @param string $instNo
     * @param string $key
     * @throws SaobeiException
     * */
    public function initMerchant($instNo, $key)
    {
        Merchant::getInstance($instNo, $key);
    }

    /**
     *
     * @throws SaobeiException
     * @throws \Exception
     * */
    public function __call($name, $arguments)
    {
        try{
            switch(strtolower($name)){
                case 'bar':
                case 'barcode':
                case 'barcodepay':
                    $response = $this->sendPostRequest(array(new PayRequest(), 'barcodePay'), $arguments[0], TradeRoute::$barcodePay);
                    break;
                case 'prepay':
                    $response = $this->sendPostRequest(array(new PayRequest(), 'prepay'), $arguments[0], TradeRoute::$prePay);
                    break;
                case 'jspay':
                    $response = $this->sendPostRequest(array(new PayRequest(), 'jsPay'), $arguments[0], TradeRoute::$jsPay);
                    break;
                case 'minipay':
                    $response = $this->sendPostRequest(array(new PayRequest(), 'miniPay'), $arguments[0], TradeRoute::$miniPay);
                    break;
                case 'facepay':
                    $response = $this->sendPostRequest(array(new PayRequest(), 'facePay'), $arguments[0], TradeRoute::$miniPay);
                    break;
                case 'wappay':
                    $request = new PayRequest();
                    $param = $request->wapPay($arguments[0]);
                    $rootPath = Path::getPath();
                    $response = $rootPath.TradeRoute::$wapSdk.$param;
                    break;
                case 'qrpay':
                    $response = $this->sendPostRequest(array(new PayRequest(), 'qrPay'), $arguments[0], TradeRoute::$qrPay);
                    break;
                case 'query':
                    $response = $this->sendPostRequest(array(new OrderRequest(), 'query'), $arguments[0], TradeRoute::$query);
                    break;
                case 'refund':
                    $response = $this->sendPostRequest(array(new OrderRequest(), 'refund'), $arguments[0], TradeRoute::$refund);
                    break;
                case 'cancel':
                    $response = $this->sendPostRequest(array(new OrderRequest(), 'cancel'), $arguments[0], TradeRoute::$cancel);
                    break;
                case 'close':
                    $response = $this->sendPostRequest(array(new OrderRequest(), 'close'), $arguments[0], TradeRoute::$close);
                    break;
                case 'faceinfo':
                    $response = $this->sendPostRequest(array(new FaceRequest(), 'faceInfo'), $arguments[0], TradeRoute::$faceInfo);
                    break;
                case 'authcodetoopenid':
                    $response = $this->sendPostRequest(array(new WeChatRequest(), 'authCodeToOpenId'), $arguments[0], TradeRoute::$authCodeToOpenId);
                    break;
                case 'authaccesstoken':
                    $request = new WeChatRequest();
                    $param = $request->authAccessToken($arguments[0]);
                    $rootPath = Path::getPath();
                    $response = $rootPath.TradeRoute::$authAccessToken.$param;
                    break;
                case 'authopenid':
                    $request = new WeChatRequest();
                    $param = $request->authOpenId($arguments[0]);
                    $rootPath = Path::getPath();
                    $response = $rootPath.TradeRoute::$authOpenid.$param;
                    break;
                case 'scanordersync':
                    $response = $this->sendGetRequest(array(new ScanCodeRequest(), 'orderSync'), $arguments[0], TradeRoute::$scanOrderSync);
                    break;
                case 'notify':
                    $notify = new PrimaryNotify();
                    $response = $notify->notify($arguments[0], $arguments[1]);
                    break;
                case 'ordersync':
                    $notify = new PrimaryNotify();
                    $response = $notify->orderSync($arguments[0], $arguments[1]);
                    break;
                case 'fenqiratequery':
                    $response = $this->sendPostRequest(array(new FenQiRate(), 'query'), $arguments[0], TradeRoute::$fenqiRateQuery);
                    break;
                case 'fenqibar':
                case 'fenqibarcode':
                case 'fenqibarcodepay':
                    $response = $this->sendPostRequest(array(new FenQiPay(), 'barcodePay'), $arguments[0], TradeRoute::$fenqiBarcodePay);
                    break;
                case 'fenqiprepay':
                    $response = $this->sendPostRequest(array(new FenQiPay(), 'prepay'), $arguments[0], TradeRoute::$fenqiPrePay);
                    break;
                case 'fenqijspay':
                    $response = $this->sendPostRequest(array(new FenQiPay(), 'jsPay'), $arguments[0], TradeRoute::$fenqiSsPay);
                    break;
                case 'fenqiminipay':
                    $response = $this->sendPostRequest(array(new FenQiPay(), 'miniPay'), $arguments[0], TradeRoute::$fenqiMiniPay);
                    break;
                case 'fenqiquery':
                    $response = $this->sendPostRequest(array(new FenQiOrder(), 'query'), $arguments[0], TradeRoute::$fenqiQuery);
                    break;
                case 'fenqirefund':
                    $response = $this->sendPostRequest(array(new FenQiOrder(), 'refund'), $arguments[0], TradeRoute::$fenqiRefund);
                    break;
                case 'fenqicancel':
                    $response = $this->sendPostRequest(array(new FenQiOrder(), 'cancel'), $arguments[0], TradeRoute::$fenqiCancel);
                    break;
                case 'fenqiclose':
                    $response = $this->sendPostRequest(array(new FenQiOrder(), 'close'), $arguments[0], TradeRoute::$fenqiClose);
                    break;
                case 'fenqinotify':
                    $notify = new FenQiNotify();
                    $response = $notify->notify($arguments[0], $arguments[1]);
                    break;
                case 'preauthbar':
                case 'preauthbarcode':
                case 'preauthbarcodepay':
                    $response = $this->sendPostRequest(array(new PreAuthPay(), 'barcode'), $arguments[0], TradeRoute::$preAuthBar);
                    break;
                case 'preauthqr':
                    $response = $this->sendPostRequest(array(new PreAuthPay(), 'qr'), $arguments[0], TradeRoute::$preAuthQr);
                    break;
                case 'preauthqrh5pay':
                    $request = new PreAuthPay();
                    $param = $request->qrH5Pay($arguments[0]);
                    $rootPath = Path::getPath();
                    $response = $rootPath.TradeRoute::$preAuthQrH5Pay.$param;
                    break;
                case 'preauthjspay':
                    $response = $this->sendPostRequest(array(new PreAuthPay(), 'jsPay'), $arguments[0], TradeRoute::$preAuthJsPay);
                    break;
                case 'preauthminipay':
                    $response = $this->sendPostRequest(array(new PreAuthPay(), 'miniPay'), $arguments[0], TradeRoute::$preAuthMiniPay);
                    break;
                case 'preauthfacepay':
                    $response = $this->sendPostRequest(array(new PreAuthPay(), 'facePay'), $arguments[0], TradeRoute::$preAuthFacePay);
                    break;
                case 'preauthquery':
                    $response = $this->sendPostRequest(array(new PreAuthOrder(), 'query'), $arguments[0], TradeRoute::$preAuthCommonQuery);
                    break;
                case 'preauthstatusquery':
                    $response = $this->sendPostRequest(array(new PreAuthOrder(), 'queryStatus'), $arguments[0], TradeRoute::$preAuthQuery);
                    break;
                case 'preauthfinish':
                    $response = $this->sendPostRequest(array(new PreAuthOrder(), 'finish'), $arguments[0], TradeRoute::$preAuthFinish);
                    break;
                case 'preauthcancel':
                    $response = $this->sendPostRequest(array(new PreAuthOrder(), 'cancel'), $arguments[0], TradeRoute::$preAuthCancel);
                    break;
                case 'partnerpay':
                    $response = $this->sendPostRequest(array(new PartnerOrder(), 'payApply'), $arguments[0], TradeRoute::$partnerPayApply);
                    break;
                case 'partnerquery':
                    $response = $this->sendPostRequest(array(new PartnerOrder(), 'query'), $arguments[0], TradeRoute::$partnerQuery);
                    break;
                case 'partnerrefund':
                    $response = $this->sendPostRequest(array(new PartnerOrder(), 'refund'), $arguments[0], TradeRoute::$partnerRefund);
                    break;
                case 'partneruser':
                    $response = $this->sendPostRequest(array(new PartnerUser(), 'query'), $arguments[0], TradeRoute::$partnerQueryUser);
                    break;
                case 'partnernotify':
                    $notify = new PartnerNotify();
                    $response = $notify->notify($arguments[0], $arguments[1]);
                    break;
                case 'merchantadd':
                    $response = $this->sendPostRequest(array(new MerchantInfo(), 'add'), $arguments[0], MerchantRoute::$addMerchant, 'mch');
                    break;
                case 'merchantcheckname':
                    $response = $this->sendPostRequest(array(new MerchantInfo(), 'checkName'), $arguments[0], MerchantRoute::$checkNameMerchant, 'mch');
                    break;
                case 'merchantupdate':
                    $response = $this->sendPostRequest(array(new MerchantInfo(), 'update'), $arguments[0], MerchantRoute::$updateMerchant, 'mch');
                    break;
                case 'merchantquery':
                    $response = $this->sendPostRequest(array(new MerchantInfo(), 'query'), $arguments[0], MerchantRoute::$queryMerchant, 'mch');
                    break;
                case 'merchantquerywechatstatus':
                    $response = $this->sendPostRequest(array(new MerchantInfo(), 'queryWeChatStatus'), $arguments[0], MerchantRoute::$queryWxStatus, 'mch');
                    break;
                case 'billdownload':
                    $response = $this->sendGetRequest(array(new Bill(), 'downloadPath'), $arguments[0], '', 'mch');
                    break;
                case 'merchantaddstore':
                    $response = $this->sendGetRequest(array(new MerchantStore(), 'add'), $arguments[0], MerchantRoute::$addStore, 'mch');
                    break;
                case 'merchantupdatestore':
                    $response = $this->sendGetRequest(array(new MerchantStore(), 'update'), $arguments[0], MerchantRoute::$updateStore, 'mch');
                    break;
                case 'merchantquerystore':
                    $response = $this->sendGetRequest(array(new MerchantStore(), 'query'), $arguments[0], MerchantRoute::$queryStore, 'mch');
                    break;
                case 'merchantaddterminal':
                    $response = $this->sendGetRequest(array(new MerchantTerminal(), 'downloadPath'), $arguments[0], MerchantRoute::$addTerminal, 'mch');
                    break;
                case 'merchantqueryterminal':
                    $response = $this->sendGetRequest(array(new MerchantTerminal(), 'downloadPath'), $arguments[0], MerchantRoute::$queryTerminal, 'mch');
                    break;
                case 'wechatconfigset':
                    $response = $this->sendPostRequest(array(new WechatConfig(), 'set'), $arguments[0], MerchantRoute::$setWechatConfig, 'mch');
                    break;
                case 'wechatconfigget':
                    $response = $this->sendPostRequest(array(new WechatConfig(), 'get'), $arguments[0], MerchantRoute::$getWechatConfig, 'mch');
                    break;
                case 'updatepayrate':
                    $response = $this->sendPostRequest(array(new Rate(), 'update'), $arguments[0], MerchantRoute::$updatePayRate, 'mch');
                    break;
                case 'querypayrate':
                    $response = $this->sendPostRequest(array(new Rate(), 'query'), $arguments[0], MerchantRoute::$queryPayRate, 'mch');
                    break;
                case 'querychannelmerchant':
                    $response = $this->sendPostRequest(array(new ChannelMerchant(), 'query'), $arguments[0], MerchantRoute::$queryChannelMerchant, 'mch');
                    break;
                case 'updatebankcardinfo':
                    $response = $this->sendPostRequest(array(new BankCard(), 'update'), $arguments[0], MerchantRoute::$updateBankCardInfo, 'mch');
                    break;
                case 'querybankcardinfo':
                    $response = $this->sendPostRequest(array(new BankCard(), 'query'), $arguments[0], MerchantRoute::$queryBankCardInfo, 'mch');
                    break;
                case 'updatesettletype':
                    $response = $this->sendPostRequest(array(new Settle(), 'update'), $arguments[0], MerchantRoute::$updateSettleType, 'mch');
                    break;
                case 'querysettletype':
                    $response = $this->sendPostRequest(array(new Settle(), 'query'), $arguments[0], MerchantRoute::$querySettleType, 'mch');
                    break;
                case 'opend0':
                    $response = $this->sendPostRequest(array(new Timely(), 'update'), $arguments[0], MerchantRoute::$openD0, 'mch');
                    break;
                case 'queryd0':
                    $response = $this->sendPostRequest(array(new Timely(), 'query'), $arguments[0], MerchantRoute::$queryD0, 'mch');
                    break;
                case 'merchantinfonotify':
                    $notify = new MerchantNotify();
                    $response = $notify->notify($arguments[0], $arguments[1]);
                    break;
                case 'merchantupdatenotify':
                    $notify = new MerchantNotify();
                    $response = $notify->changeNotify($arguments[0], $arguments[1]);
                    break;
                case 'querycash':
                    $response = $this->sendPostRequest(array(new MerchantCash(), 'queryCash'), $arguments[0], MerchantRoute::$queryMerchantCash, 'mch');
                    break;
                case 'queryfee':
                    $response = $this->sendPostRequest(array(new MerchantCash(), 'queryFee'), $arguments[0], MerchantRoute::$queryMerchantFee, 'mch');
                    break;
                case 'applycash':
                    $response = $this->sendPostRequest(array(new MerchantCash(), 'applyCash'), $arguments[0], MerchantRoute::$applyMerchantCash, 'mch');
                    break;
                case 'settlementrecords':
                    $response = $this->sendPostRequest(array(new MerchantCash(), 'settlementRecords'), $arguments[0], MerchantRoute::$querySettlementRecords, 'mch');
                    break;
                case 'generatecontract':
                    $response = $this->sendPostRequest(array(new MerchantContract(), 'create'), $arguments[0], MerchantRoute::$generateContract, 'mch');
                    break;
                case 'signcontract':
                    $response = $this->sendPostRequest(array(new MerchantContract(), 'sign'), $arguments[0], MerchantRoute::$signContract, 'mch');
                    break;
                case 'querycontract':
                    $response = $this->sendPostRequest(array(new MerchantContract(), 'query'), $arguments[0], MerchantRoute::$queryContract, 'mch');
                    break;
                case 'queryallocate':
                    $response = $this->sendPostRequest(array(new AllocateOrder(), 'query'), $arguments[0], MerchantRoute::$queryAllocate, 'mch');
                    break;
                case 'doallocate':
                    $response = $this->sendPostRequest(array(new AllocateOrder(), 'doAllocate'), $arguments[0], MerchantRoute::$doAllocate, 'mch');
                    break;
                case 'cancelallocate':
                    $response = $this->sendPostRequest(array(new AllocateOrder(), 'cancel'), $arguments[0], MerchantRoute::$cancelAllocate, 'mch');
                    break;
                case 'queryallocaterecord':
                    $response = $this->sendPostRequest(array(new MerchantAccount(), 'query'), $arguments[0], MerchantRoute::$queryAllocateRecord, 'mch');
                    break;
                case 'opentransfer':
                    $response = $this->sendPostRequest(array(new MerchantTransfer(), 'open'), $arguments[0], MerchantRoute::$openTransfer, 'mch');
                    break;
                case 'dotransfer':
                    $response = $this->sendPostRequest(array(new MerchantTransfer(), 'doTransfer'), $arguments[0], MerchantRoute::$doTransfer, 'mch');
                    break;
                case 'querytransfer':
                    $response = $this->sendPostRequest(array(new MerchantTransfer(), 'query'), $arguments[0], MerchantRoute::$queryTransfer, 'mch');
                    break;
                default:
                    throw new SaobeiException('方法不存在');
                    break;
            }
        } catch (SaobeiException $e) {
            echo $e->getMessage();
        }
        return empty($response) ? null : $response;
    }

    /**
     * POST
     * @throws SaobeiException
     * @throws \Exception
     * */
    private function sendPostRequest($callback, $argument, $apiRoute, $apiType = 'pay')
    {
        $param = call_user_func($callback, $argument);
        $rootPath = Path::getPath($apiType);
        $client = new HttpClient($rootPath.$apiRoute);//设置请求地址
        return $client->post($param);//请求参数
    }

    /**
     * GET
     * @throws SaobeiException
     * @throws \Exception
     * */
    private function sendGetRequest($callback, $argument, $apiRoute, $apiType = 'pay')
    {
        $param = call_user_func($callback, $argument);
        $rootPath = Path::getPath($apiType);
        $client = new HttpClient($rootPath.$apiRoute.$param);
        return $client->get();
    }
}
