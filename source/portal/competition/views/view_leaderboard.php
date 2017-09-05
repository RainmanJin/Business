<?php
$all=$User->Leaderboard($_GET);
$page_bottom=$all[0];
$leaderboard=$all[1];

$title='总排行榜';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<style>
#main a{
	font-size:18px;
}
</style>

<div id="wrap">
  <div id="main">
    <div class="kaggle content">
      <h1><a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=leaderboard" style="font-size:36px"><?php echo $title; ?></a></h1>
      <p>竞赛者用他们的能力在竞赛中赚取积分。本页面用于显示当前的总排行。想知道如何赚取更多积分，请查看&nbsp;<a href="javascript:;" onclick="$('#pts_rank_help').dialog('open')">积分规则</a>。</p>
      <div class="full-width">
        <div id="users-navbar">
          <!--Sorted by <a class="selected" href="#">Rank</a> (Beta) -->
        </div>
        <ul class="users-list">
        
        <?php
		if($leaderboard){
			foreach($leaderboard as $user){
			?>
                <li>
                  <div class="user-stat">
                    <div class="rank">第<?php echo $user['place']; ?>名</div>
                    <?php echo $user['pts']; ?>分 
                  </div>
                  <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=my&id_user=<?php echo $user['id_user']; ?>" target="_blank">
                    <img src="<?php echo $user['image']; ?>" width="100" height="100">
                  </a>
                  <h4><a class="profilelink" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=my&id_user=<?php echo $user['id_user']; ?>" target="_blank"><?php echo $user['display_name']; ?></a></h4>
                  <!--<p> <span class="comps"><?php echo $user['submission']; ?></span><br>
                    NYC<br>
                    United States<br>
                  </p>-->
                </li>
			<?php
			}
		}else{
			?>
			<li>暂无任何用户</li>
            <?php
		}
		?>
        </ul>
        <div id="user-pages">
		  <?php echo $page_bottom; ?>
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
