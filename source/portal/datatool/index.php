<?php
define('FILE_ROOT',dirname(__FILE__));

//基本配置
require_once(FILE_ROOT.'/php/config.php');
/*
//数据库
require_once(FILE_ROOT.'/settings.inc.php');
require_once(FILE_ROOT.'/classes/class_db.php');
$DB=new DB();
$DB->Connect();*/

//初始化用户
require_once(FILE_ROOT.'/php/classes/class_user.php');
$User=new User($_POST);
$User->Init();


//HTTP请求路由
if(isset($_GET['ajax'])){
	include(FILE_ROOT.'/php/controllers/ajax_'.$_GET['ajax'].'.php');
}elseif(isset($_GET['view'])){
	include(FILE_ROOT.'/php/views/view_'.$_GET['view'].'.php');
}else{
	include(FILE_ROOT.'/php/views/view_index.php');
}
?>
