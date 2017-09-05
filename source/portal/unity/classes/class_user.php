<?php
//用户
class User{
	public function __construct($item=false){
		$this->item=$item;
	}
	public function UseDB($db){
		@mysql_select_db($db)or die('数据库“'.$db.'”未正确安装！');
		mysql_query('set names utf8');
	}
	
	//初始化用户
	public function Init(){
		session_start();
		/*if(isset($_COOKIE['id_user'])){
			global $DB;
			$_SESSION['user']=$DB->Get_arr("select * from "._DB_PREFIX_."users where id_user='".$_COOKIE['id_user']."'");
		}*/
	}
	
	//登录
	public function Login(){
		//登录
		global $DB;
		$this->UseDB('unity');
		$user=$DB->Get_arr("select * from un_users where email='".trim($this->item['email'])."' or username='".trim($this->item['email'])."'");
		if(!$user){
			echo 1;
		}else{
			if($user['password']!=md5(trim($this->item['password']))){
				echo 2;
			}else{
				//数据工具
				//$_SESSION['datatool']=json_decode(file_get_contents('http://'.$_SERVER['HTTP_HOST'].':8088/sofa/flex-workspace/loggin.ctrl?method=getUserByID&id='.$user['id']),true);
				
				//通用
				//$_SESSION['unity']=$user;
				
				//电商
				$this->UseDB('market');
				$_SESSION['customer']=$DB->Get_arr("select * from ps_customer where id_customer=".$user['id']);
				
				//竞赛
				$this->UseDB('competition');
				$_SESSION['user']=$DB->Get_arr("select * from ka_users where id_user=".$user['id']);
			
				//cookie
				if(isset($this->item['autologin'])){
					setcookie("id_user",$user['id'],time()+3600*24*30,"/");
				}
			}
		}
	}
	
	//登出
	/*public function Logout(){
		setcookie("id_user",0,time()-3600*24*30,"/");
		session_unset();
		session_destroy();
		echo '<script>window.location="'.$index_url.'"</script>';
	}*/
	
