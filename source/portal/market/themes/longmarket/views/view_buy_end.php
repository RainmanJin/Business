<?php 
if(!isset($_SESSION['customer'])){
	header('location:'.UNITY_INDEX.'/index.php?view=login&site=market');
}

$is_payed=true;

$is_buyed=$Customer->Is_buyed($_GET['id_product']);
if(!$is_buyed&&$is_payed){
	include_once(FILE_ROOT.'/classes/class_product.php');
	$Product=new Product($_GET);
	$Product->Buy_end();
}

$title='完成';
?>

<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/css/global.css" type="text/css" />

<div class="Main">
    
    <div id="center_column" class="center_column col-xs-12 col-sm-12">
      <ul class="step clearfix" id="order_step">
        <li class="step_todo  first" style="width:33%"> <span><em>01.</em> 产品订阅信息 </span> </li>
        <li class="step_todo second" style="width:33%"> <span><em>02.</em> 支付 </span> </li>
        <li class="step_current last" style="width:33%" id="step_end"> <span><em>03.</em> 完成 </span>
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
            <td style="font-weight:bold; width:120px">订阅选择：</td>
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
        <div class="prouduct_L" style="height:auto; border-bottom:0"><img src="<?php echo $_GET['image']; ?>" width="121" height="124" /></div>
        <div class="prouduct_R" style="height:auto; border-bottom:0; float:left">
          <h1><a href="<?php echo MARKET_INDEX; ?>/index.php?view=use&id_product=<?php echo $_GET['id_product']; ?>">使用数据产品</a></h1>
          <div class="clear"></div>
          <ul>
            <li><a href="<?php echo MARKET_INDEX; ?>/index.php?view=use&id_product=<?php echo $_GET['id_product']; ?>">启动交互式的数据产品分析管理工具</a></li>
          </ul>
        </div>
        <div class="clear"></div>
      </div>
       
    </div>
    <div class="clear"></div>
  </div>

<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
