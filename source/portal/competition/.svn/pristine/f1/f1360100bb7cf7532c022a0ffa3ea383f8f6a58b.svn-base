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
	
	/*case 'password':
	$User->Password();
	break;*/
	
	case 'validate_email':
	$User->Validate_email();
	break;
	
	case 'validate_email_ok':
	$User->Validate_email_ok($_GET);
	break;
	

#########
#用户专区
#########
	case 'user_image':
	$User->User_image($_FILES);
	break;
	
	case 'profile_edit':
	$User->Profile_edit();
	break;
	
	case 'account_edit':
	$User->Account_edit();
	break;
	
	case 'password_edit':
	$User->Password_edit();
	break;

########
#后台用户管理
########
	case 'manual':
	$User->Manual();
	break;
	
	case 'save':
	$User->Save();
	break;
	
	case 'pts_rank':
	$User->Pts_rank();
	break;
	
	case 'autocomplete':
	$User->AutoComplete();
	break;
	
	
	default:
	break;
}
?>