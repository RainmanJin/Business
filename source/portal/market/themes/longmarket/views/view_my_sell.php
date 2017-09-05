<?php 
if(!isset($_SESSION['customer'])){
	header('location:'.UNITY_INDEX.'/index.php?view=login&site=market');
}

$products_list=$Customer->Sell_list();

$title='在售产品';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div class="Main">

  <?php require(FILE_ROOT.'/views/view_my_left.php'); ?>
  
  <div class="my_right">
    <h2><?php echo $title ?></h2>
   
    <table border="0" width="100%" cellpadding="5" cellspacing="2" class="my_table">
      <thead>
        <tr>
          <th width="64%">产品</th>
          <th width="12%">类型</th>
          <th width="12%">状态</th>
          <th width="12%">操作</th>
        </tr>
      </thead>
      <tbody>
	  <?php
	  if(count($products_list)>0){
		  foreach($products_list as $product){
		  ?>
          <tr>
            <td class="my_table_td">
            
              <table border="0" cellpadding="5" cellspacing="0" width="100%">
                <tr>
                  <td rowspan="3" width="20%">
                    <a href="<?php echo MARKET_INDEX; ?>/index.php?view=product&id_product=<?php echo $product['id_product']; ?>" target="_blank">
                    <img src="<?php echo $product['image']; ?>" width="121" height="124" />
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="<?php echo MARKET_INDEX; ?>/index.php?view=product&id_product=<?php echo $product['id_product']; ?>" target="_blank">
                    <?php echo $product['name']; ?>
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>
                    <a href="<?php echo MARKET_INDEX; ?>/index.php?view=product&id_product=<?php echo $product['id_product']; ?>" target="_blank">
                    <?php echo $product['description_short']; ?>
                    </a>
                  </td>
                </tr>
               </table>
            
            </td>
            
            
            <td align="center" class="my_table_td">
            订阅
            </td>
            
            <td align="center" class="my_table_td">
            活动
            </td>
            
            <td align="center" class="my_table_td"><button class="trash" onclick="pop_alert('请联系网站管理员')">下架</button></td>
          </tr>
		  <?php	
		  }
	  }else{
      ?>
          <tr><td align="center" colspan="4" class="my_table_td">暂无任何产品</td></tr>
      <?php
	  }
	  ?>
      </tbody>
    </table>
  
  </div>
  
</div>

<script type="text/javascript">
$(document).ready(function(){
						   
});
</script>

<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>