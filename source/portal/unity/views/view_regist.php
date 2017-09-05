<?php 
//print_r($_SESSION['datatool']);

$title='注册';
?>

<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div class="Main">

  <div style="float:right; width:500px; border:0px solid #ccc; height:400px; margin-bottom:50px">
    <img src="<?php echo LINK_ROOT; ?>/images/overview-AfSIS-kaggle.png" width="100%" height="100%" />
  </div>

  <form action="" method="post" id="form-regist" class="form-regist">
    <table cellpadding="5">
      <tr>
        <td>用户名</td><td><input type="text" class="form-control"  id="username" name="username" value="" placeholder="用于登录，由字母和数字组成" /></td>
      </tr>
      <tr>
        <td>昵称</td><td><input type="text" class="form-control"  id="nickname" name="nickname" value="" placeholder="用于公开显示在评论或排行榜中" /></td>
      </tr>
      <tr>
        <td>邮箱</td><td><input type="text" class="form-control"  id="email" name="email" value="" placeholder="格式xxx@xxx.xxx" /></td>
      </tr>
      <tr>
        <td>密码</td><td><input type="password" class="form-control" name="password" id="password" value="" placeholder="不少于8个字符，由字母和数字组成" /></td>
      </tr>
      <tr>
        <td>确认密码</td><td><input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" placeholder="请再输入一遍您的密码" /></td>
      </tr>
      <tr>
        <td>验证码</td>
        <td>
          <input type="text" name="validate" class="validate" maxlength="4" />
          <img src="<?php echo MARKET_INDEX; ?>/index.php?ajax=validate" class="validate_img" onclick="validate_change()" title="换一张" />
          <a href="javascript:;" onclick="validate_change()" style="font-size:12px">换一张</a>
        </td>
      </tr>
      <tr>
        <td colspan="2"><input type="checkbox" id="agreelist" checked="checked" />&nbsp;<a href="<?php echo CLOUD_INDEX; ?>/index.php/0" target="_blank">同意我们的使用条例（点击阅读）</a></td>
      </tr>
      <tr>
        <td colspan="2"><button type="submit" class="ju_button" onclick="regist();return false">注册</button></td>
      </tr>
    </table>  
  </form>
</div>

<script type="text/javascript">
function regist(){
	//用户名
	if(!$("#username").val()){
		pop_alert("请填写您的用户名！");
		$("#username").attr('class','form-error');
		return false;
	}else{
		$("#username").attr('class','form-ok');
	}
	if($("#username").val().match(/[\u4e00-\u9fa5]|(?:^\s+)|(?:\s+$)/)!=null){
		pop_alert("用户名不能有汉字！");
		$("#username").attr('class','form-error');
		return false;
	}else{
		$("#username").attr('class','form-ok');
	}
	//昵称
	if(!$("#nickname").val()){
		pop_alert("请填写您的昵称！");
		$("#nickname").attr('class','form-error');
		return false;
	}else{
		$("#nickname").attr('class','form-ok');
	}
	if($("#nickname").val().length>8){
		pop_alert("昵称不能超过8个字符！");
		$("#nickname").attr('class','form-error');
		return false;
	}else{
		$("#nickname").attr('class','form-ok');
	}
	//邮箱
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
	if($("#email").val().match(/[\u4e00-\u9fa5]|(?:^\s+)|(?:\s+$)/)!=null){
		pop_alert("邮箱地址不能有汉字！");
		$("#email").attr('class','form-error');
		return false;
	}else{
		$("#email").attr('class','form-ok');
	}
	//密码
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
	if($("#password").val().match(/[\u4e00-\u9fa5]|(?:^\s+)|(?:\s+$)/)!=null){
		pop_alert("密码不能有汉字！");
		$("#password").attr('class','form-error');
		return false;
	}else{
		$("#password").attr('class','form-ok');
	}
	//确认密码
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
	//同意
	if(!document.getElementById('agreelist').checked){
		pop_alert('请先同意使用条例！');
		return false;
	}
	$.ajax({
		url:$('#unity_index').val()+"/index.php?ajax=user&op=regist&time="+ new Date().getTime(),
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
					pop_alert("用户名已存在！");
					$("#username").attr('class','form_error');
					return false;
				break;
				
				case 3:
					pop_alert("邮箱已存在！");
					$("#email").attr('class','form-error');
					return false;
				break;
				
				default:
					if(text){
						alert(text);
					}else{
						$("#email").attr('class','form-ok');
						window.location=$('#index_url').val();
					}
				break;
			}
		}
	});
}
</script>

<!--脚部-->
<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
