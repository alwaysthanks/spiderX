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

use GuzzleHttp\Client;
use Spider\Contracts\ParseInterface;
use Spider\Support\Config;
use Spider\Work\Output;
use Spider\Contracts\ContentInterface;

class Content implements ContentInterface
{
    protected $output;
    protected $request;
    public $response;

    public function __construct($response = null)
    {
        $this->response = $response;
    }

    public function __toString()
    {
        return $this->response;
    }

    public function getUrlContent(string $url, ParseInterface $parse = null)
    {
        $this->output = new Output(['StartTime'=> time()]);
        Request::getContent($url, $parse);
        $this->output->info();
    }

}