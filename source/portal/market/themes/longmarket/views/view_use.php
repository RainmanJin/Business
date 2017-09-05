<?php 
if(!isset($_SESSION['customer'])){
	header('location:'.UNITY_INDEX.'/index.php?view=login&site=market');
}

$is_buyed=$Customer->Is_buyed($_GET['id_product']);
if($is_buyed){
	include_once(FILE_ROOT.'/classes/class_product.php');
	$Product=new Product($_GET);
	$product=$Product->Using();
}

$title='产品使用';
?>

<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div class="Main">
<?php
if($is_buyed){
	?>
    <div style="border-bottom:1px solid #ccc">
      <table border="0" width="100%">
		<tr>
          <td width="15%" rowspan="2">
            <a href="<?php echo MARKET_INDEX; ?>/index.php?view=product&id_product=<?php echo $_GET['id_product']; ?>" target="_blank">
              <img src="<?php echo $product['image']; ?>" width="121" height="124" />
            </a>
          </td>
          <td>
            <a href="<?php echo MARKET_INDEX; ?>/index.php?view=product&id_product=<?php echo $_GET['id_product']; ?>" target="_blank" style="font-size:32px; font-weight:bold">
			  <?php echo $product['name']; ?>
            </a>
          </td>
        </tr>    
		<tr>
          <!--<td>&nbsp;</td>-->
          <td height="70">
            <!--使用说明：<br />-->
            <a href="<?php echo MARKET_INDEX; ?>/index.php?view=product&id_product=<?php echo $_GET['id_product']; ?>" target="_blank"><?php echo $product['description_short']; ?></a>
          </td>
        </tr>    
      </table>
    </div>
    
    <div style="width:100%; height:500px; border:0px solid #ccc; margin-top:30px">
      <iframe id="flash_iframe" src="<?php echo LINK_ROOT; ?>/demos2/DemoData.html" width="100%" height="100%" scrolling="no" frameborder="0"></iframe>
    </div>
    <?php
}else{
	echo '您还未购买该产品';
}
?>
</div>

<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>

<script>
$(document).ready(function(){
	//$('#flash_iframe').attr('src',$('#link_root').val()+'/demos2/DemoData.html');					   
});
</script>
