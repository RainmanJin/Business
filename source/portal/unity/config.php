<?php 
//路径
define('LINK_ROOT','http://'.str_replace($_SERVER['DOCUMENT_ROOT'],$_SERVER['HTTP_HOST'],FILE_ROOT));

define('CLOUD_INDEX','http://'.$_SERVER['HTTP_HOST'].'/cloud');
define('MARKET_INDEX','http://'.$_SERVER['HTTP_HOST'].'/market');
define('COMMUNITY_INDEX','http://'.$_SERVER['HTTP_HOST'].'/community');
define('COMPETITION_INDEX','http://'.$_SERVER['HTTP_HOST'].'/competition');
define('DATATOOL_INDEX','http://'.$_SERVER['HTTP_HOST'].'/datatool');
define('UNITY_INDEX','http://'.$_SERVER['HTTP_HOST'].'/unity');

//时区
date_default_timezone_set("Asia/Shanghai");

//页面编码
header("Content-Type:text/html;charset=utf-8");
?>