<?php
/**
 * Created by spiderX.
 * @File: ContentTest.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/16
 * @Time: 18:37
 */

namespace Spider\Tests;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Spider\Work\Content;

class ContentTest extends TestCase
{
    public function testGetUrlContent()
    {
//        // 创建模拟接口响应值
//        $response = new Response(200, [], '{"success": true}');
//
//        // 创建模拟 http client
//        $client = \Mockery::mock(Client::class);
//
//        $client->allows()->get('https://hui.1222.store/2018/05/20/%E6%90%AD%E5%BB%BA%E5%8D%9A%E5%AE%A2%E8%AE%B0%E5%BD%95/', [])->andReturn($response);
//
//        // 将 `getHttpClient` 方法替换为上面创建的 http client 为返回值的模拟方法。
//        $w = \Mockery::mock(Content::class)->makePartial();
//        $w->allows()->getHttpClient()->andReturn($client); // $client 为上面创建的模拟实例。
//
//        $this->assertSame(['success' => true], $w->getUrlContent('https://hui.1222.store/2018/05/20/%E6%90%AD%E5%BB%BA%E5%8D%9A%E5%AE%A2%E8%AE%B0%E5%BD%95/'));

    }

}