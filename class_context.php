<?php
/**
 * date: 2018.11.09
 * createby: yusl
 * email: alwaysthanks@163.com
 */

require_once __DIR__ . '/class_libs.php';

//global info manage
class Context
{
	public static $Domain = '';
	public static $StartTime = 0;
	public static $PicNumber = 0;
	public static $TotalSize = 0;
	public static $MaxSize = 0;

	public static $PicDir = '';

	public static function PrintInfo()
	{
		//第..个
		//共..个
		//内存占用
		//运行时长
		Libs::Echos('-----------------====================----------------------');
		$run = date('Y-m-d H:i:s', self::$StartTime); 
		Libs::Echos("           开始运行时间： $run          ");
		list($h, $m, $s) = self::runTime();
		Libs::Echos("           目前已经运行了： $h 小时 $m 分钟 $s 秒          ");
		list($gb, $mb, $kb) = self::printSize();
		Libs::Echos("           目前累计下载： {$gb}GB \ {$mb}MB \ {$kb}KB 的资源  ");
		$num = self::$PicNumber;
		Libs::Echos("           目前下载资源个数： {$num}  ");
		$dir = self::$PicDir;
		Libs::Echos("           下载资源目录为： {$dir}  ");

		Libs::Echos('-----------------====================----------------------');

	}

	private static function printSize()
	{
		$kb = intval(self::$TotalSize / (1<<10));
		$mb = intval(self::$TotalSize / (1<<20));
		$gb = intval(self::$TotalSize / (1<<30));
		return [$gb, $mb, $kb];
		//KB
		//MB
		//GB
	}

	private static function runTime()
	{
		$time = time() - self::$StartTime;
		$s = $time;
		$m = intval($s/60);
		$h = intval($m/60);
		return [$h, $m-($h*60), $s-($m*60)];
		//s
		//min
		//hour
	}

	public static function AssertNotExceedMaxFileSize()
	{
		if (self::$TotalSize > self::$MaxSize) {
			throw new Exception("exceed max context limit size");
		}
	}

}