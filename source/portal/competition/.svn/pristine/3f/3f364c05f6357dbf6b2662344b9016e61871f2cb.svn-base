<?php 
/*echo dirname(__FILE__);//文件目录
echo '<br>';
echo $_SERVER['REQUEST_URI'];//当前url（不包括IP）
echo '<br>';
echo $_SERVER['DOCUMENT_ROOT'];//网站目录
echo '<br>';
echo $_SERVER['HTTP_HOST'];//当前IP（只有IP）
echo '<br>';*/
//exit;

//路径
define('MARKET_ROOT',$_SERVER['DOCUMENT_ROOT'].'/market');
define('LINK_ROOT','http://'.str_replace($_SERVER['DOCUMENT_ROOT'],$_SERVER['HTTP_HOST'],FILE_ROOT));

define('CLOUD_INDEX','http://'.$_SERVER['HTTP_HOST'].'/cloud');
define('MARKET_INDEX','http://'.$_SERVER['HTTP_HOST'].'/market');
define('COMMUNITY_INDEX','http://'.$_SERVER['HTTP_HOST'].'/community');
define('COMPETITION_INDEX','http://'.$_SERVER['HTTP_HOST'].'/competition');
define('DATATOOL_INDEX','http://'.$_SERVER['HTTP_HOST'].'/datatool');
define('UNITY_INDEX','http://'.$_SERVER['HTTP_HOST'].'/unity');

define('COM_IMG','/images/competition/');
define('USER_IMG','/images/user/');
define('TMP_IMG','/images/tmp/');

define('COM_DATA','/data/competition/');
define('USER_DATA','/data/user/');
define('TMP_DATA','/data/tmp/');

//关键字默认显示
define('KEYWORD_DEFAULT','请输入关键字');

//每页记录数
define('PAGESIZE',4);

//时区
date_default_timezone_set("Asia/Shanghai");

//页面编码
header("Content-Type:text/html;charset=utf-8");
?>