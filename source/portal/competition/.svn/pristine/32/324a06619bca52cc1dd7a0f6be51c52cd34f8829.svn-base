<form action="" method="post" id="form-login" class="form-login-pop">
  <p>用户名/邮箱</p>
  <p><input type="text" id="email" name="email" class="form-control"  value=""></p>
  <p>密码</p>
  <p><input type="password" id="password" name="password" class="form-control" value=""></p>
  
  <p><input type="checkbox" name="autologin" id="autologin" value="1" />1个月内自动登录</p>
  <p>
    <a href="<?php echo UNITY_INDEX; ?>/index.php?view=password_email&site=market" title="找回忘记的密码" target="_blank">忘记密码？</a>&nbsp;
    <a href="<?php echo UNITY_INDEX; ?>/index.php?view=regist&site=market" title="注册一个帐号" target="_blank">还未注册？</a>
  </p>
</form>
  
<script type="text/javascript">
$(document).ready(function(){
	pop_buttons({
		"登录":function(){
			login();
		},
		"取消":function(){
			$("#pop_div_login").dialog("close");
		}
	},"login");
});

function login(){
	if(!$("#email").val()){
		pop_alert("请填写您的邮箱！");
		$("#email").attr('class','form-error');
		return false;
	}else{
		$("#email").attr('class','form-ok');
	}
	/*if($("#email").val().match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)==null){
		pop_alert("邮箱格式不正确！");
		$("#email").attr('class','form-error');
		return false;
	}else{
		$("#email").attr('class','form-ok');
	}*/
	if(!$("#password").val()){
		pop_alert("请填写您的密码！");
		$("#password").attr('class','form-error');
		return false;
	}else{
		$("#password").attr('class','form-ok');
	}
	//$('#market_index').val()+"/index.php?ajax=customer&op=login&time="+ new Date().getTime(),
	$.ajax({
		url:$('#unity_index').val()+"/index.php?ajax=user&op=login&time="+ new Date().getTime(),
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
					$("#password").attr('class','form-error');
					return false;
				break;
				
				default:
					$("#email").attr('class','form-ok');
					$("#password").attr('class','form-ok');
					//window.location=$('#market_index').val()+'/index.php?view=my';
					if($('#pop_div_login_val').val()=='reload'){
						window.location.reload();
					}else{
						window.location=$('#pop_div_login_val').val();
					}
				break;
			}
		}
		
	});
}
</script>

