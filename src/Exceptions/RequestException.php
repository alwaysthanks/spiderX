<?php
/**
 * Created by spider.
 * @File: RequestException.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/13
 * @Time: 14:47
 */

namespace Spider\Exceptions;

use Throwable;

class RequestException extends Exception
{
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}