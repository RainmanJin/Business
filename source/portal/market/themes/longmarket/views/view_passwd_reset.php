<?php 
$email=$DB->Get_one("select email from "._DB_PREFIX_."customer where email='".trim($_GET['email'])."' and  passwd='".trim($_GET['validate'])."' ");

if(!$email){
	echo '该地址错误或已过期';
	exit;
}

$title='重置密码';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div class="Main">
  <form action="" method="post" id="form-reset" class="form-login">
  	<p>帐号</p>
    <p><?php echo $_GET['email']; ?><input type="hidden" name="email" value="<?php echo $_GET['email']; ?>" /></p>
    <p>新密码</p>
    <p><input type="password" id="passwd" name="passwd" class="form-control" value=""></p>
    <p>确认密码</p>
    <p><input type="password" class="form-control" name="passwd_confirm" id="passwd_confirm" value=""></p>
    
    <p><button type="submit" class="ju_button" onclick="passwd_reset();return false">重置</button></p>
  </form>
</div>

<script type="text/javascript">
function passwd_reset(){
	if(!$("#passwd").val()){
		pop_alert("请填写新密码！");
		$("#passwd").attr('class','form-error');
		return false;
	}else{
		$("#passwd").attr('class','form-ok');
	}
	
	if($("#passwd").val().length<8){
		pop_alert("密码不能少于8位！");
		$("#passwd").attr('class','form-error');
		return false;
	}else{
		$("#passwd").attr('class','form-ok');
	}
	
	if(!$("#passwd_confirm").val()){
		pop_alert("请确认您的密码！");
		$("#passwd_confirm").attr('class','form-error');
		return false;
	}else{
		$("#passwd_confirm").attr('class','form-ok');
	}
	
	if($("#passwd").val()!=$("#passwd_confirm").val()){
		pop_alert("两次密码填写不一致！");
		$("#passwd_confirm").attr('class','form-error');
		return false;
	}else{
		$("#passwd_confirm").attr('class','form-ok');
	}
	$.ajax({
		url:$('#market_index').val()+"/index.php?ajax=customer&op=reset&time="+ new Date().getTime(),
		data:$("#form-reset").serialize(),
		type:'POST',
		async:true,
		beforeSend: function(){
			pop_loading();
		},
		success: function(text){
			pop_loading_close();
			window.location=$('#market_index').val()+'/index.php?view=my';
		}
	});
	
}
</script>

<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>


