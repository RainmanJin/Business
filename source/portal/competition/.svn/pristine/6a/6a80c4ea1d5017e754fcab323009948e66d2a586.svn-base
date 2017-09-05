<?php require(FILE_ROOT.'/views/view_header.php'); ?>
<!--注册-->

<div class="full-width" id="standalone-signin">
  <h1>成为一个竞赛者</h1>
  <form action="https://www.kaggle.com/account/register" id="create-account" method="post">
    <div class="validation-summary-valid" data-valmsg-summary="true">
      <ul>
        <li style="display:none"></li>
      </ul>
    </div>
    
    <fieldset id="manual-signup" style="display: block;">
      <div class="field standard">
        <label for="DisplayName">昵称</label>
        <input data-val="true" data-val-length="The field Display name must be a string with a minimum length of 4 and a maximum length of 255." data-val-length-max="255" data-val-length-min="4" data-val-required="The Display name field is required." id="DisplayName" name="DisplayName" placeholder="用于显示在排行榜中" title="Enter the name you would like publicly displayed with your account (such as on competition leaderboards)." type="text" value="">
        <span class="field-validation-valid" data-valmsg-for="DisplayName" data-valmsg-replace="true"></span> 
      </div>
        
      <div class="field standard">
        <label for="LegalName">真实的/合法的名字</label>
        <input id="LegalName" name="LegalName" placeholder="绝不会公开" title="Enter your real (legal) name. This name will be used to award competition prizes and ensure competition compliance. It will never be displayed publicly." type="text" value="">
        <span class="field-validation-valid" data-valmsg-for="LegalName" data-valmsg-replace="true"></span> 
      </div>
      
      <div class="field standard">
        <label for="UserName">用户名</label>
        <input data-val="true" data-val-length="The field User name must be a string with a minimum length of 3 and a maximum length of 255." data-val-length-max="255" data-val-length-min="3" data-val-required="The User name field is required." id="UserName" name="UserName" placeholder="用于登录" title="Enter the name you would like to use to log into the site" type="text" value="">
        <span class="field-validation-valid" data-valmsg-for="UserName" data-valmsg-replace="true"></span> 
      </div>
      
      <div class="field standard">
        <label for="Email">邮箱地址</label>
        <input data-val="true" data-val-length="The field Email address must be a string with a maximum length of 255." data-val-length-max="255" data-val-required="The Email address field is required." id="Email" name="Email" placeholder="格式：xxx@xxx.com" title="Enter your email address you&#39;d like to receive competition updates and optionally the Kaggle newsletter" type="text" value="">
        <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span> 
      </div>
      
      <div class="field standard">
        <label for="Password">密码</label>
        <input data-val="true" data-val-length="&#39;Password&#39; must be at least 7 characters long." data-val-length-min="7" data-val-required="The Password field is required." id="Password" name="Password" placeholder="最少7个字符" type="password">
        <span class="field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span> 
      </div>
      
      <div class="field standard">
        <label for="ConfirmPassword">确认密码</label>
        <input data-val="true" data-val-equalto="The password and confirmation password do not match." data-val-equalto-other="*.Password" id="ConfirmPassword" name="ConfirmPassword" placeholder="最少7个字符" type="password">
        <span class="field-validation-valid" data-valmsg-for="ConfirmPassword" data-valmsg-replace="true"></span> 
      </div>
      
      <div class="checkbox-input">
        <!--<input checked="checked" data-val="true" data-val-required="The Subscribe to the Kaggle Mailing List for Competition Updates field is required." id="SubscribeToNewsletter" name="SubscribeToNewsletter" type="checkbox" value="true">
        <input name="SubscribeToNewsletter" type="hidden" value="false">
        <label for="SubscribeToNewsletter"> 给我发送最新的竞赛升级 Email me news and competition updates</label>-->
      </div>
      
      <div class="field center" style="background:none">
        <input id="get-started" type="submit" value="注册" onclick="regist();return false">
      </div>
      
      <div id="terms-caution">
        <div> 点击按钮前，请确认您已接受 <a href="javascript:;" target="_blank">服务条款</a> and <a href="javascript:;" target="_blank">隐私协议</a>。</div>
      </div>
    </fieldset>
    
  </form>
  <div id="group-note" style="max-width:none">
    <p> <strong>一个人只能一个帐号。</strong> 如果您是已公司的方式加入，请为参与的每个成员创建帐号。 </p>
  </div>
</div>


<script type="text/javascript">
function regist(){
	if(!$("#DisplayName").val()){
		alert("请填写您的昵称！");
		//$("#email").attr('class','form-error');
		return false;
	}else{
		//$("#email").attr('class','form-ok');
	}
	if(!$("#LegalName").val()){
		alert("请填写您的真实/合法姓名！");
		//$("#email").attr('class','form-error');
		return false;
	}else{
		//$("#email").attr('class','form-ok');
	}
	if(!$("#UserName").val()){
		alert("请填写您的用户名！");
		//$("#email").attr('class','form-error');
		return false;
	}else{
		//$("#email").attr('class','form-ok');
	}
	
	
	if(!$("#Email").val()){
		alert("请填写您的邮箱！");
		//$("#email").attr('class','form-error');
		return false;
	}else{
		//$("#email").attr('class','form-ok');
	}
	
	if($("#Email").val().match(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)==null){
		alert("邮箱格式不正确！");
		//$("#email").attr('class','form-error');
		return false;
	}else{
		//$("#email").attr('class','form-ok');
	}
	
	if(!$("#Password").val()){
		alert("请填写您的密码！");
		//$("#passwd").attr('class','form-error');
		return false;
	}else{
		//$("#passwd").attr('class','form-ok');
	}
	
	if($("#Password").val().length<7){
		alert("密码不能少于7位！");
		//$("#passwd").attr('class','form-error');
		return false;
	}else{
		//$("#passwd").attr('class','form-ok');
	}
	
	if(!$("#ConfirmPassword").val()){
		alert("请确认您的密码！");
		//$("#passwd_confirm").attr('class','form-error');
		return false;
	}else{
		//$("#passwd_confirm").attr('class','form-ok');
	}
	
	if($("#Password").val()!=$("#ConfirmPassword").val()){
		alert("两次密码填写不一致！");
		//$("#passwd_confirm").attr('class','form-error');
		return false;
	}else{
		//$("#passwd_confirm").attr('class','form-ok');
	}
	/*if(!document.getElementById('agreelist').checked){
		alert('请先同意使用条例！');
		return false;
	}*/
	$.ajax({
		url:$('#competition_index').val()+"/index.php?ajax=user&op=regist&time="+ new Date().getTime(),
		data:$("#manual-signup").serialize(),
		type:'POST',
		async:true,
		beforeSend: function(){
			pop_loading();
		},
		success: function(text){
			pop_loading_close();
			switch(parseInt(text)){
				case 1:
					alert("用户名已存在！");
					//$(".validate").attr('class','validate-error');
					return false;
				break;
				
				case 2:
					alert("邮箱已存在！");
					//$("#email").attr('class','form-error');
					return false;
				break;
				
				
				default:
					//$("#email").attr('class','form-ok');
					window.location=$('#competition_index').val()+'/index.php?view=my';
				break;
			}
		}
	});
	
}
</script>


<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
