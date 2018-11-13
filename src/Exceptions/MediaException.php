<?php
/**
 * Created by spider.
 * @File: MediaException.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/13
 * @Time: 12:31
 */

namespace Spider\Exceptions;

use Throwable;

class MediaException extends Exception
{
    public function __construct($message = "", $code = 500, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}