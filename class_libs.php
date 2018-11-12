<?php
/**
 * date: 2018.11.09
 * createby: yusl
 * email: alwaysthanks@163.com
 */

class Libs
{
	//line output
	public static function Echos($str = '')
	{
		echo "$str\n";
	}
	//curl
	public static function CurlGet($url = '', $referer = '', $ua = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36')
	{
		//初始化
	    $curl = curl_init();
	    //设置抓取的url
	    curl_setopt($curl, CURLOPT_URL, $url);
	    if (!empty($referer)) {
	    	curl_setopt ($curl, CURLOPT_REFERER, $referer);
	    }
	    if (!empty($ua)) {
	    	curl_setopt($curl, CURLOPT_USERAGENT, $ua);
		}
		//rand ip
		curl_setopt($curl, CURLOPT_HTTPHEADER, [
			'X-FORWARDED-FOR:' . self::MakeRandIP(), 
			'CLIENT-IP:' . self::MakeRandIP()
		]);
	    //设置获取的信息以文件流的形式返回，而不是直接输出。
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
	    //执行命令
	    $data = curl_exec($curl);
	    //关闭URL请求
	    curl_close($curl);
	    //显示获得的数据
	    return $data;
	}

	//make rand IP
	public static function MakeRandIP()
	{
		//第一种方法，直接生成
	    $ip2id= round(rand(600000, 2550000) / 10000); 
	    $ip3id= round(rand(600000, 2550000) / 10000);
	    $ip4id= round(rand(600000, 2550000) / 10000);
	    //下面是第二种方法，在以下数据中随机抽取
	    $ip1bases = [
	    	"218","218","66","66","218","218","60","60",
	    	"202","204","66","66","66","59","61","60",
	    	"222","221","66","59","60","60","66","218",
	    	"218","62","63","64","66","66","122","211"
	    ];
	    $randarr = mt_rand(0,count($ip1bases)-1);
	    $ip1id = $ip1bases[$randarr];
	    return $ip1id.".".$ip2id.".".$ip3id.".".$ip4id;
	}

}