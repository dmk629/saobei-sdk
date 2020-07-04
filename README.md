# Saobei php-sdk

## 简介

利楚商务 **接口对接** 的PHP版SDK，集成几乎所有现版本开放接口，让开发者专注功能开发，从枯燥而没有规律的参数中解放出来，极简化对接。

## 安装

最好的安装方法是通过 [Composer](http://getcomposer.org/) 包管理器 :

```shell
composer require dmk629/saobei-sdk
```

## 依赖

- **PHP 5.3** or later
- **libcurl 7.10.5** or later

## 快速开始

#### 样例解析

- **支付接口** 用于支付场景，以下将以付款码支付(barcodepay)为例：

```php
    
    //实例化调度器
    $sdk = new \Saobei\sdk\Dispatcher();
    
    //配置商户号、终端号、终端token
    $sdk->initTerminal('yourMerchantNo', 'yourTerminalId', 'yourAccessToken');
    
    //传入必传参数
    $param = array(
        'pay_type' => '010', //支付方式：微信、支付宝等
        'terminal_trace' => '12345678901234567890123456789012', //客户端唯一流水号，生成须有识别性
        'total_fee' => '1', //支付金额（分）
        'auth_no' => '12345678901' //付款码
    );
    
    //调用方法，方法名大小写不敏感
    //$result = $client->barcodepay($param);
    $result = $sdk->barcodePay($param);

```

- **异步回调**内置验签，开发者传入闭包进行业务处理，下以交易通知为例：

```php
    
    //实例化调度器
    $sdk = new \Saobei\sdk\Dispatcher();
    
    //配置商户号、终端号、终端token
    $sdk->initTerminal('yourMerchantNo', 'yourTerminalId', 'yourAccessToken');
    
    //请求转化为数组
    $data = json_decode(file_get_contents('php://input'), true);//php-fpm模式接参
    //$data = JsonParser::ToArray($request->post());//Request类接参
    
    //传入闭包，处理业务逻辑
    $response = $sdk->notify($data, function() use ($data) {
        //TODO 业务逻辑
        var_dump($data);
        //if($data['total_fee'] == '1')echo "Amount checked \n";
        
        /**
         *  闭包返回
         * @example
         *  []
         *  ["status" => true]
         *  ["status" => true, "errmsg" => "成功"]
         *  ["status" => false, "errmsg" => "签名失败"]
         * */
         return array();
    });
    
    //额外参数
    $response['trace_no'] = $data['trace_no'];
    
    //响应
    echo json_encode($response, 256);

```

- **商户接口**的配置参数与方法与支付有所不同：

```php
    
    //实例化调度器
    $sdk = new \Saobei\sdk\Dispatcher();
    
    //配置机构号、KEY
    $sdk->initMerchant('yourInstNo', 'yourKey');

```

#### 接口方法列表

> 方法名大小写不敏感

- barCodePay        付款码支付
- prePay            扫码支付
- jsPay             公众号预支付
- miniPay           小程序支付
- facePay           刷脸支付
- wapPay            WAP SDK
- qrPay             聚合码支付
- query             支付订单查询
- refund            支付订单退款
- cancel            支付订单取消
- close             支付订单关闭
- faceInfo          刷脸信息
- authCodeToOpenId  授权码查询OPENID
- authAccessToken   微信获取access_token
- authOpenId        微信公众号JSAPI支付授权
- scanOrderSync     扫码点餐数据上传
- notify            交易通知
- orderSync         交易实时同步
- fenQiRateQuery    分期费率查询
- fenQiBarCodePay   分期刷卡支付
- fenQiPrePay       分期扫码支付
- fenQiJsPay        分期公众号预支付
- fenQiMiniPay      分期小程序支付
- fenQiQuery        分期查询订单
- fenQiRefund       分期退款
- fenQiCancel       分期取消订单
- fenQiClose        分期关闭订单
- fenQiNotify       分期交易通知
- preAuthBarCodePay 条码预授权
- preAuthQR         获取预授权聚合码
- preAuthQRH5Pay    预授权聚合码
- preAuthJsPay      公众号预授权
- preAuthMiniPay    小程序预授权
- preAuthFacePay    刷脸预授权
- preAuthQuery      预授权查询
- preAuthStatusQuery 预授权查询状态
- preAuthFinish     预授权完成
- preAuthCancel     预授权取消
- partnerPay        交通代扣申请扣款
- partnerQuery      交通代扣查询订单
- partnerRefund     交通代扣退款
- partnerUser       交通代扣查询用户
- merchantAdd       商户新增
- merchantCheckName 商户名查重
- merchantUpdate    商户更新
- merchantAddStore  创建门店
- merchantUpdateStore 修改门店
- merchantquerystore 门店查询
- merchantaddterminal 创建终端
- merchantqueryterminal 查询终端
- billDownLoad      账单下载
- weChatConfigSet   微信配置设置
- weChatConfigGet   微信配置查询
- updatePayRate     修改支付费率
- queryChannelMerchant 查询子商户
- updateBankCardInfo 修改结算卡
- queryBankCardInfo 查询结算卡
- updateSettleType  修改结算周期
- querySettleType   查询结算周期
- opend0            即时到账申请
- queryd0           即时到账查询
- merchantInfoNotify 商户异步通知
- merchantUpdateNotify 商户修改异步通知
- queryCash         查询余额
- queryFee          查询手续费
- applycash         发起提现
- settlementRecords 查询清算
- generateContract  生成电子协议
- signContract      签署电子协议
- queryContract     查询电子协议
- queryAllocate     查询分账
- doAllocate        发起分账
- cancelAllocate    取消分账
- queryAllocateRecord 查询分账记录
- openTransfer      开启转账
- doTransfer        发起转账
- queryTransfer     查询转账

-----

## 目录结构

```bash
├── demos/  ----- 参考样例
├── src/
│   ├── Config/            ----- 配置门面
│   ├── Exception/         ----- 定义异常类目录
│   ├── Model/             ----- 实体
│   ├── Util/              ----- 工具类
│   └── Dispatcher.php/    ----- 集中调度器
├── composer.json
└── README.md
```
------

- src/Dispatcher.php中集成所有方法，若有疑问可查看相关实体类。

- src/Util/HttpClient.php 为 `curl` 版简单封装的请求类，可以替换为其他客户端。

    > HttpClient方法调用封装在Dispatcher.php调度器中，如需替换须按需修改

- 为区别发送请求和接回调，组件分别使用 `request` 类发送请求， `response` 类接收回调。`/src/model` 目录下实体都以此标准区分。

    > `request` 类的返回体将直接转换为数组交予开发者，不做其他逻辑处理。
    >
    > `response` 类的请求体将经过状态码判断与验签后交予开发者，开发者使用闭包处理业务逻辑。

-------

 Email :  *dongmaike@lcsw.cn*