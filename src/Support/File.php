<?php
/**
 * Created by spiderX.
 * @File: File.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/19
 * @Time: 18:52
 */

namespace Spider\Support;


use Spider\Exceptions\HttpException;

class File
{
    protected static $extensionMap = [
        'audio/wav'         => '.wav',
        'audio/x-ms-wma'    => '.wma',
        'video/x-ms-wmv'    => '.wmv',
        'video/mp4'         => '.mp4',
        'audio/mpeg'        => '.mp3',
        'audio/amr'         => '.amr',
        'application/vnd.rn-realmedia' => '.rm',
        'audio/mid'         => '.mid',
        'image/bmp'         => '.bmp',
        'image/gif'         => '.gif',
        'image/png'         => '.png',
        'image/tiff'        => '.tiff',
        'image/jpeg'        => '.jpg',
        'application/pdf'   => '.pdf'
    ];

    public static function getStreamExt($stream)
    {
        try {
            $stream = file_get_contents($stream);
        } catch (\Exception $e) {
            throw new HttpException("get files($stream) field");
        }

        $fileInfo = new \finfo(FILEINFO_MIME);

        $mime = strstr($fileInfo->buffer($stream), ';', true);

        return self::$extensionMap[$mime];
    }

}