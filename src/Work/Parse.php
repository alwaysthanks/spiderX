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

use Psr\Http\Message\ResponseInterface;
use Spider\Contracts\ParseInterface;

class Parse implements ParseInterface
{
    public function parse(ResponseInterface $response)
    {
        $urls = [];
        $pattern = '/<img.*src=[\'\"]{1}([http|https].+\.[a-z]{3,4})[\'\"]{1}/iUs';
        preg_match_all($pattern, $response, $matches);
        if (count($matches[1]) > 0) $urls = array_merge($urls, $matches[1]);
        $nextPagePattern = $this->getNextPagePattern();
        if(!empty($nextPagePattern)) {
            preg_match($nextPagePattern, $response, $matches_page);
            if(count($matches_page) > 1) $urls = array_merge($urls, array_pop($matches_page));
            else if(count($matches_page) == 1) $urls = array_merge($urls, $matches_page);
        }
        return $urls;
    }

    public function getNextPage()
    {
        return '';
    }

}