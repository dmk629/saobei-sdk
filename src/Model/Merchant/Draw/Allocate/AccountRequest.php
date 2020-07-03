<?php
namespace Saobei\sdk\Model\Merchant\Allocate;

use Saobei\sdk\Exception\SaobeiException;
use Saobei\sdk\Model\Merchant\Draw\DrawRequest;

class AccountRequest extends DrawRequest
{
    protected $requiredFields = array(
        'inst_no','trace_no','merchant_no','account_in','start_date','end_date','key_sign'
    );

    /** @var string 机构编号 */
    protected $inst_no;
    /** @var string 请求流水号 */
    protected $trace_no;
    /** @var string 分账入帐户 */
    protected $account_in;
    /** @var string 分账起始日期 */
    protected $start_date;
    /** @var string 分账截止日期 */
    protected $end_date;

    /**
     * 汇总查询
     * @param array $fields
     *
     * @fieldParam String $inst_no
     * @fieldParam String $trace_no
     * @fieldParam String $merchant_no
     * @fieldParam String $account_in
     * @fieldParam String $start_date
     * @fieldParam String $end_date
     * @fieldParam String $key_sign
     *
     * @return array
     * @throws SaobeiException
     * */
    public function query($fields)
    {
        return $this->main($fields);
    }
}
