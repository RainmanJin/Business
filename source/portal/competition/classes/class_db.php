<?php
//数据库
class DB{
	
	
	
	public function Connect(){
		mysql_connect(_DB_SERVER_,_DB_USER_,_DB_PASSWD_);
		mysql_select_db(_DB_NAME_);
		mysql_query('set names utf8');
	}
	
	public function Get_arr($sql,$is_num=false){
		$result=mysql_query($sql);
		if($is_num){
			$db_arr=mysql_fetch_array($result,$is_num);
		}else{
			$db_arr=mysql_fetch_array($result,MYSQL_ASSOC);
		}
		return $db_arr;
	}
	
	public function Get_one($sql){
		$result=mysql_query($sql);
		$result=mysql_fetch_row($result);
		return $result[0];
	}
}
?>