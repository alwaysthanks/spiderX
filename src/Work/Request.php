<?php
/**
 * Created by spider.
 * @File: Request.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/12
 * @Time: 15:34
 */
namespace Spider\Work;

use GuzzleHttp\Client;
use Exception;
use Spider\Contracts\MediaInterface;
use Spider\Contracts\ParseInterface;
use Spider\Exceptions\MediaException;
use Spider\Exceptions\ParseException;
use Spider\Exceptions\RequestException;

class Request extends Work
{
    /**
     * @param array $guzzleOptions | Request Url Headers
     *
     * @return \GuzzleHttp\Client
     */
    public static function getHttpClient(array $guzzleOptions=[])
    {
        $guzzleOptions = array_merge($guzzleOptions, ['headers'=> self::$config['request.headers']]);
        return new Client($guzzleOptions);
    }

    /**
     * @param string $url          | Request url
     * @param $parse              | Custom Parse Url Content
     *
     * @return Exception
     */
    public static function getContent($url, $parse = null)
    {
        try{
            $result = self::getHttpClient()->get($url);
        } Catch (\Exception $exception) {
            throw new RequestException('Request Error, url：'.$url.', detail：' . $exception->getMessage(),500, $exception);
        }

        /**
         * @returnType Text
         **/
        if(substr($result->getHeader('Content-Type')[0], 0, 4) == 'text')
        {
            if(is_null($parse)) $parse = new self::$config['parse.parse'];
            try {
                $contents = $result->getBody()->getContents();
                if(! ($parse instanceof ParseInterface)) throw new Exception('parse class should be instanceof ParseInterface', 501);
                @call_user_func($parse::parseContent(new Content($contents)));
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
                $media = new self::$config['media.media'];
                if(! ($media instanceof MediaInterface)) throw new Exception('media class should be instanceof ParseInterface',501);
                @$media::handle($result);
            } Catch (\Exception $exception) {
                throw new MediaException('Media Error，detail：' . $exception->getMessage(), $exception->getCode());
            }

        }

    }

}