<?php
/**
 * Created by spiderX.
 * @File: DemoParse.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/13
 * @Time: 16:40
 */

namespace Spider;

use Psr\Http\Message\ResponseInterface;
use Spider\Work\Parse;

class DemoParse extends Parse
{

    public function getNextPagePattern()
    {
        return '';
    }
}