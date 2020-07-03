<?php

if(!empty($_POST)){
    if(empty($_POST['merchant_no']))emptyParamError('商户号缺失');
    if(empty($_POST['terminal_id']))emptyParamError('终端号号缺失');
    if(empty($_POST['access_token']))emptyParamError('终端token缺失');
    if(empty($_POST['auth_no']))emptyParamError('授权码缺失');

    //付款码支付
    error_reporting(-1);

    //自动加载
    include_once dirname(__DIR__)."/vendor/autoload.php";

    //调度器
    $sdk = new \Saobei\sdk\Dispatcher();

    //配置商户号、终端号、终端token
    $sdk->initTerminal($_POST['merchant_no'], $_POST['terminal_id'], $_POST['access_token']);

    //传入参数
    $fields = array(
        'pay_type' => '000',//自动识别支付类型
        'terminal_trace' => createTerminalTraceDemo($_POST['merchant_no'], $_POST['terminal_id']),
        'total_fee' => '1',
        'auth_no' => $_POST['auth_no']
    );

    //调用方法，方法名大小写不敏感
    $result = $sdk->barCodePay($fields);

    header('Content-type: text/html; charset=utf-8');
    foreach($result as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : ".htmlspecialchars($value, ENT_QUOTES)." <br/>";
    }
}

/**
 * 流水号生成样例
 *  仅用于演示，一秒内多单会出现相同流水号，请勿生产使用
 * @param string $merchantNo 商户号
 * @param string $terminalId 终端号
 * @return string
 * */
function createTerminalTraceDemo($merchantNo, $terminalId)
{
    return substr($merchantNo, 1).$terminalId.time();
}

function emptyParamError($message){
    echo '<script>alert("'.$message.'");</script>';
    exit();
}

?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>扫呗支付样例-付款码</title>
</head>
<body>
<form method="post">
    <div style="margin-left:2%;">商户号：</div><br/>
    <input type="text" style="width:96%;height:35px;margin-left:2%;" name="merchant_no" /><br /><br />
    <div style="margin-left:2%;">终端号：</div><br/>
    <input type="text" style="width:96%;height:35px;margin-left:2%;" name="terminal_id" /><br /><br />
    <div style="margin-left:2%;">终端token：</div><br/>
    <input type="text" style="width:96%;height:35px;margin-left:2%;" name="access_token" /><br /><br />
    <div style="margin-left:2%;">支付金额：</div><br/>
    <input type="text" style="width:96%;height:35px;margin-left:2%;" readonly value="1分" name="total_fee" /><br /><br />
    <div style="margin-left:2%;">授权码：</div><br/>
    <input type="text" style="width:96%;height:35px;margin-left:2%;" name="auth_no" /><br /><br />
    <div align="center">
        <input type="submit" value="提交" style="width:210px; height:50px; border-radius: 15px;background-color:#2d8bfe; border:1px #2ecbee solid; cursor: pointer;  color:white;  font-size:16px;" />
    </div>
</form>
</body>
</html>
