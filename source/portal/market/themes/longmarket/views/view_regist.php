<?php 
$title='注册';
?>

<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div class="Main">

  <div style="float:right; width:600px; border:0px solid #ccc; height:400px; margin-bottom:50px">
    <img src="<?php echo LINK_ROOT; ?>/images/overview-AfSIS-kaggle.png" width="100%" height="100%" />
  </div>

  <form action="" method="post" id="form-regist" class="form-regist">
    <p>邮箱</p>
    <p><input type="text" class="form-control"  id="email" name="email" value=""></p>
    <p>密码</p>
    <p><input type="password" class="form-control" name="passwd" id="passwd" value=""></p>
    <p>确认密码</p>
    <p><input type="password" class="form-control" name="passwd_confirm" id="passwd_confirm" value=""></p>
    <p>验证码</p>
    <p>
      <input type="text" name="validate" class="validate" maxlength="4" />
      <img src="<?php echo MARKET_INDEX; ?>/index.php?ajax=validate" class="validate_img" onclick="validate_change()" title="换一张" />
      <a href="javascript:;" onclick="validate_change()" style="font-size:12px">换一张</a>
    </p>
    
    <p><input type="checkbox" id="agreelist" checked="checked" />&nbsp;<a href="<?php echo CLOUD_INDEX; ?>/index.php/0" target="_blank">同意我们的使用条例（点击阅读）</a></p>
    <p><button type="submit" class="ju_button" onclick="regist();return false">注册</button></p>
  </form>
</div>

<script type="text/javascript">
function regist(){
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
	if(!document.getElementById('agreelist').checked){
		pop_alert('请先同意使用条例！');
		return false;
	}
	$.ajax({
		url:$('#market_index').val()+"/index.php?ajax=customer&op=regist&time="+ new Date().getTime(),
		data:$("#form-regist").serialize(),
		type:'POST',
		async:true,
		beforeSend: function(){
			pop_loading();
		},
		success: function(text){
			pop_loading_close();
			switch(parseInt(text)){
				case 1:
					pop_alert("验证码填写错误！");
					$(".validate").attr('class','validate-error');
					return false;
				break;
				
				case 2:
					pop_alert("邮箱已存在！");
					$("#email").attr('class','form-error');
					return false;
				break;
				
				default:
					$("#email").attr('class','form-ok');
					window.location=$('#market_index').val()+'/index.php?view=my';
				break;
			}
		}
	});
	
}
</script>

<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
