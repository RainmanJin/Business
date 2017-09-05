<form action="" method="post" id="form-password" class="form-login-pop">
  <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['customer']['id_customer']; ?>" />
  <p>新密码</p>
  <p><input type="password" class="form-control" name="password" id="password" value=""></p>
  <p>确认密码</p>
  <p><input type="password" class="form-control" name="password_confirm" id="password_confirm" value=""></p>
</form>

<script type="text/javascript">
$(document).ready(function(){
	pop_buttons({
		"确定":function(){
			my_password();
		},
		"取消":function(){
			$("#pop_div_my_password").dialog("close");
		}
	},"my_password");
});

function my_password(){
	if(!$("#password").val()){
		pop_alert("请填写您的密码！");
		$("#password").attr('class','form-error');
		return false;
	}else{
		$("#password").attr('class','form-ok');
	}
	
	if($("#password").val().length<8){
		pop_alert("密码不能少于8位！");
		$("#password").attr('class','form-error');
		return false;
	}else{
		$("#password").attr('class','form-ok');
	}
	
	if(!$("#password_confirm").val()){
		pop_alert("请确认您的密码！");
		$("#password_confirm").attr('class','form-error');
		return false;
	}else{
		$("#password_confirm").attr('class','form-ok');
	}
	
	if($("#password").val()!=$("#password_confirm").val()){
		pop_alert("两次密码填写不一致！");
		$("#password_confirm").attr('class','form-error');
		return false;
	}else{
		$("#password_confirm").attr('class','form-ok');
	}
	//$('#market_index').val()+"/index.php?ajax=customer&op=my_password&time="+ new Date().getTime(),
	$.ajax({
		url:$('#unity_index').val()+"/index.php?ajax=user&op=password_modify&time="+ new Date().getTime(),
		data:$("#form-password").serialize(),
		type:'POST',
		async:true,
		beforeSend: function(){
			pop_loading();
		},
		success: function(text){
			pop_loading_close();
			//alert(text);
			window.location.reload();
		}
	});
}
</script>