<?php 
if(!isset($_SESSION['customer'])){
	header('location:'.UNITY_INDEX.'/index.php?view=login&site=market');
}

if(!$_SESSION['customer']['lastname']){
	$name='-';
}else{
	$name=$_SESSION['customer']['lastname'];
}

$detail=$Customer->Detail();

$title='账户信息';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div class="Main">

  <?php require(FILE_ROOT.'/views/view_my_left.php'); ?>
  
  <div class="my_right">
    <h2><?php echo $title ?></h2>
    
    <p>账号：<?php echo $_SESSION['customer']['firstname']; ?></p>
    <p>电子邮件：<?php echo $_SESSION['customer']['email']; ?></p>
    <p>昵称：<?php echo $name; ?></p>
    <p>固定电话：<?php echo $detail['phone']; ?></p>
    <p>移动电话：<?php echo $detail['mobile']; ?></p>
    <!--<p>国家/地区：<?php echo $detail['country']; ?></p>-->
    <p>地址：<?php echo $detail['address']; ?></p>
    <p>邮编：<?php echo $detail['postcode']; ?></p>
    <p>公司/机构：<?php echo $detail['company']; ?></p>
    <!--<p>语言: xxxxx</p>-->
    <!--<p>账户秘钥：xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>-->
    <p>&nbsp;</p>
    <p><button class="pencil" onclick="pop_div(370,570,'账户修改','my_modify')">修改帐户</button>&nbsp;<button class="pencil" onclick="pop_div(350,310,'密码修改','my_password')">修改密码</button></p>
  </div>
  
</div>

<script type="text/javascript">
$(document).ready(function(){
						   
});
</script>

<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
