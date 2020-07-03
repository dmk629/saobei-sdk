<?php

if(!empty($_POST)){
    if(empty($_POST['inst_no']))emptyParamError('机构号缺失');
    if(empty($_POST['key']))emptyParamError('key缺失');
    if(empty($_POST['merchant_name']))emptyParamError('商户名缺失');

    error_reporting(-1);

    //自动加载
    include_once dirname(__DIR__)."/vendor/autoload.php";

    //调度器
    $sdk = new \Saobei\sdk\Dispatcher();

    //配置商户号、终端号、终端token
    $sdk->initMerchant($_POST['inst_no'], $_POST['key']);

    //传入参数
    $fields = array(
        'merchant_name' => $_POST['merchant_name'],
        'trace_no' => createTraceNoDemo($_POST['inst_no'])
    );

    //调用方法，方法名大小写不敏感
    $result = $sdk->merchantCheckName($fields);

    header('Content-type: text/html; charset=utf-8');
    foreach($result as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : ".htmlspecialchars($value, ENT_QUOTES)." <br/>";
    }
}

/**
 * 流水号生成样例
 *  仅用于演示，一秒内多单会出现相同流水号，请勿生产使用
 * @param string $instNo 机构号
 * @param string $key
 * @return string
 * */
function createTraceNoDemo($instNo)
{
    return $instNo.date('YmdHis').mt_rand(1000000000,9999999999);
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
    <title>扫呗商户样例-商户名验重</title>
</head>
<body>
<form method="post">
    <div style="margin-left:2%;">机构号：</div><br/>
    <input type="text" style="width:96%;height:35px;margin-left:2%;" name="inst_no" /><br /><br />
    <div style="margin-left:2%;">KEY：</div><br/>
    <input type="text" style="width:96%;height:35px;margin-left:2%;" name="key" /><br /><br />
    <div style="margin-left:2%;">商户名称：</div><br/>
    <input type="text" style="width:96%;height:35px;margin-left:2%;" name="merchant_name" /><br /><br />
    <div align="center">
        <input type="submit" value="提交" style="width:210px; height:50px; border-radius: 15px;background-color:#2d8bfe; border:1px #2ecbee solid; cursor: pointer;  color:white;  font-size:16px;" />
    </div>
</form>
</body>
</html>