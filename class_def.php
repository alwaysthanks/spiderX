<?php
/**
 * date: 2018.11.09
 * createby: yusl
 * email: alwaysthanks@163.com
 */
require_once __DIR__ . '/class_context.php';

class Def
{
	/**
	@return array
	valid resouce
	[
		'domain' . 'url',
		'domain' . 'url',
		...
	]
	*/
	public static function EntranceContent($resource)
	{
		$pattern = '/<dd><a target="_blank" href="(.*)">.*img.*<\/a><\/dd>/iUs';
		preg_match_all($pattern, $resource, $matches);
		if (empty($matches) || empty($matches[0])) {
			return [];
		}
		return $matches[1];
	}

	/**
	@return array
	//next page
	//sigle but use array
	[
		'domain' . 'url',
		'domain' . 'url',
		...
	]
	*/
	public static function EntrancePage($resource)
	{
		$conv = iconv('GBK','UTF-8',$resource);		
		$pattern = '/<dd class="page">(.*)<\/dd>/iUs';
		preg_match_all($pattern, $conv, $matches);
		if (empty($matches) || empty($matches[0])) {
			return [];
		}
		//匹配
		$pattern = '/<a href=["\'](list[0-9_]*\.html)["\'] class="page-en">下一页<\/a>/iUs';
		preg_match_all($pattern, $matches[1][0], $get);
		if (empty($get) || empty($get[0])) {
			return [];
		}
		return array_map(function($o) {
			return Context::$Domain . $o;
		}, $get[1]);
	}

	/**
	@return array
	*/
	public static function CContent($resource)
	{
		$pattern = '/<div class="content-pic">.*<img.*src=[\'"](.*)[\'"].*\/><\/a><\/div>/iUs';
		preg_match_all($pattern, $resource, $matches);
		if (empty($matches) || empty($matches[0])) {
			return [];
		}
		return $matches[1];
	}

	/**
	@return array
	*/
	public static function CPage($resource)
	{
		$conv = iconv('GBK','UTF-8',$resource);
		$pattern = '/<div class="content-page">(.*)<\/div>/iUs';
		preg_match_all($pattern, $conv, $matches);
		if (empty($matches) || empty($matches[0])) {
			return [];
		}
		//匹配
		$pattern = '/<a href=["\']([0-9_]*\.html)["\'] class="page-(en|ch)">下一页<\/a>/iUs';
		preg_match_all($pattern, $matches[1][0], $get);
		if (empty($get) || empty($get[0])) {
			return [];
		}
		return array_map(function($o) {
			return Context::$Domain . $o;
		}, $get[1]);
	}
}
