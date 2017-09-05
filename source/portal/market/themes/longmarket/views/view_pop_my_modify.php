<?php
if(!$_SESSION['customer']['lastname']){
	$name='';
}else{
	$name=$_SESSION['customer']['lastname'];
}

$detail=$Customer->Detail('empty');
?>

<form action="" method="post" id="form-modify" class="form-login-pop">
  <p>昵称</p>
  <p><input type="text" class="form-control"  id="name" name="name" value="<?php echo $name; ?>" /></p>
  <p>固定电话</p>
  <p><input type="text" class="form-control"  id="phone" name="phone" value="<?php echo $detail['phone']; ?>" /></p>
  
  <p>移动电话</p>
  <p><input type="text" class="form-control"  id="mobile" name="mobile" value="<?php echo $detail['mobile']; ?>" /></p>
  
  <!--<p>国家/地区</p>
  <p>
    <select class="form-control" id="country" name="country" style="width:50%; height:35px">
      <option value="">中国</option>
    </select>
  </p>-->
  
  <p>地址</p>
  <p><input type="text" class="form-control"  id="address" name="address" value="<?php echo $detail['address']; ?>" /></p>
  
  
  <p>邮编</p>
  <p><input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $detail['postcode']; ?>"  /></p>
  
  <p>公司/机构</p>
  <p>如需修改请联系网站管理员</p>
</form>

<script type="text/javascript">
$(document).ready(function(){
	pop_buttons({
		"确定":function(){
			modify();
		},
		"取消":function(){
			$("#pop_div_my_modify").dialog("close");
		}
	},"my_modify");
});

function modify(){
	$.ajax({
		url:$('#market_index').val()+"/index.php?ajax=customer&op=modify&time="+ new Date().getTime(),
		data:$("#form-modify").serialize(),
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