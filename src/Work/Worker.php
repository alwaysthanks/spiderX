<?php
/**
 * Created by spiderX.
 * @File: Work.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/15
 * @Time: 16:24
 */

namespace Spider\Work;

use Spider\Support\Config;
use Spider\Support\Response;
use Spider\Contracts\ParseInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

class Worker
{
    protected $processArr = [];
    protected $pattern = '/((http|https|ftp|telnet|news):\/\/)?([a-z0-9_\-\/\.]+\.[][a-z0-9:;&#@=_~%\?\/\.\,\+\-]+)/Ui';
    protected static $config;
    protected static $output;

    public function __construct()
    {
        $conf = require __DIR__ . '/../../config/config.php';
        if(!self::$config) {
            self::$config = new Config($conf);
        }
        if(!self::$output) {
            self::$output = new Output($conf);
        }
    }

    protected function isUrl($url)
    {
        if(preg_match($this->pattern, $this->url = $url) === 0) {
            return false;
        }
        return true;
    }

    protected function getRequest(array $headers = [])
    {
        return $this->request ?? $this->request = new Request(array_merge($headers,self::$config['request']));
    }

    protected function buildResponse($response)
    {
        if($response instanceof ResponseInterface) {
            return Response::buildFromPsrResponse($response);
        }
        return Response::buildFromPsrResponse(new GuzzleResponse(200, [], $response));
    }

    protected function getContent($url, array $headers = [])
    {
        return $this->buildResponse($this->getRequest($headers)->getContent($url));
    }

    public function process(ParseInterface $parse)
    {
        if(count($this->processArr) != 0)
        {
            foreach ($this->processArr as $item)
            {
                if($this->isUrl($item)) {
                    $parse->process($this->getContent($item));
                } else {
                    $parse->process($this->buildResponse($item));
                }
            }
        }

    }

    // protected function callHandler($handler = null)
    // {
    //     if ($handler instanceof ParseInterface) {
    //         return $handler;
    //     }
    //     return false;
    // }


}