<?php
/**
 * Created by spider.
 * @File: ParseInterface.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/12
 * @Time: 14:26
 */

namespace Spider\Contracts;

use Psr\Http\Message\ResponseInterface;

interface ParseInterface
{
    public function parse(ResponseInterface $response);

    public function getNextPagePattern();
}