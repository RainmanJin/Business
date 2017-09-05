<?php
//用户
switch($_GET['op']){
	case 'login':
	$Customer->Login();
	break;
	
	case 'logout':
	$Customer->Logout();
	break;
	
	case 'regist':
	$Customer->Regist();
	break;
	
	case 'password':
	$Customer->Password();
	break;
	
	case 'reset':
	$Customer->Reset();
	break;
	
	
	case 'modify':
	$Customer->Modify();
	break;
	
	case 'my_password':
	$Customer->My_password();
	break;
	
	case 'order_del':
	$Customer->Order_del();
	break;
	
	case 'favorate_del':
	$Customer->Favorate_del();
	break;

	default:
	break;
}
?>