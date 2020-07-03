<?php
namespace Saobei\sdk\Model\Merchant;

use Saobei\sdk\Config\Path;
use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Model\Request;

class BillRequest extends Request
{
    /**
     * 必传参数
     * @var array
     */
    protected $requiredFields = array(
        'day','inst_no','key_sign'
    );

    /** @var string 日期 */
    protected $day;
    /** @var string 机构号 */
    protected $inst_no;

    /**
     * 下载账单
     * @param array $fields
     *
     * @fieldParam String $day 日期
     * @fieldParam String $inst_no
     * @fieldParam String $key_sign
     *
     * @return string
     * @throws SaobeiException
     * */
    public function downloadPath($fields)
    {
        $this->init($fields);
        $this->checkParam(array());
        $param = $this->getter();
        $url = '/order/'.$param['day'].'/'.$param['inst_no'].'/'.$param['key_sign'].'/'.$fields['inst_no'].'_'.$fields['day'].'.txt';
        return $url;
    }

}
