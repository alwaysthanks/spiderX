<?php
require_once __DIR__ . "/class_libs.php";
require_once __DIR__ . "/class_def.php";
require_once __DIR__ . '/class_context.php';

//test echos
Libs::Echos("hello-you");

//test libs curl
$content = Libs::CurlGet("http://www.baidu.com/pic/2098/1.jpg");
file_put_contents('F:\img\png.jpg', $content);
Libs::Echos('content size:' . strlen($content));

//test context print
Context::PrintInfo();

//test entrance content regex
$content = Libs::CurlGet("http://www.baidu.com/pic/");
$ret = Def::EntranceContent($content);
//var_dump($ret);

//test entrance page regex
//Context::$Domain = 'http://www.baidu.com/pic/';
$content = Libs::CurlGet("http://www.baidu.com/pic/");
//var_dump($content);
$ret = Def::EntrancePage($content);
//var_dump($ret);

//test content regex
Context::$Domain = 'http://www.baidu.com/';
$content = Libs::CurlGet("http://www.baidu.com/pic/210.html");
$ret = Def::CContent($content);
//var_dump($ret);

//test content page regex
Context::$Domain = 'http://www.baidu.com/';
$content = Libs::CurlGet("http://www.baidu.com/pic/");
$ret = Def::CPage($content);
//var_dump($ret);

//test rand ip
echo Libs::Echos(Libs::MakeRandIP());
echo Libs::MakeRandIP();

