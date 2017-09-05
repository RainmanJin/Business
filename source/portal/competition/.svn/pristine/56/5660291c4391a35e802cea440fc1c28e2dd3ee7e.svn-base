<?php 
if(!isset($_SESSION['user'])&&!isset($_GET['id_user'])){
	header('location:'.UNITY_INDEX.'/index.php?view=login&site=competition');

}

$user=$User->User_detail($_GET);

//等级中文
$rank_zh=$User->rank_zh;

$title=$user['display_name'];
?>

<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<style>
.profile th{
	color:#CCC;
	font-size:24px;
	text-align:left;
	border-top:1px solid #ccc
	
}
.profile td{
	height:50px;
	vertical-align:top
}
.shu{
	border-right:1px solid #ccc
	
}
.profile-comp-list td{
	border-bottom:1px solid #ccc;
	background:#ecf9ff
}
</style>

<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/css/profiles.less.css" type="text/css" />
<link rel="stylesheet" href="<?php echo LINK_ROOT; ?>/css/jquery.Jcrop.css" type="text/css" />
<script type="text/javascript" src='<?php echo LINK_ROOT; ?>/js/jquery.Jcrop.js'></script>


<div id="main">
  <div class="kaggle content">
    <div id="profile2">
    
      <!-- ko with:profile -->
      <div id="profile2-head" data-bind="init: results.load, css: false ? &#39;kaggle team&#39; : tierName" class="<?php echo $user['rank'];  ?>">
        <div id="profile2-card">
          <h1 data-bind="text: name, style: { cursor: &#39;pointer&#39; }, click: gotoUrl" style="cursor: pointer;" <?php if(isset($_SESSION['user'])&&$user['id_user']==$_SESSION['user']['id_user']){?> onclick="$('#account_edit').dialog('open')"<?php } ?>><?php echo $user['display_name']; ?></h1>
        </div>
        <!--头像-->
        <div id="profile2-stats" data-bind="visible: true">
          <div id="profile2-ranking">
            <h3 id="tier-info"> 
              <span id="tier-text" data-bind="text: false ? &#39;kaggle team&#39; : tierName"><?php echo $rank_zh[$user['rank']]; ?></span> 
              <a class="tier-popup" href="javascript:;" onclick="rank_help()">?</a> 
            </h3>
            
            <!--<div id="ranking-highest">
              <h6>最高</h6>
              <h4 data-bind="text: highestRankingText">第5</h4>
            </div>-->
            
            <!--<div id="ranking-current">
              <h6 data-bind="if: ranking() != highestRanking()">当前</h6>
              <h4 data-bind="text: rankingText">第15</h4>
              <h5 data-bind="with: $root.global().load">/<span data-bind="    text: playersText">225,324</span></h5>
            </div>-->
            
            <h6>  <?php //if($user['score']>0){echo $user['score'].'分';} ?> <?php if($user['pts']>0){echo $user['pts'].'分';} ?> <br>
            在 <span data-bind="timeago: registered" class="timeago" title=""><?php echo $user['togo']; ?> 天前加入</span> 
            </h6>
          </div>
          <img id="profile2-avatar" width="240" height="240" src="<?php echo $user['image']; ?>" alt="" title="" data-bind="attr: { src: gravatarUrl(240, 240) }" <?php if(isset($_SESSION['user'])&&$user['id_user']==$_SESSION['user']['id_user']){?>onclick="$('#profile_edit').dialog('open')"<?php } ?> /> 
        </div>
      </div>
      
      <!-- 标签 -->
      <div id="tabs">
        <ul>
          <li> <a href="#tab1">总览</a> </li>
          <li> <a href="#tab2">竞赛</a> </li>
		  <?php
          if(isset($_SESSION['user'])&&$user['id_user']==$_SESSION['user']['id_user']){
          ?>
              <li> <a href="#tab3" >账号</a> </li>
          <?php
          }
          ?>
        </ul>
        
        <div id="tab1">
          <table border="0" width="100%" cellpadding="12" class="profile">
            <?php
			if(isset($_SESSION['user'])&&$user['id_user']==$_SESSION['user']['id_user']){
			?>
                <tr>
                  <td colspan="2" style="background:#fffce2; vertical-align:middle; text-align:center"><button class="ju_button" onclick="$('#profile_edit').dialog('open')">编辑总览</button></td>
                </tr>
            <?php
			}
			?>
            <tr>
              <th class="shu" width="50%">简历</th>
              <th>技能</th>
            </tr>
            <tr>
              <td class="shu"><?php echo $user['bio']; ?></td>
              <td><?php echo $user['skill']; ?></td>
            </tr>
            
            <!--<tr>
              <th class="shu">技能</th>
              <th>&nbsp;</th>
            </tr>
            <tr>
              <td class="shu"><?php echo $user['skill']; ?></td>
              <td>&nbsp;</td>
            </tr>-->
          </table>
          
          
          <!--tab1_end-->
        </div>
        
        <div id="tab2">
          <table class="profile-comp-list" data-bind="foreach: fullResults" border="0" width="100%">
            <?php
			if($user['result']){
				foreach($user['result'] as $result){
			?>
                    <tbody>
                      <tr>
                        <td width="100">
                          <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $result['id_competition']; ?>" target="_blank"> 
                            <img height="76" width="76"  src="<?php echo $result['image']; ?>"> 
                          </a>
                        </td>
                        
                        <td class="comp-details">
                          <h4> 
                          <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $result['id_competition']; ?>" target="_blank"><?php echo $result['name_competition']; ?></a> 
                          </h4>
                          <span><?php echo $result['my_entries']; ?> 个提交</span>
                        </td>
                        
                        <td class="comp-time">
                          <h5>当前</h5>
                          <strong><?php echo $result['my_entries']; ?></strong>/<span><?php echo $result['entries']; ?></span>
                          <h6 > 
                          <?php
						  if($result['deadline']>0){
							  ?>
                              结束于 <span><?php echo $result['deadline']; ?>天后</span> 
                              <?php
						  }else{
							  ?>
                              已过期 <span><?php echo abs($result['deadline']); ?>天</span> 
                              <?php
						  }
						  ?>
                          </h6>
                        </td>
                      </tr>
                    </tbody>
            <?php
				}
			}else{
			?>
            	<tr><td colspan="3">暂无任何参与</td></tr>
            <?php
			}
			?>
          </table>
          <!--tab2_end-->
        </div>
        
		<?php
        if(isset($_SESSION['user'])&&$user['id_user']==$_SESSION['user']['id_user']){
		?>
			<div id="tab3">
              <div style="clear:both"></div>
              <div style="float:left; border-right:1px solid #ccc; width:50%; height:400px">
                <table border="0" width="100%" cellpadding="8">
                  <tr>
                    <th style="font-size:24px; text-align:left; color:#ccc">帐号</th>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                  <tr>
                    <td>昵称</td>
                  </tr>
                  <tr>
                    <td><strong><?php echo $_SESSION['user']['display_name']; ?></strong><!--&nbsp;<a href="javascript:;" style="color:#20beff">修改</a>--></td>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                  <tr>
                    <td>真实/合法的姓名</td>
                  </tr>
                  <tr>
                    <td><strong><?php echo $_SESSION['user']['legal_name']; ?></strong><!--&nbsp;<a href="javascript:;" style="color:#20beff">修改</a>--></td>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                  </tr>
                  <tr>
                    <td><strong><?php echo $_SESSION['user']['email']; ?></strong><!--&nbsp;<a href="javascript:;" style="color:#20beff">修改</a>--></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><button class="ju_button" onclick="$('#account_edit').dialog('open')">修改</button></td>
                  </tr>
                </table>
              </div>
              
              <div style="float:right; border:0px solid #ccc; width:49%; height:400px">
                <table border="0" width="100%" cellpadding="8">
                  <tr>
                    <th style="font-size:24px; text-align:left; color:#ccc">我的登录状态</th>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="background:#eee"><font size="+1"><?php echo $_SESSION['user']['name_user']; ?></font> | 
                    <!--<a href="javascript:;" style="color:#20beff">修改用户名</a> 或-->
                    <a href="javascript:;" style="color:#20beff" onclick="$('#password_edit').dialog('open')">修改密码</a></td>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                  <!--<tr>
                    <td><a href="<?php echo COMPETITION_INDEX; ?>/index.php?ajax=user&op=logout">登出</a> </td>
                  </tr>-->
                </table>
              </div>
              <div style="clear:both"></div>
			  <!--tab3_end-->
			</div>
		<?php
        }
        ?>
        
        <!--tab_end-->
      </div>
      
    </div>
  </div>
