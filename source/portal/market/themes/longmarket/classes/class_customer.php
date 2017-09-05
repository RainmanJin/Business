<?php
//用户
class Customer{
	
	public function __construct($item=false){
		$this->item=$item;
	}
	
	public function Init(){
		//初始化用户
		session_start();
		if(isset($_COOKIE['id_user'])&&!isset($_SESSION['customer'])){
			global $DB;
			$_SESSION['customer']=$DB->Get_arr("select * from "._DB_PREFIX_."customer where id_customer='".$_COOKIE['id_user']."'");
		}
	}
	
	####################
	#注册登录
	####################
	
	public function Login(){
		//登录
		global $DB;
		$customer=$DB->Get_arr("select * from "._DB_PREFIX_."customer where email='".trim($this->item['email'])."'");
		if(!$customer){
			echo 1;
		}else{
			if($customer['passwd']!=md5(trim($this->item['passwd']))){
				echo 2;
			}else{
				$_SESSION['customer']=$customer;
				
				if(isset($this->item['autologin'])){
					setcookie("id_customer",$customer['id_customer'],time()+3600*24*30,"/");
				}
			}
		}
		
	}
	public function Logout(){
		//登出
		setcookie("id_user",0,time()-3600*24*30,"/");
		session_unset();
		session_destroy();
		echo '<script>window.location="'.MARKET_INDEX.'"</script>';
	}
	
