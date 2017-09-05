<?php
require_once(FILE_ROOT.'/classes/class_competition.php');
$Competition=new Competition($_GET);
$competition=$Competition->Detail();

$title='排行榜';
?>
<?php require(FILE_ROOT.'/views/view_header.php'); ?>

<div id="wrap">
  <div id="main">
    <div id="competition">
    
      <?php require(FILE_ROOT.'/views/view_competition_header.php'); ?>
      
      <div id="comp-dash-header" class="comp-sidebar">
        <?php require(FILE_ROOT.'/views/view_competition_dashboard.php'); ?>

        <div id="comp-dash-header-title">
          <h1> 公开的排行榜 - <?php echo $competition['name_competition']; ?> </h1>
        </div>
      </div>
      
      <div class="public-leaderboard---american-epilepsy-society-seizure-prediction-challenge-page comp-content full-width">
        <div class="comp-content-inside">
          <div id="competition-intro"> </div>
          <div id="leaderboard-conditions">
            <p>本排行榜包含大约40%的测试数据。<br>
              最终结果基于其中的60%，所以会和现在有所不同</p>
          </div>
          <div id="puppet-message"> 发现有用户拥有多个账户》<br>
            <a href="<?php echo CLOUD_INDEX; ?>/index.php/0" target="_blank">告诉我们。</a> 
          </div>
          <div id="leaderboard-container">
            <table id="leaderboard-table" class="oddeventable" border="0">
              <colgroup>
              <col class="leader-position">
              <!--<col class="leader-position">-->
              <col class="leader-teamname">
              <col class="leader-metric">
              <col class="leader-entries">
              <col class="leader-latestsub">
              </colgroup>
              <tbody>
                <tr>
                  <th width="10%">#</th>
                  <!--<th>Δ1w</th>-->
                  <th width="30%"> 团队
                    <div id="leaderboard-legend"> <!--<span>* in the money</span>--> </div>
                  </th>
                  <th width="20%" title="AUC"> 得分 <img src="<?php echo LINK_ROOT; ?>/images/leaderboard-help-icon.png" alt="Score Help"> </th>
                  <th width="20%">提交次数</th>
                  <th> 提交时间 </th>
                </tr>
                
                <?php
				if($competition['leaderboard']){
					foreach($competition['leaderboard'] as $key=>$leaderboard){
					?>
                        <tr id="team-114482">
                          <td class="leader-number"><?php echo $key+1; ?></td>
                          <!--<td class="delta"><span style="color:Green">↑2</span><span style="color:Red">↓2</span><span>-</span></td>-->
                          <td>
                            <?php
							if($leaderboard['is_leader']){
							?>
                                <a href="javscript:;" onclick="membertoggle(<?php echo $leaderboard['id_user']; ?>)"> 
								<?php echo $leaderboard['display_name']; ?> 
                                </a> 
							<?php
							}else{
							?>
                            	<a class="team-link single-player" target="_blank" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=my&id_user=<?php echo $leaderboard['id_user']; ?>">
								<?php echo $leaderboard['display_name']; ?> 
                                </a> 
                            <?php
							}
							?>
							
                            <!--<span class="asterisk">*</span>-->
                            <?php
							if($leaderboard['is_leader']){
							?>
                                <img class="team-icon" src="<?php echo LINK_ROOT; ?>/images/leaderboard-team.png">
								<ul class="team-members" id="member_<?php echo $leaderboard['id_user']; ?>" style="border:0px solid #ccc; width:70%; margin-left:30%; text-align:left">
                                  <?php
								  foreach($leaderboard['member'] as $member){
								  ?>
								  		<li class="profilelink">
                                          <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=my&id_user=<?php echo $member['id_user']; ?>" target="_blank"><?php echo $member['display_name']; ?></a>
                                        </li>
								  <?php
								  }
								  ?>
								</ul>								
                            <?php
							}
							?>
                          </td>
                          <td><a name="0.83403"></a> <abbr class="score" title="0.01204"><?php echo $leaderboard['score']; ?></abbr></td>
                          <td><?php echo $leaderboard['entries']; ?></td>
                          <td>
                          <?php echo $leaderboard['submission_time']; ?>
                          </td>
                        </tr>
                    <?php	
					}
				}else{
					?>
                    <tr>
                      <td colspan="6">暂无任何团队或个人参与</td>
                    </tr>
                    <?php
				}
                ?>
                
              </tbody>
            </table>
          </div>
          <!--<div class="table-footer"> <a href="http://www.kaggle.com/c/3960/publicleaderboarddata.zip" class="raw-data">下载不成熟的数据</a> </div>-->
          
        </div>
      </div>
      
    </div>
  </div>
</div>

<script type="text/javascript">
function membertoggle(id_user){
	if($('#member_'+id_user).css('display')=='none'){
		$('#member_'+id_user).show();
	}else{
		$('#member_'+id_user).hide();
	}
}
</script>

<?php require(FILE_ROOT.'/views/view_footer.php'); ?>
