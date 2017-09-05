<?php
define('FILE_ROOT',dirname(__FILE__));

//基本配置
require_once(FILE_ROOT.'/config.php');

//数据库
require_once(FILE_ROOT.'/settings.inc.php');
require_once(FILE_ROOT.'/classes/class_db.php');
$DB=new DB();
$DB->Connect();

//初始化用户
require_once(FILE_ROOT.'/classes/class_user.php');
$User=new User($_POST);
$User->Init();

//HTTP请求路由
if(isset($_GET['ajax'])){
	include(FILE_ROOT.'/controllers/ajax_'.$_GET['ajax'].'.php');
}elseif(isset($_GET['view'])){
	switch($_GET['site']){
		case'market':
		$index_url=MARKET_INDEX;
		break;
		
		case'competition':
		$index_url=COMPETITION_INDEX;
		break;
		
		case 'datatool':
		$index_url=DATATOOL_INDEX;
		break;
		
		default:
		break;
	}
	include(FILE_ROOT.'/views/view_'.$_GET['view'].'.php');
}else{
	echo '缺少参数';
}
?>