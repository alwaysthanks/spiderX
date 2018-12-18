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

use Spider\Support\Response;

interface ParseInterface
{
	/**
	 *	[parse description]
	 * 
	 * @param  \Spider\Support\Response $response
	 * 
	 * @return [array]	content
	 */
    public function parse(Response $response);

    /**
     * get next page url
     *
     * @param  \Spider\Support\Response $response
     *
     * @return [string|bool] 返回下一页的链接
     */
    public function getNextPage(Response $response);

    /**
     *	[parse description]
     *
     * @param  \Spider\Support\Response $response
     *
     * @return null
     */
    public function process(Response $response);
}