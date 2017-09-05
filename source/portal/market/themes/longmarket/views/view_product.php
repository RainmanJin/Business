<?php 
require_once(FILE_ROOT.'/classes/class_product.php');
$Product=new Product($_GET);
$Detail=$Product->Detail();

//左侧个数
$pricetype_quantity=$Detail['pricetype_quantity'];
$productype_quantity=$Detail['productype_quantity'];
$category_quantity=$Detail['category_quantity'];
$manufacturer_quantity=$Detail['manufacturer_quantity'];

//产品详情
$product=$Detail['product'];
$comments=$Product->Comment_list();
$comments_list=$comments['comments_list'];
$allowguests=$comments['allowguests'];
$moderate=$comments['moderate'];
$prices_list=$Product->Price();

$is_buyed=$Customer->Is_buyed($_GET['id_product']);

$title='产品详情';
?>

<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div class="Main">

  <?php require(FILE_ROOT.'/views/view_left.php'); ?>
  
  <input type="hidden" id="id_product" value="<?php echo $_GET['id_product']; ?>" />
  <div class="center_w">
    <div class="center">
    
      <!--产品详情-->
      <div class="prouduct_L" style="height:auto; border-bottom:0">
        <img src="<?php echo $product['image']; ?>" width="121" height="124" />
        <div style="border:0px solid #ccc; padding:5px; text-align:center; width:110px; vertical-align:middle">
        <?php
        if($product['id_favorite_product']){
        ?>
            <a href="<?php echo MARKET_INDEX; ?>/index.php?view=my_favorite" style="color:#43b8f0">您已收藏</a>
        <?php
        }else{
        ?>
            <button id="favorate" onclick="<?php if(isset($_SESSION['customer'])){ ?> favorite() <?php }else{ ?> pop_div(360,350,'登录','login','reload') <?php } ?>">收藏</button>
        <?php
        }
        ?>
        </div>
      </div>
      <div class="prouduct_R" style="height:auto; border-bottom:0">
        <h1><?php echo $product['name']; ?></h1>
        <div class="clear"></div>
        <ul>
          <li>价格类型：<?php echo $product['pricetype']; ?></li>
          <li>产品类型：<?php echo $product['productype']; ?></li>
          <li>行业分类：<?php echo $product['category']; ?></li>
          <li>发布者：<?php echo $product['manufacturer']; ?></li>
          <li>发布时间：<?php echo $product['dateadd']; ?></li>
        </ul>
      </div>
      <div class="clear"></div>
      <div class="prouduct_description" style="border-top:1px dashed #ccc">
        <h1>产品说明</h1>
        <?php echo $product['description']; ?>
      </div>
      
      <!--评价-->
      <div class="evaluation">
        <h1>
          产品评价
          <select id="comment_grade">
            <option value="0">请评分</option>
            <option value="1">1分</option>
            <option value="2">2分</option>
            <option value="3">3分</option>
            <option value="4">4分</option>
            <option value="5">5分</option>
          </select>
        </h1>
        <div class="pingjia">
          <form id="form1" name="form1" method="post" action="">
            <label for="textarea"></label>
            <textarea name="comment" id="comment" rows="5" class="pj1"></textarea>
          </form>
        </div>
        <div style="padding-left:119px; margin-top:5px; margin-bottom:20px">
          验证码
          <input type="text" name="validate" class="validate" id="validate" maxlength="4" />
          <img src="<?php echo MARKET_INDEX; ?>/index.php?ajax=validate" class="validate_img" onclick="validate_change()" title="换一张" />
          <a href="javascript:;" onclick="validate_change()" style="font-size:12px">换一张</a>
          &nbsp;&nbsp;
          <button class="comment" onclick="<?php if(!isset($_SESSION['customer'])&&$allowguests==0){ ?> pop_div(360,350,'登录','login','reload') <?php }else{ ?> comment(<?php echo $moderate; ?>) <?php } ?>">提交评论</button>
        </div>
        <div class="clear"></div>
        
        <!--评论列表-->
        <?php
		if(count($comments_list)>0){
			foreach($comments_list as $comment){
				if($comment['forbidden']==0){
		?>
                    <div class="pj">
                      <div class="pj_con" style="float:none; width:100%">
                        <span class="blue">
						  <?php echo $comment['customer_name']; ?>
                        </span>
                        
                        <span class="star" title="<?php echo $comment['grade']; ?>分">
                          <?php
                          for($i=1;$i<=5;$i++){
                              if($i<=$comment['grade']){
                          ?>
                                  <img src="<?php echo LINK_ROOT; ?>/images/green-star.jpg" width="14" height="14" />
                          <?php
                              }else{
                          ?>
                                  <img src="<?php echo LINK_ROOT; ?>/images/star.jpg" width="14" height="14" />
                              <?php	  
                              }
                          }
                          ?>
                        </span> 
                        
                        <span class="time" style="width:auto"><?php echo $comment['date_add']; ?></span>
                      </div>
                      
                      <div class="pj_name" style="float:none; width:100%">
                        <span><?php echo $comment['content']; ?></span>
                      </div>
                      <div class="clear"></div>
                    </div>
		<?php
				}
			}
        }else{
        ?>
        	暂无任何评论
        <?php
        }
        ?>
      </div>
    </div>
    
    <!--<div class="center1">
      <div class="bbs_tile">
        <h1>论坛文章</h1>
        <h2>查看全部>></h2>
      </div>
      <div class="clear"></div>
      <div class="bbs_con">
        <h1>采用常规的展示形式</h1>
       <p>采用常规的展示形式，可自行添加栏目模块。留言板块也可自行勾选是否展示...</p>
      </div>
      <div class="bbs_con">
        <h1>采用常规的展示形式</h1>
       <p>采用常规的展示形式，可自行添加栏目模块。留言板块也可自行勾选是否展示...</p>
      </div>
      <div class="bbs_con">
        <h1>采用常规的展示形式</h1>
       <p>采用常规的展示形式，可自行添加栏目模块。留言板块也可自行勾选是否展示...</p>
      </div>
      <div class="clear"></div>
    </div>-->
  </div>  
  
  <!--价格-->  
  <div class="Right_adv">
  	<?php 
	if($is_buyed){
		?>
		<div style="border:0px solid #CCC; width:100%; height:100px; margin-bottom:10px; text-align:center; line-height:50px; background:#CCC; color:#fff; font-size:14px">
          <p><a href="<?php echo MARKET_INDEX; ?>/index.php?view=my_order" style="color:#fff">本产品您已订购</a></p>
          <p><button class="script" onclick="window.location='<?php echo MARKET_INDEX; ?>/index.php?view=use&id_product=<?php echo $_GET['id_product']; ?>'">使用</button></p>
        </div>
        <?php
	}else{
		if(count($prices_list)>0){
			foreach($prices_list as $price){
				$buy_link=MARKET_INDEX.'/index.php?view=buy&id_product='.$_GET['id_product'].'&name='.$product['name'].'&manufacturer='.$product['manufacturer'].'&image='.$product['image'].'&from_quantity='.$price['from_quantity'].'&lastprice='.$price['lastprice'];
			?>
				<div style="border:0px solid #CCC; width:100%; height:100px; margin-bottom:10px; text-align:center; line-height:50px; background:#CCC; color:#fff; font-size:14px">
				  <p><?php echo $price['from_quantity']; ?>事务/月	<?php if($price['lastprice']==0){echo '免费';}else{echo '￥'.$price['lastprice'];} ?></p>
				  
				  <p>
				  <?php
				  if(isset($_SESSION['customer'])){
				  ?>
					  <button class="subscription" onclick="window.location='<?php echo $buy_link; ?>'">订阅</button>
				  <?php
				  }else{
				  ?>  
					  <button class="subscription" onclick="pop_div(360,350,'登录','login','reload')">订阅</button>
				  <?php
				  }
				  ?>
				  </p>
				</div>
			<?php
			}
		}else{
			?>
			<div style="border:0px solid #CCC; width:100%; height:100px; margin-bottom:10px; text-align:center; line-height:100px; background:#CCC; color:#fff; font-size:36px;">暂无价格</div>
			<?php
		}
	}
	?>
    <h1><a href="javascript:;"><img src="<?php echo LINK_ROOT; ?>/images/adv_1.jpg" width="216" height="94" /></a></h1>
  </div>
  <div class="clear"></div>
  
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#favorate').button({
		icons: {
			primary: 'ui-icon-heart'
		}
	});
	$('.comment').button({
		icons: {
			primary: 'ui-icon-comment'
		}
	});
	$('.subscription').button({
		icons: {
			primary: 'ui-icon-cart'
		}
	});
	$('.script').button({
		icons: {
			primary: 'ui-icon-script'
		}
	});
});
//收藏
function favorite(){
	$.ajax({
		url:$('#market_index').val()+"/index.php?ajax=product&op=favorate&time="+ new Date().getTime(),
		type:'POST',
		data:'id_product='+$('#id_product').val(),
		beforeSend: function(){
			pop_loading();
		},
		success:function(text){
			window.location.reload();
		}
	});
}
//评论
function comment(moderate){
	if($('#comment_grade').val()==0){
		pop_alert('请评分！');
		return false;
	}
	if(!$('#comment').val()){
		pop_alert('评论不能为空！');
		return false;
	}
	if($('#comment').val().length<5){
		pop_alert('评论不能小于5个字符');
		return false;
	}
	$.ajax({
		url:$('#market_index').val()+"/index.php?ajax=product&op=comment&time="+ new Date().getTime(),
		type:'POST',
		data:'comment='+$('#comment').val()+'&comment_grade='+$('#comment_grade').val()+'&id_product='+$('#id_product').val()+'&validate='+$('#validate').val(),
		beforeSend: function(){
			pop_loading();
		},
		success:function(text){
			pop_loading_close();
			if(text==1){
				pop_alert("验证码填写错误！");
				$("#validate").attr('class','validate-error');
				return false;
			}
			$("#validate").attr('class','validate-ok');
			if(moderate==1){
				pop_alert('发表成功！等待审核');
			}
			setTimeout('window.location.reload()',1000);
		}
	});
}
</script>

<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