</div>



<!--等级说明弹出层-->
<div id="tiers-info-popup" style="display:none;">
  <ul>
    <li id="tier-info-master"> <img src="<?php echo LINK_ROOT; ?>/images/tier-big-master.png" alt="Master">
      <h1><?php echo $rank_zh['master']; ?></h1>
      <p> 顶级的数据专家，拥有很多成功的提交结果经验的重要参与者。 </p>
    </li>
    <li id="tier-info-kaggler"> <img src="<?php echo LINK_ROOT; ?>/images/tier-big-kaggler.png" alt="Kaggler">
      <h1><?php echo $rank_zh['kaggler']; ?></h1>
      <p> 积极参与竞赛的活跃者。 </p>
    </li>
    <li id="tier-info-novice"> <img src="<?php echo LINK_ROOT; ?>/images/tier-big-novice.png" alt="Novice">
      <h1><?php echo $rank_zh['novice']; ?></h1>
      <p> 刚开始加入进来参加竞赛的菜鸟。 </p>
    </li>
  </ul>
  <!--<p style="text-align:center; margin:2em 0 1em; font-size:15px;"> <a href="https://www.kaggle.com/wiki/UserRankingAndTierSystem" target="_blank">更多信息关于我们的用户等级&amp;层级系统 »</a> </p>-->
  <script type="text/javascript">
  jQuery(function($) {
      $('body').on('click', 'a.tier-popup', function() {
          $('#tiers-info-popup').dialog({
              'modal':true,
              'width':640,
              'title':"用户等级",
              'resizable':false,
              'dialogClass': 'nicedialog'
          });
      });
  });
  </script>
