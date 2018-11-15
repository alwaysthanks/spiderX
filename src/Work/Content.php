<?php
/**
 * Created by spider.
 * @File: Content.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/12
 * @Time: 14:36
 */

namespace Spider\Work;

use Spider\Contracts\ParseInterface;
use Spider\Contracts\ContentInterface;

class Content extends Work implements ContentInterface
{
    public $response;

    public function __construct($response = null)
    {
        parent::__construct();
        $this->response = $response;
    }

    public function __toString()
    {
        return $this->response;
    }

    public function getUrlContent(string $url, ParseInterface $parse = null)
    {
        Request::getContent($url, $parse);
        self::$output->info();
    }

}