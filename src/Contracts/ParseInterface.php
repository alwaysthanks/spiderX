<?php
/**
 * Created by spider.
 * @File: ParseInterface.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/12
 * @Time: 14:26
 */

namespace Spider\Contracts;

interface ParseInterface
{
    public static function parseContent(ContentInterface $content);
}