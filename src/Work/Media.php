<?php
/**
 * Created by spider.
 * @File: Media.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/12
 * @Time: 16:13
 */
namespace Spider\Work;

use Spider\Contracts\MediaInterface;
use Spider\Work\Output;
use Psr\Http\Message\ResponseInterface;

class Media implements MediaInterface
{
    /**
     * Download Media Type
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return null
     */
    public static function handle(ResponseInterface $response)
    {
        $fileSize = $response->getHeader('Content-Length');

        $output = new Output();
        // TODO 限制下载大小
        $output->PrintSize = $fileSize[0] + $output->PrintSize;
        $output->Number = ++$output->Number;
        // TODO config 配置
        $path = './images/';
        if(!is_dir($path)) mkdir($path);
        $filename = $path . bin2hex(random_bytes(10)) . '.' . @array_pop(explode('/',$response->getHeader('Content-Type')[0]));
        file_put_contents($filename, $response->getBody()->getContents());
        return;
    }
}