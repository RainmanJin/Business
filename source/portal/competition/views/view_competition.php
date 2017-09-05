<?php
require_once(FILE_ROOT.'/classes/class_competition.php');
$Competition=new Competition($_GET);
$competition=$Competition->Detail();

$title='详情';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div id="wrap">
  <div id="main">
    <div id="competition">
    
      <?php require(FILE_ROOT.'/views/view_competition_header.php'); ?>
      <?php require(FILE_ROOT.'/views/view_competition_left.php'); ?>
      
      <!--中间-->
      <div class="description comp-content with-sidebar _panel">
		<?php require(FILE_ROOT.'/views/view_competition_title.php'); ?>
        
        <div class="comp-content-inside">
          <div id="competition-intro"> </div>
          <div id="comp-homepage-content" class="cms-page _buttons">
          
            <?php echo $competition['description']; ?>
            
            <p id="end-time-note"> 
              <strong>开始时间：</strong> <?php echo $competition['start_time']; ?> <br>
              <strong>结束时间：</strong> <?php echo $competition['end_time']; ?> 
                <?php
				if($competition['deadline']>0){
				?>
                    （剩余<?php echo $competition['deadline']; ?>天） 
               	<?php
				}else{
				?>
                    （已过期<?php echo abs($competition['deadline']); ?>天） 
                <?php
				}
				?>
               <br>
              <?php
			  if($competition['is_pts']==1){
			  ?>
                  <strong>积分：</strong> 这个竞赛给予积分奖励&nbsp;<a href="javascript:;" onclick="$('#pts_rank_help').dialog('open')">积分规则</a> <br>
              <?php
			  }
			  if($competition['is_rank']==1){
			  ?>
                  <strong>等级：</strong> 这个竞赛用于等级计算&nbsp;<a href="javascript:;" onclick="$('#pts_rank_help').dialog('open')">等级规则</a>
              <?php
			  }
			  ?>
            </p>
            
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

<div id="pts_rank_help">
  <p><strong>1.积分规则：</strong></p>
  <p>每次竞赛结束后，所有注册用户的积分重新计算，计算根据用户所参加的所有竞赛结果计算，公式如下：</p>
  <p><img src="<?php echo LINK_ROOT; ?>/images/pts.png" /></p>
  <p># Team Members：本队队员数。</p>
  <p>Team Rank：本队结果名次。</p>
  <p>#Teams：参赛队伍数。</p>
  <p>Time since deadline：竞赛结束到当前时间的间隔（范围是0到2年）。</p>
  <br />

  <p><strong>2.等级规则（等级设置和积分无关）：</strong></p>
  <p>a)初级能手：用户验证注册成功。</p>
  <p>b)竞赛先锋：用户完成一个竞赛，无论排名如何。</p>
  <p>c)数据大师：至少有两次排名在前10%的竞赛成绩；在这些成绩中，至少有一次是排名在前10的。</p>
  <br />
  
</div>

<script type="text/javascript">
$(document).ready(function(){
	$('#pts_rank_help').dialog({
		modal: true,				 
		autoOpen:false,
		resizable:false,
    	modal: true,
		width:800,
		height:550,
		title:'积分等级规则',
		close:function(){
		},
		buttons:{
			'确定':function(){
				$(this).dialog('close');
			}
		}
	});
});
</script>

<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
