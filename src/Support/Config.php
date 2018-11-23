<?php
/**
 * Created by spider.
 * @File: Config.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/13
 * @Time: 11:53
 */
namespace Spider\Support;


class Config extends Arr
{
    public function __construct(array $config = [])
    {
        $this->arr = $config;
    }

}