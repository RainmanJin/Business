<form action="" method="post" id="form-email" class="form-login-pop">
  <p>邮箱</p>
  <p><?php echo $_SESSION['user']['email']; ?><input type="hidden" id="email" name="email" class="form-control"  value="<?php echo $_SESSION['user']['email']; ?>"></p>
  <p>验证码</p>
  <p>
    <input type="text" name="validate" class="validate" id="validate" maxlength="4" />
    <img src="<?php echo COMPETITION_INDEX; ?>/index.php?ajax=validate" class="validate_img" onclick="validate_change()" title="换一张" />
    <!--<a href="javascript:;" onclick="validate_change()" style="font-size:12px">换一张</a>-->
    <button type="submit" class="ju_button" onclick="validate_email();return false">发送验证邮件</button>
  </p>
  
  <!--<p><button type="submit" class="ju_button" onclick="password_email();return false">发送验证邮件</button></p>-->
</form>
  
<script type="text/javascript">
$(document).ready(function(){
	pop_buttons({
		"验证完成":function(){
			window.location.reload();
		},
		"取消":function(){
			$("#pop_div_email").dialog("close");
		}
	},"email");
	$('.ju_button').button();
});

function validate_email(){
	if(!$("#email").val()){
		alert("请填写您的邮箱！");
		$("#email").attr('class','form-error');
		return false;
	}else{
		$("#email").attr('class','form-ok');
	}
	if($("#email").val().match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)==null){
		alert("邮箱格式不正确！");
		$("#email").attr('class','form-error');
		return false;
	}else{
		$("#email").attr('class','form-ok');
	}
	$.ajax({
		url:$('#competition_index').val()+"/index.php?ajax=user&op=validate_email&time="+ new Date().getTime(),
		data:$("#form-email").serialize(),
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
						alert("验证码填写错误！");
						$("#validate").attr('class','validate-error');
						return false;
					break;
					
					case 2:
						alert("用户不存在！");
						$("#email").attr('class','form-error');
						return false;
					break;
					
					default:
						alert(text);
						//pop_alert("发送失败，请联系网站管理员！");
						$("#email").attr('class','form-ok');
						$("#validate").attr('class','validate-ok');
						validate_change();
						return false;
					break;
				}
			}else{
				alert("验证邮件已发送，请查看邮件后继续操作！");
				$("#email").attr('class','form-ok');
				$("#validate").attr('class','validate-ok');
				validate_change();
			}
		}
		
	});
}
</script>

