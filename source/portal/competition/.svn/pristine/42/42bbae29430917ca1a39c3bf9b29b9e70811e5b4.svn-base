// JavaScript Document
//改变url
function url_change(op,index,col,new_val){
	var url=window.location.href;
	var new_url=false;
	var new_val=encodeURI(new_val);
	
	//获得当前url参数中指定键的表达式和值
	if(url_get(col)){
		var val=url_get(col);
		var key=col+'='+val;
	}

	switch(op){
		case "all":
			if(url_get(col)){
				var url_arr=url.split("?");
				var val_arr=url_arr[1].split("&");
				
				if(val_arr[0]==key){
					if(val_arr.length==1){
						var new_url=url.replace("?"+key,"");
					}else{
						var new_url=url.replace(key+"&","");
					}
				}else{
					var new_url=url.replace("&"+key,"");
				}
			}
		break;
		
		case "replace":
			if(url_get(col)){
				var new_url=url.replace(key,col+'='+new_val);
			}else{
				if(url.indexOf("?")!=-1){
					var new_url=url+"&"+col+"="+new_val;
				}else{
					if(url.indexOf(index)!=-1){
						var new_url=url+"?"+col+"="+new_val;
					}else{
						var new_url=url+index+"?"+col+"="+new_val;
					}
				}
			}
		break;
	}
	
	if(new_url){
		window.location=new_url;
	}else{
		window.location=url;
	}
}
//获得指定url参数的值
function url_get(col){
	var url_arr=window.location.href.split("?");
	if(url_arr[1]){
		var col_arr=url_arr[1].split("&");
		for(i in col_arr){
			var val_arr=col_arr[i].split("=");
			if(col==val_arr[0]){
				return val_arr[1];
			}
		}
		return false;
	}else{
		return false;
	}
}

//关键字搜索
function list_search(tab,val){
	if($("#"+tab+"_keyword").val()&&$("#"+tab+"_keyword").val()!=val){
		url_change("replace","index.php","kw",$("#"+tab+"_keyword").val());
	}else{
		url_change("all","index.php","kw");
	}
}

//排序
function list_sort(od,by){
	if(url_get("st")){
		var val=url_get("st").split("_");
		if(val[1]=="asc"&&val[0]==od){
			var by="desc";
		}else{
			var by="asc";
		}
	}
	url_change("replace","index.php","st",od+"_"+by);
}

//其他页面搜索
function other_search(){
	if($('#index_keyword').val()){
		window.location=$('#market_index').val()+'/index.php?kw='+$('#index_keyword').val();
	}else{
		window.location=$('#market_index').val();
	}
}
  //关键字默认
function keyword_default(tab,op,val){
	if(op=="click"){
		if($("#"+tab+"_keyword").val()==val){
			$("#"+tab+"_keyword").val("");
			$("#"+tab+"_keyword").css("color","#000");
		}
	}else{
		if($("#"+tab+"_keyword").val()==""){
			$("#"+tab+"_keyword").val(val);
			$("#"+tab+"_keyword").css("color","#ccc");
		}
	}
}

//弹出层
function pop_div(width,height,title,id,val,defined){
	$("body").append('<div id="pop_div_'+id+'"><div style="margin-top:30%; text-align:center"><img src="'+$('#link_root').val()+'/images/ajax-loader.gif" width="30" height="30" /></div></div>');
	if(val){
		$("body").append('<input type="hidden" id="pop_div_'+id+'_val" value="'+val+'" />');
	}
	$("#pop_div_"+id).dialog({
		modal: true,				 
		autoOpen:false,
		resizable:false,
		width:width,
		height:height,
		title:title,
		close:function(){
			$(this).remove();
			$("#pop_div_"+id+"_val").remove();//向弹出层传值
		}
	});
	$("#pop_div_"+id).dialog("open");
	if(!defined){
		var time=new Date().getTime();
		$("#pop_div_"+id).load($('#competition_index').val()+'/index.php?view=pop_'+id+"&time="+time);
	}
}
//弹出层按钮
function pop_buttons(buttons,id){
	$("#pop_div_"+id).dialog("option","buttons",buttons);
}
//弹出警告
function pop_alert(content){
	pop_div(400,300,"提示","alert","",1);
	pop_buttons({
		"确定":function(){
			$("#pop_div_alert").dialog("close");
		}
	},"alert");
	$("#pop_div_alert").html("<div class='pop_alert'>"+content+"</div>");
}
//弹出载入
function pop_loading(){
    var flag = 0;
	$("body").append('<div id="pop_loading"><p id="pop_loading_word">载入中...</p><p id="pop_loading_second">0</p></div>');
    $("#pop_loading").dialog({
    	bgiframe: true,
    	autoOpen: true,
        resizable: false,
    	modal: true,
        height: 200,
        width: 300,
        open: function(){
            $(this).parent().find('.ui-dialog-titlebar').hide();
			flag = setInterval(pop_loading_second, 1000);
        },
        beforeclose: function(){
			clearInterval(flag);
        },
    	close: function(){
    		$(this).remove();
    	}
    });
}
function pop_loading_second(){
	var pop_loading_second=parseInt($('#pop_loading_second').html());
	pop_loading_second++;
	$('#pop_loading_second').html(pop_loading_second);
}
function pop_loading_close(){
	$('#pop_loading').dialog('close');
}

//更换验证码
function validate_change(){
	$('.validate_img').attr('src',$('#competition_index').val()+'/index.php?ajax=validate&'+ Math.random());
}
