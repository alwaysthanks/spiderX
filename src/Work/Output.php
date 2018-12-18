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


use Spider\Support\Arr;

class Output extends Arr
{
    protected $arr = [
        'startTime' => '',
        'printSize' => 0,
        'number'    => 0,
        'path'      => '',
    ];

    public function __construct(array $info = [])
    {
        foreach ($this->arr as $key => $item)
        {
            if(key_exists($key, $info))
            {
                $this[$key] = $info[$key];
            }
        }
        $this['startTime'] = time();
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
        $this->format();
        self::Echos('-----------------====================----------------------');
        self::Echos("       开始运行时间： " . $this['startTime']);
        self::Echos("       目前已经运行了：" . $this['runTime']);
        self::Echos("       目前累计下载： ". $this['printSize'] ." 大小的资源  ");
        self::Echos("       目前下载资源个数：" . $this['number']);
        self::Echos("       下载资源目录为：" . $this['path']);
        self::Echos('-----------------====================----------------------');
    }

    private function format()
    {
        if($this['startTime'] || $this['startTime'] = time())
        {
            $time = time() - $this['startTime'];
            $s = $time;
            $m = intval($s / 60);
            $Run_h = intval($m / 60);
            $Run_m = $m - ($Run_h * 60);
            $Run_s = $s - ($m * 60);
            $this['startTime'] = date('Y-m-d H:i:s', $this['startTime']);
            $this['runTime'] = " $Run_h 小时, $Run_m 分钟, $Run_s 秒";
        }

        if($this['printSize']) {
            $kb = intval($this['printSize'] / (1<<10));
            $mb = intval($this['printSize'] / (1<<20));
            $gb = intval($this['printSize'] / (1<<30));
            $this['printSize'] = "{$gb}GB \ {$mb}MB \ {$kb}KB";
        } else {
            $this['printSize'] = '0KB';
        }
    }
}