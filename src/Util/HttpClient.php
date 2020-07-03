<?php
namespace Saobei\sdk\Util;

/**
 * 基于curl扩展的简单http客户端
 * */
class HttpClient
{
    /** @var string 请求地址 **/
    private $url;

    /**
     * @throws \Exception
     * */
    public function __construct($url)
    {
        if(empty($url))throw new \Exception("缺少路由地址");
        $this->url = $url;
    }

    /**
     * post请求
     * @return array
     * */
    public function post($data)
    {
        if(is_array($data) || is_object($data))$data = json_encode($data);
        $curl_handler = curl_init();
        $options = array(
            CURLOPT_TIMEOUT => 10,
            CURLOPT_URL => $this->url,
            CURLOPT_RETURNTRANSFER => 1,//将获取数据返回
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json; charset=utf-8'
            )
        );
        curl_setopt_array($curl_handler, $options);
        $curl_result = curl_exec($curl_handler);
        $curl_http_status = curl_getinfo($curl_handler,CURLINFO_HTTP_CODE);
        $curl_http_info = curl_getinfo($curl_handler);
        if ($curl_result == false) {
            $error = curl_error($curl_handler);
            curl_close($curl_handler);
            return array('code' => $curl_http_status, 'message' => $error,'data' => $curl_http_info);
        }
        curl_close($curl_handler);
        $result = json_decode($curl_result, true);
        if (is_null($result)) {
            $result = $curl_result;
        }
        return $result;
    }

    /**
     * get请求
     * @return array
     * */
    public function get()
    {
        $curl_handler = curl_init();
        $options = array(
            CURLOPT_URL             => $this->url,
            CURLOPT_RETURNTRANSFER => 1
        );
        curl_setopt_array($curl_handler, $options);
        $curl_result = curl_exec($curl_handler);
        $curl_http_status = curl_getinfo($curl_handler,CURLINFO_HTTP_CODE);
        $curl_http_info = curl_getinfo($curl_handler);
        if ($curl_result === false) {
            $error = curl_error($curl_handler);
            curl_close($curl_handler);
            return array('code' => $curl_http_status, 'message' => $error,'data' => $curl_http_info);
        }
        $result = json_decode($curl_result,true);
        if (is_null($result) || empty($result)) $result = $curl_result;
        curl_close($curl_handler);
        return $result;
    }

}
