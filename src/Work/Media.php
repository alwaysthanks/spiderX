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

use Exception;
use Spider\Contracts\MediaInterface;
use Psr\Http\Message\ResponseInterface;

class Media extends Work implements MediaInterface
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

        if(self::$config['media.max_size'] < $fileSize[0]) return;
        self::$output->printSize = $fileSize[0] + self::$output->printSize;
        self::$output->number = ++self::$output->number;

        $path = self::$config['path'];
        if(! self::newDir($path)) {
            throw new Exception('make dir field.');
        }

        $filename = $path . bin2hex(random_bytes(10)) . '.' . @array_pop(explode('/',$response->getHeader('Content-Type')[0]));
        file_put_contents($filename, $response->getBody()->getContents());
        return;
    }

    /**
     * new dir
     * @return boolean
     */
    public static function newDir($path)
    {
        if (is_dir($path) || mkdir($path)) return true;
        if ( !self::newDir(dirname($path))) return false;
        return mkdir($path);
    }

}