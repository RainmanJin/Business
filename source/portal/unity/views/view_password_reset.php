<?php 
$id_user=$User->Reset_validate();

$title='重置密码';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div class="Main">
  <form action="" method="post" id="form-reset" class="form-login">
    <input type="hidden" name="site" id="site" value="<?php echo $_GET['site']; ?>" />
    <input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user; ?>" />
  	<p>帐号</p>
    <p><?php echo $_GET['email']; ?><input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" /></p>
    <p>新密码</p>
    <p><input type="password" id="password" name="password" class="form-control" value=""></p>
    <p>确认密码</p>
    <p><input type="password" class="form-control" name="password_confirm" id="password_confirm" value=""></p>
    
    <p><button type="submit" class="ju_button" onclick="password_reset();return false">重置</button></p>
  </form>
</div>

<script type="text/javascript">
function password_reset(){
	if(!$("#password").val()){
		pop_alert("请填写新密码！");
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
	$.ajax({
		url:$('#unity_index').val()+"/index.php?ajax=user&op=password_modify&time="+ new Date().getTime(),
		data:$("#form-reset").serialize(),
		type:'POST',
		async:true,
		beforeSend: function(){
			pop_loading();
		},
		success: function(text){
			pop_loading_close();
			if(text){
				alert(text);
			}else{
				//window.location=$('#competition_index').val()+'/index.php?view=my';
				window.location=$('#unity_index').val()+'/index.php?view=login&site='+$('#site').val();
			}
		}
	});
	
}
</script>

<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>


