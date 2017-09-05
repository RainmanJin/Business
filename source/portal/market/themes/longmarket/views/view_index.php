<?php
require_once(FILE_ROOT.'/classes/class_product.php');
$Product=new Product($_GET);
$Index_result=$Product->Index_result();

//左侧个数
$pricetype_quantity=$Index_result['pricetype_quantity'];
$productype_quantity=$Index_result['productype_quantity'];
$category_quantity=$Index_result['category_quantity'];
$manufacturer_quantity=$Index_result['manufacturer_quantity'];

//产品列表
$products_num=$Index_result['products_num'];
$products_list=$Index_result['products_list'];
$page_bottom=$Index_result['page_bottom'];
?>
  <?php require(FILE_ROOT.'/views/view_header.php'); ?>
  
  <div class="Main">
  
    <?php require(FILE_ROOT.'/views/view_left.php'); ?>
    
    <div class="Right">
      <!--结果清除-->
      <div class="jieguo">
		<?php echo $products_num; ?>个结果：
        <?php
		if($clear_arr){
			foreach($clear_arr as $get=>$clear){
				if($get=='category'){
					foreach($clear as $id=>$c){
						if($id>2){
				?>
                            <a href="javascript:;" onclick="url_change('replace','index.php','<?php echo $get; ?>','<?php echo $id; ?>')"><?php echo $c; ?> <span class="off"><img src="<?php echo LINK_ROOT; ?>/images/off.png" width="12" height="12" /></span></a>
				<?php
						}else{
						?>
							<a href="javascript:;" onclick="url_change('all','index.php','<?php echo $get; ?>')"><?php echo $c; ?> <span class="off"><img src="<?php echo LINK_ROOT; ?>/images/off.png" width="12" height="12" /></span></a>
						<?php
						}
					}
				}else{
				?>
                    <a href="javascript:;" onclick="url_change('all','index.php','<?php echo $get; ?>')"><?php echo $clear; ?> <span class="off"><img src="<?php echo LINK_ROOT; ?>/images/off.png" width="12" height="12" /></span></a>
				<?php
				}
			}
		}else{
			echo '全部';
		}
		?>
      </div>
      
      <!--排序-->
      <div class="px">
        <ul>
          <li class="no">排序：</li>
          <?php
		  if(isset($_GET['st'])){
			 $st=explode('_',$_GET['st'])[0]; 
		  }else{
			 $st='dateadd';
		  }
		  ?>
          <li <?php if($st=='quantity'){echo 'class="green"';} ?>><a href="javascript:;" onclick="list_sort('quantity','asc')">销量</a></li>
          <li <?php if($st=='dateadd'){echo 'class="green"';} ?>><a href="javascript:;" onclick="list_sort('dateadd','asc')">发布时间</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      
      <!--产品列表-->
	  <?php
	  if(count($products_list)>0){
		  foreach($products_list as $product){
		  ?>
			  <div class="news">
				<div class="news_L"><a href="<?php echo MARKET_INDEX; ?>/index.php?view=product&id_product=<?php echo $product['id']; ?>" target="_blank"><img src="<?php echo $product['image']; ?>" width="121" height="124" /></a></div>
				<div class="news_R">
				  <h1><a href="<?php echo MARKET_INDEX; ?>/index.php?view=product&id_product=<?php echo $product['id']; ?>" target="_blank"><?php echo $product['name']; ?></a></h1>
				  <ul>
					<?php /*?><li>价格类型：<?php echo $product['pricetype']; ?></li><?php */?>
					<li>产品类型：<?php echo $product['productype']; ?></li>
					<?php /*?><li>行业分类：<?php echo join('&nbsp;',$product['category']) ?></li><?php */?>
					<li>发布者：<?php echo $product['manufacturer']; ?></li>
					<li>发布时间：<?php echo $product['dateadd']; ?></li>
				  </ul>
				  <div class="clear"></div>
				  <p><a href="<?php echo MARKET_INDEX; ?>/index.php?view=product&id_product=<?php echo $product['id']; ?>" target="_blank"><?php echo $product['description_short']; ?></a></p>
				</div>
				<div class="clear"></div>
			  </div>
		  <?php	
		  }
	  }else{
      ?>
          <div class="news">暂无任何产品</div>
      <?php
	  }
	  ?>
      <!--分页-->
      <div class="digg">
        <?php echo $page_bottom; ?>
      </div>
      
      <div class="clear"></div>
    </div>
    <!--/Right 结束-->
    
    <div class="clear"></div>
  </div>
  <!--/Main 结束-->
  
  <?php require(FILE_ROOT.'/views/view_footer.php'); ?>

