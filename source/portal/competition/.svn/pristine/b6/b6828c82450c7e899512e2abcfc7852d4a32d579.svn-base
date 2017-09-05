        <div class="_panel" id="competition-dashboard">
          <header>
            <h1>操作</h1>
            <?php
            if($title=='排行榜'){
			?>
            <div id="triangle">▼</div>
            <?php
			}
			?>
          </header>
          <ul id="competition-dashboard-dropdown">
            <li class="cd-home"><a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>">竞赛详情</a>
              <ul>
                <li class="cd-data"><a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_data&id_competition=<?php echo $competition['id_competition']; ?>">下载数据</a></li>
                <li class="cd-submit submission-link"> 
				  <?php
                  if($competition['deadline']>0&&$competition['enterable']==1){
                      if(isset($_SESSION['user'])){
						  if($_SESSION['user']['active']==1){
							  if($competition['choose']){
								  if($_SESSION['user']['team']){
									  if($_SESSION['user']['is_leader']==1){
										  ?>
										  <a class="comp-link" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_submission&id_competition=<?php echo $competition['id_competition']; ?>">提交数据</a>
										  <?php
									  }else{
										  ?>
										  <a class="comp-link" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_team&id_competition=<?php echo $competition['id_competition']; ?>&team=1">提交数据</a>
										  <?php
									  }
								  }else{
									  switch($competition['choose']){
										  case 1:
										  ?>
										  <a class="comp-link" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_subchoose&id_competition=<?php echo $competition['id_competition']; ?>">提交数据</a>
										  <?php
										  break;
										  
										  case 2:
										  ?>
										  <a class="comp-link" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_submission&id_competition=<?php echo $competition['id_competition']; ?>">提交数据</a>
										  <?php
										  break;
										  
										  case 3:
										  ?>
										  <a class="comp-link" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_team&id_competition=<?php echo $competition['id_competition']; ?>&team=1">提交数据</a>
										  <?php
										  break;
										  
										  default:
										  break;
									  }
								  }
							  }else{
							  ?>	
								  <a class="comp-link" href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_rule&id_competition=<?php echo $competition['id_competition']; ?>&confirm=1">提交数据</a>
							  <?php
							  }
						  }else{
							  if($_SESSION['user']['m_active']==1){
								  ?>
                                  <a class="comp-link" href="javascript:;" onclick="alert('您的帐号因违规或其他特殊原因被管理员禁用！请联系管理员。')">提交数据</a>
                                  <?
							  }else{
								  ?>
                                  <a class="comp-link" href="javascript:;" onclick="pop_validate_email()">提交数据</a>
                                  <?
							  }
						  }
                      }else{
                      ?>
                          <!--<a class="comp-link" href="<?php echo UNITY_INDEX; ?>/index.php?view=login&site=competition">提交数据</a>-->
                          <a class="comp-link" href="javascript:;" onclick="pop_div(360,390,'登录','login','reload')">提交数据</a>
                      <?php
                      }
                  }
                  ?>
                </li>
              </ul>
            </li>
            <li class="cd-info"> <a href="" id="open-info">分类信息</a>
              <ul id="pages-flyout">
                <li> <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>">描述</a> </li>
                <li> <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_evaluation&id_competition=<?php echo $competition['id_competition']; ?>">评价</a> </li>
                <li> <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_rule&id_competition=<?php echo $competition['id_competition']; ?>">规则</a> </li>
				<?php
                if($competition['prize_1']){
                ?>
                    <li> <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_prize&id_competition=<?php echo $competition['id_competition']; ?>">奖励</a> </li>
				<?php
                }
                ?>
                <!--<li> <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition&id_competition=<?php echo $competition['id_competition']; ?>">时间线</a> </li>-->
              </ul>
            </li>
            <!--<li class="cd-forum"><a href="https://www.kaggle.com/c/afsis-soil-properties/forums">论坛</a></li>-->
            <li class="cd-leaderboard"> <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_leaderboard&id_competition=<?php echo $competition['id_competition']; ?>">排行榜</a> </li>
			<?php
            if(isset($_SESSION['user'])&&$_SESSION['user']['active']==1&&$competition['choose']){
                ?>
                <li class="cd-team <?php if($_GET['view']=='competition_team'){echo 'selected';} ?>">
                  <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_team&id_competition=<?php echo $competition['id_competition']; ?>">我的团队</a> 
                </li>
                <?php
            }
            ?>
            
			<?php
            if(isset($_SESSION['user'])&&$_SESSION['user']['active']==1&&$competition['choose']){
                ?>
                <li class="cd-submissions <?php if($_GET['view']=='competition_sublist'){echo 'selected';} ?>">
                  <a href="<?php echo COMPETITION_INDEX; ?>/index.php?view=competition_sublist&id_competition=<?php echo $competition['id_competition']; ?>">我的提交</a>
                </li>
				<?php
            }
			?>
          </ul>
        </div>
        
        <script>
		function pop_validate_email(){
			//alert('如想参与竞赛请先验证邮箱！');
			pop_div(360,320,'验证邮箱','email','reload');
		}
		</script>
