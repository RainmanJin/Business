<form id="form_pay" method="post" action="<?php echo $next_url; ?>" style=" text-align:center; padding-top:5px" target="_blank">
支付中...
<input type="hidden" name="pay_validate" value="xxx" />
</form>

<script type="text/javascript">
$(document).ready(function(){
	$('#form_pay').attr('action',$('#pop_div_pay_val').val());			   
	pop_buttons({
		"重新选择支付方式":function(){
			$("#pop_div_pay").dialog("close");
		},
		"已完成支付":function(){
			$('#form_pay').submit();
			window.close();
		}
	},"pay");
});
</script>