	//注册
	public function Regist(){
		global $DB;
		$this->UseDB('unity');
		$username=$DB->Get_one("select username from un_users where username='".trim($this->item['username'])."'");
		
		if(strtolower($this->item['validate'])==strtolower($_SESSION["autonum"])){
			if(!$username){
				
				$email=$DB->Get_one("select email from un_users where email='".trim($this->item['email'])."'");
				if(!$email){
					$username=trim($this->item['username']);
					$password=md5(trim($this->item['password']));
					$email=trim($this->item['email']);
					$nickname=trim($this->item['nickname']);
					$realname='';
					$datetime=date('Y-m-d H:i:s',time());
					
					//数据工具
					$id_user=$DB->Get_arr("show table status where Name='un_users'")['Auto_increment'];
					//$signin='http://'.$_SERVER['HTTP_HOST'].':8088/sofa/flex-workspace/loggin.ctrl?method=signIn&id='.$id_user.'&username='.$username.'&password='.$password.'&email='.$email.'&nickname='.urlencode($nickname).'&realname='.urlencode($realname);
					$signin='http://'.$_SERVER['HTTP_HOST'].':8088/sofa/flex-workspace/loggin.ctrl?method=signIn&id='.$id_user.'&username='.$username.'&password='.$password.'&email='.$email.'&nickname=&realname=';
					//echo $signin;
					//$_SESSION['datatool']=json_decode(file_get_contents($signin),true);
					/*try{
						file_get_contents($signin);
					}catch(Exception $ex){
						throw new Exception("写name文件错误");
						echo 'JAVA接口访问错误！';
						exit;
					}*/
					@file_get_contents($signin)or die('JAVA接口访问错误！');
					
					//通用
					mysql_query("insert into un_users set email='".$email."',
														  username='".$username."',
														  nickname='".$nickname."',
														  realname='".$realname."',
														  password='".$password."',  
														  signtime='".$datetime."'	");
					//$_SESSION['unity']=$DB->Get_arr("select * from un_users where id=".mysql_insert_id());
					//$id_user=mysql_insert_id();
					
					//电商
					$this->UseDB('market');
					mysql_query("insert into ps_customer set id_gender=1,
															 id_default_group=3,
															 id_lang=1,
															 id_risk=0,
															 firstname='".$username."',	
															 lastname='".$nickname."',
															 email='".$email."',
															 passwd='".$password."',
															 max_payment_days=0,
															 active=1,
															 date_add='".$datetime."',
															 date_upd='".$datetime."'	");
					$_SESSION['customer']=$DB->Get_arr("select * from ps_customer where id_customer=".mysql_insert_id());
					
					
					//竞赛
					$this->UseDB('competition');
					mysql_query("insert into ka_users set email='".$email."',
														  name_user='".$username."',
														  display_name='".$nickname."',
														  legal_name='".$realname."',
														  password='".$password."',  
														  regist_time='".$datetime."'	");
					$_SESSION['user']=$DB->Get_arr("select * from ka_users where id_user=".mysql_insert_id());
				}else{
					echo 3;
				}
			}else{
				echo 2;
			}
		}else{
			echo 1;
		}
	}
	
	//找回密码
	public function Password(){
		if(strtolower($this->item['validate'])==strtolower($_SESSION["autonum"])){
			global $DB;
			$this->UseDB('unity');
			$email=$DB->Get_one("select email from un_users where email='".trim($this->item['email'])."'");
			if(!$email){
				echo 2;
			}else{
				$validate=$DB->Get_one("select password from un_users where email='".trim($this->item['email'])."'");
				$title='大数据云平台——重置密码';
				$content='<a href="'.UNITY_INDEX.'/index.php?view=password_reset&site='.$this->item['site'].'&email='.$email.'&validate='.$validate.'">点击重置</a>';
				//$content+='如果无效，请访问链接'.UNITY_INDEX.'/index.php?view=password_reset&site='.$this->item['site'].'&email='.$email.'&validate='.$validate;
				//echo $content;
				
				include_once(FILE_ROOT.'/classes/class_general.php');
				$General=new General();
				$response=$General->Mail_smtp($email,$title,$content);
				if($response==""){ 
				}else{
				}
			}
		}else{
			echo 1;
		}
	}
	
	//重置密码验证
	public function Reset_validate(){
		global $DB;
		$this->UseDB('unity');
		$id_user=$DB->Get_one("select id from un_users where email='".trim($_GET['email'])."' and  password='".trim($_GET['validate'])."' ");
		
		if(!$id_user){
			echo '该地址错误或已过期';
			exit;
		}else{
			return $id_user;
		}
	}
	
	//修改密码
	public function Password_modify(){
		//数据工具
		$user=json_decode(@file_get_contents('http://'.$_SERVER['HTTP_HOST'].':8088/sofa/flex-workspace/loggin.ctrl?method=getUserByID&id='.$this->item['id_user'])or die('JAVA接口访问错误！'),true);
		@file_get_contents('http://'.$_SERVER['HTTP_HOST'].':8088/sofa/flex-workspace/loggin.ctrl?method=updateUserByID&id='.$this->item['id_user'].'&username='.$user['userName'].'&password='.md5(trim($this->item['password'])).'&email='.$user['email'].'&nickname=&realname=')or die('JAVA接口访问错误！');
		//通用
		$this->UseDB('unity');
		mysql_query('update un_users set password="'.md5(trim($this->item['password'])).'"  where id='.$this->item['id_user']);
		//电商
		$this->UseDB('market');
		mysql_query('update ps_customer set passwd="'.md5(trim($this->item['password'])).'"  where id_customer='.$this->item['id_user']);
		//竞赛
		$this->UseDB('competition');
		mysql_query('update ka_users set password="'.md5(trim($this->item['password'])).'"  where id_user='.$this->item['id_user']);
	}
	
	//删除用户
	public function User_del($get){
		if(!isset($get['clear'])){
			//数据工具
			file_get_contents('http://'.$_SERVER['HTTP_HOST'].':8088/sofa/flex-workspace/loggin.ctrl?method=deleteUserByID&id='.$get['id_user'])or die();
			//通用
			$this->UseDB('unity');
			mysql_query('delete from un_users where id='.$get['id_user']);
			//电商
			$this->UseDB('market');
			mysql_query('delete from ps_customer where id_customer='.$get['id_user']);
			//竞赛
			$this->UseDB('competition');
			mysql_query('delete from ka_users where id_user='.$get['id_user']);
		}else{
			//数据工具
			for($i=4;$i<=100;$i++){
				file_get_contents('http://'.$_SERVER['HTTP_HOST'].':8088/sofa/flex-workspace/loggin.ctrl?method=deleteUserByID&id='.$i)or die();
			}
			//通用
			$this->UseDB('unity');
			mysql_query('delete from un_users where id>3');
			mysql_query('alter table un_users auto_increment = 4');
			//电商
			$this->UseDB('market');
			mysql_query('delete from ps_customer where id_customer>3');
			mysql_query('alter table ps_customer auto_increment = 4');
			//竞赛
			$this->UseDB('competition');
			mysql_query('delete from ka_users where id_user>3');
			mysql_query('alter table ka_users auto_increment = 4');
		}
	}
	
}
?>