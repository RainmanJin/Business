<?php
$clear_arr=array();//结果清除	
$features_list=$Product->Feature();
$categorys=$Product->Category();
$categorys_arr=$categorys['categorys_arr'];
$categorys_list=$categorys['categorys_list'];
$manufacturers_list=$Product->Manufacturer();
?>
	
    <div class="Left">
      <!--下拉菜单-->
      <div class="classification">
       <ul class="menu1">
          <li class="li_3"><a class="noclick" href="#" target="_blank"> 全部数据产品分类</a>
            <dl class="li_3_content">
			  <?php
              foreach($categorys_arr as $category){
				  if(isset($_GET['view'])){
              ?>
                      <dd><a href="<?php echo MARKET_INDEX; ?>/index.php?category=<?php echo $category['id_category']; ?>"><span><?php echo $category['name']; ?></span></a></dd>
              <?php
				  }else{
              ?>
                      <dd><a href="javascript:;" onclick="url_change('replace','index.php','category','<?php echo $category['id_category']; ?>')"><span><?php echo $category['name']; ?></span></a></dd>
              <?php
				  }
			  }
              ?>
            </dl>
          </li>
        </ul>
      </div>    
      
      <!--价格类型和产品类型-->
	  <?php
	  foreach($features_list as $feature){
      ?>
          <div class="products">
            <h1><?php echo $feature['name']; ?></h1>
            <ul>
            <?php
            foreach($feature['value'] as $feature_value){
				
				if(isset($_GET['view'])){
            ?>
                    <li class="green"><a href="<?php echo MARKET_INDEX; ?>/index.php?<?php echo $feature_value['col']; ?>=<?php echo $feature_value['id_feature_value']; ?>"><?php echo $feature_value['value']; ?></a> <span>(<?php echo $feature_value['number'] ?>)</span></li>
            <?php
				}else{
            ?>
                    <li class="green"><a href="javascript:;" onclick="url_change('replace','index.php','<?php echo $feature_value['col']; ?>','<?php echo $feature_value['id_feature_value']; ?>')" <?php if($feature_value['selected']==$feature_value['id_feature_value']){echo 'style="background:#43b8f0;color:#fff"';} ?>><?php echo $feature_value['value']; ?></a> <span>(<?php echo $feature_value['number']; ?>)</span></li>
            <?php
				}
            }
            ?>
            </ul>
            <div class="clear"></div>
          </div>
      <?php
      }
      ?>
      
      <!--行业分类-->
      <div class="products">
        <h1>行业分类</h1>
        <ul>
          <?php
		  foreach($categorys_list as $category){
			  if(isset($_GET['view'])){
          ?>
                  <li><a href="<?php echo MARKET_INDEX; ?>/index.php?category=<?php echo $category['id_category']; ?>"><?php echo $category['name']; ?></a> <span>(<?php echo $category['number']; ?>)</span></li>
          <?php	
			  }else{
          ?>
                  <li><a href="javascript:;" onclick="url_change('replace','index.php','category','<?php echo $category['id_category']; ?>')" <?php if($category['selected']==$category['id_category']){echo 'style="background:#43b8f0;color:#fff"';} ?>><?php echo $category['name']; ?></a> <span>(<?php echo $category['number']; ?>)</span></li>
          <?php	
			  }
          }
          ?>
        </ul>
        <div class="clear"></div>
      </div>
      
      <!--发布者-->
      <div class="products">
        <h1>发布者</h1>
        <ul>
          <?php
		  foreach($manufacturers_list as $manufacturer){
			  if(isset($_GET['view'])){
          ?>
                  <li><a href="<?php echo MARKET_INDEX; ?>/index.php?manufacturer=<?php echo $manufacturer['id_manufacturer']; ?>"><?php echo $manufacturer['name']; ?></a> <span>(<?php echo $manufacturer['number'] ?>)</span></li>
          <?php
			  }else{
          ?>
                  <li><a href="javascript:;" onclick="url_change('replace','index.php','manufacturer','<?php echo $manufacturer['id_manufacturer']; ?>')" <?php if($manufacturer['selected']==$manufacturer['id_manufacturer']){echo 'style="background:#43b8f0;color:#fff"';} ?>><?php echo $manufacturer['name']; ?></a> <span>(<?php echo $manufacturer['number']; ?>)</span></li>
          <?php
			  }
          }
          ?>
        </ul>
        <div class="clear"></div>
      </div>
    </div>
    <!--Left 结束-->
