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


use Spider\Contracts\ContentInterface;
use Spider\Contracts\ParseInterface;

class Parse extends Work implements ParseInterface
{
    public static function parseContent(ContentInterface $content)
    {
        $pattern = '/<img.*src=[\'\"]{1}([http|https].+\.[a-z]{3,4})[\'\"]{1}/iUs';
        preg_match_all($pattern, $content, $matches);
        if (count($matches[1]) > 0) {
            foreach ($matches[1] as $match)
            {
                if(strtolower(substr($match,0,4)) == 'http')
                {
                    Request::getContent($match);
                }
            }
        }
    }
}