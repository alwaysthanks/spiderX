<?php
/**
 * date: 2018.11.09
 * createby: yusl
 * email: alwaysthanks@163.com
 */

require_once __DIR__ . '/class_context.php';
require_once __DIR__ . '/class_content.php';
require_once __DIR__ . '/class_def.php';
require_once __DIR__ . '/class_libs.php';


class Entrance
{
	//正则函数
	public static $RegexPageFunc = null;
	public static $RegexContentFunc = null;

	//页面采集个数
	private static $depth = 0;
	//每个页面对象
	private static $objectPool = [];

	private $pageUrl = "";
	private $resource = "";
	private $contentInfos = [];
	private $nextPages = [];

	public function __construct($pageUrl)
	{
		$this->pageUrl = $pageUrl;
	}

	public static function Init($depth = -1)
	{
		self::$depth = $depth;
		Libs::Echos(sprintf("init depth %d.", self::$depth));
	}

	public static function Do($url = '')
	{
		$obj = new self($url);
		$obj->fetch();
		$obj->analysis();
		$obj->chain();
		//incr
		$obj->incr();
		//valid
		if (!$obj->isValid()) {
			throw new Exception("exceed limit " . self::$depth);
		}
		$obj->next();
	}

	//fetch page
	private function fetch()
	{
		$this->resource = Libs::CurlGet($this->pageUrl);
	}

	//analysis rule
	private function analysis()
	{
		$this->contentInfos = call_user_func_array(self::$RegexContentFunc, [$this->resource]);
		$this->nextPages = call_user_func_array(self::$RegexPageFunc, [$this->resource]);
	}

	//next child page
	private function chain()
	{
		foreach ($this->contentInfos as $url) {
			$obj = new Content($url);
			$obj->Do();
		}
	}

	//incr
	private function incr()
	{
		array_push(self::$objectPool, $this);
		Libs::Echos(sprintf("total depth [%d], complete [%d] fetch.", self::$depth, count(self::$objectPool)));
		//output
		Context::PrintInfo();
	}

	//is valid
	private function isValid()
	{
		if (self::$depth > 0 && count(self::$objectPool) > self::$depth) {
			return false;
		}
		return true;
	}

	//next
	private function next()
	{
		foreach ($this->nextPages as $url) {
			self::Do($url);
		}
	}
	
}
