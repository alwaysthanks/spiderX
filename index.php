<?php
/**
 * Created by spider.
 * @File: index.php
 * @User: Hui
 * @Author: learner.hui@gmail.com
 * @Date: 2018/11/12
 * @Time: 14:12
 */

require './vendor/autoload.php';

use Spider\Work\Content;
use Spider\DemoParse;

//(new Spider\Work\spider('https://hui.1222.store/2018/05/20/%E6%90%AD%E5%BB%BA%E5%8D%9A%E5%AE%A2%E8%AE%B0%E5%BD%95/'))->start();
(new Spider\Work\spider())->start('https://hui.1222.store/2018/05/20/%E6%90%AD%E5%BB%BA%E5%8D%9A%E5%AE%A2%E8%AE%B0%E5%BD%95/');