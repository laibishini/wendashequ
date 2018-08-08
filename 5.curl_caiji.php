<?php
//1. 先采集知乎的内容
require_once 'HttpRequest.class.php';

$http = new HttpRequest();
$http -> url = 'https://www.zhihu.com/search?type=content&q=java';

$result = $http -> send();

//2. 开始过滤（使用筛子正则表达式）

//$reg = '/<a.+?class="js-title-link">(.+?)<\/a>.+?<script.+?class="content">(.+?)<\/script>/su';
//preg_match_all($reg, $result,$match2);
//
//echo '<pre>';
//var_dump($match2[1]);   //标题部分：9个
//var_dump($match2[2]);   //内容部分：9个

var_dump($result);

//把问题标题、回复的内容，保存到我们的数据库