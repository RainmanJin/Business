<?php
//用户
class User{
	
	public function __construct($item=false){
		$this->item=$item;
	}
	
	public function Init(){
		//初始化用户
		session_start();
		if(isset($_COOKIE['id_user'])){
			//global $DB;
			//$_SESSION['user']=$DB->Get_arr("select * from "._DB_PREFIX_."users where id_user='".$_COOKIE['id_user']."'");
		}
	}
	
	
	public function Logout(){
		//登出
		setcookie("id_user",0,time()-3600*24*30,"/");
		session_unset();
		session_destroy();
		//header('location:'.MARKET_INDEX);
		echo '<script>window.location="'.DATATOOL_INDEX.'"</script>';
	}
	
	
}
?>