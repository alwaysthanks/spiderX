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

use Spider\Contracts\ParseInterface;
use Spider\Exceptions\Exception;
use Spider\Exceptions\ParseException;
use Spider\Support\Config;

class Worker
{
    protected static $config;
    protected static $output;

    public function __construct(array $conf = [])
    {
        $conf = array_merge($conf, require __DIR__ . '/../../config/config.php');
        if(!self::$config) {
            self::$config = new Config($conf);
        }
        if(!self::$output) {
            self::$output = new Output($conf);
        }
        self::$output->info();
    }

    protected function getRequest(array $headers = [])
    {
        return $this->request ?? $this->request = new Request(array_merge($headers,self::$config['request']));
    }

    protected function callHandler($handler, $payload)
    {
        if ((! is_callable($handler)) || (! $handler instanceof ParseInterface) ) {
            throw new ParseException('No valid handler is found in arguments.');
        }


    }


}