<?php
//获取时间段
function DateLen($ymdhis,$type){
	if($type=='future'){
		$stamp=strtotime($ymdhis)-time();
	}else{
		$stamp=time()-strtotime($ymdhis);
	}
	return ceil($stamp/60/60/24);
}
?>