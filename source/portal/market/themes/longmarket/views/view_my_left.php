<?php 

?>

<style>
.my_left{
	float:left; 
	width:160px;
	margin-bottom:30px;
}
.actived{
	padding:20px;
	line-height:30px; 
	text-align:center
}
.my_right{
	margin-left:190px; 
	line-height:30px;
	padding-top:5px;
}
.my_right h2{
	border-bottom:1px solid #ccc;
	padding-bottom:10px;
	margin-bottom:10px;
}
.my_table thead th{
	background:#43b8f0;
	color:#fff;
	border-top-right-radius: 5px;
	border-top-left-radius: 5px;
}
.my_table_td{
	border:1px solid #ccc;
}
</style>

<div class="my_left">
  <div class="accordion">
    <h3>我的账户</h3>
    <div class="actived">
      <p><a href="<?php echo MARKET_INDEX; ?>/index.php?view=my" <?php if($_GET['view']=='my'){ ?>style="color:#43b8f0;font-weight:bold;"<?php } ?> >账户信息</a></p>
      <p><a href="<?php echo MARKET_INDEX; ?>/index.php?view=my_order" <?php if($_GET['view']=='my_order'){ ?>style="color:#43b8f0;font-weight:bold;"<?php } ?> >已购产品</a></p>
      <p><a href="<?php echo MARKET_INDEX; ?>/index.php?view=my_sell" <?php if($_GET['view']=='my_sell'){ ?>style="color:#43b8f0;font-weight:bold;"<?php } ?> >在售产品</a></p>
      <p><a href="<?php echo MARKET_INDEX; ?>/index.php?view=my_favorite" <?php if($_GET['view']=='my_favorite'){ ?>style="color:#43b8f0;font-weight:bold;"<?php } ?> >产品收藏</a></p>
    </div>
  </div>
  
  <div class="accordion">
    <h3>我的论坛</h3>
    <div class="actived">
      <p><a href="javascript:;">论坛信息</a></p>
      <p><a href="javascript:;">已发话题</a></p>
      <p><a href="javascript:;">已答话题</a></p>
      <p><a href="javascript:;">知识收藏</a></p>
    </div>
  </div>
</div>
  
<script type="text/javascript">
$(document).ready(function(){
	$( ".accordion" ).accordion({
		//active:0,
		collapsible: true
	});
	$('.pencil').button({
		icons: {
			primary: 'ui-icon-pencil'
		}
	});
	$('.script').button({
		icons: {
			primary: 'ui-icon-script'
		}
	});
	$('.trash').button({
		icons: {
			primary: 'ui-icon-trash'
		}
	});
});
</script>
