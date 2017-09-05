<?php 
$title='登录';
?>

<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div class="Main">
  <div style="float:left; width:600px; border:0px solid #ccc; height:300px; margin-bottom:50px">
    <img src="<?php echo LINK_ROOT; ?>/images/overview-AfSIS-kaggle.png" width="100%" height="100%" />
  </div>

  <form action="" method="post" id="form-login" class="form-login">
  	<p>邮箱</p>
    <p><input type="text" id="email" name="email" class="form-control"  value=""></p>
    <p>密码</p>
    <p><input type="password" id="passwd" name="passwd" class="form-control" value=""></p>
    
    <p><input type="checkbox" name="autologin" id="autologin" value="1" />1个月内自动登录</p>
    <p><a href="<?php echo MARKET_INDEX; ?>/index.php?view=passwd_email" title="找回忘记的密码">忘记密码？</a>&nbsp;<a href="<?php echo MARKET_INDEX; ?>/index.php?view=regist" title="注册一个帐号">还未注册？</a></p>
    
    <p><button type="submit" class="ju_button" onclick="login();return false">登录</button></p>
  </form>
</div>

<script type="text/javascript">
function login(){
	if(!$("#email").val()){
		pop_alert("请填写您的邮箱！");
		$("#email").attr('class','form-error');
		return false;
	}else{
		$("#email").attr('class','form-ok');
	}
	if($("#email").val().match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)==null){
		pop_alert("邮箱格式不正确！");
		$("#email").attr('class','form-error');
		return false;
	}else{
		$("#email").attr('class','form-ok');
	}
	if(!$("#passwd").val()){
		pop_alert("请填写您的密码！");
		$("#passwd").attr('class','form-error');
		return false;
	}else{
		$("#passwd").attr('class','form-ok');
	}
	$.ajax({
		url:$('#market_index').val()+"/index.php?ajax=customer&op=login&time="+ new Date().getTime(),
		data:$("#form-login").serialize(),
		type:'POST',
		async:true,
		beforeSend: function(){
			pop_loading();
		},
		success: function(text){
			pop_loading_close();
			switch(parseInt(text)){
				case 1:
					pop_alert("用户不存在！");
					$("#email").attr('class','form-error');
					return false;
				break;
				
				case 2:
					pop_alert("密码错误！");
					$("#passwd").attr('class','form-error');
					return false;
				break;
				
				default:
					$("#email").attr('class','form-ok');
					$("#passwd").attr('class','form-ok');
					window.location=$('#market_index').val()+'/index.php?view=my';
				break;
			}
		}
		
	});
}
</script>

<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
