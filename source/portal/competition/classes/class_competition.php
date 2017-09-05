<?php
class Competition{
	
	public function __construct($item=false){
		$this->item=$item;
		$this->type_zh=array('featured'=>'特别','research'=>'研究','playground'=>'操场','getting-started'=>'开始','ge'=>'通用','masters'=>'大师','recruitment'=>'补充');
	}
	
####################
#主页
####################
	
	//竞赛列表
	public function Index_result(){
		global $DB;
		//进行中的分类数组初始化
		$active_list=array('featured'=>array('cn'=>$this->type_zh['featured'],'competition'=>array()),
						   'research'=>array('cn'=>$this->type_zh['research'],'competition'=>array()),
						   'playground'=>array('cn'=>$this->type_zh['playground'],'competition'=>array()),
						   'getting-started'=>array('cn'=>$this->type_zh['getting-started'],'competition'=>array()),
						   'ge'=>array('cn'=>$this->type_zh['ge'],'competition'=>array()),
						   'masters'=>array('cn'=>$this->type_zh['masters'],'competition'=>array()),
						   'recruitment'=>array('cn'=>$this->type_zh['recruitment'],'competition'=>array()));
		
		//默认排序
		$sort_reward=array();
		
		//获取竞赛
		$active_num=0;
		$competitions_list=array();
		$competitions_arr=mysql_query('select * from '._DB_PREFIX_.'competitions');
		while($competition_arr=mysql_fetch_assoc($competitions_arr)){
			//图片
			if(file_exists(FILE_ROOT.COM_IMG.$competition_arr['id_competition'].'.jpg')){
				$competition_arr['image']=LINK_ROOT.COM_IMG.$competition_arr['id_competition'].'.jpg';
			}else{
				$competition_arr['image']=LINK_ROOT.'/images/num_10.jpg';
			}
			
			//到期时间
			$deadline=DateLen($competition_arr['end_time'],'future');
			if($deadline>0){
				$active_num++;
				$competition_arr['deadline']=$deadline.'天';
			}else{
				$competition_arr['deadline']='已到期';
			}
			
			//报酬类型
			if($competition_arr['prize_1']==0){
				$reward=0;
				if($competition_arr['enterable']==1){
					$competition_arr['reward']='知识';
				}else{
					$competition_arr['reward']='保护';
				}
			}else{
				$reward=$competition_arr['prize_1']+$competition_arr['prize_2']+$competition_arr['prize_3'];
				$competition_arr['reward']='￥'.$reward;
				
			}
			if($deadline>0){
				$sort_reward[]=$reward;
			}
			
			//团队
			$competition_arr['teams']=$DB->Get_one('select count(distinct id_user) from '._DB_PREFIX_.'submissions where id_competition='.$competition_arr['id_competition']);
			
			//活动的
			if(isset($active_list[$competition_arr['type']])&&$deadline>0){
				$active_list[$competition_arr['type']]['competition'][]=$competition_arr;
			}
			//所有的（默认进行中的）
			if($deadline>0){
				$competitions_list[]=$competition_arr;
			}
		}
		array_multisort($sort_reward,SORT_DESC,SORT_NUMERIC,$competitions_list);//按报酬默认排序
		$index_result=array('active_list'=>$active_list,'competitions_list'=>$competitions_list,'active_num'=>$active_num,'competitions_num'=>count($competitions_list));
		return $index_result;
	}
	
