<?php 

?>

<div class="my_left">
  <div class="accordion">
    <h3>竞赛管理</h3>
    <div class="actived">
      <p><a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=admin" <?php if($_GET['view']=='admin'){ ?>style="color:#43b8f0;font-weight:bold;"<?php } ?> >竞赛列表</a></p>
      <!--<p><a href="<?php echo MARKET_INDEX; ?>/index.php?view=my_order" <?php if($_GET['view']=='my_order'){ ?>style="color:#43b8f0;font-weight:bold;"<?php } ?> >添加竞赛</a></p>
      <p><a href="<?php echo MARKET_INDEX; ?>/index.php?view=my_sell" <?php if($_GET['view']=='my_sell'){ ?>style="color:#43b8f0;font-weight:bold;"<?php } ?> >在售产品</a></p>
      <p><a href="<?php echo MARKET_INDEX; ?>/index.php?view=my_favorite" <?php if($_GET['view']=='my_favorite'){ ?>style="color:#43b8f0;font-weight:bold;"<?php } ?> >产品收藏</a></p>-->
    </div>
  </div>
  
  <div class="accordion">
    <h3>用户管理</h3>
    <div class="actived">
      <p><a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=admin_user" <?php if($_GET['view']=='admin_user'){ ?>style="color:#43b8f0;font-weight:bold;"<?php } ?>>用户列表</a></p>
      <!--<p><a href="javascript:;">已发话题</a></p>
      <p><a href="javascript:;">已答话题</a></p>
      <p><a href="javascript:;">知识收藏</a></p>-->
    </div>
  </div>
</div>
  
<script type="text/javascript">
$(document).ready(function(){
	$( ".accordion" ).accordion({
		//active:0,
		collapsible: true
	});
	$('.tabs').tabs();
	
	$('.modify').button({
		icons: {
			primary: 'ui-icon-pencil'
		}
	});
	$('.add').button({
		icons: {
			primary: 'ui-icon-plusthick'
		}
	});
	$('.script').button({
		icons: {
			primary: 'ui-icon-script'
		}
	});
	$('.keyword_search').button({
		icons: {
			primary: 'ui-icon-search'
		}
	});
	$('.del').button({
		icons: {
			primary: 'ui-icon-trash'
		}
	});
	$('.save').button({
		text: false,
		icons: {
			primary: 'ui-icon-disk'
		}
	});
	$('.arrow').button({
		text: false,
		icons: {
			primary: 'ui-icon-arrowthick-1-s' 
		}
	});
});

function keyword_search(){
	if($("#keyword").val()){
		url_change("replace","index.php","kw",$("#keyword").val());
	}else{
		url_change("all","index.php","kw");
	}
}

function move_color(tr){
	tr.style.backgroundColor="#eee";
}

function out_color(tr){
	tr.style.backgroundColor="";
}
</script>
