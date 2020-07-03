<?php
namespace Saobei\sdk\Exception;

use \Exception;

/**
 * 扫呗API异常类
 */
class SaobeiException extends Exception
{
	public function errorMessage()
	{
		return $this->getMessage();
	}
}
