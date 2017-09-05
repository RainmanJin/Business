<?php
//用户
class User{
	
	public function __construct($item=false){
		$this->item=$item;
		$this->rank_zh=array('master'=>'数据大师','kaggler'=>'竞赛先锋','novice'=>'初级能手');
	}
	
	//初始化用户
	public function Init(){
		session_start();
		if(isset($_COOKIE['id_user'])&&!isset($_SESSION['user'])){
			global $DB;
			$_SESSION['user']=$DB->Get_arr("select * from "._DB_PREFIX_."users where id_user='".$_COOKIE['id_user']."'");
		}
	}
	
####################
#注册登录
####################
	
	public function Login(){
		//登录
		global $DB;
		$user=$DB->Get_arr("select * from "._DB_PREFIX_."users where email='".trim($this->item['email'])."' or name_user='".trim($this->item['email'])."'");
		if(!$user){
			echo 1;
		}else{
			if($user['password']!=md5(trim($this->item['passwd']))){
				echo 2;
			}else{
				$_SESSION['user']=$user;
				
				if(isset($this->item['autologin'])){
					setcookie("id_user",$user['id_user'],time()+3600*24*30,"/");
				}
			}
		}
		
	}
	public function Logout(){
		//登出
		setcookie("id_user",0,time()-3600*24*30,"/");
		session_unset();
		session_destroy();
		echo '<script>window.location="'.COMPETITION_INDEX.'"</script>';
	}
	
