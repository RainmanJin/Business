<?php
class Product{
	
	public function __construct($item=false){
		$this->item=$item;
	}
	
	####################
	#主页
	####################
	
	//产品列表
	public function Index_result(){
		global $DB;
		
		//左侧个数
		$pricetype_quantity=array();
		$productype_quantity=array();
		$category_quantity=array();
		$manufacturer_quantity=array();
		
		//产品列表
		$products_list=array();
		
		
		//初始化产品查询SQL语句
		$products_query='select distinct 	'._DB_PREFIX_.'product.id_product,		'._DB_PREFIX_.'product.date_add,		'._DB_PREFIX_.'product_lang.name,		'._DB_PREFIX_.'product_lang.description_short,		'._DB_PREFIX_.'manufacturer.name                                                              
		from '._DB_PREFIX_.'product
		left join '._DB_PREFIX_.'product_sale on 	'._DB_PREFIX_.'product.id_product='._DB_PREFIX_.'product_sale.id_product 
		left join '._DB_PREFIX_.'manufacturer on 	'._DB_PREFIX_.'product.id_manufacturer='._DB_PREFIX_.'manufacturer.id_manufacturer
		,'._DB_PREFIX_.'product_lang 
		where '._DB_PREFIX_.'product.id_product='._DB_PREFIX_.'product_lang.id_product';
	
		//名称和搜索
		if(isset($this->item['kw'])){
			$products_query.=' and ('._DB_PREFIX_.'product_lang.name like "%'.trim($this->item['kw']).'%" or '._DB_PREFIX_.'product_lang.description like "%'.trim($this->item['kw']).'%")';
		}
		//发布者过滤
		if(isset($this->item['manufacturer'])){
			$products_query.=' and '._DB_PREFIX_.'manufacturer.id_manufacturer='.$this->item['manufacturer'];
		}
		//销量和发布时间的排序
		if(isset($this->item['st'])){
			$od=explode('_',$this->item['st'])[0];
			$by=explode('_',$this->item['st'])[1];
			switch($od){
				case 'dateadd';
				$od=_DB_PREFIX_.'product.date_add';
				break;
				
				case 'quantity':
				$od=_DB_PREFIX_.'product_sale.quantity';
				break;
				
				default:
				$od=_DB_PREFIX_.'product.date_add';
				break;
			}
			$products_query.=' order by '.$od.' '.$by;
		}else{
			$products_query.=' order by '._DB_PREFIX_.'product.date_add desc';
		}
		
		//获得产品列表
		$products_num=0;
		$products=mysql_query($products_query);
		while($product=mysql_fetch_row($products)){
			$product_arr=array();
			$product_arr['id']=$product[0];
			$product_arr['dateadd']=$product[1];
			
			//名称和描述的关键字高亮
			if(isset($this->item['kw'])){
				$product_arr['name']=str_replace(trim($this->item['kw']),'<font color=red>'.trim($this->item['kw']).'</font>',$product[2]);
				if($product[3]){
					$product_arr['description_short']=str_replace(trim($this->item['kw']),'<font color=red>'.trim($this->item['kw']).'</font>',$product[3]);
				}else{
					$product_arr['description_short']='暂无任何描述';
				}
			}else{
				$product_arr['name']=$product[2];
				if($product[3]){
					$product_arr['description_short']=$product[3];
				}else{
					$product_arr['description_short']='暂无任何描述';
				}
			}
			
			//发布者
			if($product[4]){
				$product_arr['manufacturer']=$product[4];
			}else{
				$product_arr['manufacturer']='-';
			}
			
			//图片
			$id_image=$DB->Get_one('select id_image from '._DB_PREFIX_.'image where id_product='.$product_arr['id']);
			if($id_image){
				$image_arr=str_split($id_image);
				$product_arr['image']=MARKET_INDEX.'/img/p/'.$image_arr[0].'/'.$image_arr[1].'/'.$id_image.'.jpg';
			}else{
				$product_arr['image']=LINK_ROOT.'/images/num_11.jpg';
			}
			
			//价格类型和产品类型的获取和过滤
			$features_list_num=0;
			$pricetype_pass=0;
			$productype_pass=0;
			$product_arr['pricetype']='-';
			$product_arr['productype']='-';
			$features_list=mysql_query('select distinct 	'._DB_PREFIX_.'feature_lang.name,		'._DB_PREFIX_.'feature_value_lang.id_feature_value,		'._DB_PREFIX_.'feature_value_lang.value        
								 from 						'._DB_PREFIX_.'feature_lang,			'._DB_PREFIX_.'feature_value_lang,						'._DB_PREFIX_.'feature_product         
								 where 		'._DB_PREFIX_.'feature_lang.id_feature='._DB_PREFIX_.'feature_product.id_feature 		
								 and		'._DB_PREFIX_.'feature_value_lang.id_feature_value='._DB_PREFIX_.'feature_product.id_feature_value    
								 and 		'._DB_PREFIX_.'feature_product.id_product='.$product_arr['id']);
			while($feature=mysql_fetch_assoc($features_list)){
				if(isset($this->item['pricetype'])){
					if($feature['name']=='价格类型'){
						if($feature['id_feature_value']==$this->item['pricetype']){
							$pricetype_pass=1;
						}
					}
				}else{
					$pricetype_pass=1;
				}
				if(isset($this->item['productype'])){
					if($feature['name']=='产品类型'){
						if($feature['id_feature_value']==$this->item['productype']){
							$productype_pass=1;
						}
					}
				}else{
					$productype_pass=1;
				}
				if($feature['name']=='价格类型'){
					$product_arr['pricetype']=$feature['value'];
				}
				if($feature['name']=='产品类型'){
					$product_arr['productype']=$feature['value'];
				}
				$features_list_num++;
			}
			if($features_list_num==0&&!isset($this->item['pricetype'])&&!isset($this->item['productype'])){
				$pricetype_pass=1;
				$productype_pass=1;
			}
			
			
			//行业分类的获取和过滤
			$category_pass=0;
			$id_category_arr=array();
			$product_arr['category']=array();
			$categorys_list=mysql_query('select id_category from '._DB_PREFIX_.'category_product where id_product='.$product_arr['id']);
			while($category=mysql_fetch_assoc($categorys_list)){
				$id_category_arr[]=$category['id_category'];
				$id_parent=$category['id_category'];
				do{
					$id_parent=$DB->Get_one('select id_parent from '._DB_PREFIX_.'category where id_category='.$id_parent);
					$id_category_arr[]=$id_parent;
				}while($id_parent>2);
			}
			$id_category_arr=array_unique($id_category_arr);
			sort($id_category_arr);
			foreach($id_category_arr as $id_category){
				if($id_category>2){
					if(isset($this->item['category'])){
						if($id_category==$this->item['category']){
							$category_pass=1;
						}
					}else{
						$category_pass=1;
					}
					$product_arr['category'][]=$DB->Get_one('select name from '._DB_PREFIX_.'category_lang where id_category='.$id_category);
				}
			}
			if($product_arr['category']){
				//$product_arr['category']=join('&nbsp;',$product_arr['category']);
			}else{
				if(!isset($this->item['category'])){
					$category_pass=1;
				}
				$product_arr['category']='-';
			}
			
			
			//判断过滤
			if($pricetype_pass==1&&$productype_pass==1&&$category_pass==1){
				$products_list[]=$product_arr;
				$products_num++;
			}
		}
		
		//个数统计
		foreach($products_list as $key=>$product){
			if($product['pricetype']!='-'){
				if(isset($pricetype_quantity[$product['pricetype']])){
					$pricetype_quantity[$product['pricetype']]++;
				}else{
					$pricetype_quantity[$product['pricetype']]=1;
				}
			}
			if($product['productype']!='-'){
				if(isset($productype_quantity[$product['productype']])){
					$productype_quantity[$product['productype']]++;
				}else{
					$productype_quantity[$product['productype']]=1;
				}
			}
			if($product['category']!='-'){
				foreach($product['category'] as $category){
					if(isset($category_quantity[$category])){
						$category_quantity[$category]++;
					}else{
						$category_quantity[$category]=1;
					}
				}
			}
			if($product['manufacturer']!='-'){
				if(isset($manufacturer_quantity[$product['manufacturer']])){
					$manufacturer_quantity[$product['manufacturer']]++;
				}else{
					$manufacturer_quantity[$product['manufacturer']]=1;
				}
			}
		}
		
		//分页
		require_once(FILE_ROOT.'/classes/class_page.php');
		if(isset($this->item['pg'])){
			$page=$this->item['pg'];
		}else{
			$page=1;
		}
		$Page=new Page($products_num,$page,PAGESIZE,'index.php');//新建分页类
		$kaishi=$Page->Page_limit();//加分页limit
		$page_bottom=$Page->Page_bottom();//获取分页底部	
		$products_list=array_slice($products_list,$kaishi,PAGESIZE);
		
		
		
		
		$Index_result=array('pricetype_quantity'=>$pricetype_quantity,
							'productype_quantity'=>$productype_quantity,
							'category_quantity'=>$category_quantity,
							'manufacturer_quantity'=>$manufacturer_quantity,
							'products_num'=>$products_num,
							'products_list'=>$products_list,
							'page_bottom'=>$page_bottom);
		return $Index_result;
	}
	
	####################
	#左侧
	####################
	
	//左侧价格类型和产品类型
	public function Feature(){
		global $clear_arr;
		global $pricetype_quantity;
		global $productype_quantity;
		
		$features_list=array();
		$features=mysql_query('select distinct '._DB_PREFIX_.'feature.id_feature,	'._DB_PREFIX_.'feature_lang.name,	'._DB_PREFIX_.'layered_indexable_feature_lang_value.meta_title 
							  from '._DB_PREFIX_.'feature,	'._DB_PREFIX_.'feature_lang,	'._DB_PREFIX_.'layered_indexable_feature_lang_value 
							  where '._DB_PREFIX_.'feature.id_feature='._DB_PREFIX_.'feature_lang.id_feature 
							  and '._DB_PREFIX_.'feature.id_feature='._DB_PREFIX_.'layered_indexable_feature_lang_value.id_feature');
		while($feature=mysql_fetch_assoc($features)){
			
			$feature['value']=array();
			$feature_values=mysql_query('select distinct '._DB_PREFIX_.'feature_value.id_feature_value,	'._DB_PREFIX_.'feature_value_lang.value 
										from '._DB_PREFIX_.'feature_value,	'._DB_PREFIX_.'feature_value_lang 
										where '._DB_PREFIX_.'feature_value.id_feature_value='._DB_PREFIX_.'feature_value_lang.id_feature_value 
										and id_feature='.$feature['id_feature']);
			while($feature_value=mysql_fetch_assoc($feature_values)){
				//判断特性
				if($feature['meta_title']){
					$feature_value['col']=$feature['meta_title'];
				}else{
					switch($feature['name']){
						case '价格类型':
						$feature_value['col']='pricetype';
						break;
						
						case '产品类型':
						$feature_value['col']='productype';
						break;
						
						default:
						$feature_value['col']='pricetype';
						break;
					}
				}
				//获得被选择的值和清除栏元素
				$feature_value['selected']=0;
				if(isset($this->item[$feature_value['col']])){
				   $feature_value['selected']=$this->item[$feature_value['col']];
				   if($feature_value['selected']==$feature_value['id_feature_value']){
					   $clear_arr[$feature_value['col']]=$feature_value['value'];
				   }
				}
				//获得该选项的数量
				$feature_value['number']=0;
				if($pricetype_quantity){
					foreach($pricetype_quantity as $key=>$quantity){
						if($key==$feature_value['value']){
							$feature_value['number']=$quantity;
							break;
						}
					}
				}
				//获得该选项的数量
				if($productype_quantity){
					foreach($productype_quantity as $key=>$quantity){
						if($key==$feature_value['value']){
							$feature_value['number']=$quantity;
							break;
						}
					}
				}
				$feature['value'][]=$feature_value;
			}
			$features_list[]=$feature;
			
		}
				
		return $features_list;
	}
	
	//左侧行业分类
	public function Category(){
		global $DB;
		global $clear_arr;
		global $category_quantity;
		
		$categorys_arr=array();
		$categorys=mysql_query('select distinct '._DB_PREFIX_.'category.id_category,	'._DB_PREFIX_.'category_lang.name 
							   from '._DB_PREFIX_.'category,	'._DB_PREFIX_.'category_lang 
							   where '._DB_PREFIX_.'category.id_category='._DB_PREFIX_.'category_lang.id_category and '._DB_PREFIX_.'category.id_parent=2');
		while($category=mysql_fetch_assoc($categorys)){
			$categorys_arr[]=$category;
		}
		
		$categorys_list=array();
		
		$children_list=array();
		$parent_list=array();
		
		if(isset($this->item['category'])){
			//找儿子
			$children=mysql_query('select distinct '._DB_PREFIX_.'category.id_category,	'._DB_PREFIX_.'category_lang.name 
								  from '._DB_PREFIX_.'category,	'._DB_PREFIX_.'category_lang 
								  where '._DB_PREFIX_.'category.id_category='._DB_PREFIX_.'category_lang.id_category and '._DB_PREFIX_.'category.id_parent='.$this->item['category']);
			while($category=mysql_fetch_assoc($children)){
				$category['selected']=0;
				/*$category['selected']=$this->item['category'];
				if($category['selected']==$category['id_category']){
				   $clear_arr['category']=$category['name'];
				}*/
				$category['number']=0;
				if($category_quantity){
					foreach($category_quantity as $key=>$quantity){
						if($key==$category['name']){
							$category['number']=$quantity;
							break;
						}
					}
				}
				$children_list[]=$category;
			}
			
			//找父亲
			$id_category_arr=array();
			$id_category_arr[]=$this->item['category'];
			$id_parent=$this->item['category'];
			do{
				$id_parent=$DB->Get_one('select id_parent from '._DB_PREFIX_.'category where id_category='.$id_parent);
				//echo $id_parent.'<Br>';
				$id_category_arr[]=$id_parent;
			}while($id_parent>2);
			$id_category_arr=array_unique($id_category_arr);
			sort($id_category_arr);
			foreach($id_category_arr as $key=>$id_category){
				if($id_category>2){
					$id_brother=$id_category_arr[$key-1];
					$parent_list[$id_category_arr[$key-1]]=$DB->Get_one('select name from '._DB_PREFIX_.'category_lang where id_category='.$id_category);
					//$clear_arr['category'][$id_category]==$DB->Get_one('select name from '._DB_PREFIX_.'category_lang where id_category='.$id_category);
				}
			}
			$clear_arr['category']=$parent_list;
		}
		
		if($children_list){
			$categorys_list=$children_list;
		}else{
			if($parent_list){
				$brother=mysql_query('select distinct '._DB_PREFIX_.'category.id_category,	'._DB_PREFIX_.'category_lang.name 
									 from '._DB_PREFIX_.'category,	'._DB_PREFIX_.'category_lang
									 where '._DB_PREFIX_.'category.id_category='._DB_PREFIX_.'category_lang.id_category and '._DB_PREFIX_.'category.id_parent='.$id_brother);
				while($category=mysql_fetch_assoc($brother)){
					$category['selected']=$this->item['category'];
					$category['number']=0;
					if($category_quantity){
						foreach($category_quantity as $key=>$quantity){
							if($key==$category['name']){
								$category['number']=$quantity;
								break;
							}
						}
					}
					$categorys_list[]=$category;
				}
			}else{
				foreach($categorys_arr as $category){
					//获得被选择的值和清除栏元素
					$category['selected']=0;
					if(isset($this->item['category'])){
					   $category['selected']=$this->item['category'];
					   if($category['selected']==$category['id_category']){
						   $clear_arr['category']=$category['name'];
					   }
					}
					//获得该选项的数量
					$category['number']=0;
					if($category_quantity){
						foreach($category_quantity as $key=>$quantity){
							if($key==$category['name']){
								$category['number']=$quantity;
								break;
							}
						}
					}
					$categorys_list[]=$category;
				}
			}
		}
		
		$categorys=array('categorys_arr'=>$categorys_arr,'categorys_list'=>$categorys_list);
		return $categorys;
		
	}
	
	//左侧发布者
	public function Manufacturer(){
		global $clear_arr;
		global $manufacturer_quantity;
		
		$manufacturers_list=array();
		$manufacturers=mysql_query('select distinct id_manufacturer,name from '._DB_PREFIX_.'manufacturer');
		while($manufacturer=mysql_fetch_assoc($manufacturers)){
			
			//获得被选择的值和清除栏元素
			$manufacturer['selected']=0;
			if(isset($this->item['manufacturer'])){
			   $manufacturer['selected']=$this->item['manufacturer'];
			   if($manufacturer['selected']==$manufacturer['id_manufacturer']){
				   $clear_arr['manufacturer']=$manufacturer['name'];
			   }
			}
			
			//获得该选项的数量
			$manufacturer['number']=0;
			if($manufacturer_quantity){
				foreach($manufacturer_quantity as $key=>$quantity){
					if($key==$manufacturer['name']){
						$manufacturer['number']=$quantity;
						break;
					}
				}
			}
			$manufacturers_list[]=$manufacturer;
		}
		
		return $manufacturers_list;
	}
	
	
	####################
	#产品页
	####################
	
	//产品详情
	public function Detail(){
		global $DB;
		
		//获取用户id
		if(isset($_SESSION['customer'])){
			$id_customer=$_SESSION['customer']['id_customer'];
		}else{
			$id_customer=0;
		}
		
		//获取产品
		$product=$DB->Get_arr('select  '._DB_PREFIX_.'product.price,  '._DB_PREFIX_.'product.date_add,  '._DB_PREFIX_.'product_lang.name,  '._DB_PREFIX_.'product_lang.description,  '._DB_PREFIX_.'manufacturer.name,  '._DB_PREFIX_.'image.id_image,  '._DB_PREFIX_.'favorite_product.id_favorite_product 
			from '._DB_PREFIX_.'product
			left join 		'._DB_PREFIX_.'manufacturer 		on		 '._DB_PREFIX_.'product.id_manufacturer='._DB_PREFIX_.'manufacturer.id_manufacturer
			left join		'._DB_PREFIX_.'image				on		 '._DB_PREFIX_.'image.id_product='.$this->item['id_product'].'
			left join		'._DB_PREFIX_.'favorite_product		on		 '._DB_PREFIX_.'favorite_product.id_product='.$this->item['id_product'].' and id_customer='.$id_customer.' 
			,'._DB_PREFIX_.'product_lang
			where '._DB_PREFIX_.'product.id_product='._DB_PREFIX_.'product_lang.id_product 
			and '._DB_PREFIX_.'product.id_product='.$this->item['id_product'],MYSQL_NUM);
		
		if($product){
			$product['price']=$product[0];//单价
			$product['dateadd']=$product[1];
			$product['name']=$product[2];
			//说明
			if($product[3]){
				$product['description']=$product[3];
			}else{
				$product['description']='<p>暂无任何说明</p>';
			}
			//发布者
			if($product[4]){
				$product['manufacturer']=$product[4];
			}else{
				$product['manufacturer']='-';
			}
			//图片
			if($product[5]){
				$image_arr=str_split($product[5]);
				$product['image']=MARKET_INDEX.'/img/p/'.$image_arr[0].'/'.$image_arr[1].'/'.$product[5].'.jpg';
			}else{
				$product['image']=LINK_ROOT.'/images/num_11.jpg';
			}
			$product['id_favorite_product']=$product[6];//当前用户是否已收藏该产品
			
			//价格类型和产品类型
			$product['pricetype']='-';
			$product['productype']='-';
			$features_list=mysql_query('select  	'._DB_PREFIX_.'feature_lang.name,		'._DB_PREFIX_.'feature_value_lang.id_feature_value,		'._DB_PREFIX_.'feature_value_lang.value        
										from 		'._DB_PREFIX_.'feature_lang,			'._DB_PREFIX_.'feature_value_lang,						'._DB_PREFIX_.'feature_product         
										where 		'._DB_PREFIX_.'feature_lang.id_feature='._DB_PREFIX_.'feature_product.id_feature 		
										and 		'._DB_PREFIX_.'feature_value_lang.id_feature_value='._DB_PREFIX_.'feature_product.id_feature_value    
										and 		'._DB_PREFIX_.'feature_product.id_product='.$this->item['id_product']);
			while($feature=mysql_fetch_assoc($features_list)){
				if($feature['name']=='价格类型'){
					$product['pricetype']=$feature['value'];
				}
				if($feature['name']=='产品类型'){
					$product['productype']=$feature['value'];
				}
			}
			
			//行业分类
			$id_category_arr=array();
			$product['category']=array();
			$categorys_list=mysql_query('select id_category from '._DB_PREFIX_.'category_product where id_product='.$this->item['id_product']);
			while($category=mysql_fetch_assoc($categorys_list)){
				$id_category_arr[]=$category['id_category'];
				$id_parent=$category['id_category'];
				do{
					$id_parent=$DB->Get_one('select id_parent from '._DB_PREFIX_.'category where id_category='.$id_parent);
					$id_category_arr[]=$id_parent;
				}while($id_parent>2);
			}
			$id_category_arr=array_unique($id_category_arr);
			sort($id_category_arr);
			foreach($id_category_arr as $id_category){
				if($id_category>2){
					$category_name=$DB->Get_one('select name from '._DB_PREFIX_.'category_lang where id_category='.$id_category);
					$product['category'][]='<span style="background:#ccc">'.$category_name.'</span>';
					$category_quantity[$category_name]=1;
				}
			}
			if($product['category']){
				$product['category']=join('&nbsp;',$product['category']);
			}else{
				$product['category']='-';
				$category_quantity=array();
			}
			
			//左侧个数
			$pricetype_quantity=array($product['pricetype']=>1);
			$productype_quantity=array($product['productype']=>1);
			//$category_quantity=array($product['category']=>1);
			$manufacturer_quantity=array($product['manufacturer']=>1);
			
			
			
			$Detail=array('pricetype_quantity'=>$pricetype_quantity,
						  'productype_quantity'=>$productype_quantity,
						  'category_quantity'=>$category_quantity,
						  'manufacturer_quantity'=>$manufacturer_quantity,
						  'product'=>$product);
			return $Detail;
		}else{
			echo '<script>window.location="'.MARKET_INDEX.'/index.php?view=404"</script>';
		}
		
	}
	
	
	//评论列表
	public function Comment_list(){
		global $DB;
		
		//获取评论配置
		$allowguests=$DB->Get_one('select value from '._DB_PREFIX_.'configuration where name="PRODUCT_COMMENTS_ALLOW_GUESTS"');//是否允许游客发表评论
		$moderate=$DB->Get_one('select value from '._DB_PREFIX_.'configuration where name="PRODUCT_COMMENTS_MODERATE"');//是否需要审核
		
		//获取评论
		$comments_list=array();
		$comments_arr=mysql_query('select * from '._DB_PREFIX_.'product_comment where id_product='.$this->item['id_product'].' order by date_add desc');
		while($comment=mysql_fetch_assoc($comments_arr)){
			if($moderate==0){
			   $comment['forbidden']=0;
			}else{
			   if($comment['validate']==0){
				   $comment['forbidden']=1;
			   }else{
				   $comment['forbidden']=0;
			   }
			}
			if($comment['id_customer']==0){
				$comment['customer_name']='游客';
			}
			$comments_list[]=$comment;
		}
		$comments=array('allowguests'=>$allowguests,'moderate'=>$moderate,'comments_list'=>$comments_list);
		return $comments;
	}
	
	//产品价格
	public function Price(){
		global $product;
		//获取价格
		$prices_list=array();
		$prices_arr=mysql_query('select * from '._DB_PREFIX_.'specific_price where id_product='.$this->item['id_product']);
		while($price=mysql_fetch_assoc($prices_arr)){
			if($price['from_quantity']==9999){
				$price['from_quantity']='无限';
				$price['lastprice']=intval($price['reduction']);
			}else{
				if($price['reduction_type']=='amount'){
					$price['lastprice']=$product['price']*$price['from_quantity']-$price['reduction'];
				}else{
					$price['lastprice']=$product['price']*$price['from_quantity']*$price['reduction'];
				}
			}
			$prices_list[]=$price;
		}
		return $prices_list;
	}
	
	//收藏
	public function Favorite(){
		  mysql_query('insert into '._DB_PREFIX_.'favorite_product (id_product,							id_customer,									id_shop,	date_add,								date_upd) 
									  			values ("'.$this->item['id_product'].'",	"'.$_SESSION['customer']['id_customer'].'",		"1",		"'.date('Y-m-d H:i:s',time()).'",		"'.date('Y-m-d H:i:s',time()).'"	)');
	}
	
	//发表评论
	public function Comment_send(){
		if(strtolower($this->item['validate'])==strtolower($_SESSION["autonum"])){
			if(isset($_SESSION['customer'])){
				$id_customer=$_SESSION['customer']['id_customer'];
				$customer_name=$_SESSION['customer']['lastname'];
			}else{
				$id_customer=0;
				$customer_name='';
			}
			
			mysql_query('insert into '._DB_PREFIX_.'product_comment (id_product,			   			id_customer,			id_guest,	title,	content,						customer_name,			grade,									validate,	deleted,	date_add) values ("'.$this->item['id_product'].'",	"'.$id_customer.'",		"0",		"",		"'.$this->item['comment'].'",	"'.$customer_name.'",	"'.$this->item['comment_grade'].'",		"0",		"0",		"'.date('Y-m-d H:i:s',time()).'" )');
		}else{
			echo 1;
		}
	}
	
	//购买完毕
	public function Buy_end(){
		$reference=rand(10000000,19999999);
		mysql_query('insert into '._DB_PREFIX_.'orders (reference,id_customer,id_address_delivery,date_add) values ("'.$reference.'","'.$_SESSION['customer']['id_customer'].'","1","'.date('Y-m-d H:i:s',time()).'")');
		$id_order=mysql_insert_id();
		mysql_query('insert into '._DB_PREFIX_.'order_detail (id_order,product_id,product_name,product_price) values ("'.$id_order.'","'.$this->item['id_product'].'","'.$this->item['name'].'","'.$this->item['lastprice'].'")');
		global $DB;
		$sale_arr=$DB->Get_arr('select * from '._DB_PREFIX_.'product_sale where id_product='.$this->item['id_product']);
		if($sale_arr){
			$quantity=intval($sale_arr['quantity']);
			$quantity++;
			mysql_query('update '._DB_PREFIX_.'product_sale set quantity='.$quantity.' where id_product='.$this->item['id_product']);
		}else{
			mysql_query('insert into '._DB_PREFIX_.'product_sale set id_product='.$this->item['id_product'].',quantity=1');
		}
	}
	
	//产品使用
	public function Using(){
		global $DB;
		//获取产品
		$product=$DB->Get_arr('select  '._DB_PREFIX_.'product.date_add,  '._DB_PREFIX_.'product_lang.name,  '._DB_PREFIX_.'product_lang.description_short,  '._DB_PREFIX_.'image.id_image
							  from '._DB_PREFIX_.'product
							  left join		'._DB_PREFIX_.'image				on		 '._DB_PREFIX_.'image.id_product='.$this->item['id_product'].'
							  ,'._DB_PREFIX_.'product_lang
							  where '._DB_PREFIX_.'product.id_product='._DB_PREFIX_.'product_lang.id_product 
							  and '._DB_PREFIX_.'product.id_product='.$this->item['id_product']);
		//说明
		if(!$product['description_short']){
			$product['description_short']='暂无任何描述';
		}
		//图片
		if($product['id_image']){
			$image_arr=str_split($product['id_image']);
			$product['image']=MARKET_INDEX.'/img/p/'.$image_arr[0].'/'.$image_arr[1].'/'.$product['id_image'].'.jpg';
		}else{
			$product['image']=LINK_ROOT.'/images/num_11.jpg';
		}
		return $product;
	}
}
?>