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

//(new Content())->getUrlContent('https://hui.1222.store/2018/05/20/%E6%90%AD%E5%BB%BA%E5%8D%9A%E5%AE%A2%E8%AE%B0%E5%BD%95/', new DemoParse());

//(new Spider\Work\Worker())->process('http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKtCIuExiaazcy6rpsNbdDjwxmPxNFFYfrZDtTrrSudwMkAPDQaia3jYFctYFrc9VgEKH4xx6oR1upg/132', [], new DemoParse());
(new Spider\Work\spider())->process('https://hui.1222.store/2018/05/20/%E6%90%AD%E5%BB%BA%E5%8D%9A%E5%AE%A2%E8%AE%B0%E5%BD%95/', new DemoParse());
//(new Spider\Work\Worker())->process('http://qeesuu.com/Public/Home/video/demo_quiet.mp4', [], new DemoParse());