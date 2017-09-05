<?php
//用户

switch($_GET['op']){
	
	
	case 'logout':
	$User->Logout();
	break;
	

	default:
	break;
}

?>