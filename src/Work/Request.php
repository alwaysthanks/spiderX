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
use Psr\Http\Message\ResponseInterface;
use Spider\Exceptions\HttpException;

class Request
{
    protected $client;

    public function __construct(array $guzzleOptions=[])
    {
        if(! $this->client instanceof Client) $this->client = new Client($guzzleOptions);
    }

    /**
     *
     * @return \GuzzleHttp\Client
     */
    public function getHttpClient() :Client
    {
        return $this->client;
    }

    /**
     * @param string $url  Request url
     *
     * @return HttpException
     */
    public function getContent(string $url) : ResponseInterface
    {
        try{
            $result = self::getHttpClient()->get($url);
        } Catch (\Exception $exception) {
            throw new HttpException('Request Error, url：'.$url.', detail：' . $exception->getMessage(), $exception->getCode(), $exception);
        }
        return $result;
    }

}