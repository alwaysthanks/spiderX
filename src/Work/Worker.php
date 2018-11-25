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
    protected $processer = [];
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

    public function process($url)
    {
       
        $response = Response::buildFromPsrResponse($this->getRequest()->getContent($url));


       /**
        * @responseType Text
        **/
       if(substr($response->getHeader('Content-Type')[0], 0, 4) == 'text')
       {
           if(is_null($handle)) $handle = new self::$config['parse.parse'];
           try {
               if(! ($handle instanceof ParseInterface)) throw new Exception('parse class should be instanceof ParseInterface', 501);
               $urls = $handle->parse($response);
               if(count($urls) > 1)
                   foreach ($urls as $url)
                       $this->process($url, $handle);
           } Catch (Exception $exception) {
               throw new ParseException('Parse Error，detail：'. $exception->getMessage(), $exception->getCode());
           }

       }
       /**
        * @returnType Media
        **/
       else
       {
           try {
               $media = new self::$config['parse.media'];
               if(! ($media instanceof MediaInterface)) throw new Exception('media class should be instanceof ParseInterface',501);
               $fileSize = $response->getHeader('Content-Length');

               if(self::$config['parse.max_size'] > $fileSize[0]) {
                   self::$output['printSize'] += $fileSize[0];
                   self::$output['number'] += 1;

                   $media::handle($response);
               }

           } Catch (\Exception $exception) {
               throw new MediaException('Media Error，detail：' . $exception->getMessage(), $exception->getCode());
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