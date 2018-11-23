<?php
/**
 * Created by spiderX.
 * @File: spiderX.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/19
 * @Time: 16:49
 */

namespace Spider\Work;

use GuzzleHttp\Psr7;
use Spider\Contracts\ParseInterface;
use Spider\Exceptions\HttpException;
use Spider\Support\Response;

class spider extends Worker
{
    protected $pattern = '/\b(([\w-]+:\/\/?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|\/)))/';

    public function process($url, callable $able = null)
    {
        if(preg_match($this->pattern, $url) === 0) {
            throw new HttpException("url({$url}) is not a valid link");
        }

        $response = Response::buildFromPsrResponse($this->getRequest()->getContent($url));


//        /**
//         * @responseType Text
//         **/
//        if(substr($response->getHeader('Content-Type')[0], 0, 4) == 'text')
//        {
//            if(is_null($handle)) $handle = new self::$config['parse.parse'];
//            try {
//                if(! ($handle instanceof ParseInterface)) throw new Exception('parse class should be instanceof ParseInterface', 501);
//                $urls = $handle->parse($response);
//                if(count($urls) > 1)
//                    foreach ($urls as $url)
//                        $this->process($url, $handle);
//            } Catch (Exception $exception) {
//                throw new ParseException('Parse Error，detail：'. $exception->getMessage(), $exception->getCode());
//            }
//
//        }
//        /**
//         * @returnType Media
//         **/
//        else
//        {
//            try {
//                $media = new self::$config['parse.media'];
//                if(! ($media instanceof MediaInterface)) throw new Exception('media class should be instanceof ParseInterface',501);
//                $fileSize = $response->getHeader('Content-Length');
//
//                if(self::$config['parse.max_size'] > $fileSize[0]) {
//                    self::$output['printSize'] += $fileSize[0];
//                    self::$output['number'] += 1;
//
//                    $media::handle($response);
//                }
//
//            } Catch (\Exception $exception) {
//                throw new MediaException('Media Error，detail：' . $exception->getMessage(), $exception->getCode());
//            }
//
//        }

    }
}