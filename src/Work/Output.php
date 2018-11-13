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
        'StartTime' => '',
        'PrintSize' => 0,
        'Number'    => 0,
        'DownDir'   => '',
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
        foreach (self::$info as $item)
        {
            if(key_exists($item, $info))
            {
                self::$info[$item] = $info[$item];
            }
        }
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
        self::Echos("       开始运行时间： " . self::$info['StartTime']);
        self::Echos("       目前已经运行了：" . self::$info['RunTime']);
        self::Echos("       目前累计下载： ". self::$info['PrintSize'] ." 大小的资源  ");
        self::Echos("       目前下载资源个数：" . self::$info['Number']);
        self::Echos("       下载资源目录为：" . self::$info['DownDir']);
        self::Echos('-----------------====================----------------------');
    }

    private static function format()
    {
        if(self::$info['StartTime'] || self::$info['StartTime'] = time())
        {
            $time = time() - self::$info['StartTime'];
            $s = $time;
            $m = intval($s / 60);
            $Run_h = intval($m / 60);
            $Run_m = $m - ($Run_h * 60);
            $Run_s = $s - ($m * 60);
            self::$info['StartTime'] = date('Y-m-d H:i:s', self::$info['StartTime']);
            self::$info['RunTime'] = " $Run_h 小时, $Run_m 分钟, $Run_s 秒";
        }

        if(self::$info['PrintSize']) {
            $kb = intval(self::$info['PrintSize'] / (1<<10));
            $mb = intval(self::$info['PrintSize'] / (1<<20));
            $gb = intval(self::$info['PrintSize'] / (1<<30));
            self::$info['PrintSize'] = "{$gb}GB \ {$mb}MB \ {$kb}KB";
        } else {
            self::$info['PrintSize'] = '0KB';
        }

        if(!self::$info['DownDir']) self::$info['DownDir'] = './images/';
    }
}