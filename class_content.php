<?php
/**
 * date: 2018.11.09
 * createby: yusl
 * email: alwaysthanks@163.com
 */

require_once __DIR__ . '/class_context.php';
require_once __DIR__ . '/class_entrance.php';
require_once __DIR__ . '/class_libs.php';

class Content
{

	//正则函数
	public static $RegexPageFunc = null;
	public static $RegexContentFunc = null;


	private $pageUrl = '';
	private $resource = '';
	private $imageUrls = [];
	private $nextPages = [];
	private $nextObjs = [];

	public function __construct($pageUrl = '')
	{
		$this->pageUrl = $pageUrl;
	}

	public function Do()
	{
		$this->fetch();
		$this->analysis();
		$this->downloadPic();
		//next
		$this->next();
	}

	private function fetch()
	{
		$this->resource = Libs::CurlGet($this->pageUrl);
	}

	private function analysis()
	{
		$this->imageUrls = call_user_func_array(self::$RegexContentFunc, [$this->resource]);
		$this->nextPages =  call_user_func_array(self::$RegexPageFunc, [$this->resource]);
	}

	private function downloadPic()
	{
		foreach ($this->imageUrls as $url) {
			$pic = Libs::CurlGet($url, $this->pageUrl);
			//context
			Context::$PicNumber++;
			$filename = sprintf("%s%s.jpg", Context::$PicDir, Context::$PicNumber);
			file_put_contents($filename, $pic);

			//check max size
			Context::$TotalSize += strlen($pic);
			Context::AssertNotExceedMaxFileSize();
		}
	}

	private function next()
	{
		foreach ($this->nextPages as $url) {
			$obj = new self($url);
			//树结构
			array_push($this->nextObjs, $obj);
			//执行
			$obj->Do();
		}
	}
}