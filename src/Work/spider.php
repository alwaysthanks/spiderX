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
use Spider\Support\Response;

class spider extends Worker
{
	protected $url; 
	protected $pattern = '/\b(([\w-]+:\/\/?|www[.])[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|\/)))/';

	public function __construct($url = null, array $headers = [])
	{
		if(!is_null($url) {
			$this->setUrl($url);
		}

        if($headers) {
        	self::$config['request.headers'] = $headers;
        }
	}

	public function setUrl($url)
	{
		if(preg_match($this->pattern, $this->url = $url) === 0) {
            throw new HttpException("url({$url}) is not a valid link");
        }
	}

	public function start($url = null, array $headers = [], ParseInterface $parse = null)
	{
		if(!is_null($url)) {
			$this->setUrl($url);	
		} 
        $response = Response::buildFromPsrResponse($this->getRequest($headers)->getContent($this->url));
        $parse = $parse ?? new Parse;
        array_push($this->processArr, $parse->parse($response))
        $this->process();
        if($next = $parse->getNextPage($response)) {
        	$this->start($next, $headers, $parse);
        }
	}

}