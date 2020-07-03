<?php
namespace Saobei\sdk\Model;

use Saobei\sdk\Exception\SaobeiException;

class Notify
{
    /**
     * 请求事件
     * @param array $data
     * @param \Closure $callback
     *
     * @return array
     * @throws SaobeiException
     * */
    public function onRequest($data, $callback)
    {
        if($this->verifySign($data) === false)$this->onFailed();
        return $this->onSucceed($callback);
    }

    /**
     * 验证请求
     * @param array $data
     *
     * @return bool
     * */
    protected function verifySign($data)
    {
        return true;
    }

    /**
     * 请求失败事件
     * @throws SaobeiException
     * */
    protected function onFailed()
    {
        throw new SaobeiException('请求失败');
    }

    /**
     * 请求成功事件
     * @param array $data
     * @param \Closure $callback
     *
     * @return array
     * */
    protected function onSucceed($callback)
    {
        $reply = $callback();//调用闭包
        return $this->reply(isset($reply['status']) ? $reply['status'] : true, isset($reply['errmsg']) ? $reply['errmsg'] : '');
    }

    /**
     * 回复
     * @param bool $status
     * @param string $errorMessage
     *
     * @return array
     * */
    protected function reply($status = true, $errorMessage = '')
    {
        if($status){
            return array('return_code' => '01', 'return_msg' => $errorMessage ?: '成功');
        }else{
            return array('return_code' => '02', 'return_msg' => $errorMessage ?: '未知错误');
        }
    }

}