	//过滤
	public function All(){
		global $DB;
		
		//搜索过滤名称排序
		$sql='select * from '._DB_PREFIX_.'competitions where id_competition!=0';
		if($this->item['Query']){
			$sql.=' and (name_competition like "%'.$this->item['Query'].'%" or introduce like  "%'.$this->item['Query'].'%") ';
		}
		if($this->item['SearchVisibility']=='EnterableCompetitions'){
			$sql.=' and enterable=1';
		}
		if(isset($this->item['ShowInclass'])){
			$sql.=' and in_class=1';
		}
		if(isset($this->item['name_competition'])){
			$sql.=' order by name_competition '.$this->item['name_competition'];
		}
		
		//其他排序
		$sort_reward=array();
		$sort_teams=array();
		$sort_deadline=array();
		
		//获取竞赛
		$active_num=0;
		$competitions_list=array();
		$competitions_arr=mysql_query($sql);
		while($competition_arr=mysql_fetch_assoc($competitions_arr)){
			//名称搜索高亮
			$competition_arr['name_competition']=str_replace($this->item['Query'],'<font color=red>'.$this->item['Query'].'</font>',$competition_arr['name_competition']);
			//描述搜索高亮
			$competition_arr['introduce']=str_replace($this->item['Query'],'<font color=red>'.$this->item['Query'].'</font>',$competition_arr['introduce']);
			
			//图片
			if(file_exists(FILE_ROOT.COM_IMG.$competition_arr['id_competition'].'.jpg')){
				$competition_arr['image']=LINK_ROOT.COM_IMG.$competition_arr['id_competition'].'.jpg';
			}else{
				$competition_arr['image']=LINK_ROOT.'/images/num_10.jpg';
			}
			
			//到期时间
			$deadline=DateLen($competition_arr['end_time'],'future');
			if($deadline>0){
				$active_num++;
				$competition_arr['deadline']=$deadline.'天';
				if(isset($this->item['ShowActive'])){
					$sort_deadline[]=$deadline;
				}
			}else{
				$competition_arr['deadline']='已过期';
				if(isset($this->item['ShowCompleted'])){
					$sort_deadline[]=$deadline;
				}
			}			
			
			//报酬类型
			if($competition_arr['prize_1']==0){
				$reward=0;
				if($competition_arr['enterable']==1){
					$competition_arr['reward']='知识';
				}else{
					$competition_arr['reward']='保护';
				}
			}else{
				$reward=$competition_arr['prize_1']+$competition_arr['prize_2']+$competition_arr['prize_3'];
				$competition_arr['reward']='￥'.$reward;
				
			}
			if($deadline>0){
				if(isset($this->item['ShowActive'])){
					$sort_reward[]=$reward;
				}
			}else{
				if(isset($this->item['ShowCompleted'])){
					$sort_reward[]=$reward;
				}
			}
			
			//团队
			$competition_arr['teams']=$DB->Get_one('select count(distinct id_user) from '._DB_PREFIX_.'submissions where id_competition='.$competition_arr['id_competition']);
			if($deadline>0){
				if(isset($this->item['ShowActive'])){
					$sort_teams[]=$competition_arr['teams'];
				}
			}else{
				if(isset($this->item['ShowCompleted'])){
					$sort_teams[]=$competition_arr['teams'];
				}
			}
			
			//总的
			if($deadline>0){
				if(isset($this->item['ShowActive'])){
					$competitions_list[]=$competition_arr;
				}
			}else{
				if(isset($this->item['ShowCompleted'])){
					$competitions_list[]=$competition_arr;
				}
			}
			
		}
		//排序
		if(isset($this->item['reward'])){
			if($this->item['reward']=='desc'){
				array_multisort($sort_reward,SORT_DESC,SORT_NUMERIC,$competitions_list);
			}else{
				array_multisort($sort_reward,SORT_ASC,SORT_NUMERIC,$competitions_list);
			}
		}
		if(isset($this->item['temas'])){
			if($this->item['teams']=='desc'){
				array_multisort($sort_teams,SORT_DESC,SORT_NUMERIC,$competitions_list);
			}else{
				array_multisort($sort_teams,SORT_ASC,SORT_NUMERIC,$competitions_list);
			}
		}
		if(isset($this->item['deadline'])){
			if($this->item['deadline']=='desc'){
				array_multisort($sort_deadline,SORT_DESC,SORT_NUMERIC,$competitions_list);
			}else{
				array_multisort($sort_deadline,SORT_ASC,SORT_NUMERIC,$competitions_list);
			}
		}
		$competitions_num=count($competitions_list);
		?>
		<input type="hidden" id="competition_num" value="<?php echo $competitions_num; ?>" />
		<input type="hidden" id="active_num" value="<?php echo $active_num; ?>" />
		<?php
		if($competitions_num>0){
			foreach($competitions_list as $competition){
			?>
				<tr class="active-comp">
				  <td><a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>" target="_blank"><img class="competition-image" src="<?php echo $competition['image']; ?>" width="76" height="76" alt="seizure-prediction Image"></a>
					<div class="competition-details">
					  <div class="competitions-types"> </div>
					  <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>" target="_blank">
					  <h4><?php echo $competition['name_competition']; ?></h4>
					  </a>
					  <p class="competition-summary"> <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>" target="_blank"><?php echo $competition['introduce']; ?></a> </p>
					</div></td>
				  <td><?php echo $competition['reward']; ?></td>
				  <td><?php echo $competition['teams']; ?></td>
				  <td><?php echo $competition['deadline']; ?></td>
				</tr>
			 <?php
			}
		}else{
			?>
				<tr class="active-comp">
				  <td colspan="4" style="height:50px">暂无任何竞赛</td>
				</tr>
			<?
		}
	}
	
	
	
####################
#竞赛页
####################
	