</div>


<!--编辑总览弹出层-->
<div id="profile_edit">
  <div style="float:left; width:400px; border:0px solid #ccc">
    <div>
      简历
      <textarea id="bio" style="width:100%; height:200px"><?php echo $_SESSION['user']['bio']; ?></textarea>
    </div>
    <div style="margin-top:5px">
      技能
      <textarea id="skill" style="width:100%; height:200px"><?php echo $_SESSION['user']['skill']; ?></textarea>
    </div>
  </div>
  <div style="float:right; width:330px; border:0px solid #ccc">
    头像（支持格式jpg，jpeg，png，gif）
	<!--裁剪-->
    <div style="width:320px; height:320px;  border:1px solid #ccc">
      <input type="hidden" id="x" name="x" />
      <input type="hidden" id="y" name="y" />
      <input type="hidden" id="w" name="w" />
      <input type="hidden" id="h" name="h" />
      <input type="hidden" id="name_image" name="name_image" />
      <img src="" id="user_image" />
    </div>
    <!--上传-->
    <div style="margin-top:5px">
      <input type="file" id="file_image" />
    </div>
  </div>
</div>

<!--账户弹出层-->
<div id="account_edit">
 <p>
   昵称</p>
  <p> <input type="text" id="display_name" size="30" value="<?php echo $_SESSION['user']['display_name']; ?>" />
 </p>
 <p>
   真实/合法的姓名</p>
  <p> <input type="text" id="legal_name" size="30" value="<?php echo $_SESSION['user']['legal_name']; ?>" />
 </p>
</div>

<!--密码弹出层-->
<div id="password_edit">
 <p>
   密码</p>
  <p> <input type="password" id="password" size="30" value="" /><input type="hidden" id="id_user" value="<?php echo $_SESSION['user']['id_user']; ?>" />
 </p>
 <p>
   确认密码</p>
  <p> <input type="password" id="password_confirm" size="30" value="" />
 </p>
</div>


<!--<script type="text/javascript" src='<?php echo LINK_ROOT; ?>/js/croppic.js'></script>
<script>
</script>
<style>
#cropContainerHeader{
	width:300px;
	height:200px;
	position:relative
}
</style>
<div id="croppic_image">
dsf
</div>-->

