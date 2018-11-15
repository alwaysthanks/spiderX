<?php
/**
 * Created by spider.
 * @File: Output.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/12
 * @Time: 14:04
 */

namespace Spider\Work;


class Output
{
    protected static $info  = [
        'startTime' => '',
        'printSize' => 0,
        'number'    => 0,
        'path'      => '',
    ];

    public function __set($name, $value)
    {
        if(key_exists($name, self::$info))
        {
            self::$info[$name] = $value;
        }
    }

    public function __get($name)
    {
        if(key_exists($name, self::$info))
        {
            return self::$info[$name];
        }
    }

    public function __construct(array $info = [])
    {
        foreach (self::$info as $key => $item)
        {
            if(key_exists($key, $info))
            {
                self::$info[$key] = $info[$key];
            }
        }
        self::$info['startTime'] = time();
    }

    /**
     * line output
     **/
    public static function Echos($str = '')
    {
        if(PHP_SAPI == 'cli') {
            echo "$str" . PHP_EOL;
        } else {
            echo "$str <br/>";
        }
    }

    public function info()
    {
        self::format();
        self::Echos('-----------------====================----------------------');
        self::Echos("       开始运行时间： " . self::$info['startTime']);
        self::Echos("       目前已经运行了：" . self::$info['runTime']);
        self::Echos("       目前累计下载： ". self::$info['printSize'] ." 大小的资源  ");
        self::Echos("       目前下载资源个数：" . self::$info['number']);
        self::Echos("       下载资源目录为：" . self::$info['path']);
        self::Echos('-----------------====================----------------------');
    }

    private static function format()
    {
        if(self::$info['startTime'] || self::$info['startTime'] = time())
        {
            $time = time() - self::$info['startTime'];
            $s = $time;
            $m = intval($s / 60);
            $Run_h = intval($m / 60);
            $Run_m = $m - ($Run_h * 60);
            $Run_s = $s - ($m * 60);
            self::$info['startTime'] = date('Y-m-d H:i:s', self::$info['startTime']);
            self::$info['runTime'] = " $Run_h 小时, $Run_m 分钟, $Run_s 秒";
        }

        if(self::$info['printSize']) {
            $kb = intval(self::$info['printSize'] / (1<<10));
            $mb = intval(self::$info['printSize'] / (1<<20));
            $gb = intval(self::$info['printSize'] / (1<<30));
            self::$info['printSize'] = "{$gb}GB \ {$mb}MB \ {$kb}KB";
        } else {
            self::$info['printSize'] = '0KB';
        }
    }
}