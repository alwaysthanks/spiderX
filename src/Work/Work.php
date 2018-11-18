<?php
/**
 * Created by spiderX.
 * @File: Work.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/15
 * @Time: 16:24
 */

namespace Spider\Work;

use Spider\Support\Config;

class Work
{
    protected static $config;
    protected static $output;

    public function __construct(array $config = [])
    {
        $config = array_merge($config, require __DIR__ . '/../../config/config.php');
        if(!self::$config) self::$config = new Config($config);
        if(!self::$output) self::$output = new Output($config);
    }


}