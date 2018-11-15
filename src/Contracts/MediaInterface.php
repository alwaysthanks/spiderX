<?php
/**
 * Created by spider.
 * @File: MediaInterface.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/13
 * @Time: 11:04
 */
namespace Spider\Contracts;

use Psr\Http\Message\ResponseInterface;

interface MediaInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return null
     */
    public static function handle(ResponseInterface $response);
}