<script type="text/javascript">
$(document).ready(function(){
	$('#tabs').tabs();
	$('#ju_button').button();
	
	$('#profile_edit').dialog({
		modal: true,				 
		autoOpen:false,
		resizable:false,
    	modal: true,
		width:800,
		height:600,
		title:'编辑总览',
		buttons:{
			'确定':function(){
				profile_edit();
			},
			'取消':function(){
				$(this).dialog('close');
			}
		}
	});
	$('#account_edit').dialog({
		modal: true,				 
		autoOpen:false,
		resizable:false,
    	modal: true,
		width:300,
		height:300,
		title:'修改账号',
		buttons:{
			'确定':function(){
				account_edit();
			},
			'取消':function(){
				$(this).dialog('close');
			}
		}
	});
	$('#password_edit').dialog({
		modal: true,				 
		autoOpen:false,
		resizable:false,
    	modal: true,
		width:300,
		height:300,
		title:'修改密码',
		buttons:{
			'确定':function(){
				password_edit();
			},
			'取消':function(){
				$(this).dialog('close');
			}
		}
	});
	
	//var cropperHeader=new Crop('croppic_image');
	/*var cropperHeader=new Crop('croppic_image',cropperOptions);
	var cropperOptions={
		uploadUrl:''
	}*/
	
	var jcrop_api;
    //var c = {"x":13,"y":7,"x2":487,"y2":107,"w":474,"h":100};
	$('#user_image').Jcrop({
		//bgFade: false,
		//setSelect: [c.x,c.y,c.x2,c.y2],
		//bgColor:'#fff',
		onSelect: updateCoords,
		aspectRatio:1,
		boxWidth:320,
		boxHeight:320,
	},function(){
		jcrop_api = this;
	});
	
	function updateCoords(c){
	  $('#x').val(c.x);
	  $('#y').val(c.y);
	  $('#w').val(c.w);
	  $('#h').val(c.h);
	}
	
	$("#file_image").uploadify({	
		swf:$('#competition_index').val()+"/js/uploadify.swf",
		uploader:$('#competition_index').val()+"/index.php?ajax=user&op=user_image&time="+ new Date().getTime(),
		auto:true,
		width:200,
		height:30,
		queueSizeLimit : 1,
		buttonText:"选择文件",
		onUploadStart:function(){
			pop_loading();
		},
		onUploadSuccess:function(file, data, response){
			
			/*if(data){
				alert(data);
				pop_loading_close();
				return false;
			}*//*else{
				window.location=$('#competition_index').val()+"/index.php?view=competition_sublist&id_competition="+url_get('id_competition');
			}*/
			//alert($('#link_root').val()+'/images/tmp/'+file.name);
			$('#name_image').val(file.name);
			jcrop_api.setImage(data,function(){
				this.setSelect([0,0,150,150]);	
				pop_loading_close();
			});
			//jcrop_api.setSelect([c.x,c.y,c.x2,c.y2]);
			//setTimeout(setxy,2000);
			//$('#user_image').attr('src',data);
			//$('#user_image').show();
		}
	});
	
	/*function setxy(){
		jcrop_api.setSelect([c.x,c.y,c.x2,c.y2]);
	}*/

});

function profile_edit(){
	$.ajax({
		url:$('#competition_index').val()+"/index.php?ajax=user&op=profile_edit&time="+ new Date().getTime(),
		data:'bio='+$('#bio').val()+'&skill='+$('#skill').val()+'&x='+$('#x').val()+'&y='+$('#y').val()+'&w='+$('#w').val()+'&h='+$('#h').val()+'&name_image='+$('#name_image').val(),
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
				window.location=$('#competition_index').val()+"/index.php?view=my#tab1";
				window.location.reload();
			}
		}
	});
}

function account_edit(){
	$.ajax({
		url:$('#competition_index').val()+"/index.php?ajax=user&op=account_edit&time="+ new Date().getTime(),
		data:'display_name='+$('#display_name').val()+'&legal_name='+$('#legal_name').val(),
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
				window.location=$('#competition_index').val()+"/index.php?view=my#tab3";
				window.location.reload();
			}
		}
	});
}

function password_edit(){
	if(!$("#password").val()){
		alert("请填写您的密码！");
		return false;
	}else{
	}
	if($("#password").val().length<8){
		alert("密码不能少于8位！");
		return false;
	}else{
	}
	if(!$("#password_confirm").val()){
		alert("请确认您的密码！");
		return false;
	}else{
	}
	if($("#password").val()!=$("#password_confirm").val()){
		alert("两次密码填写不一致！");
		return false;
	}else{
	}
	//$('#competition_index').val()+"/index.php?ajax=user&op=password_edit&time="+ new Date().getTime(),
	$.ajax({
		url:$('#unity_index').val()+"/index.php?ajax=user&op=password_modify&time="+ new Date().getTime(),
		data:'password='+$('#password').val()+'&id_user='+$('#id_user').val(),
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
				//window.location=location.href+'#tab3';
				window.location=$('#competition_index').val()+"/index.php?view=my#tab3";
				//window.location.reload();
			}
		}
	});
}
</script>




<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