	public function Regist(){
		//注册
		if(strtolower($this->item['validate'])==strtolower($_SESSION["autonum"])){
			global $DB;
			$email=$DB->Get_one("select email from "._DB_PREFIX_."customer where email='".trim($this->item['email'])."'");
			if(!$email){
				mysql_query("insert into "._DB_PREFIX_."customer (id_gender,  id_default_group,  id_lang,  id_risk,  email,  							passwd,  							max_payment_days,  active,  date_add,  						   date_upd) 
											  values (1,		  3,				 1,		   0,		 '".trim($this->item['email'])."',	'".md5(trim($this->item['passwd']))."',	0,				   1,		'".date('Y-m-d H:i:s',time())."',  '".date('Y-m-d H:i:s',time())."'	)");
				$customer=$DB->Get_arr("select * from "._DB_PREFIX_."customer where email='".trim($this->item['email'])."'");
				$_SESSION['customer']=$customer;
			}else{
				echo 2;
			}
		}else{
			echo 1;
		}
	}
	
	public function Password(){
		//找回密码
		if(strtolower($this->item['validate'])==strtolower($_SESSION["autonum"])){
			global $DB;
			$email=$DB->Get_one("select email from "._DB_PREFIX_."customer where email='".trim($this->item['email'])."'");
			if(!$email){
				echo 2;
			}else{
				$validate=$DB->Get_one("select passwd from "._DB_PREFIX_."customer where email='".trim($this->item['email'])."'");
				include_once(FILE_ROOT.'/classes/class_general.php');
				$General=new General();
				if($General->Mail_smtp($email,'龙信数据——重置密码','重置密码'.MARKET_INDEX.'/index.php?view=passwd_reset&email='.$email.'&validate='.$validate)==""){ 
					
				}else{
					
				}
			}
		}else{
			echo 1;
		}
		
	}
	public function Reset(){
		//重置密码
		global $DB;
		$_SESSION['customer']=$DB->Get_arr("select * from "._DB_PREFIX_."customer where email='".trim($this->item['email'])."'");
		mysql_query('update '._DB_PREFIX_.'customer set passwd="'.md5(trim($this->item['passwd'])).'"  where id_customer='.$_SESSION['customer']['id_customer']);
	}
	
	
	####################
	#我的专区
	####################
	
	//账户详细
	public function Detail($empty=false){
		global $DB;
		$detail=$DB->Get_arr('select id_country,address1,postcode,company,phone,phone_mobile from '._DB_PREFIX_.'address where id_customer='.$_SESSION['customer']['id_customer']);
		if($detail){
			if(!$detail['id_country']){
				$detail['country']='-';
			}else{
				$detail['country']=$detail['id_country'];
			}
			if(!$detail['address1']){
				$empty?$detail['address']='':$detail['address']='-';
			}else{
				$detail['address']=$detail['address1'];
			}
			if(!$detail['postcode']){
				$empty?$detail['postcode']='':$detail['postcode']='-';
			}else{
				$detail['postcode']=$detail['postcode'];
			}
			if(!$detail['company']){
				$detail['company']='-';
			}
			if(!$detail['phone']){
				$empty?$detail['phone']='':$detail['phone']='-';
			}
			if(!$detail['phone_mobile']){
				$empty?$detail['mobile']='':$detail['mobile']='-';
			}else{
				$detail['mobile']=$detail['phone_mobile'];
			}
		}else{
			$empty?$detail=array('country'=>'','address'=>'','postcode'=>'','company'=>'','phone'=>'','mobile'=>''):$detail=array('country'=>'-','address'=>'-','postcode'=>'-','company'=>'-','phone'=>'-','mobile'=>'-');
		}
		return $detail;
	}
	//修改账户详细
	public function Modify(){
		global $DB;
		$is_address=$DB->Get_one('select id_customer from '._DB_PREFIX_.'address where id_customer='.$_SESSION['customer']['id_customer']);
		if($is_address){
			mysql_query('update '._DB_PREFIX_.'address set 
						address1="'.$this->item['address'].'",
						postcode="'.$this->item['postcode'].'",
						phone="'.$this->item['phone'].'",
						phone_mobile="'.$this->item['mobile'].'"   
						where id_customer='.$_SESSION['customer']['id_customer']);
		}else{
			mysql_query('insert into '._DB_PREFIX_.'address (id_customer,									address1,						postcode,						phone,							phone_mobile) values 
															("'.$_SESSION['customer']['id_customer'].'",	"'.$this->item['address'].'",	"'.$this->item['postcode'].'",	"'.$this->item['phone'].'",		"'.$this->item['mobile'].'"    )');
		}
		mysql_query('update '._DB_PREFIX_.'customer set lastname="'.$this->item['name'].'"  where id_customer='.$_SESSION['customer']['id_customer']);
		$_SESSION['customer']['lastname']=$this->item['name'];
	}
	//修改密码
	public function My_password(){
		mysql_query('update '._DB_PREFIX_.'customer set passwd="'.md5(trim($this->item['passwd'])).'"  where id_customer='.$_SESSION['customer']['id_customer']);
	}
	
	
	//判断是否已购买
	public function Is_buyed($id_product){
		$is_buyed=false;
		if(isset($_SESSION['customer'])){
			global $DB;
			$is_buyed=$DB->Get_one('select '._DB_PREFIX_.'order_detail.id_order 
								   from '._DB_PREFIX_.'orders,'._DB_PREFIX_.'order_detail
								   where '._DB_PREFIX_.'order_detail.product_id='.$id_product.' 
								   and '._DB_PREFIX_.'orders.id_customer='.$_SESSION['customer']['id_customer'].' 
								   and '._DB_PREFIX_.'orders.id_order='._DB_PREFIX_.'order_detail.id_order');
		}
		return $is_buyed;
	}
	//获取订单列表
	public function Order_list(){
		global $DB;
		
		$products_list=array();
		//初始化产品查询SQL语句
		$products_query='select distinct '._DB_PREFIX_.'product.id_product,	'._DB_PREFIX_.'product.date_add,	'._DB_PREFIX_.'product_lang.name,	'._DB_PREFIX_.'product_lang.description_short		,'._DB_PREFIX_.'order_detail.id_order                                                              
		from '._DB_PREFIX_.'product,'._DB_PREFIX_.'product_lang,'._DB_PREFIX_.'orders,'._DB_PREFIX_.'order_detail
		where '._DB_PREFIX_.'product.id_product='._DB_PREFIX_.'product_lang.id_product 
		and '._DB_PREFIX_.'product.id_product='._DB_PREFIX_.'order_detail.product_id
		and '._DB_PREFIX_.'orders.id_order='._DB_PREFIX_.'order_detail.id_order 
		and '._DB_PREFIX_.'orders.id_customer='.$_SESSION['customer']['id_customer'];
		//echo $products_query;
		
		$products=mysql_query($products_query);
		while($product=mysql_fetch_assoc($products)){
			if(!$product['description_short']){
				$product['description_short']='暂无任何描述';
			}
			
			//图片
			$id_image=$DB->Get_one('select id_image from '._DB_PREFIX_.'image where id_product='.$product['id_product']);
			if($id_image){
				$image_arr=str_split($id_image);
				$product['image']=MARKET_INDEX.'/img/p/'.$image_arr[0].'/'.$image_arr[1].'/'.$id_image.'.jpg';
			}else{
				$product['image']=LINK_ROOT.'/images/num_11.jpg';
			}
			$products_list[]=$product;
		}
		return $products_list;
	}
	//退订
	public function Order_del(){
		mysql_query('delete from '._DB_PREFIX_.'orders where '._DB_PREFIX_.'orders.id_order='.$this->item['id_order']);
		mysql_query('delete from '._DB_PREFIX_.'order_detail where  '._DB_PREFIX_.'order_detail.id_order='.$this->item['id_order']);
	}
	
	//获取在售列表
	public function Sell_list(){
		global $DB;
		$company=$DB->Get_one('select company from ps_address where id_customer='.$_SESSION['customer']['id_customer']);

		$products_list=array();
		//初始化产品查询SQL语句
		$products_query='select distinct 	'._DB_PREFIX_.'product.id_product,		'._DB_PREFIX_.'product.date_add,		'._DB_PREFIX_.'product_lang.name,		'._DB_PREFIX_.'product_lang.description_short                                                              
		from '._DB_PREFIX_.'product
		left join '._DB_PREFIX_.'manufacturer on 	'._DB_PREFIX_.'product.id_manufacturer='._DB_PREFIX_.'manufacturer.id_manufacturer
		,'._DB_PREFIX_.'product_lang 
		where '._DB_PREFIX_.'product.id_product='._DB_PREFIX_.'product_lang.id_product
		and '._DB_PREFIX_.'manufacturer.name="'.$company.'" ';
		
		$products=mysql_query($products_query);
		while($product=mysql_fetch_assoc($products)){
			if(!$product['description_short']){
				$product['description_short']='暂无任何描述';
			}
			
			//图片
			$id_image=$DB->Get_one('select id_image from '._DB_PREFIX_.'image where id_product='.$product['id_product']);
			if($id_image){
				$image_arr=str_split($id_image);
				$product['image']=MARKET_INDEX.'/img/p/'.$image_arr[0].'/'.$image_arr[1].'/'.$id_image.'.jpg';
			}else{
				$product['image']=LINK_ROOT.'/images/num_11.jpg';
			}
			$products_list[]=$product;
		}
		
		return $products_list;
	}
	
	//获取收藏列表
	public function Favorate_list(){
		global $DB;
		//产品列表
		$products_list=array();
		//初始化产品查询SQL语句
		$products_query='select distinct '._DB_PREFIX_.'product.id_product,	'._DB_PREFIX_.'product.date_add,	'._DB_PREFIX_.'product_lang.name,	'._DB_PREFIX_.'product_lang.description_short                                                              
		from '._DB_PREFIX_.'product,'._DB_PREFIX_.'product_lang,'._DB_PREFIX_.'favorite_product
		where '._DB_PREFIX_.'product.id_product='._DB_PREFIX_.'product_lang.id_product 
		and '._DB_PREFIX_.'product.id_product='._DB_PREFIX_.'favorite_product.id_product
		and '._DB_PREFIX_.'favorite_product.id_customer='.$_SESSION['customer']['id_customer'];
		
		
		$products=mysql_query($products_query);
		while($product=mysql_fetch_assoc($products)){
			if(!$product['description_short']){
				$product['description_short']='暂无任何描述';
			}
			
			//图片
			$id_image=$DB->Get_one('select id_image from '._DB_PREFIX_.'image where id_product='.$product['id_product']);
			if($id_image){
				$image_arr=str_split($id_image);
				$product['image']=MARKET_INDEX.'/img/p/'.$image_arr[0].'/'.$image_arr[1].'/'.$id_image.'.jpg';
			}else{
				$product['image']=LINK_ROOT.'/images/num_11.jpg';
			}
			$products_list[]=$product;
		}
		return $products_list;
	}
	//取消收藏
	public function Favorate_del(){
		mysql_query('delete from '._DB_PREFIX_.'favorite_product where id_product='.$this->item['id_product'].' and id_customer='.$_SESSION['customer']['id_customer']);
	}
	
	
}
?>