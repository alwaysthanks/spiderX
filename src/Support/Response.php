<?php
/**
 * Created by spiderX.
 * @File: Response.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/19
 * @Time: 18:30
 */

namespace Spider\Support;

use GuzzleHttp\Psr7\Response as GuzzleHttpResponse;
use Psr\Http\Message\ResponseInterface;
use Spider\Exceptions\MediaException;

class Response extends GuzzleHttpResponse
{
    public function getBodyContent()
    {
        // 将 handle 的文件位置指针设为文件流的开头。
        $this->getBody()->rewind();
        $contents = $this->getBody()->getContents();
        $this->getBody()->rewind();

        return $contents;
    }

    public function __toString()
    {
        return $this->getBodyContent();
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Spider\Support\Response
     */
    public static function buildFromPsrResponse(ResponseInterface $response)
    {
        return new static(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );
    }

    public function save(string $directory, string $filename = '')
    {

        $directory = rtrim($directory, '/');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        if (!is_writable($directory)) {
            throw new MediaException(sprintf("'%s' is not writable.", $directory));
        }

        $contents = $this->getBodyContent();

        if (empty($filename)) {
            if (preg_match('/filename="(?<filename>.*?)"/', $this->getHeaderLine('Content-Disposition'), $match)) {
                $filename = $match['filename'];
            } else {
                $filename = md5($contents);
            }
        }

        if (empty(pathinfo($filename, PATHINFO_EXTENSION))) {
            $filename .= File::getStreamExt($contents);
        }

        file_put_contents($directory.'/'.$filename, $contents);

        return $filename;
    }


}