<?php
//产品
require_once(FILE_ROOT.'/classes/class_product.php');
$Product=new Product($_POST);

switch($_GET['op']){
	case 'comment':
	$Product->Comment_send();
	break;
	
	case 'favorate':
	$Product->Favorite();
	break;
	
	default:
	break;
}
?>