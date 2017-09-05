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
$next_url=str_replace('view=buy_pay','view=buy_end',$current_url);

$title='支付';
?>

<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/css/global.css" type="text/css" />

<style>

.pay{
	border-bottom:1px dashed #ccc;
	margin-top:30px;
	font-size:16px;
	line-height:50px;
}
.pay a{
	font-size:36px;
	color:#FFF;
	border:1px solid #fff;
}
</style>

<div class="Main">
    
  <div id="center_column" class="center_column col-xs-12 col-sm-12">
    <ul class="step clearfix" id="order_step">
      <li class="step_todo  first" style="width:33%"> <span><em>01.</em> 产品订阅信息 </span> </li>
      <li class="step_current second" style="width:33%"> <span><em>02.</em> 支付 </span> </li>
      <li class="step_todo last" style="width:33%" id="step_end"> <span><em>03.</em> 完成 </span>
    </ul>
    
    <div id="order-detail-content" class="table_block table-responsive">
      <?php
      if($_GET['lastprice']>0){
      ?>
          <div class="pay" style="">
            您需要支付：<font color="#FF0000" size="+2"><?php echo $_GET['lastprice']; ?>元</font>&nbsp;&nbsp;&nbsp;选择您的支付方式：
            <form id="form_bank" method="post" action="http://www.unionpay.com/?com=longcredit" target="_blank"></form>
          </div>
          
          <div class="pay">
            第三方支付
          </div>
          
          <div class="pay">
            <input type="radio" name="bank" id="r_unionpay" value="" checked="checked" /><a href="javascript:;" id="a_unionpay" class="a_bank">银联在线</a>
            <input type="radio" name="bank" id="r_alipay" value=""  /><a href="javascript:;" id="a_alipay" class="a_bank">支付宝</a>
          </div>
            
          <div class="pay">
            银行
          </div>
           
          <div class="pay">
            <input type="radio" name="bank" id="r_icbc" value="" /><a href="javascript:;" id="a_icbc" class="a_bank">中国工商银行</a>
            <input type="radio" name="bank" id="r_abc" value="" /><a href="javascript:;" id="a_abc" class="a_bank">中国农业银行</a>
            <input type="radio" name="bank" id="r_ccb" value="" /><a href="javascript:;" id="a_ccb" class="a_bank">中国建设银行</a>
            <input type="radio" name="bank" id="r_bcm" value="" /><a href="javascript:;" id="a_bcm" class="a_bank">中国交通银行</a>
            <input type="radio" name="bank" id="r_boc" value="" /><a href="javascript:;" id="a_boc" class="a_bank">中国银行</a>
          </div>
          
      
      <?php
      }else{
      ?>  
          这个产品是免费的，您不需要支付任何费用。
      <?php
      }
      ?>
    </div>
    
    <div class="cart_navigation clearfix" style="border-top:1px dashed #ccc; padding-top:10px"> 
      <p>
        <a href="<?php echo MARKET_INDEX; ?>/index.php?view=product&id_product=<?php echo $_GET['id_product']; ?>"  title="取消" style="color:red"> <!--<i class="icon-chevron-left"></i>-->< 取消</a>
        <div class="clear"></div>
      </p>
      
      <p>
      <?php
      if($_GET['lastprice']>0){
      ?>
          <a href="javascript:;" class="button btn btn-default standard-checkout button-medium" title="支付" onclick="$('#form_bank').submit();pop_div(300,150,'支付','pay','<?php echo $next_url; ?>')"> 
            <span>支付<!--<i class="icon-chevron-right right"></i>--></span> 
          </a>
      <?php
      }else{
      ?>  
          <a href="<?php echo $next_url; ?>" class="button btn btn-default standard-checkout button-medium" title="下一步"> 
            <span>下一步<!--<i class="icon-chevron-right right"></i>--></span> 
          </a>
      <?php
      }
      ?>
      </p>
    </div>
     
  </div>
  
    
  <div class="clear"></div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	getbankpng();
});

function getbankpng(){
	var s=1;					   
	for(i=0;i<=1536;i+=48){
		switch(s){
			case 1:
			setbank('icbc',i);
			break;
			
			case 2:
			setbank('abc',i);
			break;
			
			case 3:
			break;
			
			case 4:
			setbank('ccb',i);
			break;
			
			case 5:
			setbank('boc',i);
			break;
			
			case 6:
			setbank('bcm',i);
			break;
			
			
			case 25:
			setbank('alipay',i);
			break;
			
			case 31:
			setbank('unionpay',i);
			break;
			
			default:
			break;
			
		}
		s++;
	}
}

function setbank(bank,png){
	$('#a_'+bank).css('background','url('+$('#link_root').val()+'/images/banks.gif) no-repeat 0px -'+png+'px');
	$('#a_'+bank).attr('title',$('#a_'+bank).html());
	$('#a_'+bank).html('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
	$('#a_'+bank).click(function(){
		$('#r_'+bank).click();
	});
	$('#r_'+bank).click(function(){
		$('.a_bank').css('border','1px solid #fff');			
		$('#a_'+bank).css('border','1px solid #f00');	
		$('#form_bank').attr('action','http://'+bank+'/?com=longcredit');
	});
}

</script>

<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
