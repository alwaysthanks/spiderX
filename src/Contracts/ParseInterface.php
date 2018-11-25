<?php
/**
 * Created by spider.
 * @File: ParseInterface.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/12
 * @Time: 14:26
 */

namespace Spider\Contracts;

use Psr\Http\Message\ResponseInterface;

interface ParseInterface
{
	/**
	 *	[parse description]
	 * 
	 * @param  \Psr\Http\Message\ResponseInterface $response
	 * 
	 * @return [array]	content
	 */
    public function parse(ResponseInterface $response) :array;

    /**
     * get next page url
     * 
	 * @param  \Psr\Http\Message\ResponseInterface $response
	 * 
     * @return [string|bool] 返回下一页的链接                      
     */
    public function getNextPage(ResponseInterface $response) :string|bool;
}