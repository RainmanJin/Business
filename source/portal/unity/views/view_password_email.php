<?php 
$title='忘记密码';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div class="Main">
  <form action="" method="post" id="form-password" class="form-regist">
    <input type="hidden" name="site" id="site" value="<?php echo $_GET['site']; ?>" />
  	<p>邮箱</p>
    <p><input type="text" id="email" name="email" class="form-control"  value=""></p>
    <p>验证码</p>
    <p>
      <input type="text" name="validate" class="validate" id="validate" maxlength="4" />
      <img src="<?php echo MARKET_INDEX; ?>/index.php?ajax=validate" class="validate_img" onclick="validate_change()" title="换一张" />
      <a href="javascript:;" onclick="validate_change()" style="font-size:12px">换一张</a>
    </p>
    
    <p><button type="submit" class="ju_button" onclick="password_email();return false">发送验证邮件</button></p>
  </form>
</div>

<script type="text/javascript">

function password_email(){
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
	$.ajax({
		url:$('#unity_index').val()+"/index.php?ajax=user&op=password&time="+ new Date().getTime(),
		data:$("#form-password").serialize(),
		type:'POST',
		async:true,
		beforeSend: function(){
			pop_loading();
		},
		success: function(text){
			pop_loading_close();
			if(text){
				switch(parseInt(text)){
					case 1:
						pop_alert("验证码填写错误！");
						$("#validate").attr('class','validate-error');
						return false;
					break;
					
					case 2:
						pop_alert("用户不存在！");
						$("#email").attr('class','form-error');
						return false;
					break;
					
					default:
						pop_alert(text);
						//pop_alert("发送失败，请联系网站管理员！");
						$("#email").attr('class','form-ok');
						$("#validate").attr('class','validate-ok');
						validate_change();
						return false;
					break;
				}
			}else{
				pop_alert("验证邮件已发送，请查看邮件后继续操作！");
				$("#email").attr('class','form-ok');
				$("#validate").attr('class','validate-ok');
				validate_change();
			}
		}
		
	});
}
</script>

<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>

