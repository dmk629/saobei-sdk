<?php
//支付回调
error_reporting(-1);

//自动加载
include_once dirname(__DIR__)."/vendor/autoload.php";

//调度器
$sdk = new \Saobei\sdk\Dispatcher();

$merchantNo = '';
$terminalId = '';
$token = '';

//配置商户号、终端号、终端token
$sdk->initTerminal($merchantNo, $terminalId, $token);

//接收参数
$dataString = file_get_contents('php://input');
//if(empty($dataString))TODO log;
$data = json_decode($dataString, true);
//if(empty($data))TODO log;

//传入闭包，引入参数（必须为索引数组形式response）
$response = $sdk->notify($data, function() use ($data) {
    if($data['total_fee'] == '1')echo "Amount checked \n";
    var_dump($data);
});

//额外参数
if(false)$response['trace_no'] = $data['trace_no'];

//响应
echo json_encode($response, 256);