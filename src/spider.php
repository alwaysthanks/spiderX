<?php
/**
 * Created by spider.
 * @File: spider.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/12
 * @Time: 14:21
 */

namespace Spider;

use Spider\Contracts\ParseInterface;
use Spider\Work\Content;

class spider
{
    protected $url;

    public function __construct()
    {
        $this->content = new Content();
    }

    /**
     * @param $url | Target Url
     * @param ParseInterface $parse
     *
     * @return null
     */
    public function getContents($url, ParseInterface $parse = null)
    {
        $this->content->getUrlContent($url, $parse);
    }

}