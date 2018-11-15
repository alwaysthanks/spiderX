<?php
/**
 * Created by spider.
 * @File: ParseException.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/13
 * @Time: 12:30
 */

namespace Spider\Exceptions;

use Throwable;
class ParseException extends Exception
{
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}