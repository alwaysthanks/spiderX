<?php
/**
 * Created by spiderX.
 * @File: Parse.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/15
 * @Time: 16:52
 */

namespace Spider\Work;

use Spider\Support\Response;
use Spider\Contracts\ParseInterface;

class Parse implements ParseInterface
{
    public function parse(Response $response)
    {
        $pattern = '/<img.*src=[\'\\"]{1}([http|https].+\.[a-z]{3,4})[\'\\"]{1}/iUs';
        preg_match_all($pattern, $response, $matches);
        return $matches[1] ?? [];
    }

    public function process(Response $response)
    {
        $response->save('./images/');
    }

    public function getNextPage(Response $response)
    {
        return false;
    }

}