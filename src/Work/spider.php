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
use Spider\Work\Parse;
use Spider\Contracts\ParseInterface;
use Spider\Exceptions\HttpException;

class spider extends Worker
{
	protected $url;

	public function __construct($url = null, array $headers = [])
	{
	    parent::__construct();

		if(! is_null($url) && ! $this->isUrl($url)) {
            throw new HttpException("url({$url}) is not a valid link");
		}

        if($headers) {
        	self::$config['request.headers'] = $headers;
        }
	}

	public function start($url = null, array $headers = [], ParseInterface $parse = null)
	{
		if(!is_null($url) && ! $this->isUrl($url)) {
            throw new HttpException("url({$url}) is not a valid link");
		}
        $response = $this->getContent($this->url, $headers);
        $parse = $parse ?? new Parse;
        $this->processArr = array_merge($this->processArr, $parse->parse($response));
        $this->process($parse);
        if($next = $parse->getNextPage($response)) {
        	$this->start($next, $headers, $parse);
        }
	}

}