	//竞赛详情
	public function Detail(){
		global $DB;
		
		$competition=$DB->Get_arr('select * from '._DB_PREFIX_.'competitions where id_competition='.$this->item['id_competition']);
		
		
		//当前用户是否已接受规则
		//$competition['id_acception']=false;
		//$competition['choose']=false;
		if(isset($_SESSION['user'])){
			$acception=$DB->Get_arr('select id_acception,choose from '._DB_PREFIX_.'acceptions where id_competition='.$this->item['id_competition'].' and id_user='.$_SESSION['user']['id_user']);
			$competition['id_acception']=$acception['id_acception'];
			$competition['choose']=$acception['choose'];
		}
		
	####头部####

		//奖励
		if($competition['prize_1']==0){
			$reward=0;
			if($competition['enterable']==1){
				$competition['reward']='知识';
			}else{
				$competition['reward']='保护';
			}
		}else{
			$reward=$competition['prize_1']+$competition['prize_2']+$competition['prize_3'];
			$competition['reward']='￥'.$reward;
			
		}
		//图片
		if(file_exists(FILE_ROOT.COM_IMG.$competition['id_competition'].'.jpg')){
			$competition['image']=LINK_ROOT.COM_IMG.$competition['id_competition'].'.jpg';
		}else{
			$competition['image']=LINK_ROOT.'/images/num_10.jpg';
		}
		//进行百分比
		$competition['percent']=intval(((time()-strtotime($competition['start_time']))/(strtotime($competition['end_time'])-strtotime($competition['start_time'])))*100);
		if($competition['percent']>100){
			$competition['percent']=100;
		}
		
		//进行天数
		$competition['togo']=DateLen($competition['start_time'],'history');
		
		//剩余时间
		$competition['deadline']=DateLen($competition['end_time'],'future');
		
		
	####左侧#####
		
		//排行榜
		$teams_num=0;
		$players_num=0;
		$competition['leaderboard']=array();
		/*$leaderboards=mysql_query('select '._DB_PREFIX_.'users.id_user,		'._DB_PREFIX_.'users.id_team,	'._DB_PREFIX_.'users.display_name,	'._DB_PREFIX_.'submissions.score,	'._DB_PREFIX_.'submissions.id_submission,	'._DB_PREFIX_.'submissions.submission_time
					from '._DB_PREFIX_.'users,	'._DB_PREFIX_.'submissions
					where '._DB_PREFIX_.'submissions.id_competition='.$this->item['id_competition'].' 
					and '._DB_PREFIX_.'submissions.id_user='._DB_PREFIX_.'users.id_user 
					order by '._DB_PREFIX_.'submissions.score desc');
		while($leaderboard=mysql_fetch_assoc($leaderboards)){
			//$leaderboard['file_num']=$DB->Get_one('select count(*) from '._DB_PREFIX_.'files where id_submission='.$leaderboard['id_submission']);
			//$leaderboard['upload_time']=$DB->Get_one('select upload_time from '._DB_PREFIX_.'files where id_submission='.$leaderboard['id_submission'].' order by upload_time desc');
			$leaderboard['entries']=$DB->Get_one('select count(*) from '._DB_PREFIX_.'submissions where id_competition='.$this->item['id_competition'].' and id_user='.$leaderboard['id_user']);
			$competition['leaderboard'][]=$leaderboard;
		}*/
		$subuser_list=array();
		$subusers=mysql_query('select id_user from '._DB_PREFIX_.'submissions where id_competition='.$this->item['id_competition'].' order by score desc');
		while($subuser=mysql_fetch_assoc($subusers)){
			$subuser_list[]=$subuser['id_user'];
		}
		$subuser_list=array_unique($subuser_list);
		foreach($subuser_list as $subuser){
			$leaderboard=$DB->Get_arr('select '._DB_PREFIX_.'users.id_user, '._DB_PREFIX_.'users.team,	'._DB_PREFIX_.'users.is_leader,	'._DB_PREFIX_.'users.display_name,	'._DB_PREFIX_.'submissions.score,	'._DB_PREFIX_.'submissions.id_submission,	'._DB_PREFIX_.'submissions.submission_time
									  from '._DB_PREFIX_.'users,	'._DB_PREFIX_.'submissions
									  where '._DB_PREFIX_.'submissions.id_competition='.$this->item['id_competition'].' 
									  and '._DB_PREFIX_.'submissions.id_user='._DB_PREFIX_.'users.id_user 
									  and '._DB_PREFIX_.'submissions.id_user='.$subuser.'
									  order by '._DB_PREFIX_.'submissions.score desc');
			$leaderboard['entries']=$DB->Get_one('select count(*) from '._DB_PREFIX_.'submissions where id_competition='.$this->item['id_competition'].' and id_user='.$leaderboard['id_user']);
			
			if($leaderboard['is_leader']){
				$leaderboard['display_name']=$leaderboard['team'];
				$leaderboard['member']=array();
				$members=mysql_query('select id_user,display_name from '._DB_PREFIX_.'users where team="'.$leaderboard['team'].'" order by is_leader desc');
				while($member=mysql_fetch_assoc($members)){
					$leaderboard['member'][]=$member;
					$players_num++;
				}
			}else{
				$players_num++;
			}
			$competition['leaderboard'][]=$leaderboard;
			$teams_num++;
		}
		//团队数
		$competition['teams']=$teams_num;
		//参与者数
		$competition['players']=$players_num;
		//已提交数
		$competition['entries']=$DB->Get_one('select count(*) from '._DB_PREFIX_.'submissions where id_competition='.$this->item['id_competition']);
		
		
	####中间####
		
		//数据说明
		if(!$competition['data']){
			$competition['data']='暂无任何数据说明';
		}
		//描述
		if(!$competition['description']){
			$competition['description']='暂无任何描述';
		}
		//评价
		if(!$competition['evaluation']){
			$competition['evaluation']='暂无任何评价';
		}
		//规则
		if(!$competition['rule']){
			$competition['rule']='暂无任何规则';
		}
		
		return $competition;
	}
	
	//获取竞赛数据
	public function File_list(){
		$file_list=array();
		if(file_exists(FILE_ROOT.COM_DATA.$this->item['id_competition'])){
			$files_dir=FILE_ROOT.COM_DATA.$this->item['id_competition'];
			$files_arr=scandir($files_dir);
			if($files_arr){
				foreach($files_arr as $key=>$file){
					if($key>1){
					  $file_arr=array();
					  $file_arr['name']=$file;
					  //$file_arr['extend_name']='.'.explode('.',$file)[count(explode('.',$file))-1];
					  $file_arr['extend_name']='.'.pathinfo($file)['extension'];
					  $file_arr['url']=LINK_ROOT.COM_DATA.$this->item['id_competition'].'/'.$file;
					  $file_arr['size']=(ceil(filesize($files_dir.'/'.$file)/1024)).'KB';
					  $file_list[]=$file_arr;
					}
				}
			}
		}
		return $file_list;
	}
	
	//获取提交列表
	public function Sub_list(){
		if(isset($_SESSION['user'])){
			$sub_list=array();
			$sublists=mysql_query('select * from '._DB_PREFIX_.'submissions where id_competition='.$this->item['id_competition'].' and id_user='.$_SESSION['user']['id_user'].' order by score desc');
			while($sublist=mysql_fetch_assoc($sublists)){
				if(file_exists(FILE_ROOT.USER_DATA.$sublist['id_submission'].'/')){
					$sublist['file']=scandir(FILE_ROOT.USER_DATA.$sublist['id_submission'].'/')[2];
					$sublist['url']=LINK_ROOT.USER_DATA.$sublist['id_submission'].'/'.$sublist['file'];
				}else{
					$sublist['file']='-';
					$sublist['url']='';
				}
				$sub_list[]=$sublist;
			}
		}
		return $sub_list;
	}
	
	//选定2个来评分
	public function Sub_checked(){
		//print_r($this->item);
		mysql_query('update '._DB_PREFIX_.'submissions set checked=0 where id_user='.$_SESSION['user']['id_user']);
		if(isset($this->item['subchecked'])){
			foreach($this->item['subchecked'] as $val){
				mysql_query('update '._DB_PREFIX_.'submissions set checked=1 where id_submission='.$val);
			}
		}
	}
	
	
	//同意规则
	public function Accept(){
		mysql_query('insert into '._DB_PREFIX_.'acceptions
					(id_competition,							id_user,									accept_time	) 	values 
					("'.$this->item['id_competition'].'",		"'.$_SESSION['user']['id_user'].'",			"'.date('Y-m-d H:i:s',time()).'"	)');
		echo mysql_insert_id();
	}
	
	//选择
	public function Choose(){
		mysql_query('update '._DB_PREFIX_.'acceptions set choose='.$this->item['choose'].' where id_acception='.$this->item['id_acception']);
	}
	
	//提交限制
	public function Sub_limit(){
		$sub_limit=array();
		//print_r($Competition->Sub_list());
		//echo time()."<Br>";
		$today=date('Y-m-d');
		$tomorrow=date('Y-m-d',strtotime('+1 day'));
		
		//echo $today."<Br>";
		//echo $tomorrow."<Br>";
		$sub_num=0;
		$sublists=mysql_query('select submission_time from '._DB_PREFIX_.'submissions 
							  where id_competition='.$_GET['id_competition'].' 
							  and id_user='.$_SESSION['user']['id_user'].' 
							  and submission_time between "'.$today.'" and "'.$tomorrow.'"');
		while($sublist=mysql_fetch_assoc($sublists)){
			//echo $sublist['submission_time'].'<Br>';
			$sub_num++;
		}
		$remain_num=10-$sub_num;
		
		//echo date('Y-m-d H:i:s');
		$remain_reset=strtotime(date('Y-m-d',strtotime('+1 day')).' 00:00:00')-time();
		if($remain_reset>60){
			if(($remain_reset/60)>60){
				$remain_reset=ceil($remain_reset/3600).'小时';
			}else{
				$remain_reset=ceil($remain_reset/60).'分钟';
			}
		}else{
			$remain_reset.='秒';
		}
		
		$sub_limit['sub_num']=$sub_num;
		$sub_limit['remain_num']=$remain_num;
		$sub_limit['remain_reset']=$remain_reset;
		return $sub_limit;
	}
	
	//参与竞赛
	/*public function Submission(){
		mysql_query('insert into '._DB_PREFIX_.'submissions
					(id_competition,							id_user,								score,		last_time	) 	values 
					("'.$this->item['id_competition'].'",		"'.$_SESSION['user']['id_user'].'",		0,			"'.date('Y-m-d H:i:s',time()).'"	)');
	}*/
	
	//参与竞赛//上传文件
	//public function Upload($get=false,$file=false){
	public function Submission($get=false,$file=false){
		//print_r($file);
		//exit;
		//验证扩展名
		$extension_arr=array('cvs','zip','rar','gz','7z');
		$filename_arr=pathinfo($file['Filedata']["name"]);
		if(!in_array($filename_arr['extension'],$extension_arr)){
			echo '扩展名不能为'.$filename_arr['extension'];
			exit;
		}
		
		mysql_query('insert into '._DB_PREFIX_.'submissions
					(id_competition,							id_user,								score,		description,					submission_time	) 	values 
					("'.$get['id_competition'].'",		"'.$_SESSION['user']['id_user'].'",		0,			"'.$get['description'].'",		"'.date('Y-m-d H:i:s',time()).'"	)');
		
		$submission=FILE_ROOT.USER_DATA.mysql_insert_id().'/';
		$filepath=$submission.'/'.$file['Filedata']["name"];
		if(!file_exists($submission)){
			mkdir($submission);
			exec('export LANG=C; /usr/bin/sudo chmod 777 '.$submission);
		}
		move_uploaded_file($file['Filedata']["tmp_name"],$filepath);
		
		/*global $DB;
		$is_exists=$DB->Get_one('select name_file from '._DB_PREFIX_.'files where id_submission='.$get['id_submission'].' and name_file="'.$file['Filedata']["name"].'"');
		
		if($is_exists){
			mysql_query('update '._DB_PREFIX_.'files set size="'.$file['Filedata']["size"].'",description="'.$get['description'].'",upload_time="'.date('Y-m-d H:i:s',time()).'"  
										where id_submission='.$get['id_submission'].' 
										and name_file="'.$file['Filedata']["name"].'"');
		}else{
			mysql_query('insert into '._DB_PREFIX_.'files (id_submission,				name_file,							size,								description,				upload_time) values 
											  ("'.$get['id_submission'].'",	"'.$file['Filedata']["name"].'",	"'.$file['Filedata']["size"].'",	"'.$get['description'].'",	"'.date('Y-m-d H:i:s',time()).'")');
		}*/
		
	}
	
	//获得团队列表
	public function Team(){
		if($_SESSION['user']['team']){
			$member_list=array();
			$members=mysql_query('select id_user,display_name,is_leader,email from '._DB_PREFIX_.'users where team="'.$_SESSION['user']['team'].'" order by is_leader desc');
			while($member=mysql_fetch_assoc($members)){
				if(file_exists(FILE_ROOT.USER_IMG.$member['id_user'].'.jpg')){
					$member['image']=LINK_ROOT.USER_IMG.$member['id_user'].'.jpg';
				}else{
					$member['image']=LINK_ROOT.'/images/default.png';
				}
				$member_list[]=$member;
			}
			return $member_list;
		}
	}
	
	//创建团队
	public function Team_creat(){
		global $DB;
		$team_name=$DB->Get_one('select team from '._DB_PREFIX_.'users where team="'.trim($this->item['team_name']).'"');
		if($team_name){
			echo '该名称已存在！';
			exit;
		}
		mysql_query('update '._DB_PREFIX_.'users set team="'.trim($this->item['team_name']).'",is_leader=1 where id_user='.$_SESSION['user']['id_user']);
		$_SESSION['user']['team']=trim($this->item['team_name']);
		$_SESSION['user']['is_leader']=1;
	}
	
	//修改团队名称
	public function Team_save(){
		global $DB;
		$team_name=$DB->Get_one('select team from '._DB_PREFIX_.'users where team="'.trim($this->item['team_name']).'"');
		if($team_name){
			echo '该名称已存在！';
			exit;
		}
		mysql_query('update '._DB_PREFIX_.'users set team="'.trim($this->item['team_name']).'" where team="'.$_SESSION['user']['team'].'" ');
		$_SESSION['user']['team']=trim($this->item['team_name']);
	}
	
	//修改团队领袖
	public function Team_leader(){
		mysql_query('update '._DB_PREFIX_.'users set is_leader=0 where id_user='.$_SESSION['user']['id_user']);
		mysql_query('update '._DB_PREFIX_.'users set is_leader=1 where id_user='.$this->item['id_user']);
		$_SESSION['user']['is_leader']=0;
	}
	
	//踢出团队
	public function Team_eject(){
		mysql_query('update '._DB_PREFIX_.'users set team="" where id_user='.$this->item['id_user']);
	}
	//发送邀请
	public function Team_invite(){
		global $DB;
		$id_user=$DB->Get_one('select id_user from '._DB_PREFIX_.'users where email="'.trim($this->item['invite_email']).'"');
		if($id_user){
			//echo $_SESSION['user']['team'].'邀请您加入'.COMPETITION_INDEX.'/index.php?ajax=competition&op=team_accept&id_user='.$id_user.'&id_competition='.$this->item['id_competition'].'&team='.$_SESSION['user']['team'];
			$email=trim($this->item['invite_email']);
			$title='数据竞赛——“'.$_SESSION['user']['team'].'”邀请您加入';
			$content='<a href="'.COMPETITION_INDEX.'/index.php?ajax=competition&op=team_accept&id_user='.$id_user.'&id_competition='.$this->item['id_competition'].'&team='.$_SESSION['user']['team'].'">点击接受</a>';
			include_once(FILE_ROOT.'/classes/class_general.php');
			$General=new General();
			if($General->Mail_smtp($email,$title,$content)==""){ 
			}else{
			}
		}else{
			echo '用户不存在！';
		}
	}
	//接受邀请
	public function Team_accept($get){
		global $DB;
		mysql_query('update '._DB_PREFIX_.'users set team="'.$get['team'].'" where id_user='.$get['id_user']);
		$_SESSION['user']=$DB->Get_arr('select * from '._DB_PREFIX_.'users where id_user='.$get['id_user']);
		echo '<script>alert("您已接受'.$get['team'].'的邀请！")</script>';
		echo '<script>window.location="'.COMPETITION_INDEX.'/index.php?view=competition_team&id_competition='.$get['id_competition'].'" </script>';
	}
	//团队解散
	public function Team_disband(){
		mysql_query('update '._DB_PREFIX_.'users set team="",is_leader=0 where team="'.$_SESSION['user']['team'].'" ');
		$_SESSION['user']['team']='';
		$_SESSION['user']['is_leader']=0;
	}
	
	
##########	
#管理员	
##########

	public function Manage_list(){
		global $DB;
		
		//搜索
		$sql='select * from '._DB_PREFIX_.'competitions where id_competition!=0';
		if(isset($this->item['kw'])){
			$sql.=' and (name_competition like "%'.trim($this->item['kw']).'%" ) ';
		}
		//数据库排序
		if(isset($this->item['st'])){
			$od=explode('_',$this->item['st'])[0];
			$by=explode('_',$this->item['st'])[1];
			switch($od){
				case 'id':
				$od='id_competition';
				break;
				
				case 'name':
				$od='name_competition';
				break;
				
				case 'type':
				$od='type';
				break;
				
				case 'start':
				$od='start_time';
				break;
				
				case 'end':
				$od='end_time';
				break;
				
				default:
				$od='array';
				break;
			}
			if($od!='array'){
				$sql.=' order by '.$od.' '.$by;
			}
		}else{
			$sql.=' order by id_competition asc';
		}
		
		//数组排序
		$sort_reward=array();
		//$sort_teams=array();
		$sort_deadline=array();
		$sort_entries=array();
		
		//获取竞赛
		//$active_num=0;
		$competitions_list=array();
		$competitions_arr=mysql_query($sql);
		while($competition_arr=mysql_fetch_assoc($competitions_arr)){
			//名称搜索高亮
			if(isset($this->item['kw'])){
				$competition_arr['name_competition']=str_replace(trim($this->item['kw']),'<font color=red>'.trim($this->item['kw']).'</font>',$competition_arr['name_competition']);
			}
			//描述搜索高亮
			//$competition_arr['introduce']=str_replace($this->item['Query'],'<font color=red>'.$this->item['Query'].'</font>',$competition_arr['introduce']);
			
			//类型
			$competition_arr['type']=$this->type_zh[$competition_arr['type']];
			
			//图片
			if(file_exists(FILE_ROOT.COM_IMG.$competition_arr['id_competition'].'.jpg')){
				$competition_arr['image']=LINK_ROOT.COM_IMG.$competition_arr['id_competition'].'.jpg';
			}else{
				$competition_arr['image']=LINK_ROOT.'/images/num_10.jpg';
			}
			
			//到期时间
			$deadline=DateLen($competition_arr['end_time'],'future');
			if($deadline>0){
				//$active_num++;
				$competition_arr['deadline']=$deadline.'天';
				/*if(isset($this->item['ShowActive'])){
					$sort_deadline[]=$deadline;
				}*/
			}else{
				$competition_arr['deadline']='已过期';
				/*if(isset($this->item['ShowCompleted'])){
					$sort_deadline[]=$deadline;
				}*/
			}
			$sort_deadline[]=$deadline;
			
			//报酬类型
			if($competition_arr['prize_1']==0){
				$reward=0;
				if($competition_arr['enterable']==1){
					$competition_arr['reward']='知识';
				}else{
					$competition_arr['reward']='保护';
				}
			}else{
				$reward=$competition_arr['prize_1']+$competition_arr['prize_2']+$competition_arr['prize_3'];
				$competition_arr['reward']='￥'.$reward;
				
			}
			/*if($deadline>0){
				if(isset($this->item['ShowActive'])){
					$sort_reward[]=$reward;
				}
			}else{
				if(isset($this->item['ShowCompleted'])){
					$sort_reward[]=$reward;
				}
			}*/
			$sort_reward[]=$reward;
			
			//提交
			$competition_arr['entries']=$DB->Get_one('select count(*) from '._DB_PREFIX_.'submissions where id_competition='.$competition_arr['id_competition']);
			$sort_entries[]=$competition_arr['entries'];
			/*
			//团队
			$competition_arr['teams']=$DB->Get_one('select count(distinct id_user) from '._DB_PREFIX_.'submissions where id_competition='.$competition_arr['id_competition']);
			if($deadline>0){
				if(isset($this->item['ShowActive'])){
					$sort_teams[]=$competition_arr['teams'];
				}
			}else{
				if(isset($this->item['ShowCompleted'])){
					$sort_teams[]=$competition_arr['teams'];
				}
			}*/
			
			//总的
			/*if($deadline>0){
				if(isset($this->item['ShowActive'])){
					$competitions_list[]=$competition_arr;
				}
			}else{
				if(isset($this->item['ShowCompleted'])){*/
					$competitions_list[]=$competition_arr;
				/*}
			}*/
			
		}
		//数组排序
		if(isset($this->item['st'])){
			$od=explode('_',$this->item['st'])[0];
			$by=explode('_',$this->item['st'])[1];
			switch($od){
				case 'reward':
				if($by=='desc'){
					array_multisort($sort_reward,SORT_DESC,SORT_NUMERIC,$competitions_list);
				}else{
					array_multisort($sort_reward,SORT_ASC,SORT_NUMERIC,$competitions_list);
				}
				break;
				
				case 'deadline':
				if($by=='desc'){
					array_multisort($sort_deadline,SORT_DESC,SORT_NUMERIC,$competitions_list);
				}else{
					array_multisort($sort_deadline,SORT_ASC,SORT_NUMERIC,$competitions_list);
				}
				break;
				
				case 'entries':
				if($by=='desc'){
					array_multisort($sort_entries,SORT_DESC,SORT_NUMERIC,$competitions_list);
				}else{
					array_multisort($sort_entries,SORT_ASC,SORT_NUMERIC,$competitions_list);
				}
				break;
				
				default:
				break;
			}
		}
		/*if(isset($this->item['reward'])){
			if($this->item['reward']=='desc'){
				array_multisort($sort_reward,SORT_DESC,SORT_NUMERIC,$competitions_list);
			}else{
				array_multisort($sort_reward,SORT_ASC,SORT_NUMERIC,$competitions_list);
			}
		}
		if(isset($this->item['temas'])){
			if($this->item['teams']=='desc'){
				array_multisort($sort_teams,SORT_DESC,SORT_NUMERIC,$competitions_list);
			}else{
				array_multisort($sort_teams,SORT_ASC,SORT_NUMERIC,$competitions_list);
			}
		}
		if(isset($this->item['deadline'])){
			if($this->item['deadline']=='desc'){
				array_multisort($sort_deadline,SORT_DESC,SORT_NUMERIC,$competitions_list);
			}else{
				array_multisort($sort_deadline,SORT_ASC,SORT_NUMERIC,$competitions_list);
			}
		}*/
		//$competitions_num=count($competitions_list);
		return $competitions_list;
		
	}
	
	//修改竞赛详情
	public function Manage_competition(){
		global $DB;
		
		$competition=$DB->Get_arr('select * from '._DB_PREFIX_.'competitions where id_competition='.$this->item['id_competition']);
		
		//数据
		$competition['file']=array();
		if(file_exists(FILE_ROOT.COM_DATA.$competition['id_competition'])){
			$files_dir=FILE_ROOT.COM_DATA.$competition['id_competition'];
			$files_arr=scandir($files_dir);
			if($files_arr){
				foreach($files_arr as $key=>$file){
					if($key>1){
					  $file_arr=array();
					  $file_arr['name']=$file;
					  //$file_arr['extend_name']='.'.explode('.',$file)[count(explode('.',$file))-1];
					  $file_arr['extend_name']='.'.pathinfo($file)['extension'];
					  $file_arr['url']=LINK_ROOT.COM_DATA.$competition['id_competition'].'/'.$file;
					  $file_arr['size']=(ceil(filesize($files_dir.'/'.$file)/1024)).'KB';
					  $competition['file'][]=$file_arr;
					}
				}
			}
		}
		//return $competition;
		echo json_encode($competition);
	}
	
	
	//添加修改竞赛
	public function Manage_set(){
		//print_r($this->item);
		
		if(isset($this->item['enterable'])){
			$enterable=1;
		}else{
			$enterable=0;
		}
		
		if(isset($this->item['in_class'])){
			$in_class=1;
		}else{
			$in_class=0;
		}
		if(isset($this->item['is_pts'])){
			$is_pts=1;
		}else{
			$is_pts=0;
		}
		
		if(isset($this->item['is_rank'])){
			$is_rank=1;
		}else{
			$is_rank=0;
		}
		
		$set='set 
			  name_competition="'.$this->item['name_competition'].'",
			  type="'.$this->item['type'].'",
			  enterable="'.$enterable.'",
			  in_class="'.$in_class.'",
			  is_pts="'.$is_pts.'",
			  is_rank="'.$is_rank.'",
			  introduce="'.$this->item['introduce'].'",
			  description="'.$this->item['description'].'",
			  data="'.$this->item['data'].'",
			  evaluation="'.$this->item['evaluation'].'",
			  rule="'.$this->item['rule'].'",
			  prize="'.$this->item['prize'].'",
			  prize_1="'.$this->item['prize_1'].'",
			  prize_2="'.$this->item['prize_2'].'",
			  prize_3="'.$this->item['prize_3'].'",
			  start_time="'.$this->item['start_time'].'",
			  end_time="'.$this->item['end_time'].'"
			  ';
		if($this->item['id_competition']){
			//修改竞赛
			mysql_query('update '._DB_PREFIX_.'competitions '.$set.' where id_competition='.$this->item['id_competition']);
			$id_competition=$this->item['id_competition'];
		}else{
			//添加竞赛
			//mysql_query('insert into '._DB_PREFIX_.'competitions '.$set.',start_time="'.date('Y-m-d H:i:s',time()).'"');
			mysql_query('insert into '._DB_PREFIX_.'competitions '.$set);
			$id_competition=mysql_insert_id();
			
			//上传文件
			if($this->item['tmp_id']){
				mkdir(FILE_ROOT.COM_DATA.$id_competition);
				exec('export LANG=C; /usr/bin/sudo chmod 777 '.FILE_ROOT.COM_DATA.$id_competition);
				$tmp_list=scandir(FILE_ROOT.TMP_DATA.$this->item['tmp_id']);
				foreach($tmp_list as $key=>$tmp){
					if($key>1){
						copy(FILE_ROOT.TMP_DATA.$this->item['tmp_id'].'/'.$tmp,  FILE_ROOT.COM_DATA.$id_competition.'/'.$tmp);
						unlink(FILE_ROOT.TMP_DATA.$this->item['tmp_id'].'/'.$tmp);
					}
				}
				rmdir(FILE_ROOT.TMP_DATA.$this->item['tmp_id']);//删除临时目录
			}
		}
		
		//图像裁剪
		$input=FILE_ROOT.TMP_IMG.$_SESSION['user']['id_user'].'/';
		$output=FILE_ROOT.COM_IMG;
		
		include_once(FILE_ROOT.'/classes/class_general.php');
		$General=new General();
		$General->ImageCrop($this->item['name_image'],$id_competition,$input,$output,$this->item['x'],$this->item['y'],$this->item['w'],$this->item['h']);
	}
	
	//删除竞赛
	public function Manage_del(){
		mysql_query('delete from '._DB_PREFIX_.'acceptions where id_competition='.$this->item['id_competition']);
		mysql_query('delete from '._DB_PREFIX_.'competitions where id_competition='.$this->item['id_competition']);
		mysql_query('delete from '._DB_PREFIX_.'submissions where id_competition='.$this->item['id_competition']);
	    $this->Dir_del(FILE_ROOT.COM_DATA.$this->item['id_competition']);
	}
	
	//删除目录
	public function Dir_del($dir){
		if(file_exists($dir)){
			$file_list=scandir($dir);
			foreach($file_list as $key=>$file){
				if($key>1){
					unlink($dir.'/'.$file);
				}
			}
			rmdir($dir);
		}
	}
	
	//数据文件上传
	public function Manage_data($file=false){
		//print_r($this->item);
		$data=array();
		//$data['name']=$file['Filedata']["name"];
		//$data['size']=$file['Filedata']["size"];
		if($this->item['id_competition']){
			if(!file_exists(FILE_ROOT.COM_DATA.$this->item['id_competition'])){
				mkdir(FILE_ROOT.COM_DATA.$this->item['id_competition']);
				exec('export LANG=C; /usr/bin/sudo chmod 777 '.FILE_ROOT.COM_DATA.$this->item['id_competition']);
			}
			move_uploaded_file($file['Filedata']["tmp_name"],FILE_ROOT.COM_DATA.$this->item['id_competition'].'/'.$file['Filedata']["name"]);
			$data['tmp_id']=0;
			$data['url']=LINK_ROOT.COM_DATA.$this->item['id_competition'].'/'.$file['Filedata']["name"];
		}else{
			if($this->item['tmp_id']){
				$tmp_id=$this->item['tmp_id'];
			}else{
				do{
					$tmp_id=rand(1,10000);
				}while(file_exists(FILE_ROOT.TMP_DATA.$tmp_id));
				
				mkdir(FILE_ROOT.TMP_DATA.$tmp_id);
				exec('export LANG=C; /usr/bin/sudo chmod 777 '.FILE_ROOT.TMP_DATA.$tmp_id);
			}
			//上传到临时文件夹
			move_uploaded_file($file['Filedata']["tmp_name"],FILE_ROOT.TMP_DATA.$tmp_id.'/'.$file['Filedata']["name"]);
			$data['tmp_id']=$tmp_id;
			$data['url']=LINK_ROOT.TMP_DATA.$tmp_id.'/'.$file['Filedata']["name"];
		}
		echo json_encode($data);
	}
	
	//删除数据文件
	public function Manage_data_del(){
		unlink(str_replace(LINK_ROOT,FILE_ROOT,$this->item['url']));
	}
	
	//提交管理
	public function Manage_submission(){
		$submission=array();
		$sublists=mysql_query('select '._DB_PREFIX_.'submissions.*,'._DB_PREFIX_.'users.name_user,'._DB_PREFIX_.'users.display_name 
							  from '._DB_PREFIX_.'submissions,'._DB_PREFIX_.'users
							  where '._DB_PREFIX_.'submissions.id_competition='.$this->item['id_competition'].'
							  and '._DB_PREFIX_.'users.id_user='._DB_PREFIX_.'submissions.id_user 
							  order by '._DB_PREFIX_.'submissions.submission_time desc');
		while($sublist=mysql_fetch_assoc($sublists)){
			if(file_exists(FILE_ROOT.USER_DATA.$sublist['id_submission'].'/')){
				$sublist['file']=scandir(FILE_ROOT.USER_DATA.$sublist['id_submission'].'/')[2];
				$sublist['url']=LINK_ROOT.USER_DATA.$sublist['id_submission'].'/'.$sublist['file'];
			}else{
				$sublist['file']='-';
				$sublist['url']='';
			}
			$submission[]=$sublist;
		}
		echo json_encode($submission);
	}
	
	//打分
	public function Manage_score(){
		//print_r($this->item);
		foreach($this->item as $key=>$score){
			mysql_query('update '._DB_PREFIX_.'submissions set score="'.$score.'" where id_submission='.$key);
		}
	}
	
}
?>