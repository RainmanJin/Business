<?php 
if(!isset($_SESSION['customer'])){
	header('location:'.UNITY_INDEX.'/index.php?view=login&site=market');
}

$is_buyed=$Customer->Is_buyed($_GET['id_product']);
if($is_buyed){
	//header('location:'. MARKET_INDEX.'/index.php?view=product&id_product='.$_GET['id_product']);
	echo '<script>alert("您已订阅该产品");window.location="'.MARKET_INDEX.'/index.php?view=product&id_product='.$_GET['id_product'].'"</script>';
}

$current_url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$next_url=str_replace('view=buy','view=buy_pay',$current_url);

$title='订阅';
?>

<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/css/global.css" type="text/css" />

<div class="Main">
    
    <div id="center_column" class="center_column col-xs-12 col-sm-12">
      <ul class="step clearfix" id="order_step">
        <li class="step_current  first" style="width:33%"> <span><em>01.</em> 产品订阅信息 </span> </li>
        <li class="step_todo second" style="width:33%"> <span><em>02.</em> 支付 </span> </li>
        <li class="step_todo last" style="width:33%" id="step_end"> <span><em>03.</em> 完成 </span>
      </ul>
      
      <div id="order-detail-content" class="table_block table-responsive">
        <div class="prouduct_L" style="height:auto; border-bottom:0"><img src="<?php echo $_GET['image']; ?>" width="121" height="124" /></div>
        <div class="prouduct_R" style="height:auto; border-bottom:0; float:left">
          <h1>
            <?php echo $_GET['name']; ?>
          </h1>
          <div class="clear"></div>
          <ul>
            <li>发布者：<?php echo $_GET['manufacturer']; ?></li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>
      
      <div style="margin-top:10px">
        <table border="0" cellpadding="10" style="color:#000">
          <tr>
            <td style="font-weight:bold; width:104px">订阅选择：</td>
            <td>订阅<?php echo $_GET['from_quantity']; ?>事务</td>
          </tr>
          <tr>
            <td style="font-weight:bold">价格：</td>
            <td>
            <?php
            if($_GET['lastprice']==0){
            ?>
                免费
            <?php
            }else{
            ?>
                ￥<?php echo $_GET['lastprice']; ?>
            <?php
            }
            ?>
            ，开始于&nbsp;<?php echo date('Y-m-d',time()); ?>，可通过<a href="<?php echo MARKET_INDEX; ?>/index.php?view=my_order" style="color:blue">我的账户</a>取消订阅</td>
          </tr>
        </table>
      </div>
      
      <div class="cart_navigation clearfix" style="border-top:1px dashed #ccc; padding-top:10px"> 
        <p>
          <a href="<?php echo MARKET_INDEX; ?>/index.php?view=product&id_product=<?php echo $_GET['id_product']; ?>"  title="取消" style="color:red"> <!--<i class="icon-chevron-left"></i>-->< 取消</a>
          <span style="float:right"><input type="checkbox" id="agreelist" checked="checked" /><a href="<?php echo CLOUD_INDEX; ?>/index.php/0" target="_blank">我已阅读并同意服务条款和隐私政策</a></span>
          <div class="clear"></div>
        </p>
        
        <p>
          <input type="hidden" id="next_url" value="<?php echo $next_url; ?>" />
          <a href="javascript:;" onclick="buy()" class="button btn btn-default standard-checkout button-medium" title="订阅"> 
            <span>订阅<!--<i class="icon-chevron-right right"></i>--></span> 
          </a>
        </p>
      </div>
      
    </div>
    <div class="clear"></div>
  </div>
  
<script type="text/javascript">
function buy(){
  	if(!document.getElementById('agreelist').checked){
		pop_alert('请先同意使用条例！');
		return false;
	}
	window.location=$('#next_url').val();
}
</script>


<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