	public function Regist(){
		global $DB;
		$name_user=$DB->Get_one("select name_user from "._DB_PREFIX_."users where name_user='".trim($this->item['UserName'])."'");
		//注册
		if(!$name_user){
			
			$email=$DB->Get_one("select email from "._DB_PREFIX_."users where email='".trim($this->item['Email'])."'");
			if(!$email){
				mysql_query("insert into "._DB_PREFIX_."users (email,  							name_user,  					display_name,  						legal_name, 			 password,  	regist_time) 
												 values ( '".trim($this->item['Email'])."',	'".trim($this->item['UserName'])."',	'".trim($this->item['DisplayName'])."',	 '".trim($this->item['LegalName'])."',			'".md5(trim($this->item['Password']))."',   '".date('Y-m-d H:i:s',time())."'	)");
				$_SESSION['user']=$DB->Get_arr("select * from "._DB_PREFIX_."users where id_user=".mysql_insert_id());
			}else{
				echo 2;
			}
		}else{
			echo 1;
		}
	}
	
	/*public function Password(){
		//找回密码
		if(strtolower($this->item['validate'])==strtolower($_SESSION["autonum"])){
			global $DB;
			$email=$DB->Get_one("select email from "._DB_PREFIX_."users where email='".trim($this->item['email'])."'");
			if(!$email){
				echo 2;
			}else{
				include_once(FILE_ROOT.'/classes/class_general.php');
				$General=new General();
				if($General->Mail_smtp($email,'龙信数据——重置密码','重置密码')==""){ 
					
				}else{
					
				}
			}
		}else{
			echo 1;
		}
	}*/
	
	//验证邮箱
	public function Validate_email(){
		if(strtolower($this->item['validate'])==strtolower($_SESSION["autonum"])){
			global $DB;
			$email=$DB->Get_one("select email from "._DB_PREFIX_."users where email='".trim($this->item['email'])."'");
			if(!$email){
				echo 2;
			}else{
				$_SESSION['validate']=md5(rand(0,10000));
				$title='数据竞赛——验证邮箱';
				$content='<a href="'.COMPETITION_INDEX.'/index.php?ajax=user&op=validate_email_ok&validate='.$_SESSION['validate'].'">点击验证</a>';
				
				include_once(FILE_ROOT.'/classes/class_general.php');
				$General=new General();
				if($General->Mail_smtp($email,$title,$content)==""){ 
				}else{
				}
			}
		}else{
			echo 1;
		}
	}
	//验证
	public function Validate_email_ok($get=false){
		if(isset($_SESSION['validate'])&&$get['validate']==$_SESSION['validate']){
			mysql_query('update '._DB_PREFIX_.'users set active=1 where id_user='.$_SESSION['user']['id_user']);
			$_SESSION['user']['active']=1;
			echo '<script>alert("您已成功验证！")</script>';
			/*echo '<script>window.location="'.COMPETITION_INDEX.'/index.php?view=competition_team&id_competition='.$get['id_competition'].'" </script>';*/
			echo '<script>window.close()</script>';
		}else{
			echo '<script>alert("验证失败，该链接已过期或您未用同一浏览器打开该链接！如是其他原因请联系管理员！")</script>';
			echo '<script>window.close()</script>';
		}
	}
	
####################
#我的专区
####################

	//用户详情
	public function User_detail($get){
		global $DB;
		
		if(isset($get['id_user'])){
			$user=$DB->Get_arr('select * from '._DB_PREFIX_.'users where id_user='.$get['id_user']);
		}else{
			$user=$_SESSION['user'];
		}
		
		//图片
		if(file_exists(FILE_ROOT.USER_IMG.$user['id_user'].'.jpg')){
			$user['image']=LINK_ROOT.USER_IMG.$user['id_user'].'.jpg';
		}else{
			$user['image']=LINK_ROOT.'/images/default.png';
		}
		
		//加入天数
		$user['togo']=DateLen($user['regist_time'],'history');
		
		//得分
		/*$user['score']=0;
		$scores=mysql_query('select score from '._DB_PREFIX_.'submissions where id_user='.$user['id_user']);
		while($score=mysql_fetch_row($scores)){
			$user['score']+=intval($score[0]);
		}
		
		//等级
		if($user['score']>50){
			if($user['score']>100){
				$user['rank']='master';
			}else{
				$user['rank']='kaggler';
			}
		}else{
			$user['rank']='novice';
		}*/
		
		//接受列表
		$user['result']=array();
		$results=mysql_query('select '._DB_PREFIX_.'competitions.id_competition,	'._DB_PREFIX_.'competitions.name_competition,	'._DB_PREFIX_.'competitions.end_time 
							 from '._DB_PREFIX_.'competitions,	'._DB_PREFIX_.'acceptions 
							 where '._DB_PREFIX_.'competitions.id_competition='._DB_PREFIX_.'acceptions.id_competition 
							 and '._DB_PREFIX_.'acceptions.id_user='.$user['id_user'].' order by end_time desc');
		while($result=mysql_fetch_assoc($results)){
			//图片
			if(file_exists(FILE_ROOT.COM_IMG.$result['id_competition'].'.jpg')){
				$result['image']=LINK_ROOT.COM_IMG.$result['id_competition'].'.jpg';
			}else{
				$result['image']=LINK_ROOT.'/images/num_10.jpg';
			}
			$result['my_entries']=$DB->Get_one('select count(*) from '._DB_PREFIX_.'submissions where id_competition='.$result['id_competition'].' and id_user='.$user['id_user']);
			$result['entries']=$DB->Get_one('select count(*) from '._DB_PREFIX_.'submissions where id_competition='.$result['id_competition']);
			$result['deadline']=DateLen($result['end_time'],'future');
			$user['result'][]=$result;
		}
		
		return $user;
	}
	
	//头像上传
	public function User_image($file=false){
		//验证扩展名
		$extension_arr=array('jpg','jpeg','png','gif');
		$filename_arr=pathinfo($file['Filedata']["name"]);
		if(!in_array($filename_arr['extension'],$extension_arr)){
			echo '扩展名不能为'.$filename_arr['extension'].'，应该为'.join(',',$extension_arr);
			exit;
		}
		//$file['Filedata']["name"]
		//$tmp_name=md5(rand(0,10000)).'.'.$filename_arr['extension'];
		//$filepath=FILE_ROOT.TMP_IMG.$file['Filedata']["name"];
		if(!file_exists(FILE_ROOT.TMP_IMG.'/'.$_SESSION['user']['id_user'].'/')){
			mkdir(FILE_ROOT.TMP_IMG.'/'.$_SESSION['user']['id_user'].'/');
			exec('export LANG=C; /usr/bin/sudo chmod 777 '.FILE_ROOT.TMP_IMG.'/'.$_SESSION['user']['id_user'].'/');
		}
		move_uploaded_file($file['Filedata']["tmp_name"],FILE_ROOT.TMP_IMG.'/'.$_SESSION['user']['id_user'].'/'.$file['Filedata']["name"]);
		echo LINK_ROOT.TMP_IMG.'/'.$_SESSION['user']['id_user'].'/'.$file['Filedata']["name"];
	}
	
	//编辑总览
	public function Profile_edit(){
		//图像裁剪
		$input=FILE_ROOT.TMP_IMG.$_SESSION['user']['id_user'].'/';
		$output=FILE_ROOT.USER_IMG;
		
		include_once(FILE_ROOT.'/classes/class_general.php');
		$General=new General();
		$General->ImageCrop($this->item['name_image'],$_SESSION['user']['id_user'],$input,$output,$this->item['x'],$this->item['y'],$this->item['w'],$this->item['h']);
		
		//修改总览
		mysql_query('update '._DB_PREFIX_.'users set bio="'.trim($this->item['bio']).'",skill="'.trim($this->item['skill']).'" where id_user='.$_SESSION['user']['id_user']);
		$_SESSION['user']['bio']=$this->item['bio'];
		$_SESSION['user']['skill']=$this->item['skill'];
	}
	//修改帐号
	public function Account_edit(){
		mysql_query('update '._DB_PREFIX_.'users set display_name="'.trim($this->item['display_name']).'",legal_name="'.trim($this->item['legal_name']).'" where id_user='.$_SESSION['user']['id_user']);
		$_SESSION['user']['display_name']=$this->item['display_name'];
		$_SESSION['user']['legal_name']=$this->item['legal_name'];
	}
	//修改密码
	public function Password_edit(){
		mysql_query('update '._DB_PREFIX_.'users set password="'.md5(trim($this->item['passwd'])).'" where id_user='.$_SESSION['user']['id_user']);
		$_SESSION['user']['password']=$this->item['passwd'];
	}
	
	
	
#########
#后台管理
#########

	//用户列表
	public function User_manage($get=false){
		global $DB;
		//搜索
		$sql='select * from '._DB_PREFIX_.'users where id_user!=0';
		if(isset($get['kw'])){
			$sql.=' and (display_name like "%'.trim($get['kw']).'%" or team like "%'.trim($get['kw']).'%" ) ';
		}
		//数据库排序
		if(isset($get['st'])){
			$od=explode('_',$get['st'])[0];
			$by=explode('_',$get['st'])[1];
			switch($od){
				case 'id':
				$od='id_user';
				break;
				
				case 'name':
				$od='display_name';
				break;
				
				case 'team':
				$od='team';
				break;
				
				case 'pts':
				$od='pts';
				break;
				
				case 'rank':
				$od='rank';
				break;
				
				case 'active':
				$od='active';
				break;
				
				case 'time':
				$od='regist_time';
				break;
				
				default:
				$od='array';
				break;
			}
			if($od!='array'){
				$sql.=' order by '.$od.' '.$by;
			}
		}else{
			$sql.=' order by id_user asc';
		}
		//$sort_sub=array();
		
		//用户列表
		$user_list=array();
		$users=mysql_query($sql);
		while($user=mysql_fetch_array($users)){
			if(isset($get['kw'])){
				$user['display_name']=str_replace(trim($get['kw']),'<font color=red>'.trim($get['kw']).'</font>',$user['display_name']);
				$user['team']=str_replace(trim($get['kw']),'<font color=red>'.trim($get['kw']).'</font>',$user['team']);
			}
			if($user['is_leader']==1){
				$user['team'].='（领袖）';
			}
			if(file_exists(FILE_ROOT.USER_IMG.$user['id_user'].'.jpg')){
				$user['image']=LINK_ROOT.USER_IMG.$user['id_user'].'.jpg';
			}else{
				$user['image']=LINK_ROOT.'/images/default.png';
			}
			$user['rank']=$this->rank_zh[$user['rank']];
			$user['sub']=0;//$DB->Get_one('select count(distinct id_competition) from '._DB_PREFIX_.'submissions where id_user='.$user['id_user']);
			//$sort_sub[]=$user['sub'];
			
			if(isset($get['cl'])){
				$isin_complete=$DB->Get_one('select id_competition from '._DB_PREFIX_.'submissions where id_competition='.$get['cl'].' and  id_user='.$user['id_user']);
				if($isin_complete){
					$user_list[]=$user;
				}
			}else{
				$user_list[]=$user;
			}
			
			
		}
		
		//数组排序
		/*if(isset($get['st'])){
			$od=explode('_',$get['st'])[0];
			$by=explode('_',$get['st'])[1];
			switch($od){
				case 'sub':
				if($by=='desc'){
					array_multisort($sort_sub,SORT_DESC,SORT_NUMERIC,$user_list);
				}else{
					array_multisort($sort_sub,SORT_ASC,SORT_NUMERIC,$user_list);
				}
				break;
				
				default:
				break;
			}
		}*/
		return $user_list;
	}
	//手动/自动
	public function Manual(){
		mysql_query('update '._DB_PREFIX_.'users set m_'.$this->item['type'].'='.$this->item['m'].' where id_user='.$this->item['id_user']);
	}
	//保存
	public function Save(){
		mysql_query('update '._DB_PREFIX_.'users set '.$this->item['type'].'="'.$this->item['val'].'"	,m_'.$this->item['type'].'=1 where id_user='.$this->item['id_user']);
	}
	//清算
	public function Pts_rank(){
		global $DB;
		$user_arr=explode(',',$this->item['user_list']);
		//$pts_arr=array();//调试用
		
		foreach($user_arr as $id_user){
			$user=$DB->Get_arr('select * from '._DB_PREFIX_.'users where id_user='.$id_user);
			
			$percent10=0;//排名前百分之十的次数
			$place10=0;//排名前十的次数
			
			//积分
			$pts=0;
			
			$members=1;
			$use_id=$id_user;
			if($user['team']){
				$members=$DB->Get_one('select count(*) from '._DB_PREFIX_.'users where team="'.$user['team'].'"');
				if($user['is_leader']==0){
					$use_id=$DB->Get_one('select id_user from '._DB_PREFIX_.'users where is_leader=1 and team="'.$user['team'].'"');//如果不是团队领袖则用团队领袖的积分和等级
				}
			}
			
			//$pts_arr['members']=$members;
			//$pts_arr['com']=array();
			$competitions=mysql_query('select distinct id_competition from '._DB_PREFIX_.'submissions where id_user='.$use_id);
			while($competition=mysql_fetch_row($competitions)){
				$place=0;
				$teams=0;
				$history=0;
				
				//获得当前排名
				$subuser_list=array();
				$subusers=mysql_query('select id_user from '._DB_PREFIX_.'submissions where id_competition='.$competition[0].' order by score desc');
				while($subuser=mysql_fetch_assoc($subusers)){
					$subuser_list[]=$subuser['id_user'];
				}
				$subuser_list=array_unique($subuser_list);
				foreach($subuser_list as $key=>$subuser_id){
					if($subuser_id==$use_id){
						$place=$key+1;
					}
				}
				if($place){
					$teams=count($subuser_list);
					$com_set=$DB->Get_arr('select is_pts,is_rank,end_time from '._DB_PREFIX_.'competitions where id_competition='.$competition[0]);
					$deadline=DateLen($com_set['end_time'],'future');
					//该竞赛已结束且设置为可积分
					if($deadline<=0&&$com_set['is_pts']==1){
						$history=abs($deadline);
						$pts+=round((100000/$members)*pow($place,-0.75)*log10($teams)*((365*2-$history)/(365*2)),0);
					}
					//$com=array();
					//$com['place']=$place;
					//$com['teams']=$teams;
					//$com['history']=$history;
					//$pts_arr['com'][]=$com;
					
					//该竞赛设置为可评级
					if($com_set['is_rank']==1){
						if($teams<10){
							$teams10=ceil($teams/10);
						}else{
							$teams10=floor($teams/10);
						}
						if($place<=$teams10){
							$percent10++;
						}
						if($place<=10){
							$place10++;
						}
					}
				}
			}
			//非手动
			if($user['m_pts']!=1){
				mysql_query('update '._DB_PREFIX_.'users set pts='.$pts.' where id_user='.$id_user);
			}
			//print_r($pts_arr);
			
			
			//等级
			if($user['m_rank']!=1){
				$rank='novice';
				if($pts>0){
					$rank='kaggler';
					if($percent10>=2&&$place10>=1){
						$rank='master';
					}
				}
				mysql_query('update '._DB_PREFIX_.'users set rank="'.$rank.'" where id_user='.$id_user);
			}
		}
	}
	//自动完成列表
	/*public function AutoComplete(){
		$name_list=array();
		$name_competitions=mysql_query('select name_competition from '._DB_PREFIX_.'competitions where end_time<"'.date('Y-m-d H:i:s',time()).'" ');
		while($name_competition=mysql_fetch_row($name_competitions)){
			$name_list[]=$name_competition[0];
		}
		echo json_encode($name_list);
	}*/
	//结束竞赛列表
	public function Complete_list(){
		$complete_list=array();
		$completes=mysql_query('select id_competition,name_competition from '._DB_PREFIX_.'competitions where end_time<"'.date('Y-m-d H:i:s',time()).'" ');
		while($complete=mysql_fetch_assoc($completes)){
			$complete_list[]=$complete;
		}
		return $complete_list;
	}
	
	//总排行榜
	public function Leaderboard($get){
		//global $DB;
		$user_num=0;
		$leaderboard=array();
		$leaderboards=mysql_query('select id_user,display_name,pts from '._DB_PREFIX_.'users order by pts desc');
		while($user=mysql_fetch_assoc($leaderboards)){
			$user_num++;
			$user['place']=$user_num;
			//图片
			if(file_exists(FILE_ROOT.USER_IMG.$user['id_user'].'.jpg')){
				$user['image']=LINK_ROOT.USER_IMG.$user['id_user'].'.jpg';
			}else{
				$user['image']=LINK_ROOT.'/images/default.png';
			}
			//$user['submission']=$DB->Get_one('select count(distinct id_competition) from '._DB_PREFIX_.'submissions where id_user='.$user['id_user']);
			$leaderboard[]=$user;
		}
		
		//分页
		/*require_once(FILE_ROOT.'/classes/class_page.php');
		if(isset($get['pg'])){
			$page=$get['pg'];
		}else{
			$page=1;
		}
		$Page=new Page($user_num,$page,5,'index.php');//新建分页类
		$kaishi=$Page->Page_limit();//加分页limit*/
		$page_bottom='';//$Page->Page_bottom();//获取分页底部	
		//$leaderboard=array_slice($leaderboard,$kaishi,5);
		
		$all=array($page_bottom,$leaderboard);
		return $all;
	}
}
?>