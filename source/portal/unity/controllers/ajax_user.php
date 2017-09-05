<?php
//用户

switch($_GET['op']){
	
	case 'login':
	$User->Login();
	break;
	
	case 'logout':
	$User->Logout();
	break;
	
	case 'regist':
	$User->Regist();
	break;
	
	
	case 'password':
	$User->Password();
	break;
	
	case 'reset':
	$User->Reset();
	break;
	
	case 'password_modify':
	$User->Password_modify();
	break;
	
	case 'user_del':
	$User->User_del($_GET);
	break;
	
	
	default:
	break;
}

?>