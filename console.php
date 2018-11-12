<?php
/**
 * date: 2018.11.09
 * createby: yusl
 * email: alwaysthanks@163.com
 */

require_once __DIR__ . '/class_context.php';
require_once __DIR__ . '/class_content.php';
require_once __DIR__ . '/class_entrance.php';
require_once __DIR__ . '/class_def.php';
require_once __DIR__ . '/class_libs.php';

Context::$StartTime = time();
Context::$Domain = "http://www.baidu.com/";
Context::$PicDir = "F:\img\abc\\";
Context::$MaxSize = 1<<31;//2GB

//bind 回调
Entrance::$RegexPageFunc = 'Def::EntrancePage';
Entrance::$RegexContentFunc = 'Def::EntranceContent';

Content::$RegexPageFunc = 'Def::CPage';
Content::$RegexContentFunc = 'Def::CContent';


try {
	//init depth
	Entrance::Init(-1);
	//execute
	$url = sprintf("%s%s", Context::$Domain, '');
	Entrance::Do($url);
	
} catch (Exception $e) {
	Libs::Echos($e->getMessage());
}
//output
Context::PrintInfo();

