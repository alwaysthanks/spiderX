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
use Spider\Contracts\ParseInterface;
use Spider\Exceptions\Exception;
use Spider\Exceptions\ParseException;
use Spider\Exceptions\RequestException;
use Spider\Support\Config;

class Request
{
    /**
     * @param array $guzzleOptions | Request Url Headers
     *
     * @return \GuzzleHttp\Client
     */
    public static function getHttpClient(array $guzzleOptions=[])
    {
        // TODO headers config
        $guzzleOptions = array_merge($guzzleOptions, []);
        return new Client($guzzleOptions);
    }

    /**
     * @param string $url           | Request url
     * @param $closure              | Custom Parse Url Content
     *
     * @return null
     */
    public static function getContent($url, $parse = null)
    {
        try{
            $result = self::getHttpClient()->get($url);
        } Catch (\Exception $exception) {
            throw new RequestException('链接'.$url.'请求失败',500, $exception);
        }

        /**
         * @returnType Text
         **/
        if(substr($result->getHeader('Content-Type')[0], 0, 4) == 'text')
        {
            try {
                $contents = $result->getBody()->getContents();
                if($parse instanceof ParseInterface) {
                    @call_user_func($parse::parseContent(new Content($contents)));
                }
            } Catch (Exception $exception) {
                throw new ParseException('解析失败'. $exception->getMessage(), 500);
            }

        }
        /**
         * @returnType Media
         **/
        else
        {
            // TODO config 配置 自定义 多媒体文件处理 需要继承 MediaInterface
            Media::handle($result);
        }

    }

}