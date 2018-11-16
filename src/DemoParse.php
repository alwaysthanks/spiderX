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


use Spider\Contracts\ContentInterface;
use Spider\Contracts\ParseInterface;
use Spider\Work\Request;

class DemoParse implements ParseInterface
{
    /**
     * 通用网页图片捕获 Demo
     */
    public static function parseContent(ContentInterface $content)
    {
        $pattern = '/<img.*src=[\'\"]{1}([http|https].+\.[a-z]{3,4})[\'\"]{1}/iUs';
        preg_match_all($pattern, $content, $matches);
        if (count($matches[1]) > 0) {
            foreach ($matches[1] as $match)
            {
                if(strtolower(substr($match,0,4)) == 'http')
                {
                    yield Request::getContent($match);
                }
            }
        }
    }
}